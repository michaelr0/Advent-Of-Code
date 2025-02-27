<?php

namespace App\AoC\Aoc2015;

use App\AdventOfCode;

class Day2 extends AdventOfCode
{
    protected function solution(string $input): void
    {
        $exploded = explode('x', trim($input));

        throw_unless(count($exploded) === 3, 'Not enough dimensions provided');

        $length = $exploded[0];
        $width = $exploded[1];
        $height = $exploded[2];

        $packageSize = collect([$length * $width, $width * $height, $height * $length]);

        $paperAmount = ($packageSize->map(fn (int $value): int => $value * 2)->sum() + $packageSize->min());

        $ribbonWrap = collect([$length, $width, $height])
            ->sort()
            ->take(2)
            ->map(fn (int $value): int => $value * 2)
            ->sum();

        $ribbonBow = ($length * $width * $height);

        $ribbonLength = ($ribbonWrap + $ribbonBow);

        $this->result['paperAmount'] = $paperAmount;
        $this->result['ribbonLength'] = $ribbonLength;
    }
}
