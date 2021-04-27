<?php
/**
 * @package    Requests
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       09/03/2021 02:54:27
 */

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\GamesDay;
use App\Rules\GamesDayRule;
use Illuminate\Foundation\Http\FormRequest;

class GamesDayStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->user()->can('create', GamesDay::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return GamesDayRule::rules();
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return GamesDayRule::messages();
    }
}
