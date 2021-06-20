<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Resources\PersonResource;
use App\Models\Address;
use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return PersonResource::collection(Person::areAdmins()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminRequest $request
     * @return JsonResponse
     */
    public function store(AdminRequest $request): JsonResponse
    {
        $person = Person::create(array_merge($requestValidated = $request->validated(), ['role' => Person::ROLES['admin']]));
        $address = Address::create($requestValidated['address'] ?? []);
        $person->address_id = $address->id;
        $person->save();
        return response()->json(['message' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param Person $admin
     * @return PersonResource
     */
    public function show(Person $admin): PersonResource
    {
        return PersonResource::make($admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdminRequest $request
     * @param Person $admin
     * @return JsonResponse
     */
    public function update(AdminRequest $request, Person $admin): JsonResponse
    {
        $admin->update($requestValidated = $request->validated());
        if (isset($requestValidated['address'])) {
            $admin->address()->update($requestValidated['address']);
        }
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Person $admin
     * @return JsonResponse
     */
    public function destroy(Person $admin): JsonResponse
    {
        $admin->address()->delete();
        $admin->delete();
        return response()->json(['message' => 'deleted']);
    }
}
