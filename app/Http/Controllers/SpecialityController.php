<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialityRequest;
use App\Http\Resources\SpecialityResource;
use App\Models\Speciality;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return SpecialityResource::collection(Speciality::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SpecialityRequest $request
     * @return JsonResponse
     */
    public function store(SpecialityRequest $request): JsonResponse
    {
        Speciality::create($request->validated());
        return response()->json(['message' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param Speciality $speciality
     * @return SpecialityResource
     */
    public function show(Speciality $speciality): SpecialityResource
    {
        return SpecialityResource::make($speciality);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SpecialityRequest $request
     * @param Speciality $speciality
     * @return JsonResponse
     */
    public function update(SpecialityRequest $request, Speciality $speciality): JsonResponse
    {
        $speciality->update($request->validated());
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Speciality $speciality
     * @return JsonResponse
     */
    public function destroy(Speciality $speciality): JsonResponse
    {
        $speciality->delete();
        return response()->json(['message' => 'deleted']);
    }
}
