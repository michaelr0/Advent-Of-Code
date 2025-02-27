<?php

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
