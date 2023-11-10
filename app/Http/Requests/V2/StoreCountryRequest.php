<?php

namespace App\Http\Requests\V2;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO: When authentication is implemented, change this to false
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // TODO: consider adding validation for uid (Rule)
        return[
            'uid' => ['required'],
            'name_ru' => ['required'],
            'name_en' => ['required']
        ];
    }
}
