<?php

use Illuminate\Support\Str;
use App\Models\PageTextBlock;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

function storeImage(string $path, UploadedFile $image, string $format, $quality = 70): void
{
    $image = Image::make($image)->encode($format, $quality);
    Storage::disk(config('app.images_disk_default'))->put($path . '.'.$format, $image);
}


function deleteImage(string|null $path): void
{
    if(is_null($path)){
        return;
    }

    // remove webp
    if (Storage::disk(config('app.images_disk_default'))->exists($path)) {
        Storage::disk(config('app.images_disk_default'))->delete($path);
    }

    // remove jpg
    $jpgPath = pathinfo($path, PATHINFO_DIRNAME) . '/' . pathinfo($path, PATHINFO_FILENAME)  . '.jpg';
    if (Storage::disk(config('app.images_disk_default'))->exists($jpgPath)) {
        Storage::disk(config('app.images_disk_default'))->delete($jpgPath);
    }

    // remove png
    $jpgPath = pathinfo($path, PATHINFO_DIRNAME) . '/' . pathinfo($path, PATHINFO_FILENAME)  . '.png';
    if (Storage::disk(config('app.images_disk_default'))->exists($jpgPath)) {
        Storage::disk(config('app.images_disk_default'))->delete($jpgPath);
    }
}


function makeUsort(array $items)
{
    usort($items, function ($a, $b) {
        return $a['sort'] <=> $b['sort'];
    });

    return $items;
}

function updateSort(Collection $items, int $i = 1)
{
    foreach($items as $item) {
        $item->update([
            'sort' => $i,
        ]);

        $i += 1;
    }
}

function downloadImage(string $folderName, $file)
{
    $image = Storage::disk('public')->put($folderName, $file);
    return $image;
}

function removeImageFromStorage($path)
{
    if(is_null($path)){
        return;
    }

    if (Storage::disk(config('app.images_disk_default'))->exists($path)) {
        Storage::disk(config('app.images_disk_default'))->delete($path);
    }
}

function isEmptyHtml($html) {
    $cleanedHtml = trim(
        preg_replace('/<p><br><\/p>|<br>|&nbsp;|\s+/', '', $html)
    );

    return empty($cleanedHtml);
}


function downloadVideoFile(string $folderName, $file)
{
    $image = Storage::disk('public')->put($folderName, $file);
    return $image;
}
function removeVideoFileFromStorage($path)
{
    if(is_null($path)){
        return;
    }

    if (Storage::disk(config('app.images_disk_default'))->exists($path)) {
        Storage::disk(config('app.images_disk_default'))->delete($path);
    }
}