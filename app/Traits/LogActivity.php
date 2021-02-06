<?php

namespace App\Traits;

trait LogActivity
{
    public function log($metodo)
    {
        /*if (\Auth::user()->type != 'DEVELOPER') {


        }*/

        /*$log = new \App\Entities\LogActivity();
        $log->user_id = \Auth::user()->id;
        $log->function = $metodo;
        $log->url = \Request::fullUrl();
        $log->request = json_encode(\Request::all());
        $log->method = \Request::method();

        $log->save();*/
    }
}
