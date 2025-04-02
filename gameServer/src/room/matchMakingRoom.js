import { Room } from "colyseus";
import { MatchmakingQueue } from "./gameState/MatchmakingQueue.js";

class MatchmakingRoom extends Room {
  onCreate() {
    // console.log("Matchmaking room created!");

    this.matchmakingQueue = new MatchmakingQueue();

    this.broadcast("matchmak", this.matchmakingQueue.queue);
  }

  onJoin(client, options) {
    // console.log(`Matchmaking room joined by client: ${client.id}`);

    this.matchmakingQueue.addToQueue(client, options);

    this.broadcast("matchmak", this.matchmakingQueue.queue);
  }

  onLeave(client) {
    // console.log(`Matchmaking room left by client: ${client.id}`);

    this.matchmakingQueue.removeFromQueue(client.id);
  }
}

export default MatchmakingRoom;
