<?php
/**
 * @package    Resources
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/02/2021 03:49:31
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigurationResource extends JsonResource
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
            'players' => $this->players,
            'game_duration' => $this->game_duration,
            'team1_name' => $this->team1_name,
            'team2_name' => $this->team2_name,
            'max_players_list_limit' => $this->max_players_list_limit,
            'count_players_leave_both' => $this->count_players_leave_both,
        ];
    }
}
