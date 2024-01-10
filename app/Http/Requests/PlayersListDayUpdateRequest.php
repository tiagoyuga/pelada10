<?php
/**
 * @package    Requests
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/04/2021 01:27:44
 */

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\PlayersListDayRule;
use Illuminate\Foundation\Http\FormRequest;

class PlayersListDayUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->user()->can('update', $this->playersListDay);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return PlayersListDayRule::rules();
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return PlayersListDayRule::messages();
    }
}
