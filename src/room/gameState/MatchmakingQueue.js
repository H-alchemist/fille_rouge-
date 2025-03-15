import { matchMaker } from "colyseus";

export class MatchmakingQueue {
  constructor() {
    this.queue = [];

    this.checkTime = 2000; 

    this.rateDifference = 200; 
    this.WaitingTime = 30000; 
    

    this.intervalId = setInterval(this.findMatches.bind(this), this.tickRate);
  }
  addPlayer(player) {
    this.queue.push(player);
  }
}