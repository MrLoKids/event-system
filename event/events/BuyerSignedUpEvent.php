<?php

namespace app\event\events;

use app\event\interfaces\HasBuyerInterface;
use app\models\Buyer;
use yii\base\Event;

class BuyerSignedUpEvent extends Event implements HasBuyerInterface
{
    private Buyer $buyer;

    public function __construct(Buyer $buyer)
    {
        $this->buyer = $buyer;

        parent::__construct([]);
    }

    public function getBuyer(): Buyer
    {
        return $this->buyer;
    }
}
