import { Room } from "colyseus";
import GameState from './gameState/GameState.js';


import {calculatepieceMove,WhitePawn,BlackPawn,whiteRook,blackRook,whiteBishop,blackBishop,whiteQueen,blackQueen,whiteKing,blackKing,whiteKnight,blackKnight} from '../calculmoves/calculMoves.js';


class GameRoom extends Room {
  onCreate(options) {
    
   
    this.maxClients = 2;
    
    this.players = 0;

    let list =null;

    this.whitePlayer = null;
    this.blackPlayer = null;
    
    
    this.state = GameState.createGameState(
      null,
      null,
    
      options.timeControl
    );

   

    this.onMessage("selectPiece", (client, message) => {

      console.log(`Received "selectPiece" from ${client.sessionId}:`, message);


      // console.log("Received movePiece message:", message);

      list = calculatepieceMove(message.row,message.col, message.pieceN , this.state.board);

      // console.log(list);
      client.send("validMoves", {validMoves: list,selectedPiece: {row: message.row,col: message.col,pieceN: message.pieceN}});


    });

    this.onMessage("handleMove", (client, message) => {

      console.log("Received movePiece message:", message);
      const exists = list.find(item => item[0] === message.toRow && item[1] === message.toCol) !== undefined;

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

    onJoin(client, options) {
      console.log(options);
      
      if (this.players < 2) {
        this.players++;
        
  
        if (this.players === 1) {
          this.state.whitePlayer = client.sessionId;
          console.log(this.state.whitePlayer);
          this.state.whitePlayerData = { ...options };
          // this.state.whitePlayerData = {

          //   name: options.name,
          //   rating: options.rating,
          //   accountId: options.accountId,
          // };
          client.send("playerColor", "white");
        } else if (this.players === 2) {
          console.log(this.state.whitePlayer);

          this.state.blackPlayer = client.sessionId;
          this.state.blackPlayerData = { ...options };
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