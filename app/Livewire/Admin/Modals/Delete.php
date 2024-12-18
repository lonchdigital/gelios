<?php

namespace App\Livewire\Admin\Modals;

use App\Models\Article;
use App\Models\ArticleBlock;
use App\Models\ArticleCategory;
use App\Models\ArticleSlider;
use App\Models\CheckUp;
use App\Models\CheckUpProgram;
use App\Models\Doctor;
use App\Models\DoctorCategory;
use App\Models\Laboratory;
use App\Models\PageBlock;
use App\Models\Promotion;
use App\Models\Specialization;
use App\Models\Surgery;
use App\Models\SurgeryBlock;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Delete extends Component
{
    public bool $isOpen = false;

    public $item = null;
    public $type = '';
    public $modalTitle = '';
    public $modalBody = '';
    public $modalInfo = '';
    public $withRedirect;

    protected $listeners = [
        'refresh' => '$refresh',
        'openModalDeleteItem' => 'openModal',
    ];

    public function openModal($modelName, $modelId, $withRedirect = false)
    {
        $this->withRedirect = $withRedirect;

        switch ($modelName) {
            case 'user':
                $this->item = User::find($modelId);
                $this->type = 'user';
                $this->modalTitle = __('admin.delete_user');
                $this->modalBody  = 'You really want to delete user: ' . $this->item->name . $this->item->second_name . '?';
                $this->modalInfo  = '';
                break;

            case 'laboratory':
                $this->item = Laboratory::find($modelId);
                $this->type = 'laboratory';
                $this->modalTitle = 'Delete laboratory';
                $this->modalBody  = 'You really want to delete laboratory: ' . $this->item->address . '?';
                $this->modalInfo  = '';
                break;

            case 'checkUpProgram':
                $this->item = CheckUpProgram::find($modelId);
                $this->type = 'checkUpProgram';
                $this->modalTitle = 'Delete program';
                $this->modalBody  = 'You really want to delete program: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'checkUp':
                $this->item = CheckUp::find($modelId);
                $this->type = 'checkUp';
                $this->modalTitle = 'Delete Check Up';
                $this->modalBody  = 'You really want to delete Check Up: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'promotion':
                $this->item = Promotion::find($modelId);
                $this->type = 'promotion';
                $this->modalTitle = 'Delete Promotion';
                $this->modalBody  = 'You really want to delete Promotion: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'pageBlock':
                $this->item = PageBlock::find($modelId);
                $this->type = 'pageBlock';
                $this->modalTitle = 'Delete slide';
                $this->modalBody  = 'You really want to delete slide: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'doctor':
                $this->item = Doctor::find($modelId);
                $this->type = 'doctor';
                $this->modalTitle = 'Delete doctor';
                $this->modalBody  = 'You really want to delete doctor: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'doctorCategory':
                $this->item = DoctorCategory::find($modelId);
                $this->type = 'doctorCategory';
                $this->modalTitle = 'Delete category';
                $this->modalBody  = 'You really want to delete doctor category: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'article':
                $this->item = Article::find($modelId);
                $this->type = 'article';
                $this->modalTitle = 'Delete article';
                $this->modalBody  = 'You really want to delete article: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'articleBlock':
                $this->item = ArticleBlock::find($modelId);
                $this->type = 'articleBlock';
                $this->modalTitle = 'Delete article block';
                $this->modalBody  = 'You really want to delete article block: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'specialization':
                $this->item = Specialization::find($modelId);
                $this->type = 'specialization';
                $this->modalTitle = 'Delete specialization';
                $this->modalBody  = 'You really want to delete specialization: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'pageBlock2':
                $this->item = PageBlock::find($modelId);
                $this->type = 'pageBlock2';
                $this->modalTitle = 'Delete block';
                $this->modalBody  = 'You really want to delete block: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'article_category':
                $this->item = ArticleCategory::find($modelId);
                $this->type = 'article_category';
                $this->modalTitle = 'Delete category';
                $this->modalBody  = 'You really want to delete category: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'articleSlide':
                $this->item = ArticleSlider::find($modelId);
                $this->type = 'articleSlide';
                $this->modalTitle = 'Delete slide';
                $this->modalBody  = 'You really want to delete slide: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'vacancy':
                $this->item = Vacancy::find($modelId);
                $this->type = 'vacancy';
                $this->modalTitle = 'Delete vacancy';
                $this->modalBody  = 'You really want to delete vacancy: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'surgery':
                $this->item = Surgery::find($modelId);
                $this->type = 'surgery';
                $this->modalTitle = 'Delete surgery direction';
                $this->modalBody  = 'You really want to delete direction: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            case 'surgeryBlock':
                $this->item = SurgeryBlock::find($modelId);
                $this->type = 'surgeryBlock';
                $this->modalTitle = 'Delete surgery direction block';
                $this->modalBody  = 'You really want to delete direction block: ' . $this->item->title . '?';
                $this->modalInfo  = '';
                break;

            default:

                break;
        }

        $this->isOpen   = true;
        $this->dispatch('showModal', 'openModalConfirmDelete');
    }

    public function closeModal()
    {
        $this->isOpen   = false;
        $this->dispatch('closeModal', 'closeModalConfirmDelete');
    }

    public function confirmDelete()
    {
        if ($this->item && $this->itemDelete()) {
            $this->closeModal();
            $this->dispatch('showAlert', 'success', 'Successfuly deleted!');
            $this->dispatch('refreshItemsAfterDelete');

            return true;
        }

        $this->dispatch('showAlert', 'warning', 'Can\'t delete!');
        $this->closeModal();
        return false;
    }

    public function itemDelete()
    {
        switch ($this->type) {
            case 'user':

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'laboratory':

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'checkUpProgram':

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'checkUp':

                if (!empty($this->item->image)) {
                    $this->deleteImage($this->item->image);
                }

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'promotion':

                if (!empty($this->item->image)) {
                    $this->deleteImage($this->item->image);
                }

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'pageBlock':

                if (!empty($this->item->image)) {
                    $this->deleteImage($this->item->image);
                }

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'pageBlock2':

                if (!empty($this->item->image)) {
                    $this->deleteImage($this->item->image);
                }

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'doctor':

                if (!empty($this->item->image)) {
                    $this->deleteImage($this->item->image);
                }

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'doctorCategory':

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'article':

                $this->deleteBlocks($this->item);

                if (!empty($this->item->image)) {
                    $this->deleteImage($this->item->image);
                }

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'articleBlock':

                $this->updateArticleBlockSort($this->item);

                // $this->deleteImage($this->item->image);

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'specialization':

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'article_category':

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'articleSlide':

                $this->updateArticleSliderSort($this->item);

                $this->deleteImage($this->item->image);

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'vacancy':
                $this->deleteImage($this->item->image);

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'surgeryBlock':
                $this->deleteImage($this->item->image);

                $this->item->delete();

                $this->item->refresh();

                return true;

            case 'surgery':

                $this->deleteSurgeryBlocks($this->item);

                $this->item->delete();

                $this->item->refresh();

                return true;

            default:

                return false;
        }
    }

    public function deleteBlocks(Article $article)
    {
        foreach($article->articleBlocks as $block) {
            // $this->deleteImage($block->image);

            $block->delete();
        }
    }

    public function deleteSurgeryBlocks(Surgery $surgery)
    {
        foreach($surgery->surgeryBlocks as $block) {
            $this->deleteImage($block->image);

            $block->delete();
        }
    }

    public function deleteImage($image)
    {
        if (!empty($image) && Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
    }

    public function updateArticleBlockSort(ArticleBlock $block)
    {
        $articleBlocks = ArticleBlock::where('article_id', $block->article_id)
            ->where('sort', '>', $block->sort)
            ->get();

        foreach($articleBlocks as $block2) {
            $block2->update([
                'sort' => $block2->sort - 1,
            ]);
        }
    }

    public function updateArticleSliderSort(ArticleSlider $slide)
    {
        $articleSliders = ArticleSlider::where('article_id', $slide->article_id)
            ->where('sort', '>', $slide->sort)
            ->get();

        foreach($articleSliders as $block) {
            $block->update([
                'sort' => $block->sort - 1,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.modals.delete');
    }
}
