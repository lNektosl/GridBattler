console.log(players);

players.forEach((player) => {
    console.log(player.x, player.y);
});

const table = document.getElementById('gameTable');

const p1 = table.rows[players[0].x + 1].cells[players[0].y + 1];
const p2 = table.rows[players[1].x + 1].cells[players[1].y + 1];

const commandHistory = [];
let historyIndex = -1;
const MAX_HISTORY = 10;

p1.style.color = 'red';
p2.style.color = 'blue';

const commandInput = document.getElementById('command');
const button = document.getElementById('submit');

button.addEventListener('click', () => { sendCommand() });
commandInput.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        sendCommand();
    }
});

commandInput.addEventListener('keydown', navigateCommandHistory);

function sendCommand() {
    const command = commandInput.value.trim();

    if (command === '') {
        console.error('Please enter a command before submitting.');
        return;
    }

    const parsedCommand = validateCommand(command);

    if (!parsedCommand) {
        return;
    }
    commandInput.value = '';
    updateCommandHistory(command);
    const json = executeCommand(parsedCommand.commandName, parsedCommand.args);
    if (!json) {
        return;
    }
    console.log('Command JSON:', json);
}

function validateCommand(command) {
    const match = command.match(/^([^()]+)\(([^()]*)\)$/);

    if (!match) {
        console.error('Invalid command format.');
        return null;
    }

    let commandName = match[1].trim().toLowerCase();
    const argsString = match[2].trim();

    const args = argsString
        ? argsString.split(',').map(arg => arg.trim())
        : [];

    return { commandName, args };
}

function executeCommand(commandName, args) {
    switch (commandName) {
        case 'move': {
            if (args.length !== 1) {
                console.error('Invalid number of arguments for command:', commandName);
                return;
            }
            const direction = args[0].toLowerCase();
            if (direction !== 'n' && direction !== 'e' && direction !== 'w' && direction !== 's') {
                console.error('Invalid move argument:', args[0]);
                return;
            }
            console.log('Moving in direction:', direction);
            return createJSON(commandName, [direction]);
        }
        case 'shoot': {
            if (args.length !== 2) {
                console.error('Invalid number of arguments for command:', commandName);
                return;
            }
            let x;
            let y;
            for (let i = 0; i < args.length; i++) {
                if (/^[a-zA-Z]$/.test(args[i])) {
                    y = args[i].toUpperCase().charCodeAt(0) - 65;
                } else if (/^\d+$/.test(args[i])) {
                    x = parseInt(args[i], 10) - 1;
                } else {
                    console.error('Invalid shoot argument:', args[i]);
                    return;
                }
            }
            if (x === undefined || y === undefined) {
                console.log("Error");
                return;
            }
            if (x < 0 || x >= table.rows.length - 1 || y < 0 || y >= table.rows[0].cells.length - 1) {
                console.error('Shoot coordinates out of bounds:', x, y);
                return;
            }
            return createJSON(commandName, [x, y]);
        }
        case 'wait': {
            if (args.length !== 0) {
                console.error('Invalid number of arguments for command:', commandName);
                return;
            }
            return createJSON(commandName, []);
        }
        case 'help': {
            if (args.length !== 0) {
                console.error('Invalid number of arguments for command:', commandName);
                return;
            }
            console.log('Available commands:');
            console.log('move(direction) - Move in the specified direction (n, e, s, w)');
            console.log('shoot(x, y) - Shoot at the specified coordinates (e.g., shoot(A, 1))');
            console.log('wait() - Wait for the next turn');
            console.log('help() - Show this help message');
            return null;
        }
        default:
            console.error('Unknown command:', commandName);
    }
}

function createJSON(commandName, args) {
    const json = {
        commandName: commandName,
        direction: args.length === 1 ? args[0] : null,
        target: args.length === 2 ? { x: args[0], y: args[1] } : null
    };
    return json;
}

function updateCommandHistory(command) {
    const index = commandHistory.indexOf(command);

    if (index !== -1) {
        commandHistory.splice(index, 1);
    }

    commandHistory.push(command);

    if (commandHistory.length > MAX_HISTORY) {
        commandHistory.shift();
    }

    historyIndex = -1;
}

function navigateCommandHistory(event) {
    if (event.key === 'ArrowUp') {
        event.preventDefault();

        if (commandHistory.length === 0) return;

        if (historyIndex === -1) {
            historyIndex = commandHistory.length - 1;
        } else if (historyIndex > 0) {
            historyIndex--;
        }

        commandInput.value = commandHistory[historyIndex];
    }

    if (event.key === 'ArrowDown') {
        event.preventDefault();

        if (historyIndex === -1) return;

        if (historyIndex < commandHistory.length - 1) {
            historyIndex++;
            commandInput.value = commandHistory[historyIndex];
        } else {
            historyIndex = -1;
            commandInput.value = '';
        }
    }
}