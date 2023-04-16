<?php

namespace App\Grpc\Proto\Order;

class OrderClient extends \Grpc\BaseStub
{
    public function Execute(Request $request, $metadata = [], $options = [])
    {
        return $this->_simpleRequest(
            '/order.Order/Create',
            $request,
            [Response::class, 'decode'],
            $metadata,
            $options
        );
    }
}
