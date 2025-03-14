// gameState.js
const GameState = {
  createGameState(whitePlayer = null, blackPlayer = null) {
    return {
      board: initializeBoard(),
      turn: "white",
      whitePlayer,
      blackPlayer,
    };
  },

  updateMatrix(gameState, from, to) {
    const [fromRow, fromCol] = from;
    const [toRow, toCol] = to;

    // Move the piece
    gameState.board[toRow][toCol] = gameState.board[fromRow][fromCol];
    gameState.board[fromRow][fromCol] = 0;

    return gameState;
  },

  switchTurn(gameState) {
    gameState.turn = gameState.turn === "white" ? "black" : "white";
    return gameState;
  }
};

function initializeBoard() {
  const board = [
    [-2, -3, -4, -5, -6, -4, -3, -2],
    [-1, -1, -1, -1, -1, -1, -1, -1],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0],
    [1, 1, 1, 1, 1, 1, 1, 1],
    [2, 3, 4, 5, 6, 4, 3, 2]
  ];

  return board;
}

export default GameState;