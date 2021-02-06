<?php

use Carbon\Carbon;

function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}
function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}
function raw($class, $attributes = [], $times = null)
{
    $attributes = factory($class, $times)->raw($attributes);
    return array_map(function ($attribute) {
        if($attribute instanceof Carbon){
            return $attribute->format('d/m/Y');
        }
        return $attribute;
    }, $attributes);
}

function verifyIfInputIsADate($attribute)
{
    $array = explode('/', $attribute);

    if(count($array) == 3){
        $dia = (int)$array[0];
        $mes = (int)$array[1];
        $ano = (int)$array[2];

        //testa se a data é válida
        if(checkdate($mes, $dia, $ano)){
            return true;
        }

    }

    return false;
}
