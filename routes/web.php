<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/solve', function () {
    $file = Storage::disk('aoc')->get('2015/06.input');

    $results = resolve(App\AoC\Aoc2015\Day6::class)->withBrightness(true)->solve($file);

    return $results;
});
