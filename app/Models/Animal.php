<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'species',
        'age',
        'gender',
        'location_id',
        'date_of_birth',
        'acquisition_date',
        'identification_number',
        'origin',
        'dietary_requirements',
        'medical_history',
        'image'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'acquisition_date' => 'date',
    ];
     
    //many animals to one location 
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    
    //an animal has many  records
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
	public function habitat()
{
    return $this->belongsTo(Habitat::class);
}

    
    // // If you want to track which employees care for this animal
    // public function caretakers()
    // {
    //     return $this->belongsToMany(Employee::class, 'animal_employee');
    // }
}