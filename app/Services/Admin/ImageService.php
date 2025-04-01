<?php

namespace App\Services\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
// use Intervention\Image\Facades\Image;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class ImageService
{
    public function downloadImage($file, $folder)
    {
        $image = $this->convertToWebp($file, $folder);

        return $image;
    }

    public function convertToWebp(UploadedFile $file, $folder)
    {
        $name = $file->getClientOriginalName();
        $name = pathinfo($name, PATHINFO_FILENAME);

        // $manager = new ImageManager(
        //     new (Driver::class)
        // );
        // $image = $manager->read($file);

        // $encoded = $image->toWebp();

        // $filePath = $folder . '/' . $name . '.webp';

        $counter = 1;

        $extension = $file->getClientOriginalExtension();

        $filePath = $folder . '/' . $name;

        // while (Storage::exists('public/' . $filePath)) {
        //     $filePath = $folder . '/' . $name . '-' . $counter . '.webp';
        //     $counter++;
        // }
        if (strtolower($extension) === 'svg') {
            // Додаємо розширення .svg до шляху
            $filePath .= '.svg';

            // Перевіряємо, чи існує файл з таким ім'ям, і додаємо суфікс, якщо потрібно
            while (Storage::disk('public')->exists($filePath)) {
                $filePath = $folder . '/' . $name . '-' . $counter . '.svg';
                $counter++;
            }

            // Зберігаємо SVG-файл без змін
            Storage::disk('public')->put($filePath, $file->getContent());
        } else {
            // Ініціалізуємо менеджер зображень з драйвером GD
            $manager = new ImageManager(new Driver());
            // Зчитуємо зображення з файлу
            $image = $manager->read($file);
            // Конвертуємо зображення у формат WebP
            $encoded = $image->toWebp();
            // Додаємо розширення .webp до шляху
            $filePath .= '.webp';

            while (Storage::disk('public')->exists($filePath)) {
                $filePath = $folder . '/' . $name . '-' . $counter . '.webp';
                $counter++;
            }

            Storage::disk('public')->put($filePath, $encoded);
        }

        return $filePath;
    }

    public function deleteStorageImage($image, $path)
    {
        if ($image && $path) {
            Storage::disk('public')->delete($path);
        }
    }

    public function deleteAdditionalImage($image)
    {
        if(Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
    }

    public function processImages($currentImages, $newImages)
    {
        $processedImages = [];

        foreach ($newImages as $image) {
            if (!in_array($image['image'], $currentImages ?? [])) {
                $processedImages[] = $this->downloadImage($image['image'], 'article');
            } else {
                $processedImages[] = $image['image'];
            }
        }

        foreach ($currentImages ?? [] as $image) {
            if (!in_array($image, $processedImages)) {
                $this->deleteAdditionalImage($image, );
            }
        }

        return $processedImages;
    }
}
