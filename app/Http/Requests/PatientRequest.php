<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\CaseType;
use App\CoronavirusType;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
     $this->merge([
            'coronavirus_status' => $this->input('coronavirus_status') ?: null,
            'email' => $this->input('email') ?: null,
        ]);

    if($this->isMethod('PATCH') || $this->isMethod('PUT')){
        if($this->input('case_type') !== "Positive on Covid"){
            $this->merge(['coronavirus_status' => null]);
        }

    }
   
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    $numberRule = [
        'required',
        'string',
        'regex:/^(09\d{9}|\+639\d{9})$/',
    ];

    $patientId = request()->route('patient'); 

    if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
        $numberRule[] = Rule::unique('patients', 'number')->ignore($patientId);
    } else {
        $numberRule[] = Rule::unique('patients', 'number');
    }

    return [
        'name' => 'required|string|max:255',
        'brgy_id' => 'required|exists:brgys,id',
        'number' => $numberRule,
        'email' => 'nullable|email|max:255',
        'case_type' => ['required', Rule::enum(CaseType::class)],
        'coronavirus_status' => ['nullable', Rule::enum(CoronavirusType::class)],
    ];
}

}
