<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentsTypeRequest;
use App\Http\Resources\AppointmentsTypeResource;
use App\Models\AppointmentsType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AppointmentsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AppointmentsTypeResource::collection(AppointmentsType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AppointmentsTypeRequest $request
     * @return JsonResponse
     */
    public function store(AppointmentsTypeRequest $request): JsonResponse
    {
        AppointmentsType::create($request->validated());
        return response()->json(['message' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param AppointmentsType $appointmentsType
     * @return AppointmentsTypeResource
     */
    public function show(AppointmentsType $appointmentsType): AppointmentsTypeResource
    {
        return AppointmentsTypeResource::make($appointmentsType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AppointmentsTypeRequest $request
     * @param AppointmentsType $appointmentsType
     * @return JsonResponse
     */
    public function update(AppointmentsTypeRequest $request, AppointmentsType $appointmentsType): JsonResponse
    {
        $appointmentsType->update($request->validated());
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AppointmentsType $appointmentsType
     * @return JsonResponse
     */
    public function destroy(AppointmentsType $appointmentsType): JsonResponse
    {
        $appointmentsType->delete();
        return response()->json(['message' => 'deleted']);
    }
}
