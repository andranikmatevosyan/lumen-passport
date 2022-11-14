<?php

namespace App\Repositories;

use App\Components\PasswordReset\PasswordResetCreateComponent;
use App\Components\PasswordReset\PasswordResetTokenComponent;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Throwable;

class PasswordResetRepository
{
    /**
     * @param PasswordResetCreateComponent $component
     * @return Model|PasswordReset|Builder
     */
    public function updateOrCreate(PasswordResetCreateComponent $component): Model|PasswordReset|Builder
    {
        return PasswordReset::query()->updateOrCreate(
            $component->only(['email'])->toArray(),
            $component->except(['email'])->toArray()
        );
    }

    /**
     * @param PasswordResetTokenComponent $component
     * @return Model|PasswordReset|Builder|null
     */
    public function findByToken(PasswordResetTokenComponent $component): Model|PasswordReset|Builder|null
    {
        return PasswordReset::query()->where($component->all())->first();
    }

    /**
     * @param PasswordReset $passwordReset
     * @return bool|null
     * @throws Throwable
     */
    public function deleteOrFail(PasswordReset $passwordReset): ?bool
    {
        return $passwordReset->deleteOrFail();
    }

    /**
     * @param PasswordReset $passwordReset
     * @return Model|User|BelongsTo
     */
    public function relatedUser(PasswordReset $passwordReset): Model|User|BelongsTo
    {
        return $passwordReset->user->getModel();
    }
}
