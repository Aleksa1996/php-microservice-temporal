<?php

namespace App\Temporal\Order;

use Temporal\Workflow\WorkflowMethod;
use Temporal\Workflow\WorkflowInterface;

#[WorkflowInterface]
interface OrderWorkflowInterface
{
    #[WorkflowMethod('OrderWorkflow.create')]
    public function create();
}
