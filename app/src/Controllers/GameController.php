<?php

namespace App\Controllers;

use App\Service\GridService;

class GameController
{
    private GridService $gridService;

    public function __construct()
    {
        $this->gridService = new GridService();
    }

    public function getGrid($vars = [])
    {
        $grid = $this->gridService->createNewGrid(5, 5);

        header('Content-Type: application/json');
        echo json_encode($grid);
    }
}
