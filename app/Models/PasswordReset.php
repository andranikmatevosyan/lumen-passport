<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @property string $email
 * @property string $token
 * @property DateTime $created_at
 * @property BelongsTo $user
 */
class PasswordReset extends Model
{
    use HasFactory;

    public $timestamps = ["created_at"];
    const UPDATED_AT = null;

    protected $fillable = [
        'email',
        'token',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    /**
     * Generates unique token
     *
     * @return string
     */
    public static function generateUniqueToken(): string
    {
        do {
            $token = Str::random(60);
            $tokenExists = self::query()->where(compact('token'))->exists();
        } while($tokenExists);

        return $token;
    }
}
