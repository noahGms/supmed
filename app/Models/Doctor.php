<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Doctor extends Model
{
    use HasFactory, Searchable;

    public function usesTimestamps(): bool
    {
        return false;
    }

    protected $primaryKey = 'person_id';

    public $incrementing = false;

    protected $fillable = [
        'person_id'
    ];

    protected $casts = [
        'person_id' => 'int'
    ];

    public const APPOINTMENT_TIME = 15;

    public function toSearchableArray()
    {
        return [
            'person_id' => $this->person_id,
            'firstname' => $this->person->firstname,
            'lastname' => $this->person->lastname,
            'fulladdress' => $this->person->address->fulladdress,
            'specialities' => $this->specialities->map(function ($speciality) {
                return $speciality->name;
            }),
            'keywords' => $this->specialities->map(function ($speciality) {
                return $speciality->keywords->map(function ($keyword) {
                    return $keyword->name;
                });
            })
        ];
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function workstimes()
    {
        return $this->hasMany(Workstime::class, 'doctor_id');
    }

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class, 'speciality_doctor', 'doctor_id', 'speciality_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'person_id');
    }
}
