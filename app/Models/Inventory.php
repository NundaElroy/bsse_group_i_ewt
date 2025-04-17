<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'name',
        'inventory_type',
        'description',
        'quantity',
        'image',
        'employee_id',
    ];

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}

