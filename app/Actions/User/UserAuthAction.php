<?php
namespace App\Actions\User;


use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\PasswordResetNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\PersonalAccessTokenResult;

class UserAuthAction
{
    /**
     * @param User $user
     * @return PersonalAccessTokenResult
     */
    public function createToken(User $user): PersonalAccessTokenResult
    {
        return $user->createToken('app');
    }

    /**
     * @param User $user
     * @param string $password
     * @return bool
     */
    public function checkPasswords(User $user, string $password): bool
    {
        return Hash::check($password, $user->password);
    }

    /**
     * @param User $user
     * @param PasswordReset $passwordReset
     * @return void
     */
    public function notifyPasswordReset(User $user, PasswordReset $passwordReset): void
    {
        $url = sprintf('%s?%s', config('front.password_reset_url'), http_build_query(['token' => $passwordReset->token]));
        $name = sprintf('%s %s', $user->first_name, $user->last_name);
        $data = compact('url', 'name');

        Mail::send('emails.recover', $data, function($message) use ($user, $name) {
            $message->to($user->email, $name)->subject('Password recover');
            $message->from(config('mail.from.address'), config('mail.from.name'));
        });
    }
}
