# Workflow

This package is aimed to be a realistic PHP workflow package that works in a similar fashion to GitHub Actions.

## Installation


## Usage

```php
<?php

$runner = WorkflowRunner::build(
    workflow: [
        WorkflowBuilder::make(YamlLoader::load(__DIR__ . '/test.yaml')),
        WorkflowBuilder::make(JsonLoader::load(__DIR__ . '/test.json')),
    ]);

$runner->run();

```