<?php

namespace app\event\interfaces;

use app\models\Order;

interface HasOrderInterface
{
    public function getOrder(): Order;
}
