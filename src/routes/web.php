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

Route::get('/inquiry', [InquiryController::class, 'index'])->name('inquiry.index');
Route::post('/inquiry/confirm', [InquiryController::class, 'confirm'])->name('inquiry.confirm');
Route::post('/inquiry/thanks', [InquiryController::class, 'thanks'])->name('inquiry.thanks');
// form action=の修正の容易さから「->name('inquiry.confirm')」を追加