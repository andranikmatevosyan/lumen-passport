<?php

namespace App\Repositories;

use App\Components\User\UserCreateComponent;
use App\Components\User\UserEmailComponent;
use App\Components\User\UserPasswordComponent;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{
    /**
     * @param UserCreateComponent $userCreateComponent
     * @return Model|User|Builder
     */
    public function firstOrCreate(UserCreateComponent $userCreateComponent): Model|User|Builder
    {
        return User::query()->firstOrCreate(
            $userCreateComponent->only(['email'])->toArray(),
            $userCreateComponent->except(['email'])->toArray()
        );
    }

    public function create(UserCreateComponent $userCreateComponent): Model|User|Builder
    {
        return User::query()->create($userCreateComponent->all());
    }

    /**
     * @param UserEmailComponent $userEmailComponent
     * @return Model|User|Builder|null
     */
    public function findByEmail(UserEmailComponent $userEmailComponent): Model|User|Builder|null
    {
        return User::query()->where($userEmailComponent->all())->first();
    }

    /**
     * @param UserEmailComponent $userEmailComponent
     * @return Model|User|Builder
     */
    public function findOrFailByEmail(UserEmailComponent $userEmailComponent): Model|User|Builder
    {
        return User::query()->where($userEmailComponent->all())->firstOrFail();
    }

    /**
     * @param User $user
     * @param UserPasswordComponent $userPasswordComponent
     * @return bool
     */
    public function changePassword(User $user, UserPasswordComponent $userPasswordComponent): bool
    {
        return $user->update($userPasswordComponent->all());
    }
}
