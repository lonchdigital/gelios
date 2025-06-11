<?php

namespace App\Services\Admin\Directions;

use App\Models\Page;
use App\Models\Contact;
use App\Models\Direction;
use Illuminate\Support\Str;
use App\Models\PageDirection;
use App\Models\DirectionPrice;
use App\Models\DirectionInfoBlock;
use App\Models\DirectionTextBlock;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;


class DirectionsService 
{
    public function setCurrentDirectionData(Direction $direction)
    {
        $data = [];

        $data['slug'] = $direction->page->slug;
        $data['in_footer'] = $direction->in_footer;

        foreach ($direction->getTranslationsArray() as $lang => $value) {
            $data['name'][$lang] = $value['name'];
        }
        foreach ($direction->getTranslationsArray() as $lang => $value) {
            $data['short_name'][$lang] = $value['short_name'];
        }
        
        return $data;
    }

    public function getAllOffices(): Collection
    {
        return Contact::all();
    }
    public function setCurrentdirectionContacts(Direction $direction): array
    {
        $data = [];
        foreach($direction->contacts as $contact) {
            $data[] = $contact->id;
        }

        return $data;
    }


    public function getAllDirections(): Collection
    {
        return Direction::with('children.children')->whereNull('parent_id')->orderBy('sort')->get();
    }
    public function getAllDirectionsExceptOne(Direction $direction)
    {
        $excludedId = $direction->id;
        // return Direction::with('children.children')
        //     ->whereNull('parent_id')
        //     ->where('id', '!=', $direction->id)
        //     ->orderBy('sort')
        //     ->get();

        return Direction::with('children.children')
            ->whereNull('parent_id')
            ->orderBy('sort')
            ->get()
            ->map(function ($direction) use ($excludedId) {
                return $this->filterDirection($direction, $excludedId);
            })->filter(); 
    }
    private function filterDirection($direction, $excludedId) 
    {

        if ($direction->id == $excludedId) {
            return null;
        }
    
        // filter children
        $direction->children = $direction->children->map(function ($child) use ($excludedId) {
            return $this->filterDirection($child, $excludedId);
        })->filter();
    
        return $direction;
    }

    public function getDirectionsByCategory(int $parentId): Collection
    {
        return Direction::with('children.children')->where('parent_id', $parentId)->orderBy('sort')->get();
    }

    public function removeDirectionWithChildren(int $id)
    {
        $direction = Direction::find($id);

        $allChildren = $this->getDirectionsByCategory($direction->id);
        $this->removeChildrenDirections($allChildren);

        $this->removeDirection($direction);
    }

    private function removeChildrenDirections(Collection $directions)
    {
        foreach($directions as $direction){
            if(count($direction->children) > 0) {
                $this->removeChildrenDirections($direction->children);
            }
            $this->removeDirection($direction);
        }
    }

    private function removeDirection(Direction $direction)
    {
        $direction->contacts()->sync([]);

        $this->removeTextBlocks($direction);

        $existingDirectionPrices = DirectionPrice::where('direction_id', $direction->id)->get();
        $this->syncPrices([], $existingDirectionPrices, $direction->id);

        $existingDirectionInfo = DirectionInfoBlock::where('direction_id', $direction->id)->get();
        $this->syncInfo([], $existingDirectionInfo, $direction->id);

        $directionPage = $direction->page;
        $direction->delete();
        $directionPage->delete();
    }

    public function addDirection(array $data)
    {
        DB::transaction(function () use ($data) {
            $page = $this->createPage($data);
            $this->createDirection($data, $page);
        });
    }

    private function createPage(array $data)
    {
        $dataToUpdate = [];

        $dataToUpdate['slug'] = $data['directionSlug'];

        foreach ($data['directionName'] as $lang => $value) {
            $dataToUpdate[$lang]['name'] = $value;
        }

        $page = PageDirection::create($dataToUpdate);
        return $page;
    }

