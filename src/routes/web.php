<?php

use Illuminate\Support\Facades\Route;
use AlRimi\Submit\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'index'])->name('students.index');
Route::post('/submit', [StudentController::class, 'store'])->name('students.submit');
