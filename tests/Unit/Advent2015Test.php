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

test('that day 05 is solved', function (string $input, bool $isLegacyList, array $blacklist, array $expected): void {
    $result = resolve(\App\AoC\Aoc2015\Day5::class)
        ->useLegacyRules($isLegacyList)
        ->blacklist($blacklist)
        ->solve($input);

    $this->assertEquals($expected, $result);
})->with([
    ['ugknbfddgicrmopn', true, ['ab', 'cd', 'pq', 'xy'], [true, true, true]],
    ['aaa', true, ['ab', 'cd', 'pq', 'xy'], [true, true, true]],
    ['jchzalrnumimnmhp', true, ['ab', 'cd', 'pq', 'xy'], [true, false, true]],
    ['haegwjzuvuyypxyu', true, ['ab', 'cd', 'pq', 'xy'], [true, true, false]],
    ['dvszwmarrgswjxmb', true, ['ab', 'cd', 'pq', 'xy'], [false, true, true]],
    //
    ['qjhvhtzxzqqjkmpb', false, [], [true, true, true]],
    ['xxyxx', false, [], [true, true, true]],
    ['aaa', false, [], [false, false, true]],
    ['uurcxstgmygtbstg', false, [], [false, true, false]],
    ['ieodomkazucvgmuy', false, [], [true, false, true]],
]);

test('that day 06 is solved', function (array $input, bool $withBrightness, int $expected): void {
    $result = resolve(\App\AoC\Aoc2015\Day6::class)
        ->withBrightness($withBrightness)
        ->solve(collect($input)->implode(PHP_EOL));

    $this->assertEquals($expected, $result[0]);
})->with([
    [
        [
            'turn on 0,0 through 999,999',
        ],
        false,
        1000000,
    ],
    [
        [
            'turn on 0,0 through 999,999',
            'toggle 0,0 through 999,0',
        ],
        false,
        999000,
    ],
    [
        [
            'turn on 0,0 through 999,999',
            'toggle 0,0 through 999,0',
            'turn off 499,499 through 500,500',
        ],
        false,
        998996,
    ],

    [
        [
            'turn on 0,0 through 0,0',
        ],
        true,
        1,
    ],
    [
        [
            'toggle 0,0 through 999,999',
        ],
        true,
        2000000,
    ],
    [
        [
            'turn on 0,0 through 0,0',
            'toggle 0,0 through 999,999',
        ],
        true,
        2000001,
    ],
    [
        [
            'turn on 0,0 through 0,0',
            'turn off 0,0 through 0,0',
            'turn off 0,0 through 0,0',
        ],
        true,
        0,
    ],
    [
        [
            'turn on 0,0 through 0,0',
            'toggle 0,0 through 999,999',
            'turn off 0,0 through 0,0',
        ],
        true,
        2000000,
    ],
    [
        [
            'turn on 0,0 through 0,0',
            'toggle 0,0 through 999,999',
            'turn off 0,0 through 999,999',
        ],
        true,
        1000001,
    ],
]);
