<?php

namespace app\event\handlers;

use app\event\interfaces\HasBuyerInterface;
use Exception;
use Yii;
use yii\base\Event;

class RewardReferralEventHandler extends BaseEventHandler
{
    /**
     * @param Event|HasBuyerInterface $event
     * @throws Exception
     */
    public function handle(Event $event): void
    {
        $buyerId = $event->getBuyer()->getId();
        Yii::info("Reward Referral User for Buyer {$buyerId}");
        /**
         * e.g.
         * Yii::$app->rewardService->rewardUser()
         */
    }

    public function requiredInterfaces(): array
    {
        return [
            HasBuyerInterface::class,
        ];
    }

    /**
     * @param Event|HasBuyerInterface $event
     * @return bool
     */
    public function runCondition(Event $event): bool
    {
        $referral = $event->getBuyer()->getReferral();
        $isBuyerNew = $event->getBuyer()->isNew();

        return $isBuyerNew && $referral && !$referral->isRewarded();
    }
}
