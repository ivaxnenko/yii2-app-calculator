<?php

namespace app\components;

class Command 
{
    /**
     * @return void
     */
    public function calculatePriceByDistance(CommandContext $context):void
    {
        $price = $context->price * $context->distance;
        $context->result = $price;
    }
}