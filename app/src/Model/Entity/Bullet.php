<?php
declare(strict_types=1);
public class Bullet extends Entity
{
    private int $endX;
    private int $endY;

    public function:: __construct($X, $Y, $endX, $endY)
    {
        parent::__construct();
        $this->endX = $endX;
        $this->endY = $endY;
    }

    public function getEndCoordinates()
    {
        return $this->endCoordinates;
    }

    public function setEndCoordinates($endCoordinates)
    {
        $this->endCoordinates = $endCoordinates;
    }

    public function __collision()
    {
        echo "Collision detected for bullet at coordinates: " . $this->endCoordinates;
    }
}