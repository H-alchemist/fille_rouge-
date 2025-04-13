
export function findKingPosition(board, color) {

  const king = color  === 'white' ? 6 : -6 ;

  for(let i = 0 ; i<8 ; i++){
    for (let j =0 ; j<8 ; j++){
        if(board[i] [ j ] == king){
            return [i , j];
        }
    }
  }

  return null;

  }



  export  function checkbetween(board , attacker , kingP){


    const [ax, ay] = attacker;
    const [kx, ky] = kingP;

    const path = [attacker];


    const pieaceType = Math.abs(board[ax][ay]);

    if (pieaceType === 1 || pieaceType === 3 ){   // because pawn and knight dont have path

        return path;
    }


    const dx = kx - ax;
    const dy = ky - ay;
    const stepX = dx === 0 ? 0 : dx > 0 ? 1 : -1;
    const stepY = dy === 0 ? 0 : dy > 0 ? 1 : -1;
    
    let x = ax + stepX;
    let y = ay + stepY;
    
    while (x !== kx || y !== ky) {
      path.push([x, y]);
      x += stepX;
      y += stepY;
    }
    
    return path;


  }




  export function getpieacePotentialMoves(board , pos , color ){



    const [row, col] = pos;
    const piece = board[row][col];
    const moves = [];



    const pieceType = Math.abs(piece);

    if (pieceType === 1) {
        
        const direction = color === 'white' ? -1 : 1;
        const startRow = color === 'white' ? 6 : 1;
        if (board[row + direction][col] === 0) {
            moves.push([row + direction, col]);
            
          
            if (row === startRow && board[row + 2 * direction][col] === 0) {
              moves.push([row + 2 * direction, col]);
            }

            
          }  


   
         const  wings = [1 , -1];


    for (const wing of wings) {

        const checkCol = col + wing ;

        if(checkCol >=0 && checkCol < 8 ) {
            let target =   board[row  + direction][checkCol];
            if (target !== 0 && !((color === 'white' && target > 0) || (color === 'black' && target < 0))) {
                moves.push([row + direction, checkCol]);
            }

        }



    }






  }


  else if (pieceType === 3) {
    const knightMoves = [[-2, -1], [-2, 1], [-1, -2], [-1, 2], [1, -2], [1, 2], [2, -1], [2, 1]];
    for (const [x,y] of knightMoves) {
     const newRow = row +x;
     const newCol = col +y;
        if (newRow >= 0 && newRow < 8 && newCol >= 0 && newCol < 8) {
          const target = board[newRow][newCol];
          if (target === 0 || !((color === 'white' && target > 0) || (color === 'black' && target < 0))) {
            moves.push([newRow, newCol]);
          }
        }
      }
  }


  else if (pieceType === 4 || pieceType === 2 || pieceType === 5) {
    let directions = [];  // this for the directions we will check for the pieace can include all 8 direcions 

    if (pieceType === 4 || pieceType === 5) {
        directions.push([-1, -1], [-1, 1], [1, -1], [1, 1]); // in case of the bishops and  queen (diagnols)
      }

      if (pieceType === 2 || pieceType === 5) {
        directions.push([-1, 0], [0, -1], [1, 0], [0, 1]);  // in case of the bishops and  queen (rows and columns)
      }
    
    // now we will check if the piece can move in the each directions it have

    for (const [x, y] of directions) {
        let newRow = row + x;
        let newCol = col + y;

   
   while (newRow >= 0 && newRow < 8 && newCol >= 0 && newCol < 8) {    
    const targetPiece = board[newRow][newCol];
        
  


    if (targetPiece === 0) { moves.push([newRow, newCol]); // 0 means empty space we can move
    
    }
    
    else {
        if (!((color === 'white' && targetPiece > 0) || (color === 'black' && targetPiece < 0))) {  // condition means the opponet pieace we can take the pieace
           
            moves.push([newRow, newCol]);
        }
    break;
    }

    newRow += x;
    newCol += y;



}
}
  }


  else if (pieceType === 6) {
    const kingmoves = [[-1, -1], [-1, 0], [-1, 1], [0, -1], [0, 1], [1, -1], [1, 0], [1, 1]]; // king moves
    for (const [x, y] of kingmoves) {
      const newRow = row + x;
      const newCol = col + y;


      if (newRow >= 0 && newRow < 8 && newCol >= 0 && newCol < 8) {
        const target = board[newRow][newCol];
        if (target === 0 || !((color === 'white' && target > 0) || (color === 'black' && target < 0))) {
            moves.push([newRow, newCol]);
          }
        }
      }
    }

    return moves;






}







  export function isSquareAttacked(board, pos, color) {
    const opponent = color === 'white' ? 'black' : 'white';
    
    for (let row = 0; row < 8; row++) {
      for (let col = 0; col < 8; col++) {
        const piece = board[row][col];
        if (piece !== 0 && ((opponent === 'white' && piece > 0) || (opponent === 'black' && piece < 0))) {
          const moves = getpieacePotentialMoves(board, [row, col], opponent);
          if (moves.some(([r, c]) => r === pos[0] && c === pos[1])) {
            return true;
          }
        }
      }
    }
    
    return false;
  }



  export function getKingLegalMoves(board, kingPos, color) {
    const poentionalLegalMoves = getpieacePotentialMoves(board, kingPos, color);
    
    
    
    return poentionalLegalMoves.filter(move => {

      const newBoard = board.map(row => [...row]);
      const kingValue = board[kingPos[0]][kingPos[1]];
      newBoard[move[0]][move[1]] = kingValue;
      newBoard[kingPos[0]][kingPos[1]] = 0;
      
      return !isSquareAttacked(tempBoard, move, color);
    });


}



