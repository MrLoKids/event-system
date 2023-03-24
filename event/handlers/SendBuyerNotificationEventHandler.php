<?php

namespace app\event\handlers;

use app\event\interfaces\HasBuyerInterface;
use app\event\interfaces\HasOrderInterface;
use Exception;
use Yii;
use yii\base\Event;

class SendBuyerNotificationEventHandler extends BaseEventHandler
{
    /**
     * @param Event|HasBuyerInterface|HasOrderInterface $event
     * @throws Exception
     */
    public function handle(Event $event): void
    {
        $buyer = $event->getBuyer();
        $order = $event->getOrder();
        Yii::info("Send notification about new order {$order->id} from {$buyer->id}");
        /**
         * e.g.
         * Yii::$app->notificationService->sendAboutNewOrder($buyer, $order);
         */
    }

    public function requiredInterfaces(): array
    {
        return [
            HasBuyerInterface::class,
            HasOrderInterface::class
        ];
    }

    public function retryAttemptsCount(): int
    {
        return 1;
    }
}
