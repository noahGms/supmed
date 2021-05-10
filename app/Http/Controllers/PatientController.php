<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Http\Resources\PersonResource;
use App\Models\Patient;
use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return PersonResource::collection(Person::arePatients()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PatientRequest $request
     * @return JsonResponse
     */
    public function store(PatientRequest $request): JsonResponse
    {
        $person = Person::create(array_merge($request->validated(), ['role' => Person::ROLES['patient']]));
        Patient::create(['person_id' => $person->id]);
        return response()->json(['message' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param Patient $patient
     * @return PersonResource
     */
    public function show(Patient $patient): PersonResource
    {
        return PersonResource::make($patient->person);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PatientRequest $request
     * @param Patient $patient
     * @return JsonResponse
     */
    public function update(PatientRequest $request, Patient $patient): JsonResponse
    {
        $patient->person()->update($request->validated());
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Patient $patient
     * @return JsonResponse
     */
    public function destroy(Patient $patient): JsonResponse
    {
        $patient->person()->delete();
        return response()->json(['message' => 'deleted']);
    }
}
