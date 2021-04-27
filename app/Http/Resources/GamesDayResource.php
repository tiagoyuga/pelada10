<?php
/**
 * @package    Resources
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       09/03/2021 02:54:27
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GamesDayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'event_id' => $this->event_id,
            'game_day' => $this->game_day,
        ];
    }
}
