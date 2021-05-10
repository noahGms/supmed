<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Http\Resources\PersonResource;
use App\Models\Doctor;
use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return PersonResource::collection(Person::areDoctors()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DoctorRequest $request
     * @return JsonResponse
     */
    public function store(DoctorRequest $request): JsonResponse
    {
        $person = Person::create(array_merge($request->validated(), ['role' => Person::ROLES['doctor']]));
        Doctor::create(['person_id' => $person->id]);
        return response()->json(['message' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param Doctor $doctor
     * @return PersonResource
     */
    public function show(Doctor $doctor): PersonResource
    {
        return PersonResource::make($doctor->person);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DoctorRequest $request
     * @param Doctor $doctor
     * @return JsonResponse
     */
    public function update(DoctorRequest $request, Doctor $doctor): JsonResponse
    {
        $doctor->person()->update($request->validated());
        return \response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Doctor $doctor
     * @return JsonResponse
     */
    public function destroy(Doctor $doctor): JsonResponse
    {
        $doctor->person()->delete();
        return \response()->json(['message' => 'deleted']);
    }
}
