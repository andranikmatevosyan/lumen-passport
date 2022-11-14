<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use Pearl\RequestValidate\RequestAbstract;

class UserRegisterRequest extends RequestAbstract
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
            'email' => [
                'required',
                'string',
                'email:filter',
                'max:255',
                Rule::unique('users', 'email')
            ],
            'phone' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'phone')
            ],
            'first_name' => [
                'required',
                'string',
                'max:255'
            ],
            'last_name' => [
                'required',
                'string',
                'max:255'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
            ],
            'password_confirmation' => [
                'required',
                'same:password'
            ],
        ];
    }
}
