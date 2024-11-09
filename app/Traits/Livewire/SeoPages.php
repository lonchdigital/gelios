<?php

namespace App\Traits\Livewire;

use App\Models\Page;

trait SeoPages
{

    public function updateSeoDataPage(Page $page, array $data)
    {
        $dataToUpdate = [];

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
        if($data['seo_text']) {
            foreach ($data['seo_text'] as $lang => $value) {
                $dataToUpdate[$lang]['seo_text'] = $value;
            }
        }

        $page->update($dataToUpdate);
    }

    public function setSeoDataPage(Page|null $page)
    {
        $data = [];

        if( !is_null($page) ) {

            if(!is_null($page->meta_title)) {
                foreach ($page->getTranslationsArray() as $lang => $value) {
                    $data['meta_title'][$lang] = $value['meta_title'];
                }
            } else {
                $data['meta_title'] = [];
            }
            if(!is_null($page->meta_description)) {
                foreach ($page->getTranslationsArray() as $lang => $value) {
                    $data['meta_description'][$lang] = $value['meta_description'];
                }
            } else {
                $data['meta_description'] = [];
            }
            if(!is_null($page->meta_keywords)) {
                foreach ($page->getTranslationsArray() as $lang => $value) {
                    $data['meta_keywords'][$lang] = $value['meta_keywords'];
                }
            } else {
                $data['meta_keywords'] = [];
            }
            if(!is_null($page->seo_text)) {
                foreach ($page->getTranslationsArray() as $lang => $value) {
                    $data['seo_text'][$lang] = $value['seo_text'];
                }
            } else {
                $data['seo_text'] = [];
            }

        } else {
            $data['meta_title'] = [];
            $data['meta_description'] = [];
            $data['meta_keywords'] = [];
            $data['seo_text'] = [];
        }

        return $data;
    }
    
}