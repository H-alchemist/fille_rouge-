import {isPieceAligned , isClearBetween ,findThreatInDirection,checkPin} from '../calculmoves/helper.js';
 
 export function findKingPosition(board, sign) {
    for (let row = 0; row < board.length; row++) {
        for (let col = 0; col < board[row].length; col++) {
            // Check for the king based on the sign
            if (board[row][col] === 6 * sign) {
                return [col, row]; // Return the position [row, col] of the king
            }
        }
    }
    return null; // If no king is found, return null
}



  export   function calculatepieceMove(r,c,num,board , isCheck){


    let res;



    switch (num) {
        case 1:
            return WhitePawn(r,c , board);
            
            break;
        case -1:
        
            return BlackPawn(r,c,board);
                
            break;
        case 2:
        
             
            res = whiteRook(r,c,board);
            // console.log(isCheck);
            
            // console.log(res);
            

            if(isCheck){
                // console.log('filter');
                
             
                const isCheckSet = new Set(isCheck.map(move => `${move[0]},${move[1]}`));
    
   
                res = res.filter(move => isCheckSet.has(`${move[0]},${move[1]}`));
             
                return res ;
            }
            return  res;
                
                
        break;
        case -2:
                        

        res = blackRook(r,c,board);
        // console.log(isCheck);
        
        // console.log(res);
        

        if(isCheck){
            // console.log('filter');
            
         
            const isCheckSet = new Set(isCheck.map(move => `${move[0]},${move[1]}`));


            res = res.filter(move => isCheckSet.has(`${move[0]},${move[1]}`));
         
            return res ;
        }
        return  res;
                
        break;
        
        case 2:
        
            return whiteRook(r,c,board);
                
        break;


        case 4:
            //console.log(r +'test'+c,board);
            res = whiteBishop(r,c,board);
        
            if(isCheck){
                // console.log('filter');
                
             
                const isCheckSet = new Set(isCheck.map(move => `${move[0]},${move[1]}`));
    
   
                res = res.filter(move => isCheckSet.has(`${move[0]},${move[1]}`));
             
                return res ;
            }
            return  res;
                
        break;
        case -4:
        
        res = blackBishop(r,c,board);
        // console.log(isCheck);
        
        // console.log(res);
        

        if(isCheck){
            // console.log('filter');
            
         
            const isCheckSet = new Set(isCheck.map(move => `${move[0]},${move[1]}`));


            res = res.filter(move => isCheckSet.has(`${move[0]},${move[1]}`));
         
            return res ;
        }
        return  res;
                
        break;

        case 5:
            //console.log(r +'test'+c,board);
            
        
            res = whiteQueen(r,c,board);
            // console.log(isCheck);
            
            // console.log(res);
            

            if(isCheck){
                // console.log('filter');
                
             
                const isCheckSet = new Set(isCheck.map(move => `${move[0]},${move[1]}`));
    
   
                res = res.filter(move => isCheckSet.has(`${move[0]},${move[1]}`));
             
                return res ;
            }
            return  res;
                
        break;
        
        case -5:
        
            res = blackQueen(r,c,board);
            // console.log(isCheck);
            
            // console.log(res);
            

            if(isCheck){
                // console.log('filter');
                
             
                const isCheckSet = new Set(isCheck.map(move => `${move[0]},${move[1]}`));
    
   
                res = res.filter(move => isCheckSet.has(`${move[0]},${move[1]}`));
             
                return res ;
            }
            return  res;
                
        break;

        case 6:
            //console.log(r +'test'+c,board);
            
        
            return whiteKing(r,c,board);
                
        break;
        
        case -6:
        
            return blackKing(r,c,board);
                
        break;


        case 3:
            //console.log(r +'test'+c,board);
            
        
            // return whiteKnight(r,c,board);
            res = whiteKnight(r,c,board);
            // console.log(isCheck);
            
            // console.log(res);
            
    
            if(isCheck){
                // console.log('filter');
                
             
                const isCheckSet = new Set(isCheck.map(move => `${move[0]},${move[1]}`));
    
    
                res = res.filter(move => isCheckSet.has(`${move[0]},${move[1]}`));
             
                return res ;
            }
            return  res;
                
        break;
        
        case -3:
        
        res = blackKnight(r,c,board);
        // console.log(isCheck);
        
        // console.log(res);
        

        if(isCheck){
            // console.log('filter');
            
         
            const isCheckSet = new Set(isCheck.map(move => `${move[0]},${move[1]}`));


            res = res.filter(move => isCheckSet.has(`${move[0]},${move[1]}`));
         
            return res ;
        }
        return  res;
                
        break;

        default:
            break;
    }



    
}





