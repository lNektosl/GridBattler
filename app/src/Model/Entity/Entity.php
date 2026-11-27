<?php

declare(strict_types=1);

namespace App\Model\Entity;

abstract class Entity
{
    protected string $id;
    private int $x;
    private int $y;

    public function __construct()
    {
        $this->id = uniqid();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setXY(int $x, int $y): void
    {
        $this->x = $x;
        $this->y = $y;
    }
    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    abstract public function __collision();
}
