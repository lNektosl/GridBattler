<?php
declare(strict_types=1);
namespace App\Model\Entity;

class Player extends Entity
{
    private $name;
    private $endX;
    private $endY;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->name = $name;
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

    public getEndX()
    {
        return $this->endX;
    }

    public getEndY(){
        return $this->endY;
    }

    public function setEndXY($x, $y)
    {
       $this->x = $x;
       $this->y = $y;
    }

    public function __collision()
    {
        echo "Collision detected for player: " . $this->name;
    }
}