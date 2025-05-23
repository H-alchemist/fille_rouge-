
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
        white: { kingSide: false, queenSide: false },
        black: { kingSide: false, queenSide: false }
      },

      timeControl,     
      timeRemaining: {  
        white: timeControl?.initialTime || 600,
        black: timeControl?.initialTime || 600
      }
    };
  },

  updateMatrixPromote(board, from, to , pieace , gameMoves) {

    const [fromRow, fromCol] = from;
    const [toRow, toCol] = to;
    const movingPiece = pieace;

   
     
    
      
     

    gameMoves.push({
      from: [fromRow, fromCol],
      to: [toRow, toCol],
      piece: board[fromRow][fromCol],
      pormoted : pieace
    });
    
    
    // Move the piece
    board[toRow][toCol] = pieace;
    board[fromRow][fromCol] = 0;

    // console.log("Matrix after update:", board);
    // console.log("////////////////////////////////////");
    
    return ;


  
  },

  updateMatrix(board, from, to , gameMoves , castling) {
  
    const [fromRow, fromCol] = from;
    const [toRow, toCol] = to;

    const movingPiece = board[fromRow][fromCol];

    if ( castling &&(Math.abs(movingPiece) === 6) &&(toCol == 6 || toCol == 2 ) ) {

      if (movingPiece === 6) {
        if (toCol === 6) {

          board[7][6] = 6;

          board[7][7] = 0;

          board[7][5] = 2;

          board[7][4] = 0;
        
        
        }
       else if (toCol === 2) {

        board[7][2] = 6;

        board[7][0] = 0;

        board[7][3] = 2;

        board[7][4] = 0;



       } 
      }else if (movingPiece === -6) {
        if (toCol === 6) {

          board[0][6] = -6;
          board[0][7] = 0;

          board[0][5] = -2;

          board[0][4] = 0;



          
        }
       else if (toCol === 2) {
        board[0][2] = -6;

        board[0][0] = 0;

        board[0][3] = -2;

        board[0][4] = 0;



       } 
      }

      gameMoves.push({
        from: [fromRow, fromCol],
        to: [toRow, toCol],
        piece: movingPiece
      });
    
      
      return ;
    }

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
    [-2, -3, -4, -5, -6, -4, -3, -2],
    [-1,-1,-1,-1,-1,-1,-1,-1],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [1,1,1,1,1,1,1,1],
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