<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class BrgyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => [
                'required',
                'string',
                'max:255',
                'min:2',
                Rule::unique('brgys')->where(function ($query){return $query->where('city_id', request()->city_id);})->ignore(request()->route('brgy'))
            ],
            'city_id' =>[
                Rule::exists('cities', 'id'),
                'required',
            ],
        ];
    }
}
