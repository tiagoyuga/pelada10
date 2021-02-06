<?php

//Avatars
Route::get('default-user-avatar/{width}', function ($width) {

    $file = 'img/default-user-avatar.jpeg';

    return Image::make($file)->resize($width, null, function ($constraint) {
        $constraint->aspectRatio();
    })->response();
})->where('width', '[0-9]+');

Route::prefix('images')
    ->group(function ($image) {

        // Imagem salva no banco de dados
        $image->get('{folder}/{filename}', function ($folder, $filename) {

            $path = 'images/' . $folder . '/' . $filename;
            $file = Storage::get($path);
            return Image::make($file)->response();
        });
        // Imagem salva no banco de dados para as fotos de uma galeria
        // gallery/album1/20191025165638_32904e421ac4c22d_684863437461_d4892f2783346617.png
        $image->get('gallery/{folder}/{filename}', function ($folder, $filename) {

            $path = 'images/gallery/' . $folder . '/' . $filename;
            $file = Storage::get($path);
            return Image::make($file)->response();
        });

        $image->get('{width}/{folder}/{filename}', function ($width, $folder, $filename) {

            $path = 'images/' . $folder . '/' . $filename;
            $file = Storage::get($path);

            return Image::make($file)->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            })->response();
        })->where('width', '[0-9]+');

        Route::get('{width}/{height}/{folder}/{filename}', function ($width, $height, $folder, $filename) {

            $path = 'images/' . $folder . '/' . $filename;
            $file = Storage::get($path);

            return Image::make($file)->fit($width, $height, function ($constraint) {
                //$constraint->aspectRatio();
            }, 'top')->response();
        })->where('width', '[0-9]+')->where('height', '[0-9]+');

        $image->get('original/{width}/{folder}/{filename}', function ($width, $folder, $filename) {

            $path = 'images/' . $folder . '/Original/' . $filename;
            $file = Storage::get($path);

            return Image::make($file)->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            })->response();
        })->where('width', '[0-9]+');
    });
