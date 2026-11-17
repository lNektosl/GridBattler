<?php
declare(strict_types=1);
namespace App\Model\Entity;

class Cover extends Entity{
    public function __construct($X, $Y)
    {
        parent::__construct($X,$Y);
    }

    public function __collision()
    {
        echo "Collision detected for cover.";
    }
}