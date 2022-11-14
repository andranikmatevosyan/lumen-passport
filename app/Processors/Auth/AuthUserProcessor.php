<?php

namespace App\Processors\Auth;

use App\Actions\User\UserAuthAction;
use App\Components\PasswordReset\PasswordResetCreateComponent;
use App\Components\PasswordReset\PasswordResetTokenComponent;
use App\Components\User\UserCreateComponent;
use App\Components\User\UserEmailComponent;
use App\Components\User\UserPasswordComponent;
use App\Exceptions\IncorrectCredentialsException;
use App\Exceptions\InvalidTokenException;
use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Throwable;

class AuthUserProcessor
{
    /**
     * @param UserRepository $userRepository
     * @param PasswordResetRepository $passwordResetRepository
     * @param UserAuthAction $userAuthAction
     */
    public function __construct(
        private UserRepository $userRepository,
        private PasswordResetRepository $passwordResetRepository,
        private UserAuthAction $userAuthAction
    ) {
        //
    }

    public function processRegister(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $userCreateComponent = UserCreateComponent::fromArray($data);
            $user = $this->userRepository->create($userCreateComponent);
            $token = $this->userAuthAction->createToken($user);

            return compact('user', 'token');
        });
    }

    /**
     * @param array $data
     * @return array
     * @throws Throwable
     */
    public function processSignIn(array $data): array
    {
        $user = $this->userRepository->findByEmail(UserEmailComponent::fromArray($data));
        throw_if(!$user, new IncorrectCredentialsException());
        $passwordMatch = $this->userAuthAction->checkPasswords($user, $data['password']);
        throw_if(!$passwordMatch, new IncorrectCredentialsException());
        $token = $this->userAuthAction->createToken($user);

        return compact('user', 'token');
    }

    /**
     * @param array $data
     * @return void
     */
    public function processRecoverPassword(array $data): void
    {
        $user = $this->userRepository->findOrFailByEmail(UserEmailComponent::fromArray($data));
        $passwordResetCreateComponent = PasswordResetCreateComponent::fromArray(['email' => $user->email]);
        $passwordReset = $this->passwordResetRepository->updateOrCreate($passwordResetCreateComponent);
        $this->userAuthAction->notifyPasswordReset($user, $passwordReset);
    }

    /**
     * @param array $data
     * @return array
     */
    public function processPasswordReset(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $passwordResetTokenComponent = PasswordResetTokenComponent::fromArray(['token' => $data['token']]);
            $passwordReset = $this->passwordResetRepository->findByToken($passwordResetTokenComponent);
            throw_if(!$passwordReset, new InvalidTokenException());
            $user = $this->passwordResetRepository->relatedUser($passwordReset);
            $userPasswordComponent = UserPasswordComponent::fromArray(['password' => $data['password']]);
            $this->userRepository->changePassword($user, $userPasswordComponent);
            $this->passwordResetRepository->deleteOrFail($passwordReset);
            $token = $this->userAuthAction->createToken($user);

            return compact('user', 'token');
        });
    }
}
