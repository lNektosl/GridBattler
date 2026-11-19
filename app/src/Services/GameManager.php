<?php
declare(strict_types= 1);
namespace App\Services;
use App\Services\GridService;


class GameManager{
    private $gridService;
    public function __construct(GridService $gridService){
        $this->gridService = $gridService;
    }

    public function startGame($p1, $p2):array{
    $grid = $this->gridService->createNewGrid(6,6);
    $this->gridService->placePlayers($grid, $p1,$p2);
    return $grid;
    }
}