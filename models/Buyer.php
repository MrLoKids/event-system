<?php

namespace app\models;

use yii\base\BaseObject;

class Buyer extends BaseObject
{
    public function getId(): int
    {
        return rand(1, 100);
    }

    public function isNew(): bool
    {
        // Check some logic
        return rand(0, 1);
    }

    public function getReferral(): Referral
    {
        // Get relation referral (e.g. AR)
        return new Referral();
    }
}