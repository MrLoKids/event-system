<?php

namespace app\event\interfaces;

use app\models\Buyer;

interface HasBuyerInterface
{
    public function getBuyer(): Buyer;
}
