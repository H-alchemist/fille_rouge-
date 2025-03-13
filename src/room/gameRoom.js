const { Room } = require("colyseus");
const GameState = require("./gameState");

class GameRoom extends Room {
  onCreate() {
    this.maxClients = 2;
    this.gameState = new GameState(client.sessionId, client.sessionId , );
   
  }

  onJoin(client) {
   
  }

  onMessage(client, message) {
    if (message.type === "move") {
      this.gameState.makeMove(message.move);
      this.broadcast("move", message);
    } else if (message.type === "chat") {
      this.gameState.addMessage(client.sessionId, message.text);
      this.broadcast("chat", { player: client.sessionId, text: message.text });
    }
  }

  onLeave(client) {
    console.log(`Player ${client.sessionId} left.`);
  }
}

module.exports = GameRoom;
