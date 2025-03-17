import { Room } from "colyseus";
import MatchmakingQueue from "./gameState/MatchmakingQueue.js";

 class MatchmakingRoom extends Room {
  onCreate() {
    console.log("Matchmaking room created!");
    

    // this.testRR = 'nothing';
    
    
    this.state =  MatchmakingQueue.createMatchMakingQueue();
    
    
    this.broadcast("matchmak", this.state.queue );
      

    }
  




  onJoin(client) {
    console.log("Matchmaking room joined by client:", client.id);
    this.broadcast("matchmak", this.state.queue );
    // this.broadcast("matchmaking:join", client.id);
  }

}



export default MatchmakingRoom;