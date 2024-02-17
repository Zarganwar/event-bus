<?php

namespace Zarganwar\EventBus;

interface EventBus
{

	public function registerSubscriber(string $eventClassName, EventHandler $subscriber): EventBus;


	public function dispatch(object $event): void;

}