<?php

namespace App\Rlustosa;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GenericImageUpload
{
    public static function store($file, $folder)
    {

        $fileName = Carbon::now('America/Fortaleza')->format('YmdHis') . '_' .
            Str::random(8) . '_' .
            rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999) . '_' .
            Str::random(8) . '.' .
            $file->guessClientExtension();

        $file->storeAs(
            'images/' . $folder . '/Original/', $fileName
        );

        $path = $file->storeAs(
            'images/' . $folder, $fileName
        );

        if (config('upload.' . $folder . '.width')) {

            $complete_path = storage_path() . '/app/' . $path;
            $img = Image::make($complete_path);
            $img->fit(config('upload.' . $folder . '.width'), config('upload.' . $folder . '.height'));
            $img->save($complete_path, 75);
        }

        return str_replace('images/', '', $path);
    }

    public static function storeByFroala($file, $folder)
    {

        $fileName = Carbon::now('America/Fortaleza')->format('YmdHis') . '_' .
            Str::random(8) . '_' .
            rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999) . '_' .
            Str::random(8) . '.' .
            $file->guessClientExtension();

        $file->storeAs(
            'images/' . $folder . '/Original/', $fileName
        );

        $path = $file->storeAs(
            'images/' . $folder, $fileName
        );

        if (config('upload.' . $folder . '.width')) {

            $complete_path = storage_path() . '/app/' . $path;
            $img = Image::make($complete_path);
            $img->fit(config('upload.' . $folder . '.width'), config('upload.' . $folder . '.height'));
            $img->save($complete_path, 75);
        }

        return $path;
    }

    public static function uploadByFroala()
    {

        $image_types = ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/jpeg', 'image/jpg', 'image/png', 'image/x-png']; // Image types.
        $allowedExts = ['gif', 'jpeg', 'jpg', 'png', 'bmp']; // Allowed extentions.
        $temp = explode('.', $_FILES['file']['name']); // Get filename.
        $extension = end($temp); // Get extension.
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['file']['tmp_name']);

        if (in_array($mime, $image_types) && in_array(strtolower($extension), $allowedExts)) {
            $name = Str::slug($temp[0]) . '_' . sha1(microtime()) . '.' . $extension;
            move_uploaded_file($_FILES['file']['tmp_name'], getcwd() . '/uploads/editor/' . $name); // Save file in the uploads folder.

            $response = new StdClass();
            $response->link = '/uploads/editor/' . $name;
            echo stripslashes(json_encode($response));
        }
    }

    public static function listToFroala()
    {

        $response = []; // Array of image objects to return.
        $image_types = ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/jpeg', 'image/jpg', 'image/png', 'image/x-png']; // Image types.
        $fnames = scandir($_SERVER['DOCUMENT_ROOT'] . '/uploads/editor/'); // Filenames in the uploads folder.

        if ($fnames) { // Check if folder exists.

            arsort($fnames);

            foreach ($fnames as $name) { // Go through all the filenames in the folder.

                if (!is_dir($name)) {

                    if (in_array(mime_content_type(getcwd() . '/uploads/editor/' . $name), $image_types)) {

                        $img = new StdClass();
                        $img->url = '/uploads/editor/' . $name;
                        $img->thumb = '/uploads/editor/' . $name;
                        $img->name = $name;
                        array_push($response, $img); // Add to the array of image.
                    }
                }
            }

        } else {

            $response = new StdClass();
            $response->error = 'Images folder does not exist!';
        }

        $response = json_encode($response);

        echo stripslashes($response); // Send response.
    }
}
