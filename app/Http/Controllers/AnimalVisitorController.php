<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Location;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AnimalVisitorController extends Controller
{
    public function index()
    {
        $animals = Animal::with('location')->get();
        return view('animal_in_zoo', compact('animals'));
    }


}
