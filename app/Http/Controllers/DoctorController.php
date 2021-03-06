<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Address;
use App\Models\Doctor;
use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        if (!is_null($search = $request->query('search'))) {
            $doctors = Doctor::search($search)->get();
        } else {
            $doctors = Doctor::all();
        }

        return DoctorResource::collection($doctors);
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
     * @return DoctorResource
     */
    public function show(Doctor $doctor): DoctorResource
    {
        return DoctorResource::make($doctor);
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
