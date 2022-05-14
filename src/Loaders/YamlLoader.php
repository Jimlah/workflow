<?php

namespace Abdullahi\Workflow\Loaders;

use Symfony\Component\Yaml\Yaml;

class YamlLoader implements \Abdullahi\Workflow\Contracts\LoaderContract
{

    public static function load(string $path): array
    {
        return (array)Yaml::parseFile(filename: $path);
    }
}