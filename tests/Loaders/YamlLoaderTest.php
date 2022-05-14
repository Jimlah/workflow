<?php

namespace Loaders;

use Abdullahi\Workflow\Loaders\YamlLoader;

it("can read a yaml file and return an array", function () {
    $loader = YamlLoader::load(__DIR__ . '/../../tests/Fixtures/test.yaml');
    expect($loader)->toBeArray();
});
