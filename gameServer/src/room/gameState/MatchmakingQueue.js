// matchmaking.js
import { matchMaker } from "colyseus";

export class MatchmakingQueue {
  constructor() {
    this.queue = [];
    this.everyTime = 4000;
    this.maxRatingDifference = 200;
    this.ratingIncrease = 60; 
    this.maxWaitTime = 15000;
    // this.intervalId = setInterval(() =>{

    //   console.log("Matchmaking loop running...");
      
    //   this.findMatches.bind(this)
    // }, this.everyTime);
  }

  async addToQueue(client, options) {
    const {  name, rating, timeControl , accounId} = options;
    
    const obj = {client,
      accounId,name,rating: rating || 1200,
      timeControl: timeControl || "rapid", joinedAt: Date.now(),maxRatingDifference: this.maxRatingDifference,searching: true
    };
    
    this.queue.push(obj);
    console.log(`Player ${name} (${rating}) added to ${timeControl} queue`);
    
    client.send("added", { 
      status: "added to the queue", 
      position: this.queue.length,
      timeControl
    });
    
    this.findMatches();
  }
  
  removeFromQueue(sessionId) {
    const index = this.queue.findIndex(entry => entry.sessionId === sessionId);
    if (index !== -1) {
      const entry = this.queue[index];
      console.log(`Player ${entry.name} removed from ${entry.timeControl} queue`);
      this.queue.splice(index, 1);
      
      // Update queue positions for remaining players
      this.updateQueuePositions();
      return true;
    }
    return false;
  }


  findMatches() {
    if (this.queue.length < 2) return;
    
    this.queue.sort((a, b) => a.joinedAt - b.joinedAt);
    
    for (let i = 0; i < this.queue.length; i++) {
      const entry = this.queue[i];
      
      if (!entry.searching) continue;

      /////// time cheking for (time , rating )
         
      const waitTime = Date.now() - entry.joinedAt;
      console.log("Wait time:", waitTime);
      
      const waitFactor = Math.floor(waitTime / this.everyTime);
      const currentDifference = this.maxRatingDifference + (waitFactor * this.ratingIncrease);
      
      for (let j = 0; j < this.queue.length; j++) {
        if (i === j || !this.queue[j].searching) continue;
        
        const checkmatching = this.queue[j];
        
        
        
        if (entry.timeControl !== checkmatching.timeControl) continue;
        
        const ratingDiff = Math.abs(entry.rating - checkmatching.rating);
        // console.log(  this.maxRatingDifference +'Two player'+ waitFactor);
        if (ratingDiff <= currentDifference || waitTime >= this.maxWaitTime) {
         
          console.log('test' + entry.name + checkmatching.name);
          this.createMatch(entry, checkmatching);
          break; 
        }
      }
    }
    
    this.queue = this.queue.filter(entry => entry.searching);
  }
  

  async createMatch(player1, player2) {
    console.log(`Matching ${player1.name} ,,,,, ${player2.name}`);
    
    player1.searching = false;
    player2.searching = false;
    console.log(player1.accounId);
    console.log(player2.accounId);
    console.log(player1.client);
    console.log(player2.client);
    

    const room = await matchMaker.createRoom("game_room", {


          timeControl: player1.timeControl,
         
        
        });
    
    console.log(`Match created: ${room.roomId}`);



    
    

    player1.client.send("matchmakingFound", {
      roomId: room.roomId,
      // reservation: reservedSeat1,
      opponent: {
        name: player2.name,
        rating: player2.rating
      }
    });
    

    player2.client.send("matchmakingFound", {
      roomId: room.roomId,
      // reservation: reservedSeat2,
      opponent: {
        name: player1.name,
        rating: player1.rating
      }
    });
    
    
    
  }
  


 
}
