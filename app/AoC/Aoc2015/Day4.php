<?php

namespace App\AoC\Aoc2015;

use App\AdventOfCode;
use Illuminate\Support\Str;

class Day4 extends AdventOfCode
{
    protected array $prefixes;

    public function prefixes(array $prefixes): self
    {
        $this->prefixes = $prefixes;

        return $this;
    }

    protected function solution(string $input): void
    {
        $iteration = 0;

        $prefixesCount = count($this->prefixes);

        while (true) {
            $hash = md5(sprintf('%s%s', $input, $iteration));

            foreach ($this->prefixes as $prefix) {
                if (Str::startsWith($hash, $prefix)) {
                    $this->data[$prefix][] = $iteration;
                }
            }

            if (count($this->data) === $prefixesCount) {
                break;
            }

            $iteration++;
        }

        $this->result = collect($this->data)
            ->map(fn (array $result): int => collect($result)->first())
            ->toArray();
    }
}
