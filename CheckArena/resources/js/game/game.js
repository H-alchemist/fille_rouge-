
// import {addStylingforlegalMoves, removeStylingforlegalMoves } from './helper.js';

// Game state
let board = [[-2, -3, -4, -5, -6, -4, -3, -2],
[-1,-1,-1,-1,-1,-1,-1,-1],
[0, 0, 0, 0, 0, 0, 0, 0],
[0, 0, 0, 0, 0, 0, 0, 0],
[0, 0, 0, 0, 0, 0, 0, 0],
[0, 0, 0, 0, 0, 0, 0, 0],
[1,1,1,1,1,1,1,1],
[2,3,4,5,6,4,3,2]];

let start = [null, null, null];
let end = [null, null, null];
let playerColor = 'white';
let isMyTurn = false;
var client = null;
var room = null;
let gameRoom=null ;

// let RR =Math.floor(Math.random() * 301) + 1200;

// //console.log(RR);


const blackBoard = `<div class="absolute inset-0 pointer-events-none z-0">
    <svg id="coordinates" class="numLett" viewBox="0 0 100 100" class="coordinates">
        <text class="coordinate" id="row1" x="0.75" y="3.5" font-size="2.8">1</text>
        <text class="coordinate" id="row2" x="0.75" y="15.75" font-size="2.8">2</text>
        <text class="coordinate" id="row3" x="0.75" y="28.25" font-size="2.8">3</text>
        <text class="coordinate" id="row4" x="0.75" y="40.75" font-size="2.8">4</text>
        <text class="coordinate" id="row5" x="0.75" y="53.25" font-size="2.8">5</text>
        <text class="coordinate" id="row6" x="0.75" y="65.75" font-size="2.8">6</text>
        <text class="coordinate" id="row7" x="0.75" y="78.25" font-size="2.8">7</text>
        <text class="coordinate" id="row8" x="0.75" y="90.75" font-size="2.8">8</text>
        
        <text class="coordinate" id="colA" x="10" y="99" font-size="2.8">h</text>
        <text class="coordinate" id="colB" x="22.5" y="99" font-size="2.8">g</text>
        <text class="coordinate" id="colC" x="35" y="99" font-size="2.8">f</text>
        <text class="coordinate" id="colD" x="47.5" y="99" font-size="2.8">e</text>
        <text class="coordinate" id="colE" x="60" y="99" font-size="2.8">d</text>
        <text class="coordinate" id="colF" x="72.5" y="99" font-size="2.8">c</text>
        <text class="coordinate" id="colG" x="85" y="99" font-size="2.8">b</text>
        <text class="coordinate" id="colH" x="97.5" y="99" font-size="2.8">a</text>
    </svg>
</div>`; 


const whiteBoard = ` <div class="absolute inset-0 pointer-events-none z-0">
                        <svg class="numLett" viewBox="0 0 100 100" class="coordinates"><text x="0.75" y="3.5" font-size="2.8" class="coordinate-light">8</text><text x="0.75" y="15.75" font-size="2.8" class="coordinate-dark">7</text><text x="0.75" y="28.25" font-size="2.8" class="coordinate-light">6</text><text x="0.75" y="40.75" font-size="2.8" class="coordinate-dark">5</text><text x="0.75" y="53.25" font-size="2.8" class="coordinate-light">4</text><text x="0.75" y="65.75" font-size="2.8" class="coordinate-dark">3</text><text x="0.75" y="78.25" font-size="2.8" class="coordinate-light">2</text><text x="0.75" y="90.75" font-size="2.8" class="coordinate-dark">1</text><text x="10" y="99" font-size="2.8" class="coordinate-dark">a</text><text x="22.5" y="99" font-size="2.8" class="coordinate-light">b</text><text x="35" y="99" font-size="2.8" class="coordinate-dark">c</text><text x="47.5" y="99" font-size="2.8" class="coordinate-light">d</text><text x="60" y="99" font-size="2.8" class="coordinate-dark">e</text><text x="72.5" y="99" font-size="2.8" class="coordinate-light">f</text><text x="85" y="99" font-size="2.8" class="coordinate-dark">g</text><text x="97.5" y="99" font-size="2.8" class="coordinate-light">h</text></svg>
                    </div>` ;




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
        client = new Colyseus.Client('ws://localhost:3001');
        // await client.getAvailableRooms();
        document.getElementById('gameStatus').textContent = "Connected to server";
        return true;
    } catch (error) {
        console.error("Could not connect to server:", error);
        document.getElementById('gameStatus').textContent = "Could not connect to server";
        return false;
    }
}


