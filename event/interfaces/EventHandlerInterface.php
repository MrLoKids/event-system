<?php

namespace app\event\interfaces;

use yii\base\Event;

interface EventHandlerInterface
{
    public function handle(Event $event): void;

    public function requiredInterfaces(): array;

    public function needQueue(): bool;

    public function runCondition(Event $event): bool;

    public function getTtr(): int;

    public function retryAttemptsCount(): int;

    public function queueDelay(): int;
}
