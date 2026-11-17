<?php

public class Cover extends Entity{
    public function __construct($X, $Y)
    {
        parent::__construct();
    }

    public function __collision()
    {
        echo "Collision detected for cover.";
    }
}