export function getLegalMoves(board, pos, color) {
    const [row, col] = pos;
    const piece = board[row][col];
    const pseudoLegalMoves = getpieacePotentialMoves(board, pos, color);
    const legalMoves = [];
    
   
    for (const [newRow, newCol] of pseudoLegalMoves) {
      const tempBoard = board.map(r => [...r]);
      
      tempBoard[newRow][newCol] = piece;
      tempBoard[row][col] = 0;
      
      let kingPos;

      if (piece === (color === 'white' ? 6 : -6)) {
         
          kingPos = [newRow, newCol]; 
      } else {
          
          kingPos = getKingPosition(tempBoard, color);  
      }
      if (!isSquareAttacked(tempBoard, kingPos, color)) {
        legalMoves.push([newRow, newCol]);
      }
      }
    
       return legalMoves;
  }




  export function getAllPiecesLegalMoves(board, color) {
    const allMoves = [];
    
    for (let row = 0; row < 8; row++) {
    for (let col = 0; col < 8; col++) {
         const piece = board[row][col];
        if (piece !== 0 && ((color === 'white' && piece > 0) || (color === 'black' && piece < 0))) {
          const moves = getLegalMoves(board, [row, col], color);
          allMoves.push(...moves.map(move => ({ from: [row, col], to: move })));
     }
      }
    }
    
    return allMoves;
  }



  export function canBlockorCaptureCheck(board, color, checkPath) {



    for (let i = 0; i < checkPath.length; i++) {
        const [x, y] = checkPath[i];
        
        for (let row = 0; row < 8; row++) {
          for (let col = 0; col < 8; col++) {
            const piece = board[row][col];
            if (piece !== 0 && ((color === 'white' && piece > 0) || (color === 'black' && piece < 0))) {
              const moves = getLegalMoves(board, [row, col], color);
              if (moves.some(([r, c]) => r === x && c === y)) {
                return true;
              }
            }
          }
        }
      }
      return false;
    


  }


  export function hasKingEscapeMoves(board, color) {
    const kingPos = getKingPosition(board, color);
    let is= getKingLegalMoves(board, kingPos, color) 
    return is.length > 0;
  }






export function checkIfLastMovePutKingInCheck(board, opponentColor) {
    console.log(  'color ' , opponentColor);
    
    const kingPos = findKingPosition(board, opponentColor);
    const attackerColor = opponentColor === 'white' ? 'black' : 'white';
    
    for (let row = 0; row < 8; row++) {
      for (let col = 0; col < 8; col++) {
        const piece = board[row][col];
        if (piece !== 0 &&((attackerColor === 'white' && piece > 0) || (attackerColor === 'black' && piece < 0))) {
          const moves = getpieacePotentialMoves(board, [row, col], attackerColor);
          if (moves.some(([r, c]) => r === kingPos[0] && c === kingPos[1])) {
            // return 'in check';
            return checkbetween(board , [row, col], kingPos);
          }
        }
      }
    }
    
    return false;
  }



  



  export function isCheckmate(board, color, checkPath) {
  
    
    if (hasKingEscapeMoves(board, color)) return false;
    
    
    return !canBlockorCaptureCheck(board, color, checkPath);
  }






