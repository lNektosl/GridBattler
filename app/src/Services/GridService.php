<?php

declare(strict_types=1);

namespace App\Services;

use App\Model\Entity\Cover;
use App\Model\Entity\Player;
use App\Model\Tile;

class GridService
{

    private array $grid = [];


    public function createNewGrid(int $width, int $height)
    {
        $this->generateGrid($width, $height);
        $this->populateGrid();
        return $this->grid;
    }

    private function generateGrid(int $width, int $height)
    {
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $tile = new Tile(null);
                $this->grid[$x][$y] = $tile;
            }
        }
    }

    private function populateGrid()
    {
        //place covers 
        $numCovers = 10;
        $coverPlaced = 0;
        $attempts = 0;
        while ($coverPlaced < $numCovers) {
            $y = rand(0, count($this->grid) - 1);
            $x = rand(2, count($this->grid[0]) - 3);

            if ($this->grid[$x][$y]->isOccupied()) {
                continue;
            }

            if ($this->isThereMoreThanNeighbout($x, $y)) {
                $attempts++;
                if ($attempts > 3) {
                    $coverPlaced++;
                    $attempts = 0;
                }
                continue;
            }
            $cover = new Cover($x, $y);
            $this->grid[$x][$y]->setOccupant($cover);
            $coverPlaced++;
        }
    }

    public function placePlayers(array $grid, Player $p1, Player $p2)
    {
        $p1y = rand(0, count($grid[0]) - 1);
        $grid[0][$p1y]->setOccupant($p1);
        $p1->setXY(0, $p1y);

        $p2y = rand(0, count($grid[0]) - 1);
        $grid[count($grid[0]) - 1][$p2y]->setOccupant($p2);
        $p2->setXY(count($grid[0]) - 1, $p2y);
    }

    public function isThereMoreThanNeighbout(int $x, int $y): bool
    {
        $stack = [[$x, $y]];
        $visited = [];

        while (!empty($stack)) {
            [$x, $y] = array_pop($stack);
            $key = "$x,$y";
            $visited[$key] = true;
            for ($i = -1; $i <= 1; $i++) {
                for ($j = -1; $j <= 1; $j++) {
                    if ($i == 0 && $j == 0) {
                        continue;
                    }
                    if (isset($this->grid[$x + $i][$y + $j]) && $this->grid[$x + $i][$y + $j]->isOccupied()) {
                        $nx = $x + $i;
                        $ny = $y + $j;
                        $key = "$nx,$ny";
                        if (!isset($visited[$key])) {
                            $stack[] = [$nx, $ny];
                        }
                    }
                }
            }
        }
        return count($visited) > 2;
    }
}
