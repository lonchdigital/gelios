<?php

namespace App\Services\Admin\TextPages;

use App\Models\Page;


class TextPagesService 
{

    public function updateContentData(Page $page, array $data)
    {
        $dataToUpdate = [];

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

        foreach ($page->getTranslationsArray() as $lang => $value) {
            $data['text'][$lang] = $value['text'];
        }
        
        return $data;
    }

}