<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role',
        'phone_number',
        'profile_photo',
        'contract_start_date',
        'contract_end_date',
        'salary',
        'status'
    ];

    protected $casts = [
        'contract_start_date' => 'date',
        'contract_end_date' => 'date',
    ];
     
    //one to one relationship with the user class 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // public function medicalRecords()
    // {
    //     return $this->hasMany(MedicalRecord::class, 'performed_by');
    // }
    
    // // If you want to track which animals an employee cares for
    // public function animals()
    // {
    //     return $this->belongsToMany(Animal::class, 'animal_employee');
    // }
}