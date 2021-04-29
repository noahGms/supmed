<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    public $timestamps = false;

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
}
