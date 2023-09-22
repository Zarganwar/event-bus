<?php

namespace Zarganwar\EventBus;

use Zarganwar\EventBus\BusImplementations\SimpleEventBus;

interface EventBus
{
	public function registerSubscriber(string $event, EventHandler $subscriber): SimpleEventBus;

	public function dispatch(Event $event): void;
}