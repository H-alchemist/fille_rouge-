

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



  export   function calculatepieceMove(r,c,num,board) {





    switch (num) {
        case 1:
            return WhitePawn(r,c , board);
            
            break;
        case -1:
        
            return BlackPawn(r,c,board);
                
            break;
        case 2:
        
             
            return whiteRook(r,c,board);

                
        break;
        case -2:
                        

            return blackRook(r,c,board);
                
        break;
        
        case 2:
        
            return whiteRook(r,c,board);
                
        break;


        case 4:
            console.log(r +'test'+c,board);
            
        
            return whiteBishop(r,c,board);
                
        break;
        
        case -4:
        
            return blackBishop(r,c,board);
                
        break;

        case 5:
            console.log(r +'test'+c,board);
            
        
            return whiteQueen(r,c,board);
                
        break;
        
        case -5:
        
            return blackQueen(r,c,board);
                
        break;

        case 6:
            console.log(r +'test'+c,board);
            
        
            return whiteKing(r,c,board);
                
        break;
        
        case -6:
        
            return blackKing(r,c,board);
                
        break;


        case 3:
            console.log(r +'test'+c,board);
            
        
            return whiteKnight(r,c,board);
                
        break;
        
        case -3:
        
            return blackKnight(r,c,board);
                
        break;

        default:
            break;
    }



    
}





  export   function WhitePawn(r, c , board) {
    let list = [];

    if (r > 0 && board[r - 1][c] === 0) {
        list.push([r - 1, c]);

      
        if (r === 6 && board[r - 2][c] === 0) {
            list.push([r - 2, c]);
        
        }
    }

   
    if (r > 0 && c > 0 && board[r - 1][c - 1] < 0) {
             list.push([r - 1, c - 1]);
    }

   if (r > 0 && c < board[r].length - 1 && board[r - 1][c + 1] < 0) {
        list.push([r - 1, c + 1]);
    }

    return list;
}




  export   function BlackPawn(r, c, board) {
    let list = [];

    
    if (r < board.length - 1 && board[r + 1][c] === 0) {
        list.push([r + 1, c]);

   
        if (r === 1 && board[r + 2][c] === 0) {
            list.push([r + 2, c]);
        }
    }

   
    if (r < board.length - 1 && c > 0 && board[r + 1][c - 1] > 0) {
        list.push([r + 1, c - 1]);
    }

   
    if (r < board.length - 1 && c < board[r].length - 1 && board[r + 1][c + 1] > 0) {
        list.push([r + 1, c + 1]);
    }

    return list;
}

  export   function whiteRook(r, c, board) {

    

    let list = [];

   
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

    return list;
}

  export   function blackRook(r, c, board) {
    let list = [];

    
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

    return list;
}







  export   function blackBishop(r, c, board) {
    let list = [];

    
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

    return list;
}



  export   function whiteBishop(r, c, board) {
    let list = [];
  console.log(list);
  
  
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


    //////////////////

    

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

    return list;
}

  export   function blackQueen(r, c, board) {
    let list = [];
  
   
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

    return list;
}


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

export function whiteQueen(r, c, board , color) {
    let list = [];

    let kingPos =  findKingPosition(board  , 1);
    const direction = checkPin(kingPos, [c, r], board, 1);

    
    console.log('test' +direction);

    
    //  return;
    if (!direction) {
        // No pin, calculate all possible moves
        // Horizontal
        // Right
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
                console.log('empty' + [row, col]);
                
            } else if (board[row][col] < 0) {
                list.push([row, col]);
                console.log('enemy' + [row, col]);
                break;
            } else {
                break;
            }
            row++;
            col++;
        }

    } else {
        // If the piece is pinned, only calculate moves along the direction
        let [dx, dy] = direction;
        let x = r + dy;
        let y = c + dx;

        // Loop through the direction until the end of the board or an obstacle
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


