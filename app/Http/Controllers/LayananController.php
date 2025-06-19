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

    public function show($id)
    {
        $layanan = Layanan::where('status', true)->findOrFail($id);
        return view('layanan.show', compact('layanan'));
    }
}