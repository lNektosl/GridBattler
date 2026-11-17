<?php
declare(strict_types=1);
abstract class Entity
{
    protected $id;
    private $X;
    private $Y;

    public function __construct($X, $Y)
    {
        $this->id = uniqid();
        $this->X = $X;
        $this->Y = $Y;
        
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    abstract public function __collision();
}