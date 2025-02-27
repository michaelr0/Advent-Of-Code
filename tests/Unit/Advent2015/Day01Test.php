<?php

test('that day 01 is solved', function (string $input, array $expected): void {
    $result = resolve(\App\AoC\Aoc2015\Day1::class)->solve($input);

    $this->assertEquals($expected, $result);
})->with([
    ['()()', [0, null]],
    ['(((', [3, null]],
    ['(()(()(', [3, null]],
    ['))(((((', [3, 1]],
    ['())', [-1, 3]],
    ['))(', [-1, 1]],
    [')))', [-3, 1]],
    [')())())', [-3, 1]],
]);
