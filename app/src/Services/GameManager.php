<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\GridService;
use App\Model\Entity\Player;

class GameManager
{
    private  $p1;
    private  $p2;
    private $gridService;
    public function __construct(GridService $gridService)
    {
        $this->gridService = $gridService;
    }

    public function startGame($p1Name, $p2Name): array
    {
        $this->p1 = new Player($p1Name);
        $this->p2 = new Player($p2Name);
        $grid = $this->gridService->createNewGrid(6, 6);
        $this->gridService->placePlayers($grid, $this->p1, $this->p2);
        return $grid;
    }
}
