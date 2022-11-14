<?php

namespace App\Components\User;

use App\Components\DataTransferObject;
use Illuminate\Support\Facades\Hash;

class UserPasswordComponent extends DataTransferObject
{
    public function __construct(
        public string $password
    ) {
        //
    }

    /**
     * @param array $data
     * @return UserPasswordComponent
     */
    public static function fromArray(array $data): UserPasswordComponent
    {
        return new self(
            password: Hash::make($data['password'])
        );
    }
}
