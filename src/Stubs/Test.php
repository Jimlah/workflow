<?php

namespace Abdullahi\Workflow\Stubs;

class Test
{

    public function run(string $message, int $number, bool $option): array
    {
        return [
            'message' => $message,
            'number' => $number,
            'option' => $option,
        ];
    }

    public function another(string $message)
    {
        return [
            'message' => $message,
        ];
    }
}