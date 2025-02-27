<?php

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
