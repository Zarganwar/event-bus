<?php


namespace Zarganwar\EventBus\BusImplementations;


use Psr\Log\LoggerAwareTrait;
use Throwable;
use Zarganwar\EventBus\EventBus;
use Zarganwar\EventBus\EventHandler;

class SimpleEventBus implements EventBus
{
	use LoggerAwareTrait;

	/**
	 * @var array<array<string, EventHandler>>
	 */
	private array $subscribers = [];


	public function registerSubscriber(string $eventClassName, EventHandler $subscriber): self
	{
		$this->subscribers[$eventClassName][] = $subscriber;

		return $this;
	}


	public function dispatch(object $event): void
	{
		foreach ($this->subscribers[$event::class] ?? [] as $subscriber) {
			try {
				$subscriber->handle($event);
			} catch (Throwable $e) {
				$this->logger?->error($e->getMessage(), ['exception' => $e]);
			}
		}
	}

}