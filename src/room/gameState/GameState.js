class GameState {
    constructor(whitePlayer, blackPlayer) {
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
    
      this.turn = "white";
      this.whitePlayer = whitePlayer;
      this.blackPlayer = blackPlayer;
      this.whitePlayerTime = 600;
      this.blackPlayerTime = 600;
      this.chatMap = new Map();
      this.moves = [];
      this.winner = null;
      this.result = null; 
      this.gameState = "ongoing";
    }
  
    makeMove(move) {
      if (this.gameState !== "ongoing") return;
      this.moves.push(move);
      this.turn = this.turn === "white" ? "black" : "white";
    }
  
    addMessage(player, message) {
      this.chatMap.set(player, message);
    }
  
    endGame(winner, result) {
      this.winner = winner;
      this.result = result;
      this.gameState = "completed";
    }
  }
  
  module.exports = GameState;
  