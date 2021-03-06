<?php
/**
 * @package    Requests
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/02/2021 03:49:31
 */

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\ConfigurationRule;
use Illuminate\Foundation\Http\FormRequest;

class ConfigurationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->user()->can('update', $this->configuration);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return ConfigurationRule::rules();
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return ConfigurationRule::messages();
    }
}
