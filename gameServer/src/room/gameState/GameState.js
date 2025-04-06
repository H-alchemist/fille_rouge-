
const GameState = {
  createGameState(whitePlayerData = null, blackPlayerData = null ,timeControl) {
    return {
      board: initializeBoard(),
      gameMoves :[] ,
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

  updateMatrix(board, from, to , gameMoves) {
  
    const [fromRow, fromCol] = from;
    const [toRow, toCol] = to;

    const movingPiece = board[fromRow][fromCol];

    gameMoves.push({
      from: [fromRow, fromCol],
      to: [toRow, toCol],
      piece: movingPiece
    });
    
    // Move the piece
    board[toRow][toCol] = board[fromRow][fromCol];
    board[fromRow][fromCol] = 0;

    // console.log("Matrix after update:", board);
    // console.log("////////////////////////////////////");
    
    return ;
  },

  
};

function initializeBoard() {
  const board = [
    [0, 0, 0, 0, 0, 0, 0, -6],
    [0, 0, 0, -5, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 5, 0, 0, 0, 0],
    [0, 0, 0, 0, 6, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0]
  ];

  return board;
}

export default GameState;