    private function createDirection(array $data, PageDirection $page)
    {
        $dataToUpdate = [];
        $dataToUpdate['page_direction_id'] = $page->id;
        $dataToUpdate['template'] = $data['directionTemplate'];
        $dataToUpdate['parent_id'] = $data['directionParent'];

        foreach ($data['directionName'] as $lang => $value) {
            $dataToUpdate[$lang]['name'] = $value;
        }

        $direction = Direction::create($dataToUpdate);

        $direction->contacts()->sync($data['directionContacts']);
    }

    public function updateDirection(Direction $direction, array $data)
    {
        $dataToUpdate = [];
        $dataToUpdate['parent_id'] = $data['parent_id'];
        $dataToUpdate['in_footer'] = $data['in_footer'];

        if($data['name']) {
            foreach ($data['name'] as $lang => $value) {
                $dataToUpdate[$lang]['name'] = $value;
            }
        }
        if($data['short_name']) {
            foreach ($data['short_name'] as $lang => $value) {
                $dataToUpdate[$lang]['short_name'] = $value;
            }
        }

        $direction->update($dataToUpdate);
    }

    public function getCachedDirectionsForDashboard()
    {
        $locale = app()->getLocale();

        return Cache::remember("all_directions_dashboard_{$locale}", now()->addWeek(), function () {
            return $this->buildTreeForDashboard($this->getAllDirections());
        });
    }
    public function getCachedDirections()
    {
        $locale = app()->getLocale();

        return Cache::remember("all_directions_{$locale}", now()->addWeek(), function () {
            return $this->buildTree($this->getAllDirections(), true);
        });
    }
    public function buildTree($directions, $collection = false)
    {
        $tree = [];
        $locale = app()->getLocale();
        $locale = ($locale === 'ru') ? '' : $locale;

        foreach ($directions as $direction) {
            $children = $direction->children->isNotEmpty() 
                ? $this->buildTree($direction->children, true) 
                : [];

            $tree[] = [
                'id' => $direction->id,
                'name' => $direction->short_name,
                'template' => $direction->template,
                'children' => $children,
                'slug' => $direction->page->slug,
                'full_path' => url($locale . '/' . $direction->buildFullPath())
            ];
        }

        if($collection) {
            return collect($tree);
        } else {
            return $tree;
        }
    }


    public function buildTreeForOneContact(Collection $directions, Collection $validDirections, $parentId = null)
    {
        $tree = [];
        $addedIds = collect(); // Track already added elements to avoid duplicates

        foreach ($directions as $direction) {
            // Skip the element if it is not in the list of valid directions
            if (!$validDirections->has($direction->id)) {
                continue;
            }

            // Check if the element is a child of another element
            $isChild = $validDirections->contains('id', $direction->parent_id);

            // If the element has a parent, but that parent is not valid, treat it as a root element
            if ($isChild && !$validDirections->has($direction->parent_id)) {
                $isChild = false;
            }

            // If the element has a parent, it should only be added as a child
            if ($parentId === null && $isChild) {
                continue;
            }

            // Filter only valid children
            $children = $direction->children->filter(fn($child) => $validDirections->has($child->id));

            // Add the element if it hasn't been added yet
            if (!$addedIds->contains($direction->id)) {
                $tree[] = [
                    'id' => $direction->id,
                    'name' => $direction->short_name,
                    'template' => $direction->template,
                    'children' => $this->buildTreeForOneContact($children, $validDirections, $direction->id),
                    'slug' => optional($direction->page)->slug,
                    'full_path' => url($direction->buildFullPath()),
                ];
                $addedIds->push($direction->id);
            }
        }

        return $tree;
    }


    public function buildTreeForDashboard($directions)
    {
        $tree = [];
        $locale = app()->getLocale();
        $locale = ($locale === 'ru') ? '' : $locale;

        foreach ($directions as $direction) {
            $children = $direction->children->isNotEmpty() 
                ? $this->buildTreeForDashboard($direction->children) 
                : [];

            $tree[] = [
                'id' => $direction->id,
                'name' => $direction->name,
                'template' => $direction->template,
                'children' => $children,
                'slug' => $direction->page->slug,
                'full_path' => url($locale . '/' . $direction->buildFullPath())
            ];
        }

        return $tree;
    }

