<?php

namespace App\Components\User;

use App\Components\DataTransferObject;
use Illuminate\Support\Facades\Hash;

class UserCreateComponent extends DataTransferObject
{
    public function __construct(
        public string $email,
        public string $phone,
        public string $first_name,
        public string $last_name,
        public string $password
    ) {
        //
    }

    /**
     * @param array $data
     * @return UserCreateComponent
     */
    public static function fromArray(array $data): UserCreateComponent
    {
        return new self(
            email: $data['email'],
            phone: $data['phone'],
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            password: Hash::make($data['password'])
        );
    }
}
