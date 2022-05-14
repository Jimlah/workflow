<?php

namespace Abdullahi\Workflow;

use Abdullahi\Workflow\Contracts\WorkflowContract;
use Abdullahi\Workflow\Exceptions\WorkflowExceptions;
use Abdullahi\Workflow\ValueObjects\Workflow;

class WorkflowRunner
{
    protected $logs = [];

    /**
     * @param array<int,Workflow> $workflows
     */
    protected function __construct(protected array $workflows){}

    /**
     * @param array<int,WorkflowContract> $workflows
     * @return static
     */
    public static function build(array $workflows = []): WorkflowRunner
    {
        return new WorkflowRunner(workflows: $workflows);
    }

    public function run(): void
    {
        foreach ($this->workflows as $workflow) {
           $workflow->jobs->map(callback: function ($job) {
               if (!class_exists($job->target)) {
                     throw new WorkflowExceptions("Workflow Target {$job->target} does not exist");
               }

               if(!method_exists($job->target, $job->method)) {
                   throw new WorkflowExceptions("Workflow Target {$job->target} does not have method {$job->method}");
               }

               $class = new \ReflectionClass($job->target);

               try {
                   $target = $class->newInstance();
               }catch(\Throwable $e) {
                   throw new WorkflowExceptions(message: "Can construct of {$job->target}", previous: $e);
               }

              $this->logs[$job->name] = $target->{$job->method}(...$job->args);
           });
        }
    }

    public function logs(): array
    {
        return $this->logs;
    }
}