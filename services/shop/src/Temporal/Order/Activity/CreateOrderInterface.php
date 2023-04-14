<?php

namespace App\Temporal\Order\Activity;

use Temporal\Activity\ActivityInterface;

#[ActivityInterface(prefix: 'CreateOrder.')]
interface CreateOrderInterface
{
    public function execute();

    public function compensate();
}
