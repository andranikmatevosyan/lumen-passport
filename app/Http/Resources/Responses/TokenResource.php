<?php

namespace App\Http\Resources\Responses;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property string $accessToken
 * @property Model $token
 */
class TokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'access_token' => $this->accessToken,
            'type' => 'Bearer',
            'name' => $this->token->name,
            'revoked' => $this->token->revoked,
            'expires_at' => $this->token->expires_at,
        ];
    }
}
