import { Room } from "colyseus";
import GameState from './gameState/GameState.js';


import {calculatepieceMove,WhitePawn,BlackPawn,whiteRook,blackRook,whiteBishop,blackBishop,whiteQueen,blackQueen,whiteKing,blackKing,whiteKnight,blackKnight} from '../calculmoves/calculMoves.js';


class GameRoom extends Room {
  onCreate(options) {
    
    if (!options.whitePlayerId || !options.blackPlayerId) {
      throw new Error("Missing player IDs in room creation");
    }

    this.maxClients = 2;
    
    
    this.whitePlayerId = options.whitePlayerId;
    this.blackPlayerId = options.blackPlayerId;
    
    
    this.state = GameState.createGameState(
      options.whitePlayerData,
      options.blackPlayerData,
      options.timeControl
    );

    console.log(`Room created for:
      White: ${this.state.whitePlayerData.name} (${this.whitePlayerId})
      Black: ${this.state.blackPlayerData.name} (${this.blackPlayerId})`);



    this.onMessage("selectPiece", (client, message) => {

      // console.log("Received movePiece message:", message);

      list = calculatepieceMove(message.row,message.col, message.pieceN , this.state.board);

      // console.log(list);
      client.send("validMoves", {validMoves: list,selectedPiece: {row: message.row,col: message.col,pieceN: message.pieceN}});


    });

    this.onMessage("handleMove", (client, message) => {

      // console.log("Received movePiece message:", message);
      const exists = list.find(item => item[0] === target[0] && item[1] === target[1]) !== undefined;

      if (exists==undefined) {
        client.send("invalidMove", {message: "Invalid move"});
        return;
        
      }

      GameState.updateMatrix(this.state.board, [message.fromRow, message.fromCol], [message.toRow, message.toCol]);
      console.log(this.state.turn);
      
      GameState.switchTurn(this.state);
      console.log(this.state.turn);

      // console.log(this.state.board);
      
      this.broadcast("boardUpdate", this.state);
  
    });


    }

  onJoin(client) {
    if (this.players < 2) {
      this.players++;

      if (this.players === 1) {
        
        this.state.whitePlayer = client.sessionId;
        client.send("playerColor", "white");
      } else if (this.players === 2) {

        this.state.blackPlayer = client.sessionId;
        client.send("playerColor", "black");

        
        this.broadcast("gameStart", this.state);
      }
    }
  }

  onLeave(client) {
    console.log(`Player ${client.sessionId} left.`);

    if (this.state) {
      if (client.sessionId === this.state.whitePlayer) {
        this.broadcast("playerLeft", { color: "white" });
      } else if (client.sessionId === this.state.blackPlayer) {
        this.broadcast("playerLeft", { color: "black" });
      }
    }
  }
}

export default GameRoom;