    public function getAllDirectionsWithParents(Collection $directions): Collection
    {
        $parentIds = $directions->pluck('parent_id')->filter()->unique();

        $parents = Direction::whereIn('id', $parentIds)->get();

        return $directions->merge($parents);
    }

    public function updatePage(PageDirection $page, array $data, array $directionData)
    {
        $dataToUpdate = [];

        $dataToUpdate['slug'] = $directionData['slug'];

        if($directionData['name']) {
            foreach ($directionData['name'] as $lang => $value) {
                $dataToUpdate[$lang]['name'] = $value;
            }
        }

        if($data['meta_title']) {
            foreach ($data['meta_title'] as $lang => $value) {
                $dataToUpdate[$lang]['meta_title'] = $value;
            }
        }

        if($data['meta_description']) {
            foreach ($data['meta_description'] as $lang => $value) {
                $dataToUpdate[$lang]['meta_description'] = $value;
            }
        }

        if($data['meta_keywords']) {
            foreach ($data['meta_keywords'] as $lang => $value) {
                $dataToUpdate[$lang]['meta_keywords'] = $value;
            }
        }

        if($data['seo_title']) {
            foreach ($data['seo_title'] as $lang => $value) {
                $dataToUpdate[$lang]['seo_title'] = $value;
            }
        }

        if($data['seo_text']) {
            foreach ($data['seo_text'] as $lang => $value) {
                $dataToUpdate[$lang]['seo_text'] = $value;
            }
        }

        $page->update($dataToUpdate);
    }

    public function setMainDirectionPage(Page $page)
    {
        $data = [];

        if( !empty($page->getTranslationsArray()) ) {
            foreach ($page->getTranslationsArray() as $lang => $value) {
                $data['title'][$lang] = $value['title'];
            }
        } else {
            $data['title'] = [];
        }

        return $data;
    }

    public function updateMainDirectionPage(Page $page, array $data)
    {
        $dataToUpdate = [];

        if($data['title']) {
            foreach ($data['title'] as $lang => $value) {
                $dataToUpdate[$lang]['title'] = $value;
            }
        }

        $page->update($dataToUpdate);
    }

    private function removeTextBlocks(Direction $direction)
    {
        $textBlocks = DirectionTextBlock::where('direction_id', $direction->id)->get();

        foreach ($textBlocks as $textBlock) {
            removeImageFromStorage($textBlock->image);
            $textBlock->delete();
        }
    }

    public function updateTextBlock(array $data)
    {
        $dataToUpdate = [];
        $dataToUpdate['direction_id'] = $data['direction_id'];
        $dataToUpdate['number'] = $data['number'];
        $dataToUpdate['is_reverse'] = $data['is_reverse'];
        $dataToUpdate['is_image'] = $data['is_image'];
        $dataToUpdate['button_one_url'] = isset($data['button_one_url']) ? $data['button_one_url'] : null;

        if(!is_null($data['text_one'])) {
            foreach ($data['text_one'] as $lang => $value) {
                $dataToUpdate[$lang]['text_one'] = $value;
            }
        }
        if(!is_null($data['text_two'])) {
            foreach ($data['text_two'] as $lang => $value) {
                $dataToUpdate[$lang]['text_two'] = $value;
            }
        }

        if(isset($data['image']) && isset($data['image']['newImage'])) {
            if(isset($data['image']['image'])) {
                removeImageFromStorage($data['image']['image']);
            }
            $image = downloadImage('/directions', $data['image']['newImage']);
            $dataToUpdate['image'] = $image;
        }

        $existingTextBlock = DirectionTextBlock::where('number', $data['number'])->where('direction_id', $data['direction_id'])->first();

        if(!is_null($existingTextBlock)) {
            $existingTextBlock->update($dataToUpdate);
        } else {
            DirectionTextBlock::create($dataToUpdate);
        }
    }

