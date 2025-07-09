<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::where('status', true)->get();
        return view('layanan.index', compact('layanans'));
    }

    public function show($slug)
    {
        $layanan = Layanan::where('status', true)->where('slug', $slug)->firstOrFail();
        return view('layanan.show', compact('layanan'));
    }
}
