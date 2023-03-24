<?php

namespace app\models;

use yii\base\BaseObject;

class Order extends BaseObject
{
    public function getId(): int
    {
        return rand(1, 100);
    }

    public function getBuyer(): Buyer
    {
        // Get some relation buyer (e.g. AR)
        return new Buyer();
    }
}