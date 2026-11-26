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
        require __DIR__ . '/../Views/game.php';
    }

    public function processCommands()
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);
        $commands = $data['commands'] ?? [];

        $p1Actions = [];
        $p2Actions = [];

        foreach ($commands as $command) {
            if ($command['player'] === 'player 1') {
                $p1Actions[] = $command;
            } elseif ($command['player'] === 'player 2') {
                $p2Actions[] = $command;
            }
        }


        $response = [
            'success' => true,
            'message' => 'Commands received successfully',
            'p1Actions' => $p1Actions,
            'p2Actions' => $p2Actions
        ];

        echo json_encode($response);
    }
}
