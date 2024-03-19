<?php

use App\Http\Controllers\{
    ConvertionController,
    ImageController,
    ProfileController,
    SubscriptionController
};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/convertion', function () {
        return Inertia::render('Convertion');
    })->name('convertion');
    // image generation
    Route::get('/image-generation', function () {
        return Inertia::render('Image');
    })->name('image');
    // Code generation
    Route::get('/code-generation', function () {
        return Inertia::render('Code');
    })->name('code');
    // QR code generation
    Route::get('/qr-code-generation', function () {
        return Inertia::render('QrCode');
    })->name('qr-code');
    // video generation
    Route::get('/video-generation', function () {
        return Inertia::render('Video');
    })->name('video');
    // audio generation
    Route::get('/audio-generation', function () {
        return Inertia::render('Audio');
    })->name('audio');
    // File generation
    Route::get('/file-generation', function () {
        return Inertia::render('File');
    })->name('file');
    // Setting
    Route::get('/setting', function () {
        return Inertia::render('Setting');
    })->name('setting');
    // email generation
    Route::get('/email-generation', function () {
        return Inertia::render('Email');
    })->name('email');
    // subscription
    Route::get('/subscription', function () {
        return Inertia::render('Subscription');
    })->name('subscription');


     Route::post('/convertion/convert', [ConvertionController::class, 'convert'])->name('convertion.convert');
     Route::post('/image-generation', [ImageController::class, 'genaretImage'])->name('image-generation');


     Route::prefix('subscription')->group(function () {
        Route::get('/plans', [SubscriptionController::class, 'plans'])->name('subscription.plans');
        Route::post('/subscribe/{productId}', [SubscriptionController::class, 'subscribe'])->name('subscription.subscribe');
        // Route::post('/resume', [SubscriptionController::class, 'resume'])->name('subscription.resume');
        // Route::post('/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
        // Route::post('/swap', [SubscriptionController::class, 'swap'])->name('subscription.swap');
        // Route::post('/update-card', [SubscriptionController::class, 'updateCard'])->name('subscription.updateCard');
     });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';