//   export   function WhitePawn(r, c , board) {
//     let list = [];

//     if (r > 0 && board[r - 1][c] === 0) {
//         list.push([r - 1, c]);

      
//         if (r === 6 && board[r - 2][c] === 0) {
//             list.push([r - 2, c]);
        
//         }
//     }

   
//     if (r > 0 && c > 0 && board[r - 1][c - 1] < 0) {
//              list.push([r - 1, c - 1]);
//     }

//    if (r > 0 && c < board[r].length - 1 && board[r - 1][c + 1] < 0) {
//         list.push([r - 1, c + 1]);
//     }

//     return list;
// }

export function WhitePawn(r, c, board) {
    let list = [];
    const kingPos = findKingPosition(board, 1);
    const direction = checkPin(kingPos, [c, r], board, 1);
    // //console.log(direction , '  pawn directio,nnnnnnnnnnnnnnnnnnnnnn');
    

   if (direction && !(direction[0] === 0 && direction[1] === -1)) {

   if (r > 0 && c > 0 && direction[0] === -1 && direction[1] === -1 && board[r - 1][c - 1] < 0) {
            list.push([r - 1, c - 1]);}

   if (r > 0 && c < 7 && direction[0] === 1 && direction[1] === -1 && board[r - 1][c + 1] < 0) {
            list.push([r - 1, c + 1]);}
        return list;
    }

    if (r > 0 && board[r - 1][c] === 0) {
        list.push([r - 1, c]);

    if (r === 6 && board[r - 2][c] === 0) { list.push([r - 2, c]); }
    }
    if (r > 0 && c > 0 && board[r - 1][c - 1] < 0) {
        list.push([r - 1, c - 1]);}
    if (r > 0 && c < 7 && board[r - 1][c + 1] < 0) {
        list.push([r - 1, c + 1]);}

    return list;
}





//   export   function BlackPawn(r, c, board) {
//     let list = [];

    
//     if (r < board.length - 1 && board[r + 1][c] === 0) {
//         list.push([r + 1, c]);

   
//         if (r === 1 && board[r + 2][c] === 0) {
//             list.push([r + 2, c]);
//         }
//     }

   
//     if (r < board.length - 1 && c > 0 && board[r + 1][c - 1] > 0) {
//         list.push([r + 1, c - 1]);
//     }

   
//     if (r < board.length - 1 && c < board[r].length - 1 && board[r + 1][c + 1] > 0) {
//         list.push([r + 1, c + 1]);
//     }

//     return list;
// }

export function BlackPawn(r, c, board) {
    let list = [];
    const kingPos = findKingPosition(board, -1);
    const direction = checkPin(kingPos, [c, r], board, -1);

    
    if (direction && !(direction[0] === 0 && direction[1] === 1)) {
        
    if (r < 7 && c > 0 && direction[0] === -1 && direction[1] === 1 && board[r + 1][c - 1] > 0) {
            list.push([r + 1, c - 1]);}
    if (r < 7 && c < 7 && direction[0] === 1 && direction[1] === 1 && board[r + 1][c + 1] > 0) {
            list.push([r + 1, c + 1]);}
        return list;
    }


    if (r < 7 && board[r + 1][c] === 0) {
        list.push([r + 1, c]);

    if (r === 1 && board[r + 2][c] === 0) {
            list.push([r + 2, c]);
        }
    }

    if (r < 7 && c > 0 && board[r + 1][c - 1] > 0) {
        list.push([r + 1, c - 1]);}

    if (r < 7 && c < 7 && board[r + 1][c + 1] > 0) {
        list.push([r + 1, c + 1]);}

    return list;
}


//   export   function whiteRook(r, c, board) {

    

//     let list = [];

   
//     let col = c - 1;
//     while (col >= 0) {
//         if (board[r][col] === 0) {
//             list.push([r, col]);
//         } else if (board[r][col] < 0) { 
//             list.push([r, col]);
//             break;  
//         } else {
//             break;  
//         }
//         col--;
//     }

