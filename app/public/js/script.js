document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('nameModal');

    const input = document.getElementById('playerName');
    const submitButton = document.getElementById('submitName');
    const modalTitle = document.getElementById('modalTitle');

    const players = [];
    let currentPlayerIndex = 1;

    // Показываем окно
    modal.classList.add('show');

    function insertPlayers() {
        const playerName = input.value.trim();

        if (!playerName) return;

        players.push(playerName);
        input.value = '';

        if (currentPlayerIndex === 1) {
            currentPlayerIndex++;

            modalTitle.textContent = 'Enter P2 Name';
            input.placeholder = 'Player 2 Name';
        } else {
    modal.classList.remove('show');

    const data = {
        player1: players[0],
        player2: players[1]
    };

    fetch('/game/start', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        console.log('Server response:', result);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
    }

    submitButton.addEventListener('click', insertPlayers);

});