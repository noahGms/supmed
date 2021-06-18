<?php


namespace App\Services;

use App\Models\Doctor;
use App\Models\Workstime;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AvailabilitiesService
{
    public static function getAvailabilities(Doctor $doctor, Workstime $workstime): Collection
    {
        $timeslots = self::generateTimeslots(Doctor::APPOINTMENT_TIME, $workstime->start_date, $workstime->end_date);
        return $timeslots->map(function (Timeslot $timeslot) use ($workstime, $doctor) {
            return [
                'start' =>$timeslot->start_date->format('H:i') ,
                'end' =>$timeslot->end_date->format('H:i'),
                'free' => !$doctor->appointments()
                        ->where('start_date', $timeslot->start_date)
                        ->where('end_date', $timeslot->end_date)
                        ->count() > 0
            ];
        });
    }

    private static function generateTimeslots($duration, Carbon $start_date, Carbon $end_date): Collection
    {

        $timeslots = collect();
        $whileDate = $start_date->clone();
        while ($whileDate < $end_date) {
           $timeslot = new Timeslot();
           $timeslot->start_date = $whileDate->clone();
           $whileDate->addMinutes($duration);
           $timeslot->end_date = $whileDate->clone();
           $timeslots->push($timeslot);
        }

        return $timeslots;
    }
}
