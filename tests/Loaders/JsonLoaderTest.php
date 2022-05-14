<?php

namespace Loaders;

use Abdullahi\Workflow\Loaders\JsonLoader;

it("can read a json file and return an array", function () {
    $loader = JsonLoader::load(__DIR__ . '/../../tests/Fixtures/test.json');
    expect($loader)->toBeArray();
});
