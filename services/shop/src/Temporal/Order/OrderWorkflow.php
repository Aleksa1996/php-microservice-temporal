<?php

namespace App\Temporal\Order;

use Temporal\Workflow;
use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use App\Temporal\Order\Activity\ChargeOrderInterface;
use App\Temporal\Order\Activity\CreateOrderInterface;
use App\Temporal\Order\Activity\ReserveOrderInterface;

class OrderWorkflow implements OrderWorkflowInterface
{
    private $createOrderActivity;

    private $reserveOrderActivity;

    private $chargeOrderActivity;

    public function __construct()
    {
        $this->createOrderActivity = Workflow::newActivityStub(
            CreateOrderInterface::class,
            ActivityOptions::new()
                ->withScheduleToCloseTimeout(CarbonInterval::seconds(2))
        );

        $this->reserveOrderActivity = Workflow::newActivityStub(
            ReserveOrderInterface::class,
            ActivityOptions::new()
                ->withScheduleToCloseTimeout(CarbonInterval::seconds(2))
        );

        $this->chargeOrderActivity = Workflow::newActivityStub(
            ChargeOrderInterface::class,
            ActivityOptions::new()
                ->withScheduleToCloseTimeout(CarbonInterval::seconds(2))
        );
    }

    public function create()
    {
        $saga = new Workflow\Saga();
        $saga->setParallelCompensation(true);

        try {
            $orderId = yield $this->createOrderActivity->execute();
            $saga->addCompensation(fn () => yield $this->createOrderActivity->compensate());

            $reservationId = yield $this->reserveOrderActivity->execute();
            $saga->addCompensation(fn () => yield $this->reserveOrderActivity->compensate());

            $chargeId = yield $this->chargeOrderActivity->execute();
            $saga->addCompensation(fn () => yield $this->chargeOrderActivity->compensate());
        } catch (\Throwable $e) {
            yield $saga->compensate();
        }
    }
}
