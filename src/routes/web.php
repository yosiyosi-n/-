<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InquiryController;

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

Route::get('/', [InquiryController::class, 'index'])->name('inquiry.index');
Route::post('/confirm', [InquiryController::class, 'confirm'])->name('inquiry.confirm');
Route::post('/thanks', [InquiryController::class, 'thanks'])->name('inquiry.thanks');
// form action=の修正の容易さから「->name('inquiry.confirm')」を追加
Route::get('/admin', [InquiryController::class, 'admin'])->middleware(['auth'])->name('admin.index');
Route::post('/search', [InquiryController::class, 'search'])->middleware(['auth'])->name('admin.search');
Route::get('/reset', [InquiryController::class, 'reset'])->middleware(['auth'])->name('admin.reset');
