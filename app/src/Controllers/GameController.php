<?php

namespace App\Controllers;

use App\Services\GridService;

class GameController
{
    private GridService $gridService;

    public function __construct()
    {
        $this->gridService = new GridService();
    }

    public function index($vars = [])
    {
    $grid = $this->gridService->createNewGrid(5, 5);

      require __DIR__ . '/../Views/game.php';
    }

    public function gameStart($vars = [])
    {
    $data = json_decode(file_get_contents('php://input'), true);

    $player1 = $data['player1'] ?? null;
    $player2 = $data['player2'] ?? null;
    }

    public function getGrid($vars = [])
    {
        $grid = $this->gridService->createNewGrid(5, 5);

        header('Content-Type: application/json');
        echo json_encode($grid);
    }
}
