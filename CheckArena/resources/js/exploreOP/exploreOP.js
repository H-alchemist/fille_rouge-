 
//  console.log(moves);


let defaultPosition = [
    [-2, -3, -4, -5, -6, -4, -3, -2],
    [-1, -1, -1, -1, -1, -1, -1, -1],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [1, 1, 1, 1, 1, 1, 1, 1],
    [2, 3, 4, 5, 6, 4, 3, 2]
   ];
   


   let records = [

       {
           id: 0,
           board:defaultPosition,

       }
   ];


   let moveNum = 0



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

   document.addEventListener('DOMContentLoaded', function() {
      
       
       createRecord(moves);

       renderBoard(records[0].board);

       
})





function createRecord(liste) {



   
   
   liste.forEach((move, index) => {

       //  console.log(move);

        let newBoard = deepCopyBoard(records[index].board);



        
        

        newBoard[move.from_position[0]][move.from_position[2]] = 0;
       // console.log(move.piece_number);
       
       newBoard[move.to_position[0]][move.to_position[2]] = move.piece_number;
       // console.log(move.to_position[0] , move.to_position[2]);

       // console.log(newBoard);
         

       records.push({
           id: index+1 ,
           board:  newBoard,

       })

          return ; 


   
   });

   // console.log(records);
   
}

let playerColor = "black";


function renderBoard(board) {
   
   const boardElement = document.getElementById('chessboard');
   
   boardElement.innerHTML = '';
   
   // boardElement.innerHTML = playerColor=== "white" ? whiteBoard : blackBoard;


   
   for (let row = 7; row >= 0; row--) {
       for (let col = 7; col >= 0; col--) {
           const sq = document.createElement('div');
           sq.classList.add('pieceContainer');
           
           // Adjust grid positions
           const gridRow = playerColor === "white" ? row + 1 : 7 - row + 1;
           const gridCol = playerColor === "white" ? col + 1 : 7 - col + 1;
           sq.style.gridColumn = gridCol;
           sq.style.gridRow = gridRow;
          
          
           
           const pieceNum = board[row][col];
           if (pieceNum !== 0) {
               const piece = pieceMap[pieceNum]; 
               const img = document.createElement('img');
               img.src = piece;
              
               img.classList.add('piece');
               sq.appendChild(img);
           }
           
           boardElement.appendChild(sq);
       }
   }
   
   
  
}


function deepCopyBoard(board) {
   return JSON.parse(JSON.stringify(board));
}


document.getElementById('next-move').addEventListener('click' , ()=>{


if(moveNum >= records.length - 1) return;
   moveNum++;
   renderBoard(records[moveNum].board);

});


document.getElementById('prev-move').addEventListener('click' , ()=>{


   if(moveNum <= 0) return;

   moveNum--;
   renderBoard(records[moveNum].board);

});


// flip-board

document.getElementById('flip-board').addEventListener('click' , ()=>{

playerColor = playerColor === "white" ? "black" : "white";

renderBoard(records[moveNum].board);
  

});

document.querySelectorAll('[data-ply]').forEach(el => {
   el.addEventListener('click', () => {
       const ply = parseInt(el.getAttribute('data-ply'));
       renderBoard(records[ply].board );
   });
});
