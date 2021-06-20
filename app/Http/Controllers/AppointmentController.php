<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AppointmentResource::collection(Appointment::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AppointmentRequest $request
     * @return JsonResponse
     */
    public function store(AppointmentRequest $request): JsonResponse
    {
        Appointment::create($request->validated());
        return response()->json(['message' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param Appointment $appointment
     * @return AppointmentResource
     */
    public function show(Appointment $appointment): AppointmentResource
    {
        return AppointmentResource::make($appointment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AppointmentRequest $request
     * @param Appointment $appointment
     * @return JsonResponse
     */
    public function update(AppointmentRequest $request, Appointment $appointment): JsonResponse
    {
        $appointment->update($request->validated());
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Appointment $appointment
     * @return JsonResponse
     */
    public function destroy(Appointment $appointment): JsonResponse
    {
        $appointment->delete();
        return response()->json(['message' => 'deleted']);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function myAppointments(): AnonymousResourceCollection
    {
        return AppointmentResource::collection(Appointment::all()->where('patient_id', Auth::id()));
    }
}