async function joinMatchMaking() {
    if (!client) {
        const connected = await connectToServer();
        // if (!connected) return;
    }
    
    try {
        room = await client.joinOrCreate("matchMaking_room", {name: "hamza" ,accounId : 2400 ,rating:1200,timeControl: 5});

        room.onMessage("matchmakingFound",async (message) => {
            console.log("Matchmaking found:", message.roomId);
            
            await joinGameRoom(message.roomId);

            
        });

        // gameOver

        room.onMessage("gameOver",async () => {
            

            console.log("Game Over:");
            
        });

        room.onMessage("already_in_queue",async (message) => {
            //console.log("Matchmaking found:", message.roomId);
            
            playerColor = message;
            document.getElementById('gameStatus').textContent = `already_in_queue`;

            
        });


        
       
        room.onMessage("removed", (message) => {
            document.getElementById('gameStatus').textContent = "sorry we didnt find any opponent in your level ";
            
        });
        document.getElementById('gameStatus').textContent = `Game created! ID: ${room.id}`;

        setupRoomListeners();
    } catch (error) {
        // console.error("Could not create game:", error);
        document.getElementById('gameStatus').textContent = "Could not create game";
    }
    // renderBoard();
}

document.getElementById('startGame').addEventListener('click', joinMatchMaking);


async function joinGameRoom(roomId) {
    try {
        gameRoom = await client.joinById(roomId , {
        name: "hamza",  
        rating: 1500,   
        accounId: 2425  
    });
        //console.log("Joined game room:", gameRoom);

        setupRoomListeners();
    } catch (error) {
        //console.error("Error joining game room:", error);
    }
}

