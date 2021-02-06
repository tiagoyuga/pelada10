<?php

namespace App\Rlustosa;

use Carbon\Carbon;
use Illuminate\Support\Str;

class GenericUpload
{
    public static function store($file, $folder, $filename=null)
    {

        if(!$filename){

            $filename = Carbon::now('America/Fortaleza')->format('YmdHis') . '_' .
                Str::random(8) . '_' .
                rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999) . '_' .
                Str::random(8);

        }

        $nome_arquivo = $filename . '.' .
            $file->guessClientExtension();


        $path = $file->storeAs(
            'files/' . $folder, $nome_arquivo
        );

        return $path;
    }
}
