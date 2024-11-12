<?php

namespace App\Services\Site;

use App\Models\Review;


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
            $image = downloadImage(self::IMAGE_PATH, $data['image']);
            $dataToUpdate['image'] = $image;
        }

        $review = Review::create($dataToUpdate);
        return $review !== null;
    }

}