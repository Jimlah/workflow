<?php

namespace Abdullahi\Workflow\ValueObjects;


use Tightenco\Collect\Support\Collection;

class Workflow
{
    /**
     * @param string $name
     * @param Collection Job $jobs
     */
    public function __construct(
        public string $name,
        public Collection $jobs
    ){}
}