<?php

declare(strict_types=1);

namespace App\Model\Entity;

abstract class Entity
{
    protected $id;
    private $x;
    private $y;

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
