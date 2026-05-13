<?php

namespace App\Http\Controllers;

use App\Models\Plumber;
use Illuminate\Http\Request;

class PlumberController extends Controller
{
    public function index()
    {
        $plumbers = Plumber::orderBy('rating','desc')->paginate(12);
        return view('plumbers.index', compact('plumbers'));
    }

    public function show(Plumber $plumber)
    {
        return view('plumbers.show', compact('plumber'));
    }
}
