<?php

namespace App\AoC\Aoc2015;

use App\AdventOfCode;
use Illuminate\Support\Collection;
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

        $string = collect(str_split($input));

        $letterGroups = $string->chunk(2)
            ->filter(fn (Collection $chunk): bool => $chunk->count() === 2)
            ->map(fn (Collection $chunk): Collection => $chunk->values());

        $offsetLetterGroups = $string->skip(1)->chunk(2)
            ->filter(fn (Collection $chunk): bool => $chunk->count() === 2)
            ->map(fn (Collection $chunk): Collection => $chunk->values());

        $hasLetterPairs = collect()
            ->merge($letterGroups
                ->filter(function (Collection $chunk): bool {
                    return ($chunk->first() === $chunk[1]) || ($chunk[1] === $chunk->last());
                })
                ->map(function (Collection $chunk): string {
                    if ($chunk->first() === $chunk[1]) {
                        return $chunk->take(2)->implode('');
                    }

                    return $chunk->pop(2)->implode('');
                }))
            ->merge($offsetLetterGroups
                ->filter(function (Collection $chunk): bool {
                    return ($chunk->first() === $chunk[1]) || ($chunk[1] === $chunk->last());
                })
                ->map(function (Collection $chunk): string {
                    if ($chunk->first() === $chunk[1]) {
                        return $chunk->take(2)->implode('');
                    }

                    return $chunk->pop(2)->implode('');
                })
            )->duplicates()->isNotEmpty();

        $letterGroups = $string->chunk(3)
            ->filter(fn (Collection $chunk): bool => $chunk->count() === 3)
            ->map(fn (Collection $chunk): Collection => $chunk->values());

        $offsetLetterGroups = $string->skip(1)->chunk(3)
            ->filter(fn (Collection $chunk): bool => $chunk->count() === 3)
            ->map(fn (Collection $chunk): Collection => $chunk->values());

        $offsetOffsetLetterGroups = $string->skip(2)->chunk(3)
            ->filter(fn (Collection $chunk): bool => $chunk->count() === 3)
            ->map(fn (Collection $chunk): Collection => $chunk->values());

        $hasJumpLetters = collect()
            ->merge($letterGroups
                ->filter(fn (Collection $chunk): bool => $chunk->first() === $chunk->last())
                ->map(fn (Collection $chunk): string => $chunk->implode(''))
            )
            ->merge($offsetLetterGroups
                ->filter(fn (Collection $chunk): bool => $chunk->first() === $chunk->last())
                ->map(fn (Collection $chunk): string => $chunk->implode(''))
            )
            ->merge($offsetOffsetLetterGroups
                ->filter(fn (Collection $chunk): bool => $chunk->first() === $chunk->last())
                ->map(fn (Collection $chunk): string => $chunk->implode(''))
            )
            ->filter()->isNotEmpty();

        $this->result['LatestRules'] = ! $this->isLegacyRules;
        $this->result['LetterPairs'] = $hasLetterPairs;
        $this->result['JumpLetters'] = $hasJumpLetters;
    }

    protected function solveWithLegacyRules(string $input): void
    {
        $string = collect(str_split($input));

        $hasThreeVowels = $string
            ->filter(fn (string $letter): bool => in_array($letter, ['a', 'e', 'i', 'o', 'u']))
            ->count() >= 3;

        $letterGroups = $string->chunk(2)
            ->filter(fn (Collection $chunk): bool => $chunk->count() === 2)
            ->map(fn (Collection $chunk): Collection => $chunk->values())
            ->filter(fn (Collection $chunk): bool => $chunk->first() === $chunk->last())
            ->map(fn (Collection $chunk): string => $chunk->implode(''));

        $offsetLetterGroups = $string->skip(1)->chunk(2)
            ->filter(fn (Collection $chunk): bool => $chunk->count() === 2)
            ->map(fn (Collection $chunk): Collection => $chunk->values())
            ->filter(fn (Collection $chunk): bool => $chunk->first() === $chunk->last())
            ->map(fn (Collection $chunk): string => $chunk->implode(''));

        $hasDoubleLetters = collect()
            ->merge($letterGroups)
            ->merge($offsetLetterGroups)
            ->filter()
            ->isNotEmpty();

        $this->result['ThreeVowelsCheck'] = $hasThreeVowels;
        $this->result['DoubleLetterCheck'] = $hasDoubleLetters;
        $this->result['BlacklistCheck'] = Str::doesntContain($input, $this->blacklist);
    }
}
