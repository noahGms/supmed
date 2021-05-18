<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    public function usesTimestamps(): bool
    {
        return false;
    }

    protected $fillable = [
        'name',
        'description'
    ];
}
