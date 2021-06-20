<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkstimeRequest;
use App\Http\Resources\WorkstimeResource;
use App\Models\Doctor;
use App\Models\Workstime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WorkstimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Doctor $doctor): AnonymousResourceCollection
    {
        return WorkstimeResource::collection($doctor->workstimes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Doctor $doctor
     * @param WorkstimeRequest $request
     * @return JsonResponse
     */
    public function store(Doctor $doctor, WorkstimeRequest $request): JsonResponse
    {
        $doctor->workstimes()->create($request->validated());
        return response()->json(['message' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param Doctor $doctor
     * @param Workstime $workstime
     * @return WorkstimeResource
     */
    public function show(Doctor $doctor, Workstime $workstime): WorkstimeResource
    {
        return WorkstimeResource::make($workstime);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WorkstimeRequest $request
     * @param Doctor $doctor
     * @param Workstime $workstime
     * @return JsonResponse
     */
    public function update(WorkstimeRequest $request, Doctor $doctor, Workstime  $workstime): JsonResponse
    {
        $workstime->update($request->validated());
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Doctor $doctor
     * @param Workstime $workstime
     * @return JsonResponse
     */
    public function destroy(Doctor $doctor, Workstime $workstime): JsonResponse
    {
        $workstime->delete();
        return response()->json(['message' => 'deleted']);
    }
}
