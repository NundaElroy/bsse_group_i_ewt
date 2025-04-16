<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class UserEventController extends Controller
{
    public function index()
    { 

      $events = Event::all();
      return view("events.userEvent",compact('events'));
    }

    public function gallery()
    {
      return view("gallery.gallery");
    }
}