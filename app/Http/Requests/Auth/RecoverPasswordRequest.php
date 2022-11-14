<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use Pearl\RequestValidate\RequestAbstract;

class RecoverPasswordRequest extends RequestAbstract
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::exists('users', 'email')
            ]
        ];
    }
}
