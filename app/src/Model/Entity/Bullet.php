<?php

declare(strict_types=1);

namespace App\Model\Entity;
use App\Events\EventBus;

class Bullet extends Entity
{
    private int $endX;
    private int $endY;
    private EventBus $bus;

    public function __construct($endX, $endY, $bus)
    {
        parent::__construct();
        $this->endX = $endX;
        $this->endY = $endY;
        $this->$bus = $bus;
    }


    public function setEndXY($endX, $endY): void
    {
        $this->endX = $endX;
        $this->endY = $endY;
    }

    public function getEndX(): int
    {
        return $this->endX;
    }

    public function getEndY(): int
    {
        return $this->endY;
    }

    public function __collision()
    {
        echo "Boom";
    }
}
