<?php

namespace App\Components\Company;

use App\Components\DataTransferObject;
use App\Models\User;

class CompanyCreateComponent extends DataTransferObject
{
    public function __construct(
        public int $user_id,
        public string $phone,
        public string $title ,
        public ?string $description,
    ) {
        //
    }

    /**
     * @param User $user
     * @param array $data
     * @return CompanyCreateComponent
     */
    public static function fromArray(User $user, array $data): CompanyCreateComponent
    {
        return new self(
            user_id: $user->id,
            phone: $data['phone'],
            title: $data['title'],
            description: $data['description']

        );
    }
}
