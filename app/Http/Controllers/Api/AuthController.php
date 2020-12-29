<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\Api\Auth\LoginResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Authentication user
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $foundUser = User::query()
            ->where('email', '=', $credentials['email'])
            ->first();

        if($foundUser && Hash::check($credentials['password'], $foundUser->password)) {
            return response()->json(new LoginResource($foundUser));
        }

        return response()->errorValidation(["email" => "Email or password incorrect."]);
    }
}
