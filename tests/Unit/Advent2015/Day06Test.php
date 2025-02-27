<?php

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
