// gameState.js
const GameState = {
  createGameState(whitePlayerData = null, blackPlayerData = null ,timeControl) {
    return {
      board: initializeBoard(),
      turn: "white",
      whitePlayerData,  
      blackPlayerData,  
      timeControl,     
      timeRemaining: {  
        white: timeControl?.initialTime || 600,
        black: timeControl?.initialTime || 600
      }
    };
  },

  updateMatrix(board, from, to) {
   
    
  // console.log("Updating matrix from:", from, "to:", to);
    
    const [fromRow, fromCol] = from;
    const [toRow, toCol] = to;

    // Move the piece
    board[toRow][toCol] = board[fromRow][fromCol];
    board[fromRow][fromCol] = 0;

    // console.log("Matrix after update:", board);
    // console.log("////////////////////////////////////");
    
    return ;
  },

  switchTurn(gameState) {
    if (gameState.turn === "white") {
      gameState.turn = "black";
    } else {
      gameState.turn = "white";
    }
  
    console.log("Turn switched to:", gameState.turn);
    return gameState;
  }
};

function initializeBoard() {
  const board = [
    [-2, -3, -4, -5, -6, -4, -3, -2],
    [-1, -1, -1, -1, -1, -1, -1, -1],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [1, 1, 1, 1, 1, 1, 1, 1],
    [2, 3, 4, 5, 6, 4, 3, 2]
  ];

  return board;
}

export default GameState;