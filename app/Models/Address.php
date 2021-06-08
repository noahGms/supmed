<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public function usesTimestamps(): bool
    {
        return false;
    }

    public function getFullAddressAttribute()
    {
        $values = [
            'street_number' => $this->street_number,
            'street_name' => $this->street_name,
            'zipcode' => $this->zip_code,
            'city' => $this->city,
        ];

        $full_address = '';
        foreach ($values as $value) {
            if ($value !== null && is_string($value)) {
                $full_address .= $value . ' ';
            }
        }
        return $full_address;
    }

    protected $fillable = [
        'street_number',
        'street_name',
        'zipcode',
        'city'
    ];
}
