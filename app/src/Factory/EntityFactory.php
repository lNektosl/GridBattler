<?php

declare(strict_types=1);

namespace App\Factory;

use App\Model\Entity\Entity;
use App\Model\Entity\Player;
use App\Model\Entity\Bullet;
use App\Events\EventBus;

class EntityFactory
{
    private EventBus $bus;

    public function __construct(EventBus $bus)
    {
        $this->bus = $bus;
    }

    public function CreatePlayer(string $name):Player{
        return new Player($name, $this->bus);
    }
}
