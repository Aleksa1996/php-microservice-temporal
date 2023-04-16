<?php

namespace App\Grpc\Proto\Order;

use Spiral\RoadRunner\GRPC;

class OrderService implements OrderInterface
{
    public function Create(GRPC\ContextInterface $ctx, Request $in): Response
    {
        $out = new Response();
        $out->setOrderId('12345');

        return $out;
    }
}
