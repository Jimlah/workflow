# Workflow

This package is aimed to be a realistic PHP workflow package that works in a similar fashion to GitHub Actions.

## Installation


## Usage

```php
<?php

$runner = WorkflowRunner::build();

$runner->addWorkflow::make(__DIR__ . '/test.yaml');

$runner->run();

```