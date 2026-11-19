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
    <script src="/js/script.js"></script>
</head>
<body>

<div class="modal" id="nameModal" tabindex="1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Enter P1 Name</h5>
            </div>
            <div class="modal-body">
                <input type="text" id="playerName" placeholder="Your Name">
            </div>
            <div class="modal-footer">
                <button type="button" id="submitName" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<table class="table table-borderless game-grid">
    <tbody>
        <?php foreach ($grid as $row): ?>
            <tr>
                <?php foreach ($row as $tile): ?>
                    <td class="tile">
                        <?php if ($tile->getOccupant() !== null && $tile->getOccupant() instanceof Player): ?>
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
    <input type="text" id="command" placeholder="Enter command">
    <button id="submitCommand">Submit</button>
</div>
</body>
</html>