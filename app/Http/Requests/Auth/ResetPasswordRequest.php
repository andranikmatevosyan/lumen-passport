<?php

namespace App\Http\Requests\Auth;

use Pearl\RequestValidate\RequestAbstract;

class ResetPasswordRequest extends RequestAbstract
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
            'token' => [
                'required',
                'string',
                'max:255'
            ],
            'password' => [
                'required',
                'string',
                'max:255',
                'min:8'
            ],
            'password_confirmation' => [
                'required',
                'same:password'
            ],
        ];
    }
}