//     col = c + 1;
//     while (col < board[r].length) {
//         if (board[r][col] === 0) {
//             list.push([r, col]);
//         } else if (board[r][col] < 0) {
//             list.push([r, col]);
//             break;
//         } else {
//             break;
//         }
//         col++;
//     }

    
//     let row = r - 1;
//     while (row >= 0) {
//         if (board[row][c] === 0) {
//             list.push([row, c]);
//         } else if (board[row][c] < 0) {
//             list.push([row, c]);
//             break;
//         } else {
//             break;
//         }
//         row--;
//     }

    
//     row = r + 1;
//     while (row < board.length) {
//         if (board[row][c] === 0) {
//             list.push([row, c]);
//         } else if (board[row][c] < 0) {
//             list.push([row, c]);
//             break;
//         } else {
//             break;
//         }
//         row++;
//     }

//     return list;
// }
export function whiteRook(r, c, board) {
    let list = [];

    let kingPos = findKingPosition(board, 1);
    const direction = checkPin(kingPos, [c, r], board, 1);

     if (direction && direction[0] !== 0 && direction[1] !== 0) {
        return []; // Rook moves in a straight line, no diagonal pin allowed
     }

 if (!direction) {
        let col = c - 1;
        while (col >= 0) {
            if (board[r][col] === 0) {
                list.push([r, col]);
            } else if (board[r][col] < 0) {
                list.push([r, col]);
                break;
            } else {
                break;
            }
            col--;
        }

        col = c + 1;
        while (col < board[r].length) {
            if (board[r][col] === 0) {
                list.push([r, col]);
            } else if (board[r][col] < 0) {
                list.push([r, col]);
                break;
            } else {
                break;
            }
            col++;
        }

        let row = r - 1;
        while (row >= 0) {
            if (board[row][c] === 0) {
                list.push([row, c]);
            } else if (board[row][c] < 0) {
                list.push([row, c]);
                break;
            } else {
                break;
            }
            row--;
        }

        row = r + 1;
        while (row < board.length) {
            if (board[row][c] === 0) {
                list.push([row, c]);
            } else if (board[row][c] < 0) {
                list.push([row, c]);
                break;
            } else {
                break;
            }
            row++;
        }
    } else {
        let [dx, dy] = direction;
        let x = r + dy;
        let y = c + dx;

        while (x >= 0 && x < 8 && y >= 0 && y < 8) {
            if (board[x][y] === 0) {
                list.push([x, y]);
            } else if (board[x][y] < 0) {
                list.push([x, y]);
                break;
            } else {
                break;
            }
            x += dy;
            y += dx;
        }

        let x1 = r + dy * -1;
        let y2 = c + dx * -1;

        while (x1 >= 0 && x1 < 8 && y2 >= 0 && y2 < 8) {
            if (board[x1][y2] === 0) {
                list.push([x1, y2]);
            } else if (board[x1][y2] < 0) {
                list.push([x1, y2]);
                break;
            } else {
                break;
            }
            x1 += dy * -1;
            y2 += dx * -1;
        }
    }

    return list;
}


//   export   function blackRook(r, c, board) {
//     let list = [];

    
//     let col = c - 1;
//     while (col >= 0) {
//         if (board[r][col] === 0) {
//             list.push([r, col]);
//         } else if (board[r][col] > 0) {  
            
//             list.push([r, col]);
//             break; 
            
//         } else {
//             break;  
            
//         }
//         col--;
//     }

    
//     col = c + 1;
//     while (col < board[r].length) {
//         if (board[r][col] === 0) {
//             list.push([r, col]);
//         } else if (board[r][col] > 0) {
//             list.push([r, col]);
//             break;
//         } else {
//             break;
//         }
//         col++;
//     }

    
//     let row = r - 1;
//     while (row >= 0) {
//         if (board[row][c] === 0) {
//             list.push([row, c]);
//         } else if (board[row][c] > 0) {
//             list.push([row, c]);
//             break;
//         } else {
//             break;
//         }
//         row--;
//     }

    
//     row = r + 1;
//     while (row < board.length) {
//         if (board[row][c] === 0) {
//             list.push([row, c]);
//         } else if (board[row][c] > 0) {
//             list.push([row, c]);
//             break;
//         } else {
//             break;
//         }
//         row++;
//     }

