<?php

namespace app\event\handlers;

use app\event\interfaces\HasBuyerInterface;
use Exception;
use Yii;
use yii\base\Event;

class UpdateStatisticEventHandler extends BaseEventHandler
{
    /**
     * @param Event|HasBuyerInterface $event
     * @throws Exception
     */
    public function handle(Event $event): void
    {
        $buyerId = $event->getBuyer()->getId();
        Yii::info("Update statistic about Buyer $buyerId");
        /**
         * e.g.
         * Yii::$app->statisticService->updateUser($buyerId);
         */
    }

    public function requiredInterfaces(): array
    {
        return [
            HasBuyerInterface::class
        ];
    }

    public function needQueue(): bool
    {
        return true;
    }

    public function retryAttemptsCount(): int
    {
        return 2;
    }

    public function queueDelay(): int
    {
        return 5;
    }
}
