<?php

namespace App\Services\Site;

use App\Models\Review;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ReviewsService 
{
    const IMAGE_PATH = '/reviews';

    public function saveUserReviewToDB(array $data, string $usersLocale) : bool
    {
        $dataToUpdate = [];

        $dataToUpdate['published'] = false;
        $dataToUpdate[$usersLocale]['name'] = $data['name'];
        $dataToUpdate[$usersLocale]['text'] = $data['review'];

        if( isset($data['image']) ){
            $dataToUpdate['image'] = $this->storeReviewImage($data['image']);
        }

        $review = Review::create($dataToUpdate);
        return $review !== null;
    }

    private function storeReviewImage(UploadedFile $file): string
    {
        $filenameBase = self::IMAGE_PATH . '/' . sha1(microtime()) . '_' . Str::random(8);

        storeImage($filenameBase, $file, 'webp');
        storeImage($filenameBase, $file, 'jpg');

        return $filenameBase . '.webp';
    }

}