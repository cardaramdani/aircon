<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Testimonial;

class ServiceController extends Controller
{
    public function jakarta()
    {
        return view('services.jakarta');
    }

    public function tangerang()
    {
        return view('services.tangerang');
    }

    public function jakartaArea($area)
    {
        // Logic untuk area spesifik Jakarta
        return view('services.area', compact('area'));
    }
}
