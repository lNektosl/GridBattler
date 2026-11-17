<?php

public class Player extends Entity
{
    private $name;
    private $score;

    public function __construct($X, $Y, $name, $endCoordinates)
    {
        parent::__construct();
        $this->name = $name;
        $this->endCoordinates = $endCoordinates;
    }
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public getEndCoordinates()
    {
        return $this->endCoordinates;
    }

    public function setEndCoordinates($endCoordinates)
    {
        $this->endCoordinates = $endCoordinates;
    }

    public function __collision()
    {
        echo "Collision detected for player: " . $this->name;
    }
}