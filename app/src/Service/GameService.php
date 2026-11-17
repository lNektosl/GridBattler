<?php
declare(strict_types=1);
public class GameService{

public function generateGrid($width, $height){
    for ($x = 0; $x < $width; $x++) {
        for ($y = 0; $y < $height; $y++) {
            $tile = new Tile(null);
            $grid[$x][$y] = $tile;
        }
    }

}
}