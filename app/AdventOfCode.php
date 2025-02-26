<?php

namespace App;

abstract class AdventOfCode
{
    protected array $result = [];

    protected array $data = [];

    abstract protected function solution(string $input): void;

    public function solve(string $input): array
    {
        $this->solution($input);

        return collect($this->result)->values()->toArray();
    }
}
