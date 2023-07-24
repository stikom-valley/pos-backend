<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\UserRepository;
use App\Http\Requests\V1\AuthLoginRequest;
use App\Http\Resources\V1\UserResource;

class AuthController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    function login(AuthLoginRequest $request)
    {
        $user = $this->repository->login($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;

        return (new UserResource($user))->additional(['meta' => ['token' => $token]]);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    }
}
