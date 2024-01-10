<?php
/**
 * @package    Resources
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/04/2021 01:27:44
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PlayersListDayCollection extends ResourceCollection
{

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = 'App\Http\Resources\PlayersListDayResource';

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
