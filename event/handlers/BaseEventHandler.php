<?php

namespace app\event\handlers;

use app\event\interfaces\EventHandlerInterface;
use yii\base\BaseObject;
use yii\base\Event;

class BaseEventHandler extends BaseObject implements EventHandlerInterface
{
    private const DEFAULT_QUEUE_TTR_SECONDS = 60;
    private const DEFAULT_QUEUE_RETRY_ATTEMPTS_COUNT = 0;
    private const DEFAULT_QUEUE_DELAY = 0;

    public function handle(Event $event): void
    {
    }

    public function requiredInterfaces(): array
    {
        return [];
    }

    public function needQueue(): bool
    {
        return true;
    }

    public function runCondition(Event $event): bool
    {
        return true;
    }

    /**
     * Default time to wait in queue
     * @return int
     */
    public function getTtr(): int
    {
        return self::DEFAULT_QUEUE_TTR_SECONDS;
    }

    public function retryAttemptsCount(): int
    {
        return self::DEFAULT_QUEUE_RETRY_ATTEMPTS_COUNT;
    }

    /**
     * Delay to push queue in seconds
     * @return int
     */
    public function queueDelay(): int
    {
        return self::DEFAULT_QUEUE_DELAY;
    }
}
