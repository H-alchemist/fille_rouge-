import { Room } from "colyseus";
import { MatchmakingQueue } from "./matchmaking.js";

export class MatchmakingRoom extends Room {
  onCreate() {
    console.log("Matchmaking room created!");
    
    // Use simple serializer
    this.setSimpleSerializer();
    
    
    this.matchmaking = new MatchmakingQueue();
    
    this.onMessage("joinQueue", (client, options) => {


      if (!options || !options.timeControl) {
     client.send("matchmaking:error", { message: "Missing required parameters" });
    return;

  }
      

    }
)

}
}