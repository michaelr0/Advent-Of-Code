<?php

namespace App\AoC\Aoc2015;

use App\AdventOfCode;

class Day1 extends AdventOfCode
{
    protected function solution(string $input): void
    {
        $this->result = [
            'floor' => 0,
            'basementPosition' => null,
        ];

        collect(str_split(trim($input)))
            ->each(function (string $item, int $index): void {
                $floor = $this->result['floor'];
                $basementPosition = $this->result['basementPosition'];

                if ($item === '(') {
                    $floor++;
                } elseif ($item === ')') {
                    $floor--;
                }

                if ($basementPosition === null && $floor === -1) {
                    $this->result['basementPosition'] = ($index + 1);
                }

                $this->result['floor'] = $floor;
            });
    }
}
