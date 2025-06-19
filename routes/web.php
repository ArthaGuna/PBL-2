<?php

use App\Http\Controllers\LayananController;
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

    // Route booking
    Route::get('/booking', function () {
        return view('auth.booking');
    })->name('booking');
});


require __DIR__ . '/auth.php';
