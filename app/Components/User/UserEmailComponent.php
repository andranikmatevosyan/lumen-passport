<?php

namespace App\Components\User;

use App\Components\DataTransferObject;

class UserEmailComponent extends DataTransferObject
{
    public function __construct(
        public string $email,
    ) {
        //
    }

    /**
     * @param array $data
     * @return UserEmailComponent
     */
    public static function fromArray(array $data): UserEmailComponent
    {
        return new self(
            email: $data['email']
        );
    }
}
