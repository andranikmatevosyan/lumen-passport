<?php

namespace App\Components\PasswordReset;

use App\Components\DataTransferObject;

class PasswordResetTokenComponent extends DataTransferObject
{
    public function __construct(
        public string $token,
    ) {
        //
    }

    /**
     * @param array $data
     * @return PasswordResetTokenComponent
     */
    public static function fromArray(array $data): PasswordResetTokenComponent
    {
        return new self(
            token: $data['token']
        );
    }
}
