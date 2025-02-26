<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/solve', function () {
    $file = Storage::disk('aoc')->get('2015/05.input');

    $results = collect(explode(PHP_EOL, $file))
        ->filter()
        ->map(fn (string $line): string => trim($line))
        ->map(fn (string $line): array => resolve(App\AoC\Aoc2015\Day5::class)->solve($line))
        ->filter(fn (array $result): bool => collect($result)->filter()->count() === 3);

    return [$results->count()];
});
