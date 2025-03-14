// GameRoom.js
import { Room } from "colyseus";
import GameState from './gameState/GameState.js';
import { calculatepieceMove } from '../calculmoves/calculMoves.js'; 

class GameRoom extends Room {
  onCreate() {
    console.log("GameRoom created!");

    this.maxClients = 2;
    this.players = 0;

    
    this.state = GameState.createGameState();

    
    this.onMessage("selectPiece", (client, message) => {

      console.log("Received movePiece message:", message);
      


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