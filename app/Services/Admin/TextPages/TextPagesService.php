<?php

namespace App\Services\Admin\TextPages;

use App\Models\Page;


class TextPagesService 
{

    public function updateContentData(Page $page, array $data)
    {
        $dataToUpdate = [];

        $dataToUpdate['slug'] = $data['slug'];

        if($data['title']) {
            foreach ($data['title'] as $lang => $value) {
                $dataToUpdate[$lang]['title'] = $value;
            }
        }
        if($data['text']) {
            foreach ($data['text'] as $lang => $value) {
                $dataToUpdate[$lang]['text'] = $value;
            }
        }

        $page->update($dataToUpdate);
    }

    public function setContentData(Page $page)
    {
        $data = [];

        $data['slug'] = $page->slug;

        foreach ($page->getTranslationsArray() as $lang => $value) {
            $data['title'][$lang] = $value['title'];
            $data['text'][$lang] = $value['text'];
        }
        
        return $data;
    }

}