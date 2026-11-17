<?php
declare(strict_types=1);

public class Tile{
    private ?Entity $occupant;

    public function __construct($occupant){
        $this->
        occupant = ?$occupant;
    }

    public function isOccupied():bool{
        return $this->$occupant != null;
    }
}