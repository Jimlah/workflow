<?php

use Abdullahi\Workflow\WorkflowRunner;

it("Can create a new workflow runner without no workflows", function () {
    $workflowRunner = WorkflowRunner::build();
    expect($workflowRunner)->toBeInstanceOf(WorkflowRunner::class);
});
