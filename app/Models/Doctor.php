<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

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
        return $this->belongsToMany(Doctor::class, 'speciality_doctor', 'doctor_id', 'speciality_id', 'person_id', 'person_id');
    }
}
