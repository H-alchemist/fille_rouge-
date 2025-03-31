


const MatchmakingQueue = {
  createMatchMakingQueue() {
    let queue = [];
    const checkTime = 2000;
    const rateDifference = 200;
    const waitingTime = 30000;

    // this.intervalId = setInterval(() => {
    //   this.findMatches();
    // }, checkTime);
    
    return {
      queue,
      checkTime,
      rateDifference,
      waitingTime,
      // intervalId: this.intervalId


    };
  }
  ,

  addPlayer(state,player , playerData) {

    const {  name, rating, timeControl } = playerData;


    const obj = {
      player,
      id: player.sessionId,
      name,
      rating: rating || 1200,
      timeControl: timeControl || "rapid", 
      joinedAt: Date.now(),
      rateDifference: state.rateDifference,
      searching: true
    };


    state.queue.push(obj);
  } ,
  removePlayer(state, sessionId) {
    const index = state.queue.findIndex(entry => entry.id === sessionId);
  
    if (index !== -1) {
      const entry = state.queue[index];
      
      state.queue.splice(index, 1); // Remove the player from the queue
      
      console.log(`Player with sessionId ${sessionId} removed from the queue.`);
      
  
      return true; 
    } else {
      console.log(`No player found with sessionId ${sessionId}`);
      return false; 
    }
  }
  
};
export default MatchmakingQueue ;