//     return list;
// }


export function blackRook(r, c, board) {
    let list = [];

    let kingPos = findKingPosition(board, -1);
    const direction = checkPin(kingPos, [c, r], board, -1);

    if (direction && direction[0] !== 0 && direction[1] !== 0) {
        return []; // Rook moves in a straight line, no diagonal pin allowed
    }

    if (!direction) {
        let col = c - 1;
        while (col >= 0) {
            if (board[r][col] === 0) {
                list.push([r, col]);
            } else if (board[r][col] > 0) {
                list.push([r, col]);
                break;
            } else {
                break;
            }
            col--;
        }

        col = c + 1;
        while (col < board[r].length) {
            if (board[r][col] === 0) {
                list.push([r, col]);
            } else if (board[r][col] > 0) {
                list.push([r, col]);
                break;
            } else {
                break;
            }
            col++;
        }

        let row = r - 1;
        while (row >= 0) {
            if (board[row][c] === 0) {
                list.push([row, c]);
            } else if (board[row][c] > 0) {
                list.push([row, c]);
                break;
            } else {
                break;
            }
            row--;
        }

        row = r + 1;
        while (row < board.length) {
            if (board[row][c] === 0) {
                list.push([row, c]);
            } else if (board[row][c] > 0) {
                list.push([row, c]);
                break;
            } else {
                break;
            }
            row++;
        }
    } else {
        let [dx, dy] = direction;
        let x = r + dy;
        let y = c + dx;

        while (x >= 0 && x < 8 && y >= 0 && y < 8) {
            if (board[x][y] === 0) {
                list.push([x, y]);
            } else if (board[x][y] > 0) {
                list.push([x, y]);
                break;
            } else {
                break;
            }
            x += dy;
            y += dx;
        }

        let x1 = r + dy * -1;
        let y2 = c + dx * -1;

        while (x1 >= 0 && x1 < 8 && y2 >= 0 && y2 < 8) {
            if (board[x1][y2] === 0) {
                list.push([x1, y2]);
            } else if (board[x1][y2] > 0) {
                list.push([x1, y2]);
                break;
            } else {
                break;
            }
            x1 += dy * -1;
            y2 += dx * -1;
        }
    }

    return list;
}






//   export   function blackBishop(r, c, board) {
//     let list = [];

    
//     let row = r - 1, col = c - 1;
//     while (row >= 0 && col >= 0) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] > 0) { 
//             list.push([row, col]);
//             break; 
//         } else {
//             break;  
//         }
//         row--;
//         col--;
//     }

    
//     row = r - 1, col = c + 1;
//     while (row >= 0 && col < board[row].length) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] > 0) {  
//             list.push([row, col]);
//             break;
//         } else {
//             break;
//         }
//         row--;
//         col++;
//     }

//     row = r + 1, col = c - 1;
//     while (row < board.length && col >= 0) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] > 0) {  
//             list.push([row, col]);
//             break;
//         } else {
//             break;
//         }
//         row++;
//         col--;
//     }

//     row = r + 1, col = c + 1;
//     while (row < board.length && col < board[row].length) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] > 0) {  
//             list.push([row, col]);
//             break;
//         } else {
//             break;
//         }
//         row++;
//         col++;
//     }

//     return list;
// }



