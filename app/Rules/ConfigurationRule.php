<?php
/**
 * @package    Rules
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/02/2021 03:49:31
 */

declare(strict_types=1);

namespace App\Rules;

class ConfigurationRule
{

    /**
     * Validation rules that apply to the request.
     *
     * @var array
     */
	protected static $rules = [
		'id' => 'required',
        'event_id' => 'required',
        'players' => 'required',
        'game_duration' => 'nullable',
        'team1_name' => 'required|min:2|max:255',
        'team2_name' => 'required|min:2|max:255',
        'max_players_list_limit' => 'nullable',
        'count_players_leave_both' => 'nullable',
        'user_creator_id' => 'nullable',
        'user_updater_id' => 'nullable',
        'user_eraser_id' => 'nullable',
	];

    /**
     * Return default rules
     *
     * @return array
     */
    public static function rules()
    {

        return [
            'event_id' => self::$rules['event_id'],
            'players' => self::$rules['players'],
            'game_duration' => self::$rules['game_duration'],
            'team1_name' => self::$rules['team1_name'],
            'team2_name' => self::$rules['team2_name'],
            'max_players_list_limit' => self::$rules['max_players_list_limit'],
            'count_players_leave_both' => self::$rules['count_players_leave_both'],
            'user_creator_id' => self::$rules['user_creator_id'],
            'user_updater_id' => self::$rules['user_updater_id'],
            'user_eraser_id' => self::$rules['user_eraser_id'],
        ];
    }

    /**
     * Return default messages
     *
     * @return array
     */
    public static function messages()
    {

        return [];
    }
}
