<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Entity\Entity;


class Tile
{
    private ?Entity $occupant;

    public function __construct($occupant)
    {
        $this->occupant = $occupant;
    }

    public function isOccupied(): bool
    {
        return $this->occupant != null;
    }

    public function setOccupant(?Entity $entity)
    {
        $this->occupant = $entity;
    }
    public function getOccupant(): ?Entity
    {
        return $this->occupant;
    }
}