//   export   function whiteBishop(r, c, board) {
//     let list = [];
//   //console.log(list);
  
  
//     let row = r - 1, col = c - 1;
//     while (row >= 0 && col >= 0) {
        
        
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] < 0) {  
//             list.push([row, col]);
//             break;
//         } else {
//             break; 
//         }
//         row--;
//         col--;
//     }


//     //////////////////

    

//     row = r - 1, col = c + 1;
//     while (row >= 0 && col < board[row].length) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] < 0) {  
//             list.push([row, col]);
//             break;
//         } else {
//             break;
//         }
//         row--;
//         col++;
//     }

//     row = r + 1, col = c - 1;
//     while (row < board.length && col >= 0) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] < 0) {  
//             list.push([row, col]);
//             break;
//         } else {
//             break;
//         }
//         row++;
//         col--;
//     }

   
//     row = r + 1, col = c + 1;
//     while (row < board.length && col < board[row].length) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] < 0) {  
//             list.push([row, col]);
//             break;
//         } else {
//             break;
//         }
//         row++;
//         col++;
//     }

//     return list;
// }

//   export   function blackQueen(r, c, board) {
//     let list = [];
  
   
//     let col = c - 1;
//     while (col >= 0) {
//         if (board[r][col] === 0) {
//             list.push([r, col]);
//         } else if (board[r][col] > 0) { 
//             list.push([r, col]);
//             break;  
//         } else {
//             break; 
//         }
//         col--;
//     }

//     col = c + 1;
//     while (col < board[r].length) {
//         if (board[r][col] === 0) {
//             list.push([r, col]);
//         } else if (board[r][col] > 0) {
//             list.push([r, col]);
//             break;
//         } else {
//             break;
//         }
//         col++;
//     }

//     let row = r - 1;
//     while (row >= 0) {
//         if (board[row][c] === 0) {
//             list.push([row, c]);
//         } else if (board[row][c] > 0) {
//             list.push([row, c]);
//             break;
//         } else {
//             break;
//         }
//         row--;
//     }

//     row = r + 1;
//     while (row < board.length) {
//         if (board[row][c] === 0) {
//             list.push([row, c]);
//         } else if (board[row][c] > 0) {
//             list.push([row, c]);
//             break;
//         } else {
//             break;
//         }
//         row++;
//     }

//     row = r - 1, col = c - 1;
//     while (row >= 0 && col >= 0) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] > 0) {
//             list.push([row, col]);
//             break;  
//         } else {
//             break;  
//         }
//         row--;
//         col--;
//     }

//     row = r - 1, col = c + 1;
//     while (row >= 0 && col < board[row].length) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] > 0) {
//             list.push([row, col]);
//             break;
//         } else {
//             break;
//         }
//         row--;
//         col++;
//     }

//     row = r + 1, col = c - 1;
//     while (row < board.length && col >= 0) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] > 0) {
//             list.push([row, col]);
//             break;
//         } else {
//             break;
//         }
//         row++;
//         col--;
//     }

//     row = r + 1, col = c + 1;
//     while (row < board.length && col < board[row].length) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] > 0) {
//             list.push([row, col]);
//             break;
//         } else {
//             break;
//         }
//         row++;
//         col++;
//     }

//     return list;
// }


//   export   function whiteQueen(r, c, board) {
//     let list = [];
  
//     let col = c - 1;
//     while (col >= 0) {
//         if (board[r][col] === 0) {
//             list.push([r, col]);
//         } else if (board[r][col] < 0) {  
//             list.push([r, col]);
//             break; 
//         } else {
//             break; 
//         }
//         col--;
//     }

//     col = c + 1;
//     while (col < board[r].length) {
//         if (board[r][col] === 0) {
//             list.push([r, col]);
//         } else if (board[r][col] < 0) {
//             list.push([r, col]);
//             break;
//         } else {
//             break;
//         }
//         col++;
//     }

//     let row = r - 1;
//     while (row >= 0) {
//         if (board[row][c] === 0) {
//             list.push([row, c]);
//         } else if (board[row][c] < 0) {
//             list.push([row, c]);
//             break;
//         } else {
//             break;
//         }
//         row--;
//     }

//     row = r + 1;
//     while (row < board.length) {
//         if (board[row][c] === 0) {
//             list.push([row, c]);
//         } else if (board[row][c] < 0) {
//             list.push([row, c]);
//             break;
//         } else {
//             break;
//         }
//         row++;
//     }

//     row = r - 1, col = c - 1;
//     while (row >= 0 && col >= 0) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] < 0) {
//             list.push([row, col]);
//             break;  
//         } else {
//             break; 
//         }
//         row--;
//         col--;
//     }

//     row = r - 1, col = c + 1;
//     while (row >= 0 && col < board[row].length) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] < 0) {
//             list.push([row, col]);
//             break;
//         } else {
//             break;
//         }
//         row--;
//         col++;
//     }

    
//     row = r + 1, col = c - 1;
//     while (row < board.length && col >= 0) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] < 0) {
//             list.push([row, col]);
//             break;
//         } else {
//             break;
//         }
//         row++;
//         col--;
//     }

    
//     row = r + 1, col = c + 1;
//     while (row < board.length && col < board[row].length) {
//         if (board[row][col] === 0) {
//             list.push([row, col]);
//         } else if (board[row][col] < 0) {
//             list.push([row, col]);
//             break;
//         } else {
//             break;
//         }
//         row++;
//         col++;
//     }

//     return list;
// }


export function blackBishop(r, c, board) {
    let list = [];

    let kingPos = findKingPosition(board, -1);
    const direction = checkPin(kingPos, [c, r], board, -1);

    if (direction && (direction[0] === 0 || direction[1] === 0)) {
        return []; 
    }

    if (!direction) {
        let row = r - 1, col = c - 1;
        while (row >= 0 && col >= 0) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] > 0) {
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row--;
            col--;
        }

        row = r - 1, col = c + 1;
        while (row >= 0 && col < board[row].length) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] > 0) {
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row--;
            col++;
        }

        row = r + 1, col = c - 1;
        while (row < board.length && col >= 0) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] > 0) {
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row++;
            col--;
        }

        row = r + 1, col = c + 1;
        while (row < board.length && col < board[row].length) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] > 0) {
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row++;
            col++;
        }
    } else {
        let [dx, dy] = direction;
        let x = r + dy;
        let y = c + dx;

        while (x >= 0 && x < 8 && y >= 0 && y < 8) {
            if (board[x][y] === 0) {
                list.push([x, y]);
            } else if (board[x][y] > 0) {
                list.push([x, y]);
                break;
            } else {
                break;
            }
            x += dy;
            y += dx;
        }

        let x1 = r + dy * -1;
        let y2 = c + dx * -1;

        while (x1 >= 0 && x1 < 8 && y2 >= 0 && y2 < 8) {
            if (board[x1][y2] === 0) {
                list.push([x1, y2]);
            } else if (board[x1][y2] > 0) {
                list.push([x1, y2]);
                break;
            } else {
                break;
            }
            x1 += dy * -1;
            y2 += dx * -1;
        }
    }

    return list;
}


