<?php

declare(strict_types=1);

namespace App\Managers;

use App\Factory\EntityFactory;
use App\Services\GridService;
use App\Model\Entity\Player;

class GameManager
{
    private Player $p1;
    private Player $p2;
    private GridService $gridService;
    private EntityFactory $factory;

    public function __construct(GridService $gridService, EntityFactory $factory)
    {
        $this->gridService = $gridService;
        $this->factory = $factory;
    }

    public function startGame(string $p1Name, string $p2Name): array
    {
        $this->p1 = $this->factory->CreatePlayer($p1Name);
        $this->p2 = $this->factory->CreatePlayer($p2Name);
        $grid = $this->gridService->createNewGrid(6, 6);
        $this->gridService->placePlayers($grid, $this->p1, $this->p2);
        return $grid;
    }
}
