<?php

namespace App\Components\PasswordReset;

use App\Components\DataTransferObject;
use App\Models\PasswordReset;

class PasswordResetCreateComponent extends DataTransferObject
{
    public function __construct(
        public string $email,
        public string $token,
    ) {
        //
    }

    /**
     * @param array $data
     * @return PasswordResetCreateComponent
     */
    public static function fromArray(array $data): PasswordResetCreateComponent
    {
        return new self(
            email: $data['email'],
            token: $data['token'] ?? PasswordReset::generateUniqueToken()
        );
    }
}
