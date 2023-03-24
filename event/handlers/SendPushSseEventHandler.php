<?php

namespace app\event\handlers;

use app\event\interfaces\HasBuyerInterface;
use app\event\interfaces\HasOrderInterface;
use Exception;
use Yii;
use yii\base\Event;

class SendPushSseEventHandler extends BaseEventHandler
{
    /**
     * @param Event|HasBuyerInterface|HasOrderInterface $event
     * @throws Exception
     */
    public function handle(Event $event): void
    {
        $buyerId = $event->getBuyer()->getId();
        $orderId = $event->getOrder()->getId();
        Yii::info("Push event via SSE about order $orderId from buyer $buyerId");
        /**
         * e.g.
         * SseJob::push(
         *     $event->getBuyer()->id,
         *     $event->getOrder()->id,
         * );
         */
    }

    public function requiredInterfaces(): array
    {
        return [
            HasBuyerInterface::class,
            HasOrderInterface::class
        ];
    }

    public function needQueue(): bool
    {
        return false;
    }
}
