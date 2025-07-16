<?php

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

function storeImage(string $path, UploadedFile $uploadedImage, string $format, int $quality = 70): void
{
    $format = strtolower(trim($format));
    $manager = new ImageManager(new ImagickDriver());

    switch ($format) {
        case 'jpg':
        case 'jpeg':
            $encoder = new JpegEncoder(quality: $quality);
            break;
        case 'webp':
            $encoder = new WebpEncoder(quality: $quality);
            break;
        default:
            throw new \InvalidArgumentException("Unsupported format: [$format]");
    }

    $image = $manager->read($uploadedImage)->encode($encoder);

    Storage::disk(config('app.images_disk_default'))
        ->put($path . '.' . $format, (string) $image);
}

function deleteImage(string|null $path): void
{
    if(is_null($path)){
        return;
    }
    $disk = Storage::disk(config('app.images_disk_default'));

    // remove webp
    if ($disk->exists($path)) {
        $disk->delete($path);
    }

    // remove jpg
    $jpgPath = pathinfo($path, PATHINFO_DIRNAME) . '/' . pathinfo($path, PATHINFO_FILENAME)  . '.jpg';
    if ($disk->exists($jpgPath)) {
        $disk->delete($jpgPath);
    }

    // remove png
    $jpgPath = pathinfo($path, PATHINFO_DIRNAME) . '/' . pathinfo($path, PATHINFO_FILENAME)  . '.png';
    if ($disk->exists($jpgPath)) {
        $disk->delete($jpgPath);
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

function downloadImage(string $folderName, UploadedFile $file): string
{
    $filename = Str::uuid()->toString();

    storeImage($folderName . '/' . $filename, $file, 'jpg', 90);
    storeImage($folderName . '/' . $filename, $file, 'webp', 90);

    return $folderName . '/' . $filename . '.webp';
}

function removeImageFromStorage(?string $path): void
{
    if (is_null($path)) {
        return;
    }

    $disk = Storage::disk(config('app.images_disk_default'));
    $basePath = pathinfo($path, PATHINFO_DIRNAME) . '/' . pathinfo($path, PATHINFO_FILENAME);

    foreach (['webp', 'jpg', 'jpeg', 'png'] as $ext) {
        $fullPath = $basePath . '.' . $ext;
        if ($disk->exists($fullPath)) {
            $disk->delete($fullPath);
        }
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