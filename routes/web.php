<?php

use Illuminate\Support\Facades\Route;
use App\Models\Instruction;
use App\Models\Media;

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

Route::get('/agreement', function (Instruction $instruction) {
    $media =  $instruction->first()->getFirstMedia('instructions');
    $publicFullUrl = $media->getFullUrl();

    return view('agreement', ['publicFullUrl' => $publicFullUrl]);
});