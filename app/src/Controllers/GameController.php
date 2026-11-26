<?php

namespace App\Controllers;

use App\Services\GameManager;
use App\Model\Action;

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
            $action = Action::constructFromArray($command);
            if ($action->getPlayer() === 'player 1') {
                $p1Actions[] = $action;
            } elseif ($action->getPlayer() === 'player 2') {
                $p2Actions[] = $action;
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
