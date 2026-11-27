<?php

declare(strict_types=1);

namespace App\Model\Entity;

use App\Events\EventBus;

class Player extends Entity
{
    private string $name;
    private int $endX;
    private int $endY;
    private EventBus $bus;

    public function __construct(string $name, EventBus $bus)
    {
        parent::__construct();
        $this->name = $name;
        $this->bus = $bus;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getEndX()
    {
        return $this->endX;
    }

    public function getEndY()
    {
        return $this->endY;
    }

    public function setEndXY(int $x, int $y)
    {
        $this->endX = $x;
        $this->endY = $y;
    }

    public function __collision()
    {
        echo "Collision detected for player: " . $this->name;
    }
}
