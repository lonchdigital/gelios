<?php

namespace App\Services\Admin\Reviews;

use App\Models\Page;
use App\Models\Review;
use App\Models\PageTextBlock;
use Illuminate\Database\Eloquent\Collection;


class ReviewsService 
{
    const IMAGE_PATH = '/reviews';

    public function setPageData(Page $page)
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

    public function updatePageData(Page $page, array $data)
    {
        $dataToUpdate = [];

        if($data['title']) {
            foreach ($data['title'] as $lang => $value) {
                $dataToUpdate[$lang]['title'] = $value;
            }
        }

        $page->update($dataToUpdate);
    }


    public function setReviewData(null|Review $review)
    {
        $data = [];

        $data['published'] = false;
        $data['name'] = [];
        $data['text'] = [];

        if(!is_null($review)) {
            $data['published'] = $review->published;
            foreach ($review->getTranslationsArray() as $lang => $value) {
                $data['name'][$lang] = $value['name'];
            }
            foreach ($review->getTranslationsArray() as $lang => $value) {
                $data['text'][$lang] = $value['text'];
            }
            $data['media']['image'] = $review->image;
        }

        return $data;
    }

    public function updateReview(array $sectionData, null|Review $review)
    {
        $formData = [
            'image' => $sectionData['media'] ?? null,
            'name' => $sectionData['name'],
            'text' => $sectionData['text']
        ];

        $dataToUpdate = [];

        if(!is_null($formData['name'])) {
            foreach ($formData['name'] as $lang => $value) {
                $dataToUpdate[$lang]['name'] = $value;
            }
        }
        if(!is_null($formData['text'])) {
            foreach ($formData['text'] as $lang => $value) {
                $dataToUpdate[$lang]['text'] = $value;
            }
        }

        if(isset($formData['image']) && isset($formData['image']['newImage'])) {
            if(isset($formData['image']['image'])) {
                removeImageFromStorage($formData['image']['image']);
            }
            $image = downloadImage(self::IMAGE_PATH, $formData['image']['newImage']);
            $dataToUpdate['image'] = $image;
        }

        $dataToUpdate['published'] = $sectionData['published'];

        if(!is_null($review)) {
            $review->update($dataToUpdate);
            return $review;
        } else {
            return Review::create($dataToUpdate);
        }
    }

    public function removeReview(int $reviewID)
    {
        $review = Review::find($reviewID);

        if(!is_null($review->image)){
            removeImageFromStorage($review->image);
        }
        
        $review->delete();
    }

}