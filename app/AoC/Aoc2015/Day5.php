<?php

namespace App\AoC\Aoc2015;

use App\AdventOfCode;
use Illuminate\Support\Str;

class Day5 extends AdventOfCode
{
    protected bool $isLegacyRules = false;

    protected array $blacklist = [];

    public function useLegacyRules(bool $useLegacyRules): self
    {
        $this->isLegacyRules = $useLegacyRules;

        return $this;
    }

    public function blacklist(array $blacklist): self
    {
        $this->blacklist = $blacklist;

        return $this;
    }

    protected function solution(string $input): void
    {
        if ($this->isLegacyRules) {
            $this->solveWithLegacyRules($input);

            return;
        }

        preg_match_all('/(([a-z][a-z])).*\1/', $input, $pairsCheck);
        $pairsCheck = collect($pairsCheck)
            ->flatten()
            ->filter(fn (string $item): bool => Str::of($item)->length() === 2)
            ->isNotEmpty();

        preg_match_all('/([a-z]).\1/', $input, $overlapCheck);
        $overlapCheck = collect($overlapCheck)
            ->flatten()
            ->filter(fn (string $item): bool => Str::of($item)->length() === 3)
            ->reject(function (string $item): bool {
                $letter = Str::of($item)->split(1);

                return ($letter[0] === $letter[1]) && ($letter[1] === $letter[2]);
            })
            ->isNotEmpty();

        preg_match_all('/([a-z]).\1/', $input, $jumpsCheck);
        $jumpsCheck = collect($jumpsCheck)
            ->flatten()
            ->filter(fn (string $item): bool => Str::of($item)->length() === 3)
            ->isNotEmpty();

        $this->result['WithoutOverlap'] = $overlapCheck;
        $this->result['LetterPairs'] = $pairsCheck;
        $this->result['JumpLetters'] = $jumpsCheck;
    }

    protected function solveWithLegacyRules(string $input): void
    {
        preg_match_all('/[aeiou]/', $input, $vowels);

        $hasThreeVowels = collect($vowels)->flatten()->count() >= 3;

        preg_match_all('/([a-z])\1/', $input, $doubleLetters);

        $hasDoubleLetters = collect($doubleLetters)
            ->flatten()
            ->filter(fn (string $item): bool => Str::of($item)->length() === 2)
            ->isNotEmpty();

        $this->result['ThreeVowelsCheck'] = $hasThreeVowels;
        $this->result['DoubleLetterCheck'] = $hasDoubleLetters;
        $this->result['BlacklistCheck'] = Str::doesntContain($input, $this->blacklist);
    }
}