export function whiteBishop(r, c, board) {
    let list = [];

    let kingPos = findKingPosition(board, 1);
    const direction = checkPin(kingPos, [c, r], board, 1);

      if (direction && (direction[0] === 0 || direction[1] === 0)) {
        return []; 
     }

    if (!direction) {
        let row = r - 1, col = c - 1;
        while (row >= 0 && col >= 0) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] < 0) {
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row--;
            col--;
        }

        row = r - 1, col = c + 1;
        while (row >= 0 && col < board[row].length) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] < 0) {
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row--;
            col++;
        }

        row = r + 1, col = c - 1;
        while (row < board.length && col >= 0) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] < 0) {
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row++;
            col--;
        }

        row = r + 1, col = c + 1;
        while (row < board.length && col < board[row].length) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] < 0) {
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row++;
            col++;
        }
      } else {
        let [dx, dy] = direction;
        let x = r + dy;
        let y = c + dx;

        while (x >= 0 && x < 8 && y >= 0 && y < 8) {
            if (board[x][y] === 0) {
                list.push([x, y]);
            } else if (board[x][y] < 0) {
                list.push([x, y]);
                break;
            } else {
                break;
            }
            x += dy;
            y += dx;
        }

        let x1 = r + dy * -1;
        let y2 = c + dx * -1;

        while (x1 >= 0 && x1 < 8 && y2 >= 0 && y2 < 8) {
            if (board[x1][y2] === 0) {
                list.push([x1, y2]);
            } else if (board[x1][y2] < 0) {
                list.push([x1, y2]);
                break;
            } else {
                break;
            }
            x1 += dy * -1;
            y2 += dx * -1;
        }
    }

    return list;
}


