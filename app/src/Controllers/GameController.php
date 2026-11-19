<?php

namespace App\Controllers;

use App\Services\GameManager;

class GameController
{
    private GameManager $gameManager;

    public function __construct()
    {
        $this->gameManager = new GameManager();
    }

    public function index($vars = [])
    {
      require __DIR__ . '/../Views/players.php';
    }

    public function gameStart()
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
