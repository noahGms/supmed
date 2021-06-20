<?php

namespace App\Services;

use Carbon\Carbon;

class Timeslot
{
    /**
     * @return Carbon
     */
    public function getStartDate(): Carbon
    {
        return $this->start_date;
    }

    /**
     * @param Carbon $start_date
     */
    public function setStartDate(Carbon $start_date): void
    {
        $this->start_date = $start_date;
    }

    /**
     * @return Carbon
     */
    public function getEndDate(): Carbon
    {
        return $this->end_date;
    }

    /**
     * @param Carbon $end_date
     */
    public function setEndDate(Carbon $end_date): void
    {
        $this->end_date = $end_date;
    }
    public Carbon $start_date;
    public Carbon $end_date;
}