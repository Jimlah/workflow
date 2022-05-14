# Workflow

This package is aimed to be a realistic PHP workflow package that works in a similar fashion to GitHub Actions.

## Installation

To install the package, run the following command:

```
composer require --dev --prefer-dist abdullahi/workflow
```

## Usage

To create a new workflow runner, all you need to do is to build it. It will take an optional array of workflows for you to pass in,
or you can allow it to default to empty to programmatically build it yourself.


```php
<?php

Use Abdullahi\Workflow\WorkflowRunner;
use Abdullahi\Workflow\WorkflowBuilder;
use Abdullahi\Workflow\Loaders\YamlLoader;
use Abdullahi\Workflow\Loaders\JsonLoader;

$runner = WorkflowRunner::build(
    workflow: [
        WorkflowBuilder::make(YamlLoader::load(__DIR__ . '/test.yaml')),
        WorkflowBuilder::make(JsonLoader::load(__DIR__ . '/test.json')),
    ]);

$runner->run();

```