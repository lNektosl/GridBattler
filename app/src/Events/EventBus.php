<?php
declare(strict_types = 1);
namespace App\Events;
use App\Events\Event;


class EventBus{
    private array $listeners = [];

    public function subscribe(Event $event, callable $listener ): void{
        $this->listeners[$event->value][] = $listener;
    }

    public function emit(Event $event, ...$args):void{
        foreach($this->listeners[$event->value] ?? [] as $listener){
            $listener(...$args);
        }
    }

    public function unsubscribe(Event $event, callable $listener):void{
        foreach($this->listeners[$event->value] ?? [] as $key => $registered){
            if($registered === $listener){
                unset($this->listeners[$event->value][$key]);
            }
        }
    }
}