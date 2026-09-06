<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        $animales = session('animales', []);
        
        return view('animales.index', compact('animales'));
    }
}