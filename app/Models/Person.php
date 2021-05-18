<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Person extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'persons';

    protected $fillable = [
        'email',
        'password',
        'firstname',
        'lastname',
        'phone',
        'role'
    ];

    public const ROLES = [
        'patient' => 'patient',
        'doctor' => 'doctor',
        'admin' => 'admin'
    ];


    public function scopeAreDoctors($query)
    {
        return $query->whereHas('doctor');
        //return $query->where('role', 'doctor');
    }

    public function scopeArePatients($query)
    {
        return $query->whereHas('patient');
    }

    public function scopeAreAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = Hash::make($password);
    }

    public function getFullNameAttribute()
    {
        $lastname = $this->lastname ? ' '. $this->lastname : '';
        return ucfirst($this->firstname) . Str::upper($lastname);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'person_id');
    }

    public function patient()
    {
        return $this->hasOne(Patient::class, 'person_id');
    }
}
