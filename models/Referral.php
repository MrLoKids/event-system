<?php

namespace app\models;

use yii\base\BaseObject;

class Referral extends BaseObject
{
    public function getId(): int
    {
        return rand(1, 100);
    }

    public function isRewarded(): bool
    {
        // Check some logic
        return rand(0, 1);
    }
}