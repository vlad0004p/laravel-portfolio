<?php

use App\Http\Controllers\StaticContentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Add this health check route at the top
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
        'environment' => app()->environment(),
        'php_version' => PHP_VERSION,
        'laravel_version' => app()->version()
    ]);
});

// Debug route to test view rendering
Route::get('/debug', function () {
    try {
        return response()->json([
            'views_exist' => [
                'welcome' => view()->exists('welcome'),
                'layouts.app' => view()->exists('layouts.app'),
            ],
            'storage_writable' => is_writable(storage_path()),
            'cache_writable' => is_writable(storage_path('framework/cache')),
            'env_vars' => [
                'APP_ENV' => env('APP_ENV'),
                'APP_DEBUG' => env('APP_DEBUG'),
                'DB_CONNECTION' => env('DB_CONNECTION'),
            ]
        ]);
    } catch (Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});

// Simple test route that doesn't use views
Route::get('/test', function () {
    return '<h1>Simple Test Route Works!</h1><p>Laravel is running properly.</p>';
});


/*
|--------------------------------------------------------------------------
| Public route: Welcome page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('index')
        : view('welcome');
})->name('welcome');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Static pages
    Route::get('/home', [StaticContentController::class, 'index'])->name('index');
    Route::get('/profile', [StaticContentController::class, 'profile'])->name('profile');
    Route::get('/blog', [StaticContentController::class, 'blog'])->name('blog');

    // Blog subpages
    Route::get('/blog/professions', [StaticContentController::class, 'professions'])->name('professions');
    Route::get('/blog/first_feedback', [StaticContentController::class, 'first_feedback'])->name('first_feedback');
    Route::get('/blog/programming_expirience', [StaticContentController::class, 'programming_expirience'])->name('programming_expirience');
    Route::get('/blog/study_choice', [StaticContentController::class, 'study_choice'])->name('study_choice');
    Route::get('/blog/swot_analysis', [StaticContentController::class, 'swot_analysis'])->name('swot_analysis');

    // FAQ (protected)
    Route::get('/faq', [FaqController::class, 'faq'])->name('faq');
    Route::get('faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('faq', [FaqController::class, 'store'])->name('faq.store');
    Route::get('faq/{faq}/edit', [FaqController::class, 'edit'])->name('faq.edit');
    Route::put('faq/{faq}', [FaqController::class, 'update'])->name('faq.update');
    Route::get('faq/{faq}/delete', [FaqController::class, 'delete'])->name('faq.delete');
    Route::delete('faq/{faq}', [FaqController::class, 'destroy'])->name('faq.destroy');

    // Profile management (Breeze)
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/user/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Error test routes
    Route::get('/trigger-500', fn () => abort(500, 'Intentional 500 error'))->name('trigger-500');
    Route::get('/trigger-404', fn () => abort(404, 'Intentional 404 error'))->name('trigger-404');
});

/*
|--------------------------------------------------------------------------
| Breeze Logout route (POST)
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

/*
|--------------------------------------------------------------------------
| Breeze Auth routes (login, register, etc.)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
