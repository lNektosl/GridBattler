<?php

declare(strict_types=1);

namespace App\Model\Entity;

class Bullet extends Entity
{
    private int $endX;
    private int $endY;

    public function __construct($endX, $endY)
    {
        parent::__construct();
        $this->endX = $endX;
        $this->endY = $endY;
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
