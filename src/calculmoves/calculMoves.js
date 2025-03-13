


  export   function calculatepieceMove(r,c,num){




    switch (num) {
        case 1:
            return WhitePawn(r,c);
            
            break;
        case -1:
        
            return BlackPawn(r,c);
                
            break;
        case 2:
        
            return whiteRook(r,c);
                
        break;
        case -2:
                        

            return blackRook(r,c);
                
        break;
        
        case 2:
        
            return whiteRook(r,c);
                
        break;


        case 4:
            console.log(r +'test'+c);
            
        
            return whiteBishop(r,c);
                
        break;
        
        case -4:
        
            return blackBishop(r,c);
                
        break;

        case 5:
            console.log(r +'test'+c);
            
        
            return whiteQueen(r,c);
                
        break;
        
        case -5:
        
            return blackQueen(r,c);
                
        break;

        case 6:
            console.log(r +'test'+c);
            
        
            return whiteKing(r,c);
                
        break;
        
        case -6:
        
            return blackKing(r,c);
                
        break;


        case 3:
            console.log(r +'test'+c);
            
        
            return whiteKnight(r,c);
                
        break;
        
        case -3:
        
            return blackKnight(r,c);
                
        break;

        default:
            break;
    }



    
}





  export   function WhitePawn(r, c) {
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




  export   function BlackPawn(r, c) {
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

  export   function whiteRook(r, c) {
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

  export   function blackRook(r, c) {
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







  export   function blackBishop(r, c) {
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



  export   function whiteBishop(r, c) {
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

  export   function blackQueen(r, c) {
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


  export   function whiteQueen(r, c) {
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


  export   function whiteKing(r, c) {
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







  export   function blackKing(r, c) {
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



  export   function whiteKnight(r,c){

   
    

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


  export   function blackKnight(r,c){

   
    

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


