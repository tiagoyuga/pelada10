<?php
/**
 * @package    Rules
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       09/03/2021 02:54:27
 */

declare(strict_types=1);

namespace App\Rules;

class GamesDayRule
{

    /**
     * Validation rules that apply to the request.
     *
     * @var array
     */
	protected static $rules = [
		'id' => 'required',
        //'event_id' => 'required',
        //'game_day' => 'required|date_format:d/m/Y H:i',
        'game_day' => 'required',
        'hour' => 'required',
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
            //'event_id' => self::$rules['event_id'],
            'game_day' => self::$rules['game_day'],
            'hour' => self::$rules['hour'],
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
