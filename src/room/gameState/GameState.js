class GameState {
    constructor(whitePlayer, blackPlayer, time) {
      this.board = [
        [-2,-3,-4,-5,-6,-4,-3,-2],
        [-1,-1,-1,-1,-1,-1,-1,-1],
        [0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0],
        [1, 1, 1, 1, 1, 1, 1, 1],
        [2, 3, 4, 5, 6, 4, 3, 2]
      ];

      this.start = [null, null, null]; 
      this.end = [null, null, null];

    }
  
    updateMatrix(x,y) {
        board[x[0]][x[1]]=x[2];
        board[y[0]][y[1]]=y[2];
    }


    setStart(x,y,piece) {
        this.start[0]=x;
        this.start[1]=y;
        this.start[2]=piece;
    }
    setEnd(x,y,piece) {
        this.start[0]=x;
        this.start[1]=y;
        this.start[2]=piece;
    }

  
  
  
  }
  
  module.exports = GameState;
  