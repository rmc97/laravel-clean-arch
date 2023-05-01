<?php

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

    \App\Jobs\Book\ConvertBookJob::dispatch('188e831e-0335-4bc9-9deb-c4d6dba6b258');

    return view('welcome');
});
