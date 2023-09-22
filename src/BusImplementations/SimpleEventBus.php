<?php


namespace Zarganwar\EventBus\BusImplementations;


use Zarganwar\EventBus\Event;
use Zarganwar\EventBus\EventBus;
use Zarganwar\EventBus\EventHandler;
use Psr\Log\LoggerInterface;
use Throwable;

class SimpleEventBus implements EventBus
{
	/**
	 * @var array<array<string, EventHandler>>
	 */
	private array $subscribers = [];

	public function __construct(
		private readonly LoggerInterface $logger,
	){}

	public function registerSubscriber(string $event, EventHandler $subscriber): self
	{
		$this->subscribers[$event][] = $subscriber;

		return $this;
	}

	public function dispatch(Event $event): void
	{
		foreach ($this->subscribers[$event::class] ?? [] as $subscriber) {
			try {
				$subscriber->handle($event);
			} catch (Throwable $e) {
				$this->logger->error($e->getMessage(), ['exception' => $e]);
			}
		}
	}

}