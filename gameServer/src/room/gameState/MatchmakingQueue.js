
import { matchMaker } from "colyseus";

export class MatchmakingQueue {
  constructor() {
    this.queue = [];
    this.count = 0;
    this.everyTime = 4000;
    this.maxRatingDifference = 50;
    this.ratingIncrease = 10; 
    this.maxWaitTime = 15000;
    this.intervalId = setInterval(() =>{

      // console.log("Matchmaking loop running..." + this.count++);
      this.findMatches();
    }, this.everyTime);
  }

  async addToQueue(client, options) {
    const {  name, rating, timeControl , accounId} = options;

    const alreadyInQueue = this.queue.some(entry => entry.accounId === accounId);

    if (alreadyInQueue) {
      client.send("already_in_queue", {
        status: "Player is already in the queue",
        timeControl
      });
      return;
    }
    
    const obj = {client,
      accounId,name,rating: rating || 1200,
      timeControl: timeControl || "rapid", joinedAt: Date.now(),maxRatingDifference: this.maxRatingDifference,searching: true
    };
    
    this.queue.push(obj);
    // console.log(`Player ${name} (${rating}) added to ${timeControl} queue`);
    
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
      // console.log(`Player ${entry.name} removed from ${entry.timeControl} queue`);
      this.queue.splice(index, 1);
      
      this.updateQueuePositions();
      return true;
    }
    return false;
  }


  findMatches() {
    // if (this.queue.length < 2) return;
    // console.log('none' + this.count++);
    
    
    this.queue.sort((a, b) => a.joinedAt - b.joinedAt);
    
    for (let i = 0; i < this.queue.length; i++) {

      // console.log("<<<<<<<<<<<<<<",i);
      const entry = this.queue[i];
      
      if (!entry.searching) continue;

      /////// time cheking for (time , rating )
         
      const waitTime = Date.now() - entry.joinedAt;
      if(waitTime > this.maxWaitTime) {
        entry.searching = false;
        entry.client.send("removed", { status: "removed from the queue" });
        continue;
      }
      // console.log("Wait time:", waitTime);
      
      const waitFactor = Math.floor(waitTime / this.everyTime);
      // console.log("Wait factor:", waitFactor);
      
      const currentDifference = this.maxRatingDifference + (waitFactor * this.ratingIncrease);
      // console.log("Current difference:", currentDifference);
      
      for (let j = 0; j < this.queue.length; j++) {
        if (i === j || !this.queue[j].searching) continue;
        
        const checkmatching = this.queue[j];
        
        
        
        if (entry.timeControl !== checkmatching.timeControl) continue;
        
        const ratingDiff = Math.abs(entry.rating - checkmatching.rating);
        // console.log("Rating difference:", ratingDiff);



        // console.log(  this.maxRatingDifference +'Two player'+ waitFactor);
        if (ratingDiff <= currentDifference || waitTime >= this.maxWaitTime) {
         
          //  console.log('createhere' + entry.name + checkmatching.name);
          this.createMatch(entry, checkmatching);
          break; 
        }
      }
    }
    
    this.queue = this.queue.filter(entry => entry.searching);
  }
  

  async createMatch(player1, player2) {
    // console.log(`Matching ${player1.name} ,,,,, ${player2.name}`);
    
    player1.searching = false;
    player2.searching = false;
    // console.log(player1.accounId);
    // console.log(player2.accounId);
    // console.log(player1.rating);
    // console.log(player2.rating);
    

    const room = await matchMaker.createRoom("game_room", {


          timeControl: player1.timeControl,
         
        
        });
    
    // console.log(`Match created: ${room.roomId}`);



    
    

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
