
<?php

use App\Http\Controllers\Latin\SafetyCheckController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('safetycheck/index', [SafetyCheckController::class, 'index'])->name('safetycheck.index');
Route::get('safetycheck/create', [SafetyCheckController::class, 'create'])->name('safetycheck.create');
Route::post('safetycheck/store', [SafetyCheckController::class, 'store'])->name('safetycheck.store');
Route::get('safetycheck/regulation', [SafetyCheckController::class, 'regulationForm'])->name('safetycheck.regulationForm');
Route::get(
    '/safetycheck/{id}/export-pdf',
    [SafetyCheckController::class, 'exportSinglePdf']
)->name('safetycheck.exportpdf');

require __DIR__ . '/auth.php';
