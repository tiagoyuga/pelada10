<?php
/**
 * @package    Rules
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       05/02/2021 21:38:30
 */

declare(strict_types=1);

namespace App\Rules;

class UserRule
{

    /**
     * Validation rules that apply to the request.
     *
     * @var array
     */
	protected static $rules = [
		'id' => 'required',
        'name' => 'required|min:2|max:255',
        'email' => 'nullable|email',
        'email_verified_at' => 'nullable|date_format:d/m/Y H:i',
        'password' => 'nullable|min:2|max:255',
        'nickname' => 'nullable|min:2|max:255',
        'shirt_number' => 'nullable|min:2|max:255',
        'phone1' => 'nullable|min:2|max:255',
        'phone2' => 'nullable|min:2|max:255',
        'whatsapp' => 'nullable|min:2|max:255',
        #'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3072',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3072',
        'imageUpdate' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3072',
        'birth' => 'nullable|date_format:d/m/Y',
        'first_access' => 'nullable',
        'active' => 'nullable',
        'is_dev' => 'nullable',
        'selected_event' => 'nullable|integer',
        'remember_token' => 'nullable|min:2|max:100',
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
            'email' => self::$rules['email'],
            'email_verified_at' => self::$rules['email_verified_at'],
            'password' => self::$rules['password'],
            'nickname' => self::$rules['nickname'],
            'shirt_number' => self::$rules['shirt_number'],
            'phone1' => self::$rules['phone1'],
            'phone2' => self::$rules['phone2'],
            'whatsapp' => self::$rules['whatsapp'],
            'image' => self::$rules['image'],
            'birth' => self::$rules['birth'],
            'first_access' => self::$rules['first_access'],
            'active' => self::$rules['active'],
            'is_dev' => self::$rules['is_dev'],
            'selected_event' => self::$rules['selected_event'],
            'remember_token' => self::$rules['remember_token'],
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
