
const GameState = {
  createGameState(whitePlayerData = null, blackPlayerData = null ,timeControl) {
    return {
      board: initializeBoard(),
      gameMoves :[] ,
      turn: "white",
      whitePlayerData,  
      blackPlayerData,  
      isCheck:false,  // to keep the path of check and use it in the next move 
      castling: {
        white: { kingSide: true, queenSide: true },
        black: { kingSide: true, queenSide: true }
      },

      timeControl,     
      timeRemaining: {  
        white: timeControl?.initialTime || 600,
        black: timeControl?.initialTime || 600
      }
    };
  },

  updateMatrix(board, from, to , gameMoves ,castling) {

    const movingPiece = board[fromRow][fromCol];

    if (Math.abs(movingPiece) === 6){

      if (movingPiece === 6) {
        castling.white.kingSide = false;
        castling.white.queenSide = false;
      } else {
        castling.black.kingSide = false;
        castling.black.queenSide = false;
      }

    }
    if(Math.abs(movingPiece) === 2){
      
      if (movingPiece === 2 && fromCol === 7 && fromRow === 7) {
        castling.white.kingSide = false;
        
      } else if (movingPiece === 2 && fromCol === 7 && fromRow === 0) {
        
        castling.white.queenSide = false;
        
      } else if (movingPiece === -2 && fromCol === 0 && fromRow === 7) {

        castling.black.kingSide = false;
        

      } else if (movingPiece === -2 && fromCol === 0 && fromRow === 0) {
        

        castling.black.queenSide = false;
        

      } 
    }

     

  
    const [fromRow, fromCol] = from;
    const [toRow, toCol] = to;

    // const movingPiece = board[fromRow][fromCol];

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
    [0, 0, 0, -5, -6,0 , 0,0],
    [0, 0, 0, 0, 0, 0, 0, 0],

    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 3, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
   
    [2, 3, 4, 5, 6, 4, 3, 2]
  ];

  return board;
}

export default GameState;




// [-2, -3, -4, -5, -6, -4, -3, -2],
//     [-1,-1,-1,-1,-1,-1,-1,-1],
//     [0, 0, 0, 0, 0, 0, 0, 0],
//     [0, 0, 0, 0, 0, 0, 0, 0],
//     [0, 0, 0, 0, 0, 0, 0, 0],
//     [0, 0, 0, 0, 0, 0, 0, 0],
//     [1,1,1,1,1,1,1,1],
//     [2, 3, 4, 5, 6, 4, 3, 2]