<?php

namespace App\AoC\Aoc2015;

use App\AdventOfCode;

class Day3 extends AdventOfCode
{
    protected bool $useRoboSanta;

    public function useRoboSanta(bool $useRoboSanta): self
    {
        $this->useRoboSanta = $useRoboSanta;

        return $this;
    }

    protected function solution(string $input): void
    {
        $this->resetLocation();

        $this->data['houses'] = [
            '0,0' => 1,
        ];

        $directions = collect(str_split(trim($input)));

        if ($this->useRoboSanta) {
            $this->data['houses'] = [
                '0,0' => 2,
            ];

            // Santa
            $directions
                ->filter(fn (string $d, int $index): bool => $index % 2 === 0)
                ->each(fn (string $direction) => $this->visitHouse($direction));

            $this->resetLocation();

            // Robo Santa
            $directions
                ->filter(fn (string $d, int $index): bool => $index % 2 !== 0)
                ->each(fn (string $direction) => $this->visitHouse($direction));
        } else {

            $directions
                ->each(fn (string $direction) => $this->visitHouse($direction));
        }

        $houses = collect($this->data['houses']);

        $this->result['houses_visted'] = $houses->count();
        $this->result['houses_multi_visted'] = $houses->filter(fn (int $visits): bool => $visits > 1)->count();
    }

    protected function resetLocation(): void
    {
        $this->data['x'] = 0;
        $this->data['y'] = 0;
    }

    protected function visitHouse(string $direction): void
    {
        $x = $this->data['x'];
        $y = $this->data['y'];

        $x = match ($direction) {
            '^' => $x + 1,
            'v' => $x - 1,
            default => $x
        };

        $y = match ($direction) {
            '>' => $y + 1,
            '<' => $y - 1,
            default => $y
        };

        $this->data['x'] = $x;
        $this->data['y'] = $y;

        $location = sprintf('%s,%s', $x, $y);
        $house = $this->data['houses'][$location] ?? 0;

        $house++;

        $this->data['houses'][$location] = $house;
    }
}
