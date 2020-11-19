<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/provider', function () {
    return view('provider');
})->name('provider');

Route::middleware(['auth:sanctum', 'verified'])->get('/childCalendar', function () {
    return view('child-calendar');
})->name('childCalendar');

Route::middleware(['auth:sanctum', 'verified'])->get('/billing', function () {
    return view('billing');
})->name('billing');
