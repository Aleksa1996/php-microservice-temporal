<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: order.proto

namespace App\Grpc\Proto\Order\GPBMetadata;

class Order
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            '
�
order.protoorder";
Request 
products (2.order.Product
userId (	"6
Product

id (	
price (
quantity ("
Response
orderId (	24
Order+
Create.order.Request.order.Response" B:�App\\Grpc\\Proto\\Order� App\\Grpc\\Proto\\Order\\GPBMetadatabproto3'
        , true);

        static::$is_initialized = true;
    }
}