    public function setPrices(Collection $directionPrices)
    {
        $data = [];

        foreach($directionPrices as $directionPrice) {
            $service = [];
            if(!is_null($directionPrice)) {
                foreach ($directionPrice->getTranslationsArray() as $lang => $value) {
                    $service[$lang] = $value['service'];
                }
            }

            $price = [];
            if(!is_null($directionPrice)) {
                foreach ($directionPrice->getTranslationsArray() as $lang => $value) {
                    $price[$lang] = $value['price'];
                }
            }

            $data[] = [
                'id' => $directionPrice->id,
                'sort' => $directionPrice->sort,
                'price' => $price,
                'service' => $service,
                'is_free' => $directionPrice->is_free,
            ];
        }

        return $data;
    }

    public function setInfoData(Collection $directionInfoBlocks)
    {
        $data = [];

        foreach($directionInfoBlocks as $directionInfoBlock) {
            $title = [];
            $description = [];

            if(!is_null($directionInfoBlock)) {
                foreach ($directionInfoBlock->getTranslationsArray() as $lang => $value) {
                    $title[$lang] = $value['title'];
                }
                foreach ($directionInfoBlock->getTranslationsArray() as $lang => $value) {
                    $description[$lang] = $value['description'];
                }
            }

            $data[] = [
                'id' => $directionInfoBlock->id,
                'title' => $title,
                'description' => $description
            ];
        }

        return $data;
    }

    public function syncInfo(array $infoItems, Collection $existingInfoItems, int $directionId)
    {
        foreach( $infoItems as $infoItem ) {
            $existingInfoItem = $existingInfoItems->where('id', $infoItem['id'])->first();

            if( !is_null($existingInfoItem) ) {
                if($infoItem['title']) {
                    foreach ($infoItem['title'] as $lang => $value) {
                        $dataToUpdate[$lang]['title'] = $value;
                    }
                }
                if($infoItem['description']) {
                    foreach ($infoItem['description'] as $lang => $value) {
                        $dataToUpdate[$lang]['description'] = $value;
                    }
                }
                $existingInfoItem->update($dataToUpdate);
            } else {
                $dataToUpdate = [
                    'direction_id' => $directionId
                ];

                if($infoItem['title']) {
                    foreach ($infoItem['title'] as $lang => $value) {
                        $dataToUpdate[$lang]['title'] = $value;
                    }
                }
                if($infoItem['description']) {
                    foreach ($infoItem['description'] as $lang => $value) {
                        $dataToUpdate[$lang]['description'] = $value;
                    }
                }

                DirectionInfoBlock::create($dataToUpdate);
            }
        }

        // remove items
        $existingInfoItemsInRequest = $infoItems ? array_filter(array_column($infoItems, 'id'), function ($item) {
            return $item !== null;
        }): [];

        $infoItemsToDelete = $existingInfoItems->whereNotIn('id', $existingInfoItemsInRequest);

        foreach ($infoItemsToDelete as $infoItemToDelete) {
            $infoItemToDelete->delete();
        }
    }

