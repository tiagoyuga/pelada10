<?php
/**
 * @package    Resources
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/04/2021 01:27:44
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayersListDayResource extends JsonResource
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
            'games_day_id' => $this->games_day_id,
            'user_id' => $this->user_id,
            'order' => $this->order,
            'active' => $this->active,
            'goals' => $this->goals,
            'payment' => $this->payment,
        ];
    }
}
