<?php
declare(strict_types=1);
namespace App\Model\Entity;

class Cover extends Entity{
    public function __construct($x, $y)
    {
        parent::__construct();
        $this->setXY($x, $y);
    }

    public function __collision()
    {
        echo "Collision detected for cover.";
    }
}