<?php

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
Route::get('/airpanas', function () {
    return view('layanan.airpanas');
})->name('airpanas');

Route::get('/jacuzzi', function () {
    return view('layanan.jacuzzi');
})->name('jacuzzi');

Route::get('/river', function () {
    return view('layanan.river');
})->name('river');

// Fasilitas
Route::get('/parkir', function () {
    return view('fasilitas.parkir');
})->name('parkir');

Route::get('/gazebo', function () {
    return view('fasilitas.gazebo');
})->name('gazebo');

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
