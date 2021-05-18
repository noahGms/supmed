<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Http\Resources\PersonResource;
use App\Models\Address;
use App\Models\Doctor;
use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use PhpParser\Comment\Doc;

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
        $person = Person::create($requestValidated = array_merge($request->validated(), ['role' => Person::ROLES['doctor']]));
        $address = Address::create($requestValidated['address'] ?? []);
        $person->address_id = $address->id;
        $person->save();
        $doctor = Doctor::create(['person_id' => $person->id]);

        if (isset($requestValidated['specialities'])) {
            $doctor->specialities()->attach($requestValidated['specialities']);
        }
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
        $person = $doctor->person;
        $person->update($requestValidated = $request->validated());
        if (isset($requestValidated['address'])) {
            $person->address()->update($requestValidated['address']);
        }
        if (isset($requestValidated['specialities'])) {
            $doctor->specialities()->sync($requestValidated['specialities']);
        }
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
        $doctor->person->address()->delete();
        $doctor->person()->delete();
        return \response()->json(['message' => 'deleted']);
    }
}
