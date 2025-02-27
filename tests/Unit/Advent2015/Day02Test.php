<?php

test('that day 02 is solved', function (string $input, array $expected): void {
    $result = resolve(\App\AoC\Aoc2015\Day2::class)->solve($input);

    $this->assertEquals($expected, $result);
})->with([
    ['2x3x4', [58, 34]],
    ['1x1x10', [43, 14]],
]);
