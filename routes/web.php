<?php

use App\Http\Controllers\StaticContentController;
use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
 * The static pages
 */
Route::get('/', [StaticContentController::class, 'index'])->name('index');
Route::get('/profile', [StaticContentController::class, 'profile'])->name('profile');
Route::get('/dashboard', [StaticContentController::class, 'dashboard'])->name('dashboard');
Route::get('/blog', [StaticContentController::class, 'blog'])->name('blog');

/*
 * The static blog pages
 */
Route::get('/blog/professions', [StaticContentController::class, 'professions'])->name('professions');
Route::get('/blog/first_feedback', [StaticContentController::class, 'first_feedback'])->name('first_feedback');
Route::get('/blog/programming_expirience', [StaticContentController::class, 'programming_expirience'])->name('programming_expirience');
Route::get('/blog/study_choice', [StaticContentController::class, 'study_choice'])->name('study_choice');
Route::get('/blog/swot_analysis', [StaticContentController::class, 'swot_analysis'])->name('swot_analysis');

/*
 * The faq pages
 */
Route::get('/faq', [FaqController::class, 'faq'])->name('faq');
Route::get('faq/create', [FaqController::class, 'create'])->name('faq.create');
Route::post('faq', [FaqController::class, 'store'])->name('faq.store');
Route::get('faq/{faq}/edit', [FaqController::class, 'edit'])->name('faq.edit');
Route::put('faq/{faq}', [FaqController::class, 'update'])->name('faq.update');
Route::get('faq/{faq}/delete', [FaqController::class, 'delete'])->name('faq.delete');
Route::delete('faq/{faq}', [FaqController::class, 'destroy'])->name('faq.destroy');
//edit, destroy and delete are missing a parameter

Route::get('/trigger-500', function () {
    abort(500, 'Intentional 500 error for testing purposes.');
})->name('trigger-500');

Route::get('/trigger-404', function () {
    abort(404, 'Intentional 404 error for testing purposes.');
})->name('trigger-404');

