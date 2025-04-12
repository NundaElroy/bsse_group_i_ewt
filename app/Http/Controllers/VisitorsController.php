<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;


class VisitorsController extends Controller
{
    // middleware auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $visitors = Visitor::all();
        return view('admin.visitors', compact('visitors'));
    }
}