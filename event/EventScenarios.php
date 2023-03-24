<?php

namespace app\event;

use app\event\events\BuyerSignedUpEvent;
use app\event\events\BuyerPaidOrderEvent;
use app\event\handlers\SendPushSseEventHandler;
use app\event\handlers\RewardReferralEventHandler;
use app\event\handlers\SendBuyerNotificationEventHandler;
use app\event\handlers\UpdateStatisticEventHandler;

class EventScenarios
{
    public function getEventHandlers(): array
    {
        return [
            BuyerSignedUpEvent::class     => [
                UpdateStatisticEventHandler::class,
            ],
            BuyerPaidOrderEvent::class => [
                SendPushSseEventHandler::class,
                RewardReferralEventHandler::class,
                SendBuyerNotificationEventHandler::class,
                UpdateStatisticEventHandler::class,
            ],
        ];
    }
}
