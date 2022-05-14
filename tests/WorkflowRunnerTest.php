<?php

use Abdullahi\Workflow\Exceptions\WorkflowExceptions;
use Abdullahi\Workflow\Loaders\JsonLoader;
use Abdullahi\Workflow\Loaders\YamlLoader;
use Abdullahi\Workflow\WorkflowBuilder;
use Abdullahi\Workflow\WorkflowRunner;

beforeEach(function () {
    $this->runner = $runner = WorkflowRunner::build(
        workflows: [
            WorkflowBuilder::make(payload: YamlLoader::load(__DIR__ . '/Fixtures/test.yaml')),
        ]
    );
});

it("Can create a new workflow runner without no workflows", function () {
    $workflowRunner = WorkflowRunner::build();
    expect($workflowRunner)->toBeInstanceOf(WorkflowRunner::class);
});

it('can run a workflow', closure: function () {

    expect($this->runner->logs())->toBeArray()->toBeEmpty();

    $this->runner->run();

    expect($this->runner->logs())->toBeArray()
        ->toEqual([
            "test" => [
                "message" => "test",
                "number" => "10",
                "option" => true
            ],
            "another" => [
                "message" => "test",
            ]
        ]);
});

it('can run multiple workflow', closure: function () {

    $runner = WorkflowRunner::build(
        workflows: [
            WorkflowBuilder::make(payload: YamlLoader::load(__DIR__ . '/Fixtures/test.yaml')),
            WorkflowBuilder::make(payload: YamlLoader::load(__DIR__ . '/Fixtures/test.yaml')),
        ]
    );

    expect($runner->logs())->toBeArray()->toBeEmpty();

    $runner->run();

    expect($runner->logs())->toBeArray()
    ->toEqual([
        "test" => [
            "message" => "test",
            "number" => "10",
            "option" => true
        ],
        "another" => [
            "message" => "test",
        ]
    ]);
});

it("throws a workflow exception if target class does not exist", closure: function () {
    $runner = WorkflowRunner::build(
        workflows: [
            WorkflowBuilder::make([
                "name" => "test",
                "jobs"=>[
                    "test" => [
                        "run" => [
                            "target" => "Abdullahi\Workflow\Tests\Fixtures\FailTest",
                            "method" => "test",
                            "args" => [
                                "message" => "test",
                                "number" => "10",
                                "option" => true
                            ]
                        ]
                    ]
                ]
            ]),
        ]
    );

    expect(function () use ($runner) {
        $runner->run();
    })->toThrow(WorkflowExceptions::class);
});

it("throws a workflow exception if target class does not have method", closure: function () {
    $runner = WorkflowRunner::build(
        workflows: [
            WorkflowBuilder::make([
                "name" => "test",
                "jobs"=>[
                    "test" => [
                        "run" => [
                            "target" => "Abdullahi\Workflow\Stubs\Test",
                            "method" => "test2",
                            "args" => [
                                "message" => "test",
                                "number" => "10",
                                "option" => true
                            ]
                        ]
                    ]
                ]
            ]),
        ]
    );

    expect(function () use ($runner) {
        $runner->run();
    })->toThrow(WorkflowExceptions::class);
});

it("throws an error when workflow can not instantiate a class", function (){
    $runner = WorkflowRunner::build(
        workflows: [
            WorkflowBuilder::make([
                "name" => "test",
                "jobs"=>[
                    "test" => [
                        "run" => [
                            "target" => \Abdullahi\Workflow\Stubs\FailureTest::class,
                            "method" => "run",
                            "args" => [
                                "test"
                            ]
                        ]
                    ]
                ]
            ]),
        ]
    );

    expect(function () use ($runner) {
        $runner->run();
    })->toThrow(WorkflowExceptions::class);
});

