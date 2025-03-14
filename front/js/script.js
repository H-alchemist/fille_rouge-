
// import {addStylingforlegalMoves, removeStylingforlegalMoves } from './helper.js';

// Game state
let board = [
    [-2,-3,-4,-5,-6,-4,-3,-2],
    [-1,-1,-1,-1,-1,-1,-1,-1],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [1, 1, 1, 1, 1, 1, 1, 1],
    [2, 3, 4, 5, 6, 4, 3, 2]
];

let start = [null, null, null];
let end = [null, null, null];
let playerColor = null;
let isMyTurn = false;
var client = null;
var room = null;

// Piece images
const pieceMap = {
    '1': 'https://assets-themes.chess.com/image/ejgfv/150/wp.png',
    '2': 'https://assets-themes.chess.com/image/ejgfv/150/wr.png',
    '3': 'https://assets-themes.chess.com/image/ejgfv/150/wn.png',
    '4': 'https://assets-themes.chess.com/image/ejgfv/150/wb.png',
    '5': 'https://assets-themes.chess.com/image/ejgfv/150/wq.png',
    '6': 'https://assets-themes.chess.com/image/ejgfv/150/wk.png',
    '-1': 'https://assets-themes.chess.com/image/ejgfv/150/bp.png',
    '-2': 'https://assets-themes.chess.com/image/ejgfv/150/br.png',
    '-3': 'https://assets-themes.chess.com/image/ejgfv/150/bn.png',
    '-4': 'https://assets-themes.chess.com/image/ejgfv/150/bb.png',
    '-5': 'https://assets-themes.chess.com/image/ejgfv/150/bq.png',
    '-6': 'https://assets-themes.chess.com/image/ejgfv/150/bk.png'
};



async function connectToServer() {
    try {
        client = new Colyseus.Client('ws://localhost:3000');
        // Test the connection by attempting to get available rooms
        // await client.getAvailableRooms();
        document.getElementById('gameStatus').textContent = "Connected to server";
        return true;
    } catch (error) {
        console.error("Could not connect to server:", error);
        document.getElementById('gameStatus').textContent = "Could not connect to server";
        return false;
    }
}

// Create a new game
async function createGame() {
    if (!client) {
        const connected = await connectToServer();
        if (!connected) return;
    }
    
    try {
        room = await client.joinOrCreate("game_room");
       
        document.getElementById('gameStatus').textContent = `Game created! ID: ${room.id}`;

        setupRoomListeners();
    } catch (error) {
        console.error("Could not create game:", error);
        document.getElementById('gameStatus').textContent = "Could not create game";
    }
}





function setupRoomListeners() {
    room.onMessage("playerColor", (message) => {
        console.log("Received player color:", message);
        playerColor = message;
        document.getElementById('gameStatus').textContent = `You are playing as ${playerColor}`;
    });

    room.onMessage("waitingForOpponent", (message) => {
        document.getElementById('gameStatus').textContent = "Waiting for opponent...";
    });

    room.onMessage("gameStart", (message) => {
        board = message.board;
        isMyTurn = playerColor === message.turn;
        document.getElementById('gameStatus').textContent = isMyTurn ? "Your turn" : "Opponent's turn";
        renderBoard();
    });

    room.onMessage("validMoves", (message) => {
        const { validMoves, selectedPiece } = message;
        
        start = [selectedPiece.row, selectedPiece.col, selectedPiece.piece];
        document.querySelector(`[data-row="${selectedPiece.row}"][data-col="${selectedPiece.col}"]`).classList.add('selected');
        
        addStylingforlegalMoves(validMoves);
    });

    room.onMessage("invalidMove", (message) => {

        clearSelection();
        document.getElementById('gameStatus').textContent = message.reason;
    });

    room.onMessage("boardUpdate", (message) => {
        board = message.board;
        isMyTurn = playerColor === message.turn;
        document.getElementById('gameStatus').textContent = isMyTurn ? "Your turn" : "Opponent's turn";
        
        const lastMove = message.lastMove;
        renderBoard();
        

        const fromSquare = document.querySelector(`[data-row="${lastMove.from[0]}"][data-col="${lastMove.from[1]}"]`);
        const toSquare = document.querySelector(`[data-row="${lastMove.to[0]}"][data-col="${lastMove.to[1]}"]`);
        
        if (fromSquare) fromSquare.classList.add('lastMove');
        if (toSquare) toSquare.classList.add('lastMove');
    });

    room.onMessage("playerLeft", (message) => {
        document.getElementById('gameStatus').textContent = `Opponent (${message.color}) left the game`;
    });

    room.onError((code, message) => {
        console.error(`Room error: ${code} - ${message}`);
        document.getElementById('gameStatus').textContent = `Error: ${message}`;
    });
}

function clearSelection() {
    const selected = document.querySelector('.selected');
    if (selected) {
        selected.classList.remove('selected');
    }
    
    const legalMoves = document.querySelectorAll('.legalSquare');
    legalMoves.forEach(square => {
        square.classList.remove('legalSquare');
        square.dataset.available = 0;
    });
    
    start = [null, null, null];
    end = [null, null, null];
}

function handlePieceSelection(row, col, pieceN) {
    if (!isMyTurn) {
        document.getElementById('gameStatus').textContent = "Not your turn";
        return;
    }


    if ((pieceN > 0 && playerColor === "black") || (pieceN < 0 && playerColor === "white")) {
        document.getElementById('gameStatus').textContent = "That's not your piece";
        return;
    }

    
    room.send("selectPiece", { row, col , pieceN});
}





function renderBoard() {
    const boardElement = document.querySelector('.board');
    boardElement.innerHTML = '';
    
    boardElement.innerHTML = '<svg class="numLett" viewBox="0 0 100 100" class="coordinates"><!-- Your SVG text coordinates here --></svg>';
    
    for (let row = 0; row < 8; row++) {
        for (let col = 0; col < 8; col++) {
            const sq = document.createElement('div');
            sq.classList.add('pieceContainer');
            
            sq.style.gridColumn = col + 1;
            sq.style.gridRow = row + 1;
            
            sq.dataset.row = row;
            sq.dataset.col = col;
            sq.dataset.content = board[row][col];
            sq.dataset.available = 0;
            
            const pieceNum = board[row][col];
            if (pieceNum !== 0) {
                const piece = pieceMap[pieceNum];
                
                const img = document.createElement('img');
                img.src = piece;
                img.alt = piece;
                img.classList.add('piece');
                sq.appendChild(img);
            }
            
            boardElement.appendChild(sq);
        }
    }
    
    
    const allPieces = document.querySelectorAll('.pieceContainer');
    allPieces.forEach(element => {
        element.addEventListener('click', function() {
            const row = parseInt(element.dataset.row, 10);
            const col = parseInt(element.dataset.col, 10);
            const pieceN = parseInt(element.dataset.content, 10);
            const available = parseInt(element.dataset.available, 10);

            if (start[2] === null || start[2] === 0) {
                
                if (pieceN !== 0) {
                    handlePieceSelection(row, col, pieceN);
                }
            } else if (start[0] === row && start[1] === col) {
                
                clearSelection();
            } else if (available === 1) {
                
                handleMove(start[0], start[1], row, col);
            }
        });
    });
}


document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('createGame').addEventListener('click', createGame);
    
    
    renderBoard();
});