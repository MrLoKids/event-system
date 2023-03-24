<?php

namespace app\event;

use app\event\interfaces\EventHandlerInterface;
use InvalidArgumentException;
use ReflectionClass;
use Yii;
use yii\base\Component;
use yii\base\Event;

class EventChannel extends Component
{
    public const LOG_CATEGORY = 'events';

    /**
     * @var bool
     */
    public bool $isEnabledQueue;
    /**
     * @var EventScenarios
     */
    private EventScenarios $eventScenarios;
    /**
     * @var EventQueueJob
     */
    private EventQueueJob $queueJob;

    public function __construct(
        EventScenarios $eventScenarios,
        EventQueueJob $queueJob,
        array $config
    ) {
        $this->eventScenarios = $eventScenarios;
        $this->queueJob = $queueJob;

        parent::__construct($config);
    }

    public function triggerEvent(Event $event): void
    {
        $eventName = $this->getShortName($event);

        Yii::info("Triggered {$eventName} event", self::LOG_CATEGORY);
        $eventListeners = $this->getEventHandlers($event);

        $this->onHandlers($event, $eventListeners);
        $this->trigger($eventName, $event);
    }

    private function onHandlers(Event $event, array $handlers)
    {
        $eventName = $this->getShortName($event);
        foreach ($handlers as $handler) {
            $handler = Yii::createObject($handler);
            if (!$handler instanceof EventHandlerInterface) {
                throw new InvalidArgumentException(
                    sprintf(
                        'The %s must be implement %s.',
                        get_class($handler),
                        EventHandlerInterface::class
                    )
                );
            }

            $requiredInterfaces = $handler->requiredInterfaces();
            foreach ($requiredInterfaces as $requiredInterface) {
                if (!$event instanceof $requiredInterface) {
                    throw new InvalidArgumentException(
                        sprintf('The %s must be implement %s.', get_class($event), $requiredInterface)
                    );
                }
            }

            if (!$handler->runCondition($event)) {
                continue;
            }

            $handlerName = $this->getShortName($handler);

            if ($this->isEnabledQueue && $handler->needQueue()) {
                $this->queueJob->push($event, $handler);
                Yii::info(
                    sprintf(
                        "By event `%s` have sent to queue for processing `%s`",
                        $eventName,
                        $handlerName
                    ),
                    self::LOG_CATEGORY
                );
            } else {
                $this->on($eventName, [$handler, 'handle']);

                Yii::info(
                    sprintf(
                        "By event `%s` immediately triggered `%s`",
                        $eventName,
                        $handlerName
                    ),
                    self::LOG_CATEGORY
                );
            }
        }
    }

    private function getEventHandlers(Event $event): array
    {
        $eventHandlers = $this->eventScenarios->getEventHandlers();

        return array_unique(
            $eventHandlers[get_class($event)] ?? []
        );
    }

    private function getShortName(object $object): string
    {
        $reflection = new ReflectionClass($object);
        return $reflection->getShortName();
    }
}
