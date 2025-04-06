
// import {addStylingforlegalMoves, removeStylingforlegalMoves } from './helper.js';

// Game state
let board = [
   [0, 0, 0, 0, 0, 0, 0, -6],
    [0, -2, 0, -5, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 2, 0, 5, , 0, 0, 0],
    [0, 0, 0, 0, 6, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0]
];

let start = [null, null, null];
let end = [null, null, null];
let playerColor = null;
let isMyTurn = false;
var client = null;
var room = null;
let gameRoom=null ;

// let RR =Math.floor(Math.random() * 301) + 1200;

// console.log(RR);



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
async function joinMatchMaking() {
    if (!client) {
        const connected = await connectToServer();
        if (!connected) return;
    }
    
    try {
        room = await client.joinOrCreate("matchMaking_room", {name: "hamza" ,accounId : 2425 ,rating:1200,timeControl: "blitz"});

        room.onMessage("matchmakingFound",async (message) => {
            console.log("Matchmaking found:", message.roomId);
            
            await joinGameRoom(message.roomId);

            
        });
       
        room.onMessage("removed", (message) => {
            document.getElementById('gameStatus').textContent = "sorry we didnt find any opponent in your level ";
            
        });
        // document.getElementById('gameStatus').textContent = `Game created! ID: ${room.id}`;

        // setupRoomListeners();
    } catch (error) {
        console.error("Could not create game:", error);
        document.getElementById('gameStatus').textContent = "Could not create game";
    }
}




async function joinGameRoom(roomId) {
    try {
        gameRoom = await client.joinById(roomId , {
        name: "hamza",  
        rating: 1500,   
        accounId: 2425  
    });
        console.log("Joined game room:", gameRoom);

        setupRoomListeners();
    } catch (error) {
        console.error("Error joining game room:", error);
    }
}

function setupRoomListeners() {




    gameRoom.onMessage("playerColor", (message) => {
        console.log("Received player color:", message);
        playerColor = message;
        document.getElementById('gameStatus').textContent = `You are playing as ${playerColor}`;
    });

    gameRoom.onMessage("waitingForOpponent", (message) => {
        document.getElementById('gameStatus').textContent = "Waiting for opponent...";
    });

   
    

    gameRoom.onMessage("gameStart", (message) => {
        board = message.board;
        isMyTurn = playerColor === message.turn;
        document.getElementById('gameStatus').textContent = isMyTurn ? "Your turn" : "Opponent's turn";
        renderBoard();
    });

    gameRoom.onMessage("validMoves", (message) => {
        const { validMoves, selectedPiece } = message;
        
        start = [selectedPiece.row, selectedPiece.col, selectedPiece.pieceN];
        document.querySelector(`[data-row="${selectedPiece.row}"][data-col="${selectedPiece.col}"]`).classList.add('selected');
        
        addStylingforlegalMoves(validMoves);
    });

    gameRoom.onMessage("invalidMove", (message) => {

        clearSelection();
        document.getElementById('gameStatus').textContent = message.reason;
    });

    gameRoom.onMessage("boardUpdate", (message) => {
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

    gameRoom.onMessage("playerLeft", (message) => {
        document.getElementById('gameStatus').textContent = `Opponent (${message.color}) left the game`;
    });

    gameRoom.onError((code, message) => {
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


    console.log('handle');
    


    gameRoom.send("selectPiece", { row, col , pieceN});
}

function handleMove(fromRow, fromCol , toRow , toCol , pieceN) {
    
    if (!isMyTurn) {
        document.getElementById('gameStatus').textContent = "Not your turn";
        return;

    }

    console.log(fromRow, fromCol , toRow , toCol , pieceN);
    

    gameRoom.send("handleMove", { fromRow, fromCol , toRow , toCol , pieceN});
    clearSelection();

}




function renderBoard() {
    const boardElement = document.querySelector('.board');
    boardElement.innerHTML = '';
    
    boardElement.innerHTML = '<svg class="numLett" viewBox="0 0 100 100" class="coordinates"><text x="0.75" y="3.5" font-size="2.8" class="coordinate-light">8</text><text x="0.75" y="15.75" font-size="2.8" class="coordinate-dark">7</text><text x="0.75" y="28.25" font-size="2.8" class="coordinate-light">6</text><text x="0.75" y="40.75" font-size="2.8" class="coordinate-dark">5</text><text x="0.75" y="53.25" font-size="2.8" class="coordinate-light">4</text><text x="0.75" y="65.75" font-size="2.8" class="coordinate-dark">3</text><text x="0.75" y="78.25" font-size="2.8" class="coordinate-light">2</text><text x="0.75" y="90.75" font-size="2.8" class="coordinate-dark">1</text><text x="10" y="99" font-size="2.8" class="coordinate-dark">a</text><text x="22.5" y="99" font-size="2.8" class="coordinate-light">b</text><text x="35" y="99" font-size="2.8" class="coordinate-dark">c</text><text x="47.5" y="99" font-size="2.8" class="coordinate-light">d</text><text x="60" y="99" font-size="2.8" class="coordinate-dark">e</text><text x="72.5" y="99" font-size="2.8" class="coordinate-light">f</text><text x="85" y="99" font-size="2.8" class="coordinate-dark">g</text><text x="97.5" y="99" font-size="2.8" class="coordinate-light">h</text></svg>';
 
    
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
                sq.dataset.available = 0;
                
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
        // console.log('elem');
        
        element.addEventListener('click', function() {
            const row = parseInt(element.dataset.row, 10);
            const col = parseInt(element.dataset.col, 10);
            const pieceN = parseInt(element.dataset.content, 10);
            const available = parseInt(element.dataset.available, 10);
            console.log("available", available);
            

            if (start[2] === null || start[2] === 0) {
                console.log('s');
                
                if (pieceN !== 0) {
                    handlePieceSelection(row, col, pieceN);
                }
            }else if(pieceN*start[2]>0) {
                console.log('test');

                clearSelection();

                if (pieceN !== 0) {
                    handlePieceSelection(row, col, pieceN);
                }
            
            
            }else if ((start[0] === row && start[1] === col) ) {
                console.log('3');
                
                clearSelection();
            } else if (available === 1) {
                console.log('available');
                
                handleMove(start[0], start[1], row, col , pieceN);
            }
        });
    });
}


document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('createGame').addEventListener('click', joinMatchMaking);
    
    
    renderBoard();
});



function addStylingforlegalMoves(list){

    if (list==null) {
        return
        
    } else {
        
    

    list.forEach(element => {

        const res = document.querySelector(`[data-row="${element[0]}"][data-col="${element[1]}"]`);
        res.dataset.available=1;

        res.classList.add('legalSquare');

        
    });
    }



}

function  removeStylingforlegalMoves(list){

    if (list==null) {
        return
        
    } else {
        
    


    list.forEach(element => {

        console.log(element);
        

        const res = document.querySelector(`[data-row="${element[0]}"][data-col="${element[1]}"]`);
        res.dataset.available=0;
        res.classList.remove('legalSquare');

        
    });
}

}
