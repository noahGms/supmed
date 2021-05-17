<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Resources\PersonResource;
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
        Person::create(array_merge($request->validated(), ['role' => Person::ROLES['admin']]));
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
        $admin->update($request->validated());
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
        $admin->delete();
        return response()->json(['message' => 'deleted']);
    }
}
