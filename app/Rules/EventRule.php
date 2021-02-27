<?php
/**
 * @package    Rules
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/02/2021 03:15:02
 */

declare(strict_types=1);

namespace App\Rules;

class EventRule
{

    /**
     * Validation rules that apply to the request.
     *
     * @var array
     */
	protected static $rules = [
		'id' => 'required',
        'name' => 'nullable|min:2|max:255',
        'address' => 'nullable|min:2|max:255',
        'neighborhood' => 'nullable|min:2|max:255',
        'number' => 'nullable|min:2|max:255',
        'phone1' => 'nullable|min:2|max:255',
        'phone2' => 'nullable|min:2|max:255',
        'city_name' => 'nullable|min:2|max:255',
        'lat' => 'nullable|min:2|max:255',
        'long' => 'nullable|min:2|max:255',
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
            'name' => self::$rules['name'],
            'address' => self::$rules['address'],
            'neighborhood' => self::$rules['neighborhood'],
            'number' => self::$rules['number'],
            'phone1' => self::$rules['phone1'],
            'phone2' => self::$rules['phone2'],
            'city_name' => self::$rules['city_name'],
            'lat' => self::$rules['lat'],
            'long' => self::$rules['long'],
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
