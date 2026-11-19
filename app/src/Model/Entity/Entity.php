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

    public function setXY(string $x, string $y): void
    {
        $this->x = $x;
        $this->y = $y;
    }

    abstract public function __collision();
}