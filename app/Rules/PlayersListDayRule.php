<?php
/**
 * @package    Rules
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/04/2021 01:27:44
 */

declare(strict_types=1);

namespace App\Rules;

class PlayersListDayRule
{

    /**
     * Validation rules that apply to the request.
     *
     * @var array
     */
	protected static $rules = [
		'id' => 'required',
        'games_day_id' => 'required',
        'user_id' => 'required',
        'order' => 'required|integer',
        'active' => 'required',
        'goals' => 'required|integer',
        'payment' => 'required',
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
            'games_day_id' => self::$rules['games_day_id'],
            'user_id' => self::$rules['user_id'],
            'order' => self::$rules['order'],
            'active' => self::$rules['active'],
            'goals' => self::$rules['goals'],
            'payment' => self::$rules['payment'],
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
