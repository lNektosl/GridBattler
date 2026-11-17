<?php
declare(strict_types=1);
namespace App\Service;
use App\Model\Entity\Cover;
use App\Model\Tile;

class GridService{

private array $grid = [];


public function createNewGrid($width, $height){
$this->generateGrid($width, $height);
$this->populateGrid();
// placePlayers($p1,$p2);
return $this->grid;
}

private function generateGrid($width, $height){
    for ($x = 0; $x < $width; $x++) {
        for ($y = 0; $y < $height; $y++) {
            $tile = new Tile(null);
            $this->grid[$x][$y] = $tile;
        }
    }
}

private function populateGrid(){
    //place covers 
    $numCovers = rand(2, 5);
    $coverPlaced = 0;
   while($coverPlaced<$numCovers) {
        $x = rand(0, count($this->grid) - 1);
        $y = rand(2, count($this->grid[0]) - 3);
        $cover = new Cover($x, $y);
        if($this->isThereMoreThanNeighbout($x, $y)){
            continue;
        }
        $this->grid[$x][$y]->setOccupant($cover);
        $coverPlaced++;
    }
}

// private function placePlayers($p1, $p2){
//     //place players
//     $p1X = rand(0, count($grid) - 1);
//     $grid[$p1X][0]->setOccupant($p1);

//     $p2X = rand(0, count($grid) - 1);
//     $grid[$p2X][count($grid[0]) - 1]->setOccupant($p2);

// }

public function isThereMoreThanNeighbout($x, $y): bool{
    $neighbours = 0;

    for($i=-1; $i<=1;$i++){
        for($j=-1; $j<=1;$j++){
            if( isset($this->grid[$x + $i][$y + $j])&&$this->grid[$x+$i][$y+$j]->isOccupied()){
                $neighbours++;
            }
        }
    }

    return $neighbours > 2;
}
}