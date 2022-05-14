<?php


use Abdullahi\Workflow\Loaders\YamlLoader;
use Abdullahi\Workflow\ValueObjects\Workflow;
use Abdullahi\Workflow\WorkflowBuilder;

it("can create a workflow from an array", function(){
    $arr = YamlLoader::load(__DIR__ . "/Fixtures/test.yaml");
    $workflow = WorkflowBuilder::make($arr);
    expect($workflow)->toBeInstanceOf(Workflow::class)
    ->name->toEqual("test");

});
