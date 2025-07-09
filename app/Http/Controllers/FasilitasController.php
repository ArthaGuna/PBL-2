<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::where('status', true)->get();
        return view('fasilitas.index', compact('fasilitas'));
    }

    public function show($slug)
    {
        $fasilitas = Fasilitas::where('slug', $slug)->where('status', true)->firstOrFail();
        return view('fasilitas.show', compact('fasilitas'));
    }
}
