<?php

use Illuminate\Support\Facades\Route;
use AlRimi\Submit\Controllers\StudentController;

Route::get('/submit', [StudentController::class, 'index'])->name('students.index');
Route::post('/submit/load', [StudentController::class, 'store'])->name('students.submit');
