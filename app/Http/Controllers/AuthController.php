<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\PersonResource;
use App\Models\Doctor;
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
    public function registerAsDoctor(RegisterRequest $request): JsonResponse
    {
        $person = Person::create(array_merge($request->validated(), ['role' => Person::ROLES['doctor']]));
        Doctor::create(['person_id' => $person->id]);
        return response()->json(['message' => 'created']);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function registerAsPatient(RegisterRequest $request): JsonResponse
    {
        $person = Person::create(array_merge($request->validated(), ['role' => Person::ROLES['patient']]));
        Patient::create(['person_id' => $person->id]);
        return response()->json(['message' => 'created']);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json(['message' => 'bad credentials'], 403);
        }

        return response()->json(['access_token' => Auth::user()->createToken('API Token')->plainTextToken]);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'logout']);
    }

    /**
     * @return PersonResource
     */
    public function whoami(): PersonResource
    {
        return PersonResource::make(Auth::user());
    }
}
