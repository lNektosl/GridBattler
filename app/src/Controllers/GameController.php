<?php

namespace App\Controllers;

use App\Services\GameManager;

class GameController
{
    private GameManager $gameManager;

    public function __construct($gamesService)
    {
        $this->gameManager = new GameManager($gamesService);
    }

    public function index($vars = [])
    {
      require __DIR__ . '/../Views/players.php';
    }

    public function gameStart()
    {
        $data = $_POST;

    $player1 = $data['player1'] ?? null;
    $player2 = $data['player2'] ?? null;

    $grid = $this->gameManager->startGame($player1, $player2);
    require __DIR__ .'/../Views/game.php';
    }
}
