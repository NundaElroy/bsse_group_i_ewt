<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'visit_date',
        'adult_tickets',
        'child_tickets',
        'total_amount',
        'payment_method',
        'special_requests',
       
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

   
}