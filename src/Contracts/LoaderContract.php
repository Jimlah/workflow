<?php

namespace Abdullahi\Workflow\Contracts;

interface LoaderContract
{
    public static function load(string $path): array;
}