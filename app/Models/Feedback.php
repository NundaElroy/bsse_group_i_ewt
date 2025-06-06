<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // Specify the table name if it differs from the model name (optional here)
    //removed comments from protected $table
    protected $table = 'feedback';

    // Define fillable fields for mass assignment
    protected $fillable = [
        'email',
        'comment',
        'subject',
        'rating',
        'date',
    ];

    // Cast the date field to a proper date format
    protected $casts = [
        'date' => 'date',
        //added rating to make sure it is treated as an integer value
        'rating'=> 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}