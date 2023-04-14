<?php

namespace App\Temporal\Order\Activity;

use Temporal\Activity\ActivityInterface;

#[ActivityInterface(prefix: 'ReserveOrder.')]
interface ReserveOrderInterface
{
    public function execute();

    public function compensate();
}
