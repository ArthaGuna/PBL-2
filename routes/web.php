<?php

use App\Http\Controllers\LayananController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\GaleriFotoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Chatbot
// Route::post('/chatbot', [ChatbotController::class, 'handle']);

// Galeri Foto
Route::get('/galeri/foto', function () {
    return view('galeri.foto');
})->name('galeri.foto');

//  Galeri Video
Route::get('/galeri/video', function () {
    return view('galeri.video');
})->name('galeri.video');

// Layanan
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan/{id}', [LayananController::class, 'show'])->name('layanan.show');

// Fasilitas
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');
Route::get('/fasilitas/{id}', [FasilitasController::class, 'show'])->name('fasilitas.show');

// Logout Admin 
Route::post('/admin/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/'); // redirect ke homepage setelah logout
})->name('filament.admin.auth.logout');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route reservasi
    Route::get('/reservasi', function() {
        return view('auth.reservasi');
    })->name('reservasi');

    Route::post('/reservasi/proses', [ReservasiController::class, 'process'])->name('reservasi.proses');
    
    // Route status pembayaran
    Route::get('/reservasi/thankyou', function () {
        return view('payment.thankyou');
    })->name('reservasi.thankyou');
    
    Route::get('/reservasi/pending', function () {
        return view('payment.pending');
    })->name('reservasi.pending');
    
    Route::get('/reservasi/failed', function () {
        return view('payment.failed');
    })->name('reservasi.failed');
    
    // Handle notifikasi Midtrans
    Route::post('/payment/notification', [ReservasiController::class, 'handleNotification']);
});


require __DIR__ . '/auth.php';
