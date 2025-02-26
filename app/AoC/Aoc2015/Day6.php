<?php

namespace App\AoC\Aoc2015;

use App\AdventOfCode;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Day6 extends AdventOfCode
{
    protected bool $withBrightness = false;

    public function withBrightness(bool $withBrightness): self
    {
        $this->withBrightness = $withBrightness;

        return $this;
    }

    protected function solution(string $input): void
    {
        $this->data['instructions'] = Str::of($input)->explode(PHP_EOL)
            ->map(fn (string $line): string => trim($line))
            ->filter()
            ->map(function (string $instruction): array {
                preg_match_all('/(turn on|toggle|turn off) (\d{1,}),(\d{1,}) through (\d{1,}),(\d{1,})/', $instruction, $matches);

                return [
                    'instruction' => $matches[1][0],
                    'lowerX' => (int) $matches[2][0],
                    'lowerY' => (int) $matches[3][0],
                    'upperX' => (int) $matches[4][0],
                    'upperY' => (int) $matches[5][0],
                ];
            });

        if ($this->withBrightness) {
            $this->solveBrightness();
        } else {
            $this->solveOnOff();
        }
    }

    protected function solveBrightness(): void
    {
        $this->data['lights'] = [];

        $this->data['instructions']->each(function (array $instruction) {
            for ($x = $instruction['lowerX']; $x <= $instruction['upperX']; $x++) {
                for ($y = $instruction['lowerY']; $y <= $instruction['upperY']; $y++) {
                    $key = sprintf('%s,%s', $x, $y);

                    if ($instruction['instruction'] === 'turn off') {
                        $brightness = Arr::get($this->data['lights'], $key, 0) - 1;

                        if ($brightness > 0) {
                            $this->data['lights'][$key] = $brightness;
                        } else {
                            unset($this->data['lights'][$key]);
                        }
                    } elseif ($instruction['instruction'] === 'turn on') {
                        $brightness = Arr::get($this->data['lights'], $key, 0) + 1;

                        $this->data['lights'][$key] = $brightness;
                    } elseif ($instruction['instruction'] === 'toggle') {
                        $brightness = Arr::get($this->data['lights'], $key, 0) + 2;

                        $this->data['lights'][$key] = $brightness;
                    }
                }
            }
        });

        $this->result['brightness'] = collect($this->data['lights'])->sum();
    }

    protected function solveOnOff(): void
    {
        $this->data['instructions']->each(function (array $instruction) {
            for ($x = $instruction['lowerX']; $x <= $instruction['upperX']; $x++) {
                for ($y = $instruction['lowerY']; $y <= $instruction['upperY']; $y++) {
                    $key = sprintf('%s,%s', $x, $y);

                    if ($instruction['instruction'] === 'turn off' || $instruction['instruction'] === 'toggle' && isset($this->data['lights'][$key])) {
                        unset($this->data['lights'][$key]);
                    } elseif ($instruction['instruction'] === 'turn on' || $instruction['instruction'] === 'toggle' && ! isset($this->data['lights'][$key])) {
                        $this->data['lights'][$key] = true;
                    }
                }
            }
        });

        $this->result['lightsOn'] = count($this->data['lights']);
    }
}