    public function syncPrices(array $prices, Collection $existingPrices, int $directionId)
    {
        foreach( $prices as $price ) {
            $existingPrice = $existingPrices->where('id', $price['id'])->first();

            if( !is_null($existingPrice) ) {
                $dataToUpdate = [
                    'sort' => $price['sort'],
                    'is_free' => $price['is_free']
                ];

                if($price['service']) {
                    foreach ($price['service'] as $lang => $value) {
                        $dataToUpdate[$lang]['service'] = $value;
                    }
                }
                if($price['price']) {
                    foreach ($price['price'] as $lang => $value) {
                        $dataToUpdate[$lang]['price'] = $value;
                    }
                }

                $existingPrice->update($dataToUpdate);
            } else {
                $dataToUpdate = [
                    'direction_id' => $directionId,
                    'sort' => $price['sort'],
                    'is_free' => $price['is_free']
                ];

                if($price['service']) {
                    foreach ($price['service'] as $lang => $value) {
                        $dataToUpdate[$lang]['service'] = $value;
                    }
                }
                if($price['price']) {
                    foreach ($price['price'] as $lang => $value) {
                        $dataToUpdate[$lang]['price'] = $value;
                    }
                }

                DirectionPrice::create($dataToUpdate);
            }
        }

        // remove items
        $existingPricesInRequest = $prices ? array_filter(array_column($prices, 'id'), function ($item) {
            return $item !== null;
        }): [];

        $pricesToDelete = $existingPrices->whereNotIn('id', $existingPricesInRequest);

        foreach ($pricesToDelete as $priceToDelete) {
            $priceToDelete->delete();
        }
    }

    public function setTextBlockData(null|DirectionTextBlock $directionTextBlock)
    {
        $data = [];

        $data['text_one'] = [];
        $data['text_two'] = [];
        $data['is_reverse'] = false;
        $data['is_image'] = true;
        $data['button_one_url'] = null;

        if(!is_null($directionTextBlock)) {
            foreach ($directionTextBlock->getTranslationsArray() as $lang => $value) {
                $data['text_one'][$lang] = $value['text_one'];
            }
            foreach ($directionTextBlock->getTranslationsArray() as $lang => $value) {
                $data['text_two'][$lang] = $value['text_two'];
            }
            $data['media']['image'] = $directionTextBlock->image;
            $data['is_reverse'] = $directionTextBlock->is_reverse;
            $data['is_image'] = $directionTextBlock->is_image;
            $data['button_one_url'] = $directionTextBlock->button_one_url;
        }

        return $data;
    }

    public function setSeoData(PageDirection $page)
    {
        $data = [
            'meta_title' => [],
            'meta_description' => [],
            'meta_keywords' => [],
            'seo_title' => [],
            'seo_text' => [],
        ];

        foreach ($page->getTranslationsArray() as $lang => $translation) {
            $data['meta_title'][$lang] = $translation['meta_title'] ?? null;
            $data['meta_description'][$lang] = $translation['meta_description'] ?? null;
            $data['meta_keywords'][$lang] = $translation['meta_keywords'] ?? null;
            $data['seo_title'][$lang] = $translation['seo_title'] ?? null;
            $data['seo_text'][$lang] = $translation['seo_text'] ?? null;
        }

        return $data;
    }

    public function searchWithParents(string $search): array
    {
        $locale = app()->getLocale();

        $matched = Direction::with(['parent', 'parent.parent', 'page'])
            ->whereTranslationLike('short_name', "%$search%")
            ->get();

        $allIds = collect();

        foreach ($matched as $direction) {
            $allIds->push($direction->id);

            if ($direction->parent) {
                $allIds->push($direction->parent->id);

                if ($direction->parent->parent) {
                    $allIds->push($direction->parent->parent->id);
                }
            }
        }

        $uniqueIds = $allIds->unique();
        $all = Direction::with(['children', 'page'])->whereIn('id', $uniqueIds)->get();

        return $this->buildTreeFromSubset($all);
    }
    private function buildTreeFromSubset($directions)
    {
        $directions = $directions->keyBy('id');

        $tree = [];

        foreach ($directions as $direction) {
            if (!$direction->parent_id || !$directions->has($direction->parent_id)) {
                $tree[] = $this->buildBranch($direction, $directions);
            }
        }

        return $tree;
    }
    private function buildBranch($direction, $all)
    {
        $children = $direction->children
            ->filter(fn($child) => $all->has($child->id))
            ->map(fn($child) => $this->buildBranch($child, $all))
            ->toArray();

        return [
            'id' => $direction->id,
            'name' => $direction->short_name,
            'template' => $direction->template,
            'children' => $children,
            'slug' => $direction->page->slug,
            'full_path' => url($direction->buildFullPath())
        ];
    }

}