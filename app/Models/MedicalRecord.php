<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'record_date',
        'procedure_type',
        'diagnosis',
        'treatment',
        'notes',
        'performed_by'
    ];

    protected $casts = [
        'record_date' => 'date',
    ];
    

    //many medical records to one animal 
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class, 'performed_by');
    // }
}
