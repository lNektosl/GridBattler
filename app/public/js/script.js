console.log(players);

players.forEach((player) => {
    console.log(player.x, player.y);
});

const table = document.getElementById('gameTable');

const p1 = table.rows[players[0].x + 1].cells[players[0].y + 1];
const p2 = table.rows[players[1].x + 1].cells[players[1].y + 1];

p1.style.color = 'red';
p2.style.color = 'blue';


