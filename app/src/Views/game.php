<?php

use App\Model\Entity\Player;
use App\Model\Entity\Cover;
use App\Model\Tile;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php $players = []; ?>
    <table class="table table-borderless game-grid" id="gameTable">

        <thead>
            <tr>
                <th></th>
                <?php for ($x = 1; $x <= count($grid[0]); $x++): ?>
                    <th><?= $x ?></th>
                <?php endfor; ?>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($grid as $y => $row): ?>
                <tr>
                    <th><?= chr(65 + $y) ?></th>
                    <?php foreach ($row as $tile): ?>
                        <td class="tile">
                            <?php if ($tile->getOccupant() !== null && $tile->getOccupant() instanceof Player): {
                                    $players[] = [
                                        'x' => $tile->getOccupant()->getX(),
                                        'y' => $tile->getOccupant()->getY()
                                    ];
                                } ?>
                                @
                            <?php elseif ($tile->getOccupant() !== null && $tile->getOccupant() instanceof Cover): ?>
                                #
                            <?php else: ?>
                                ~
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div id="CommandInput">
        <label id="commandLabel" for="command">Player 1 moves</label>
        <input type="text" id="command" placeholder="Enter command">
        <button id="submit">Submit</button>
    </div>
</body>

<script>
    const players = <?= json_encode($players) ?>;
</script>
<script src="/js/script.js"></script>

</html>