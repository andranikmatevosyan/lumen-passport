<?php

namespace App\Http\Resources\Responses;

use App\Http\Resources\UserResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserAuthResource extends JsonResource
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
            'user' => new UserResource($this['user']),
            'token' =>new TokenResource($this['token'])
        ];
    }
}
