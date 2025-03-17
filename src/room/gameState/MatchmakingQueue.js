


const MatchmakingQueue = {
  createMatchMakingQueue() {
    let queue = [];
    const checkTime = 2000;
    const rateDifference = 200;
    const waitingTime = 30000;

    // this.intervalId = setInterval(this.findMatches.bind(this), checkTime);
    
   
    
    return {
      queue,
      checkTime,
      rateDifference,
      waitingTime,
      // intervalId: this.intervalId

    };
  }
};
export default MatchmakingQueue ;
