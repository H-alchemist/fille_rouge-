// matchmaking.js
import { matchMaker } from "colyseus";

export class MatchmakingQueue {
  constructor() {
    this.queue = [];
    this.everyTime = 2000;
    this.maxRatingDifference = 200;
    this.ratingIncrease = 60; 
    this.maxWaitTime = 15000;
    this.intervalId = setInterval(() =>{

      console.log("Matchmaking loop running...");
      
      this.findMatches.bind(this)
    }, this.everyTime);
  }

  async addToQueue(client, options) {
    const { sessionId, name, rating, timeControl , accountId} = options;
    
    const obj = {client,sessionId,
      accountId,name,rating: rating || 1200,
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
  



  findMatches() {
    if (this.queue.length < 2) return;
    
    this.queue.sort((a, b) => a.joinedAt - b.joinedAt);
    
    for (let i = 0; i < this.queue.length; i++) {
      const entry = this.queue[i];
      
      if (!entry.searching) continue;

      /////// time cheking for (time , rating )
         
      const waitTime = Date.now() - entry.joinedAt;
      const waitFactor = Math.floor(waitTime / this.tickRate);
      const currentMaxDifference = this.maxRatingDifference + (waitFactor * this.ratingIncrease);
      
      for (let j = 0; j < this.queue.length; j++) {
        if (i === j || !this.queue[j].searching) continue;
        
        const checkmatching = this.queue[j];
        console.log('test' + entry.name + checkmatching.name);
        
        
        if (entry.timeControl !== checkmatching.timeControl) continue;
        
        const ratingDiff = Math.abs(entry.rating - checkmatching.rating);
        
        if (ratingDiff <= currentMaxDifference || waitTime >= this.maxWaitTime) {
       
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
    
    
  }
  


 
}
