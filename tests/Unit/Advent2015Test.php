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

test('that day 02 is solved', function (string $input, array $expected): void {
    $result = resolve(\App\AoC\Aoc2015\Day2::class)->solve($input);

    $this->assertEquals($expected, $result);
})->with([
    ['2x3x4', [58, 34]],
    ['1x1x10', [43, 14]],
]);

test('that day 03 is solved', function (string $input, bool $useRoboSanta, array $expected): void {
    $result = resolve(\App\AoC\Aoc2015\Day3::class)
        ->useRoboSanta($useRoboSanta)
        ->solve($input);

    $this->assertEquals($expected, $result);
})->with([
    ['>', false, [2, 0]],
    ['^>v<', false, [4, 1]],
    ['^v^v^v^v^v', false, [2, 2]],
    ['^v', true, [3, 1]],
    ['^>v<', true, [3, 1]],
    ['^v^v^v^v^v', true, [11, 1]],
]);

test('that day 04 is solved', function (string $input, array $prefixes, array $expected): void {
    $result = resolve(\App\AoC\Aoc2015\Day4::class)
        ->prefixes($prefixes)
        ->solve($input);

    $this->assertEquals($expected, $result);
})->with([
    ['abcdef', ['00000', '000000'], [609043, 6742839]],
    ['pqrstuv', ['00000', '000000'], [1048970, 5714438]],
]);
