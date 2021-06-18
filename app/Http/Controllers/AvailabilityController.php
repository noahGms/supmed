<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Workstime;
use App\Services\AvailabilitiesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    /**
     * @param Request $request
     * @param Doctor $doctor
     * @param Workstime $workstime
     * @return JsonResponse
     */
    public function __invoke(Request $request, Doctor $doctor, Workstime $workstime): JsonResponse
    {
        return response()->json(['data' => AvailabilitiesService::getAvailabilities($doctor, $workstime)]);
    }
}
