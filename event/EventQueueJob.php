<?php

namespace app\event;

use app\event\interfaces\EventHandlerInterface;
use ReflectionClass;
use Yii;
use yii\base\BaseObject;
use yii\base\Event;
use yii\queue\JobInterface;
use yii\queue\RetryableJobInterface;

class EventQueueJob extends BaseObject implements JobInterface, RetryableJobInterface
{
    public Event $event;
    public EventHandlerInterface $listener;

    public function execute($queue)
    {
        Yii::info("Executing {$this->getHandlerShortName()} handler", EventChannel::LOG_CATEGORY);

        $this->listener->handle($this->event);
    }

    public function push(Event $event, EventHandlerInterface $listener)
    {
        Yii::$app->queue
            ->delay($listener->queueDelay())
            ->push(
                new self([
                    'event'    => $event,
                    'listener' => $listener
                ])
            );
    }

    /**
     * Time to reserve in queue in seconds
     * @return int
     */
    public function getTtr(): int
    {
        return $this->listener->getTtr();
    }

    public function canRetry($attempt, $error): bool
    {
        return $attempt <= $this->listener->retryAttemptsCount();
    }

    private function getHandlerShortName(): string
    {
        $reflection = new ReflectionClass($this->listener);
        return $reflection->getShortName();
    }
}
