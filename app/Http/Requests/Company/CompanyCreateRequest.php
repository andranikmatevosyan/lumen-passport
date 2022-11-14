<?php

namespace App\Http\Requests\Company;

use Illuminate\Validation\Rule;
use Pearl\RequestValidate\RequestAbstract;

class CompanyCreateRequest extends RequestAbstract
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'phone' => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies', 'phone')
            ],
            'title' => [
                'required',
                'string',
                'max:255'
            ],
            'description' => [
                'nullable',
                'present',
                'string',
                'max:255'
            ],

        ];
    }

}
