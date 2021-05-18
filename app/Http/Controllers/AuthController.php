<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\PersonRequest;
use App\Http\Resources\PersonResource;
use App\Models\Patient;
use App\Models\Person;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $person = Person::create(array_merge($request->validated(), ['role' => Person::ROLES['patient']]));
        Patient::create(['person_id' => $person->id]);
        return response()->json(['message' => 'created']);
    }

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
        Auth::user()->update($request->validated());
        return response()->json(['message' => 'updated']);
    }

}
