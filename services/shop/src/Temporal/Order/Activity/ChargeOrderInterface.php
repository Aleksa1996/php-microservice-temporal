<?php

namespace App\Temporal\Order\Activity;

use Temporal\Activity\ActivityInterface;

#[ActivityInterface(prefix: 'ChargeOrder.')]
interface ChargeOrderInterface
{
    public function execute();

    public function compensate();
}
