<?php

namespace Abdullahi\Workflow\Loaders;

use Abdullahi\Workflow\Contracts\LoaderContract;
use Symfony\Component\Yaml\Yaml;

class JsonLoader implements LoaderContract
{

public static function load(string $path): array
    {
        return (array)Yaml::parseFile(filename: $path);
    }

}