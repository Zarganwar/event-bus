<?php


namespace Zarganwar\EventBus;



interface EventHandler
{
	public function handle(Event $event): void;
}