function setupRoomListeners() {




    gameRoom.onMessage("playerColor", (message) => {
        //console.log("Received player color:", message);
        playerColor = message;
        document.getElementById('gameStatus').textContent = `You are playing as ${playerColor}`;
    });

    gameRoom.onMessage("waitingForOpponent", (message) => {
        document.getElementById('gameStatus').textContent = "Waiting for opponent...";
    });

   gameRoom.onMessage("newMove", (message) => {

    console.log(message);
    



   })
    

    gameRoom.onMessage("gameStart", (message) => {
        document.getElementById('gameStatus').textContent = "Game started!";
        let op = playerColor === "white" ? message.blackPlayerData : message.whitePlayerData;
        gameStart(op);

        let opT = playerColor === "white" ? message.timeRemaining.black: message.timeRemaining.white;
        let meT = playerColor === "white" ? message.timeRemaining.white : message.timeRemaining.black;

        // console.log(opT , 'opT' , meT);
        

        SetUpTimer({ op: opT, me: meT }, message.turn);

        // console.log(message);
        
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


    gameRoom.onMessage("null", (message) => {
        //console.log("Game Over:", message.winner);
        document.getElementById('gameStatus').textContent = `Game Over: ${message.winner}`;
    });

    gameRoom.onMessage("boardUpdate", (message) => {
        board = message.board;
        isMyTurn = playerColor === message.turn;
        // console.log(playerColor);
        
        let opT = playerColor === "white" ? message.timeRemaining.black: message.timeRemaining.white;
        let meT = playerColor === "white" ? message.timeRemaining.white : message.timeRemaining.black;

        // console.log(opT , 'opT' , meT);
        

        SetUpTimer({ op: opT, me: meT }, message.turn);
        document.getElementById('gameStatus').textContent = isMyTurn ? "Your turn" : "Opponent's turn";
        
        // const lastMove = message.lastMove;

        renderBoard();
        
        //  //console.log("Last move:", lastMove);
         
        // const fromSquare = document.querySelector(`[data-row="${lastMove.from[0]}"][data-col="${lastMove.from[1]}"]`);
        // const toSquare = document.querySelector(`[data-row="${lastMove.to[0]}"][data-col="${lastMove.to[1]}"]`);
        
        // if (fromSquare) fromSquare.classList.add('lastMove');
        // if (toSquare) toSquare.classList.add('lastMove');
    });

    gameRoom.onMessage("playerLeft", (message) => {
        document.getElementById('gameStatus').textContent = `Opponent (${message.color}) left the game`;
    });

    gameRoom.onError((code, message) => {
        //console.error(`Room error: ${code} - ${message}`);
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


    //console.log('handle');
    


    gameRoom.send("selectPiece", { row, col , pieceN});
}

function handleMove(fromRow, fromCol , toRow , toCol , pieceN) {
    
    if (!isMyTurn) {
        document.getElementById('gameStatus').textContent = "Not your turn";
        return;

    }

    //console.log(fromRow, fromCol , toRow , toCol , pieceN);
    

    gameRoom.send("handleMove", { fromRow, fromCol , toRow , toCol , pieceN});
    clearSelection();

}




function renderBoard() {
    const boardElement = document.getElementById('board');
    boardElement.innerHTML = '';
    
    boardElement.innerHTML = playerColor=== "white" ? whiteBoard : blackBoard;


    
    for (let row = 7; row >= 0; row--) {
        for (let col = 7; col >= 0; col--) {
            const sq = document.createElement('div');
            sq.classList.add('pieceContainer');
            
            // Adjust grid positions
            const gridRow = playerColor === "white" ? row + 1 : 7 - row + 1;
            const gridCol = playerColor === "white" ? col + 1 : 7 - col + 1;
            sq.style.gridColumn = gridCol;
            sq.style.gridRow = gridRow;
            
            sq.dataset.row = row;
            sq.dataset.col = col;
            sq.dataset.content = board[row][col];
            sq.dataset.available = 0;
            
            const pieceNum = board[row][col];
            if (pieceNum !== 0) {
                const piece = pieceMap[pieceNum]; // Assuming pieceMap maps numbers to piece images
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
        // //console.log('elem');
        
        element.addEventListener('click', function() {
            const row = parseInt(element.dataset.row, 10);
            const col = parseInt(element.dataset.col, 10);
            const pieceN = parseInt(element.dataset.content, 10);
            const available = parseInt(element.dataset.available, 10);
            //console.log("available", available);
            

            if (start[2] === null || start[2] === 0) {
                //console.log('s');
                
                if (pieceN !== 0) {
                    handlePieceSelection(row, col, pieceN);
                }
            }else if(pieceN*start[2]>0) {
                //console.log('test');

                clearSelection();

                if (pieceN !== 0) {
                    handlePieceSelection(row, col, pieceN);
                }
            
            
            }else if ((start[0] === row && start[1] === col) ) {
                //console.log('3');
                
                clearSelection();
            } else if (available === 1) {
                //console.log('available');
            //    updateBoardForPawnPormotion(pieace , from , to);

           const isWhite = start[2] === 1;
           const shouldPromote = (start[2] === 1 && row === 0) || (start[2] === -1 && row === 7);

           if (shouldPromote && Math.abs)  {
        //    console.log('pawn');updateTimerDisplay
           
            // console.log(start[2] ,[ start[0], start[1]],[ row, col] ,isWhite);
            
            updateBoardForPawnPormotion(start[2] ,[ start[0], start[1]],[ row, col] ,isWhite);
            return;
           }
                
                handleMove(start[0], start[1], row, col , pieceN);
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    // document.getElementById('createGame').addEventListener('click', joinMatchMaking);
    
    
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

        //console.log(element);
        

        const res = document.querySelector(`[data-row="${element[0]}"][data-col="${element[1]}"]`);
        res.dataset.available=0;
        res.classList.remove('legalSquare');

        
    });
}

}



const promotionPopup = document.getElementById('promotion-popup');

const pieceImages = {
  '2': 'https://assets-themes.chess.com/image/ejgfv/150/wr.png',
  '3': 'https://assets-themes.chess.com/image/ejgfv/150/wn.png',
  '4': 'https://assets-themes.chess.com/image/ejgfv/150/wb.png',
  '5': 'https://assets-themes.chess.com/image/ejgfv/150/wq.png',
  '-2': 'https://assets-themes.chess.com/image/ejgfv/150/br.png',
  '-3': 'https://assets-themes.chess.com/image/ejgfv/150/bn.png',
  '-4': 'https://assets-themes.chess.com/image/ejgfv/150/bb.png',
  '-5': 'https://assets-themes.chess.com/image/ejgfv/150/bq.png',
};

function showPromotionPopup(row, col, isWhite, callback) {
  const square = document.querySelector(`[data-row='${row}'][data-col='${col}']`);
//   //console.log(square);
  
  const rect = square.getBoundingClientRect();

  const direction = isWhite ? '' : '-';

  promotionPopup.querySelectorAll('img').forEach(img => {
    const value = img.dataset.value;
    img.src = pieceImages[direction + value];
    img.onclick = () => {
      promotionPopup.classList.add('hidden');
      callback(parseInt(direction + value));
    };
  });

  promotionPopup.style.left = `${rect.left}px`;
  promotionPopup.style.top = `${rect.top}px`;
  promotionPopup.classList.remove('hidden');
}


async  function updateBoardForPawnPormotion(piece, from, to , isWhite) {

    //console.log('test' , isWhite);
    
   
      board[from[0]][from[1]] = 0;
      board[to[0]][to[1]] = piece;
      
  
      renderBoard(); // this re-renders board so popup is shown on nUncaught TypeError: Cannot read properties of null (reading 'getBoundingClientRect')ew square
  
    //   setTimeout(() => {
    //     showPromotionPopup(to[0], to[1], isWhite, (promotedPiece) => {
    //         promoteTo = promotedPiece;
    //       board[to[0]][to[1]] = promotedPiece;
    //       renderBoard(); 
    //     });
    //   }, 10);

      const promotedPiece = await new Promise((resolve) => {
        showPromotionPopup(to[0], to[1], isWhite, resolve);
      });
      
      board[to[0]][to[1]] = promotedPiece;
      renderBoard();


      //console.log("promote", from[0], from[1] , to[0] , to[1] , piece , promotedPiece);
      

      gameRoom.send("promote",  {
        fromRow: from[0],
        fromCol: from[1],
        toRow: to[0],
        toCol: to[1],
        piece: piece,
        promoteTo: promotedPiece
      });
      renderBoard();
    } 
  
  



    function gameStart(op){


        document.getElementById('startGameContainer').classList.add('hidden');
        document.getElementById('game_moves').classList.remove('hidden');
        document.getElementById('game_buttons').classList.remove('hidden');
        document.getElementById('infoContainer').classList.remove('h-[95%]');

        document.getElementById('infoContainer').classList.add('h-[500px]');

        document.getElementById('apponent_name').textContent = op.name;

        document.getElementById('apponent_rating').textContent = op.rating;


     
        showNotification('Game start');




    }

    function showNotification(message, duration = 3000) {
        const bar = document.getElementById('notificationBar');
        const msg = document.getElementById('notificationMessage');

        msg.textContent = message;
        bar.style.top = '0';

        setTimeout(() => {
            bar.style.top = '-100px';
        }, duration);
    }


   
    let myTime = 0;
    let opponentTime = 0;
    let currentTurn = 'white';
    let myColor = 'white';
    let timerInterval;
    
    function SetUpTimer(time, color) {
        myTime = time.me;
        opponentTime = time.op;
         // or set dynamically if needed
        console.log();
        
    
        updateTimerDisplay();
    
        if (timerInterval) clearInterval(timerInterval);
    
        timerInterval = setInterval(() => {
            if (playerColor === color && myTime > 0) {
                myTime--;
            } else if (playerColor !== color && opponentTime > 0) {
                opponentTime--;
            }
    
            updateTimerDisplay();
        }, 1000);
    }
    
    function formatTime(seconds) {
        const m = Math.floor(seconds / 60);
        const s = seconds % 60;
        return `${m}:${s.toString().padStart(2, '0')}`;
    }
    
    function updateTimerDisplay() {
        document.getElementById('My_time').textContent = formatTime(myTime);
        document.getElementById('apponent_time').textContent = formatTime(opponentTime);
    }
    
    function switchTurn() {
        currentTurn = currentTurn === 'white' ? 'black' : 'white';
    }
    