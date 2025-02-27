<?php

test('that day 04 is solved', function (string $input, array $prefixes, array $expected): void {
    $result = resolve(\App\AoC\Aoc2015\Day4::class)
        ->prefixes($prefixes)
        ->solve($input);

    $this->assertEquals($expected, $result);
})->with([
    ['abcdef', ['00000', '000000'], [609043, 6742839]],
    ['pqrstuv', ['00000', '000000'], [1048970, 5714438]],
]);
