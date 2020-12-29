<?php

namespace App\Http\Resources\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'token' => $this->createToken('auth')->accessToken,
          'user' => [
              'name' => $this->name,
              'role' => $this->getRoleNames()[0] ?? null,
              'permissions' => $this->getPermissionsViaRoles()->pluck('name')
          ]
        ];
    }
}
