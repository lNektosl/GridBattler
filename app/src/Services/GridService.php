<?php
declare(strict_types=1);
namespace App\Services;
use App\Model\Entity\Cover;
use App\Model\Tile;

class GridService
{

    private array $grid = [];


    public function createNewGrid($width, $height)
    {
        $this->generateGrid($width, $height);
        $this->populateGrid();
        return $this->grid;
    }

    private function generateGrid($width, $height)
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
            $x = rand(0, count($this->grid) - 1);
            $y = rand(2, count($this->grid[0]) - 3);

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

    public function placePlayers($grid, $p1, $p2)
    {
        $p1X = rand(0, count($grid) - 1);
        $grid[$p1X][0]->setOccupant($p1);

        $p2X = rand(0, count($grid) - 1);
        $grid[$p2X][count($grid[0]) - 1]->setOccupant($p2);

    }

    public function isThereMoreThanNeighbout($x, $y): bool
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