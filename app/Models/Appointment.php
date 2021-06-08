<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'person_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'person_id');
    }

    public function type()
    {
        return $this->belongsTo(AppointmentsType::class, 'type_id');
    }
}
