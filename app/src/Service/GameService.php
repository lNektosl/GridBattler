<?php
declare(strict_types=1);
public class GameService{

public function generateGrid($width, $height): array{
    for ($x = 0; $x < $width; $x++) {
        for ($y = 0; $y < $height; $y++) {
            $tile = new Tile(null);
            $grid[$x][$y] = $tile;
        }
    }
 return $grid;
}

public function populateGrid($grid): array{
    //place covers 
    int $numCovers = rand(1, 5);
    for ($i = 0; $i < $numCovers; $i++) {
        $x = rand(0, count($grid) - 1);
        $y = rand(2, count($grid[0]) - 3);
        $cover = new Cover($x, $y);
        $grid[$x][$y]->setOccupant($cover);
    }
    return $grid;
}

public function placePlayers($grid, $p1, $p2): array{
    //place players
    $p1X = rand(0, count($grid) - 1);
    $grid[$p1X][0]->setOccupant($p1);

    $p2X = rand(0, count($grid) - 1);
    $grid[$p2X][count($grid[0]) - 1]->setOccupant($p2);

    return $grid;
}

public function isThereMoreThanNeighbout($grid, $x, $y): bool{
    $neighbours = 0;

    for($i=-1; $i>1;$i++){
        for($j=-1; $j>1;$g++){
            $grid[$x+i][$y+j]->isOccupied
        }
    }

    return $neighbours > 2;
}
}