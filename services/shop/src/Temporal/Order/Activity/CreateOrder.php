<?php

namespace App\Temporal\Order\Activity;

use App\Grpc\Proto\Order\Product;
use App\Grpc\Proto\Order\Request;
use App\Grpc\Proto\Order\Response;
use App\Grpc\Proto\Order\OrderClient;

class CreateOrder implements CreateOrderInterface
{
    public function __construct()
    {
    }

    public function execute()
    {
        $client = new OrderClient('shop-service:9001', [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(),
        ]);

        $product = new Product();
        $product->setId('1');
        $product->setPrice(5.5);
        $product->setQuantity(3);

        $request = new Request();
        $request->setProducts([$product]);
        $request->setUserId('12345');

        /**
         * @var Response $response
         */
        [$response, $status] = $client->Execute($request)->wait();

        dump($response->getOrderId(), $status);
    }

    public function compensate()
    {
    }
}
