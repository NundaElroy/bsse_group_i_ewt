<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'address',
        'visitor_type',
        'document_type',
        'document_number',
    ];

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }
}
