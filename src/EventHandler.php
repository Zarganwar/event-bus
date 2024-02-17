<?php


namespace Zarganwar\EventBus;


interface EventHandler
{
	public function handle(object $event): void;

}