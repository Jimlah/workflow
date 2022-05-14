<?php

namespace Abdullahi\Workflow;

use Abdullahi\Workflow\Contracts\LoaderContract;
use Abdullahi\Workflow\ValueObjects\Job;
use Abdullahi\Workflow\ValueObjects\Workflow;
use Ramsey\Uuid\Uuid;
use Tightenco\Collect\Support\Collection;

class WorkflowBuilder
{
    public static function make(array $payload): Workflow
    {
        $workflow = new Workflow(name: $payload['name'], jobs: new Collection());

      foreach ($payload['jobs'] as $name => $job) {
          $workflow->jobs->add(new Job(
              uuid: Uuid::uuid4()->toString(),
              name: $name,
              target: $job['run']['target'],
              method: $job['run']['method'],
              args: $job['run']['args']
          ));
      }

      return$workflow;
    }
}