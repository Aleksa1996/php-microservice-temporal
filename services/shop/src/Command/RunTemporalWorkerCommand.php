<?php

namespace App\Command;

use Temporal\WorkerFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:run-temporal-worker')]
class RunTemporalWorkerCommand extends Command
{
    private $workflows;

    private $activities;

    public function __construct(iterable $workflows, iterable $activities)
    {
        parent::__construct();

        $this->workflows = $workflows;
        $this->activities = $activities;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $factory = WorkerFactory::create();

        // Worker that listens on a task queue and hosts both workflow and activity implementations.
        $worker = $factory->newWorker();

        foreach ($this->workflows as $workflowType) {
            // Workflows are stateful. So you need a type to create instances.
            // Class names
            $worker->registerWorkflowTypes($workflowType);
        }

        foreach ($this->activities as $activityType) {
            // Activities are stateless and thread safe. So a shared instance is used.
            // Get registered services from DI container
            $worker->registerActivity(get_class($activityType), fn (\ReflectionClass $class) => $activityType);
        }

        $factory->run();

        return Command::SUCCESS;
    }
}