export function blackQueen(r, c, board, color) {
    let list = [];

    let kingPos = findKingPosition(board, -1);  
    const direction = checkPin(kingPos, [c, r], board, -1);  
    
    //console.log('test' + direction);

    if (!direction) {
        
        let col = c + 1;
        while (col < board[r].length) {
            if (board[r][col] === 0) {
                list.push([r, col]);
            } else if (board[r][col] > 0) {  
                list.push([r, col]);
                break;
            } else {
                break;
            }
            col++;
        }
        // Left
        col = c - 1;
        while (col >= 0) {
            if (board[r][col] === 0) {
                list.push([r, col]);
            } else if (board[r][col] > 0) {  
                list.push([r, col]);
                break;
            } else {
                break;
            }
            col--;
        }

        // Vertical
        // Up
        let row = r - 1;
        while (row >= 0) {
            if (board[row][c] === 0) {
                list.push([row, c]);
            } else if (board[row][c] > 0) {  
                list.push([row, c]);
                break;
            } else {
                break;
            }
            row--;
        }
        // Down
        row = r + 1;
        while (row < board.length) {
            if (board[row][c] === 0) {
                list.push([row, c]);
            } else if (board[row][c] > 0) {  
                list.push([row, c]);
                break;
            } else {
                break;
            }
            row++;
        }

       
        row = r - 1, col = c - 1;
        while (row >= 0 && col >= 0) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] > 0) {  
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row--;
            col--;
        }
        // Top-right
        row = r - 1, col = c + 1;
        while (row >= 0 && col < board[row].length) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] > 0) {  
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row--;
            col++;
        }
        // Bottom-left
        row = r + 1, col = c - 1;
        while (row < board.length && col >= 0) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] > 0) {  
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row++;
            col--;
        }
        // Bottom-right
        row = r + 1, col = c + 1;
        while (row < board.length && col < board[row].length) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] > 0) {  
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row++;
            col++;
        }

    } else {
        let [dx, dy] = direction;
        let x = r + dy;
        let y = c + dx;

        while (x >= 0 && x < 8 && y >= 0 && y < 8) {
            if (board[x][y] === 0) {
                list.push([x, y]);
                //console.log('empty' + [x, y]);
            } else if (board[x][y] > 0) { 
                list.push([x, y]);
                //console.log('enemy' + [x, y]);
                break;
            } else {
                break;
            }

            x += dy;
            y += dx;
        }

        let x1 = r + dy * -1;
        let y2 = c + dx * -1;

        while (x1 >= 0 && x1 < 8 && y2 >= 0 && y2 < 8) {
            if (board[x1][y2] === 0) {
                list.push([x1, y2]);
            } else if (board[x1][y2] > 0) {  
                list.push([x1, y2]);
                //console.log('enemy' + [x1, y2]);
                break;
            } else {
                break;
            }

            x1 += dy * -1;
            y2 += dx * -1;
        }
    }

    return list;
}


