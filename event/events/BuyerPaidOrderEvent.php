<?php

namespace app\event\events;

use app\models\Order;
use app\event\EventScenarios;
use app\event\interfaces\HasBuyerInterface;
use app\event\interfaces\HasOrderInterface;
use app\models\Buyer;
use yii\base\Event;

/**
 * @see EventScenarios
 */
class BuyerPaidOrderEvent extends Event implements HasBuyerInterface, HasOrderInterface
{
    private Order $order;
    private Buyer $buyer;

    public function __construct(Order $order)
    {
        $this->order = $order;

        parent::__construct([]);
    }

    public function init()
    {
        $this->buyer = $this->order->getBuyer();
    }

    public function getBuyer(): Buyer
    {
        return $this->buyer;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }
}
