<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\PersonRequest;
use App\Http\Resources\PersonResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return PersonResource|JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json(['message' => 'bad credentials'], 403);
        }

        return PersonResource::make(Auth::user())->additional(['token_bearer' => Auth::user()->createToken('API Token')->plainTextToken]);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logout']);
    }

    /**
     * @return PersonResource
     */
    public function whoami(): PersonResource
    {
        return PersonResource::make(Auth::user());
    }

    /**
     * @param PersonRequest $request
     * @return JsonResponse
     */
    public function update(PersonRequest $request): JsonResponse
    {
        Auth::user()->update($requestValidated = $request->validated());
        if (isset($requestValidated['address'])) {
            Auth::user()->address()->update($requestValidated['address']);
        }
        return response()->json(['message' => 'updated']);
    }

}
