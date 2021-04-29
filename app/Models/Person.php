<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
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

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = Hash::make($password);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'person_id');
    }
}