export function whiteQueen(r, c, board , color) {
    let list = [];

    let kingPos =  findKingPosition(board  , 1);
    const direction = checkPin(kingPos, [c, r], board, 1);

    
    //console.log('test' +direction);

    
    //  return;
    if (!direction) {
        
        let col = c + 1;
        while (col < board[r].length) {
            if (board[r][col] === 0) {
                list.push([r, col]);
            } else if (board[r][col] < 0) {
                list.push([r, col]);
                break;
            } else {
                break;
            }
            col++;
        }
        // Left
        col = c - 1;
        while (col >= 0) {
            if (board[r][col] === 0) {
                list.push([r, col]);
            } else if (board[r][col] < 0) {
                list.push([r, col]);
                break;
            } else {
                break;
            }
            col--;
        }

        // Vertical
        // Up
        let row = r - 1;
        while (row >= 0) {
            if (board[row][c] === 0) {
                list.push([row, c]);
            } else if (board[row][c] < 0) {
                list.push([row, c]);
                break;
            } else {
                break;
            }
            row--;
        }
        // Down
        row = r + 1;
        while (row < board.length) {
            if (board[row][c] === 0) {
                list.push([row, c]);
            } else if (board[row][c] < 0) {
                list.push([row, c]);
                break;
            } else {
                break;
            }
            row++;
        }

        // Diagonal
        // Top-left
        row = r - 1, col = c - 1;
        while (row >= 0 && col >= 0) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] < 0) {
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row--;
            col--;
        }
        // Top-right
        row = r - 1, col = c + 1;
        while (row >= 0 && col < board[row].length) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] < 0) {
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row--;
            col++;
        }
        // Bottom-left
        row = r + 1, col = c - 1;
        while (row < board.length && col >= 0) {
            if (board[row][col] === 0) {
                list.push([row, col]);
            } else if (board[row][col] < 0) {
                list.push([row, col]);
                break;
            } else {
                break;
            }
            row++;
            col--;
        }
        // Bottom-right
        row = r + 1, col = c + 1;
        while (row < board.length && col < board[row].length) {
            if (board[row][col] === 0) {
                list.push([row, col]);

                
            } else if (board[row][col] < 0) {
                list.push([row, col]);
                
                break;
            } else {
                break;
            }
            row++;
            col++;
        }

    } else {
        let [dx, dy] = direction;
        let x = r + dy;
        let y = c + dx;

        while (x >= 0 && x < 8 && y >= 0 && y < 8) {
            if (board[x][y] === 0) {
                list.push([x, y]);
                //console.log('empty' + [x, y]);
            } else if (board[x][y] < 0) {
                list.push([x, y]);
                //console.log('enemy' + [x, y]);
                break;
            } else {
                break;
            }

            x += dy;
            y += dx;
        }
       
        let x1 = r + dy*-1;
        let y2 = c + dx*-1;

        while (x1 >= 0 && x1 < 8 && y2 >= 0 && y2 < 8) {
            if (board[x1][y2] === 0) {
                list.push([x1, y2]);
                // //console.log('empty' + [x, y]);
            } else if (board[x1][y2] < 0) {
                list.push([x1, y2]);
                //console.log('enemy' + [x1, y2]);
                break;
            } else {
                break;
            }

            x1 += dy*-1;
            y2 += dx*-1;
        }
    }

    return list;
}



  export   function whiteKing(r, c, board) {
    let list = [];

    const directions = [
        [-1, 0], [1, 0], [0, -1], [0, 1],    
        [-1, -1], [-1, 1], [1, -1], [1, 1]   
    ];

    for (const [dr, dc] of directions) {
        const newRow = r + dr;
        const newCol = c + dc;
        if (newRow >= 0 && newRow < board.length && newCol >= 0 && newCol < board[r].length) {
            if (board[newRow][newCol] === 0 || board[newRow][newCol] < 0) {  
                list.push([newRow, newCol]);
            }
        }
    }

    return list;
}







  export   function blackKing(r, c, board) {
    let list = [];

    const directions = [
        [-1, 0], [1, 0],  
        [0, -1], [0, 1], 
        [-1, -1], [-1, 1], 
        [1, -1], [1, 1]   
    ];

    for (const [dr, dc] of directions) {
        const newRow = r + dr;
        const newCol = c + dc;

        
        if (newRow >= 0 && newRow < board.length && newCol >= 0 && newCol < board[r].length) {
           
            if (board[newRow][newCol] === 0 || board[newRow][newCol] > 0) {
                list.push([newRow, newCol]);
            }
        }
    }

    return list;
}



  export   function whiteKnight(r,c , board){

   
    let kingPos = findKingPosition(board, 1);
    const direction = checkPin(kingPos, [c, r], board, 1);

    if (direction ) {
        return []; 
    }

    let list =[];

    let checklist=[
        [r+2 , c-1] ,[r+2 , c+1],
        [r-2 , c-1] ,[r-2 , c+1],
        [r-1 , c-2] ,[r-1 , c+2],
        [r+1 , c-2] ,[r+1 , c+2]
    ] 

    checklist.forEach(e => {
  
        

        if (e[0] <8 && e[1]<8 && e[0]>-1  && e[1]>-1 ) {
         
            if( board[e[0]][e[1]]<=0  ){
               
                
            list.push([e[0],e[1]]);
        }
        }
        
        
    });

    return list ;

}


  export   function blackKnight(r,c, board){
    let kingPos = findKingPosition(board, -1);
    const direction = checkPin(kingPos, [c, r], board, -1);

    if (direction ) {
        return []; 
    }

   
    

    let list =[];

    let checklist=[
        [r+2 , c-1] ,[r+2 , c+1],
        [r-2 , c-1] ,[r-2 , c+1],
        [r-1 , c-2] ,[r-1 , c+2],
        [r+1 , c-2] ,[r+1 , c+2]
    ] 

    checklist.forEach(e => {
  
        

        if (e[0] <8 && e[1]<8 && e[0]>-1  && e[1]>-1 ) {
         
            if( board[e[0]][e[1]]>=0  ){
               
                
            list.push([e[0],e[1]]);
        }
        }
        
        
    });

    return list ;

}


