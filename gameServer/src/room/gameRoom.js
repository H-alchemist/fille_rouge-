import { Room } from "colyseus";
import GameState from './gameState/GameState.js';

import { sendToLaravel } from "../../utils/sendToLaravel.js";

import * as check from '../calculmoves/check.js';


import {isPieceAligned , isClearBetween ,findThreatInDirection,checkPin} from '../calculmoves/helper.js';
import {calculatepieceMove,findKingPosition,WhitePawn,BlackPawn,whiteRook,blackRook,whiteBishop,blackBishop,whiteQueen,blackQueen,whiteKing,blackKing,whiteKnight,blackKnight} from '../calculmoves/calculMoves.js';


class GameRoom extends Room {
  onCreate(options) {
    
    
    this.turnTimer = null;
    // this.timeRemaining= {
    //   white: options.timeControl * 60 ,
    //   black: options.timeControl * 60 ,
    // };

    
   
    this.maxClients = 2;
    
    this.players = 0;

    let list =null;

    this.chat=[];

    this.gameState = {

      state : null ,

      winner  :null ,

      loser : null 


    } ;

    this.whitePlayer = null;
    this.blackPlayer = null;
    
    
    this.state = GameState.createGameState(
      null,
      null,
    
      options.timeControl
    );

   

    this.onMessage("selectPiece", (client, message) => {

      // console.log(`Received "selectPiece" from ${client.sessionId}:`, message);

     
      //  console.log(this.gameState.state , 'from gameRoom');
      
   
    if (this.gameState.state !=null){


         
      client.send("null", {message: this.gameState.winner});

      return;

      
    }
      // console.log("Received movePiece message:", message);

      list = calculatepieceMove(message.row,message.col, message.pieceN , this.state.board ,   this.state.castling ,this.state.isCheck  );

      // console.log(list);
      client.send("validMoves", {validMoves: list,selectedPiece: {row: message.row,col: message.col,pieceN: message.pieceN}});


    });

    this.onMessage("promote", (client, message) => {

        // console.log(`Received "promote" from :`, message);
        

      GameState.updateMatrixPromote(this.state.board, [message.fromRow, message.fromCol], [message.toRow, message.toCol], message.promoteTo , this.state.gameMoves);
     
      let res =  check.processMove(this.state.board,message.promoteTo );

      // console.log('from promo' , res , 'res');
       
      if (res.status==='check') {

        this.state.isCheck = res.checkPath;
        this.broadcast("check", color);

        
       }else if (res.status==='checkmate') {

        // console.log(res);
        // console.log('checkmate');
        

        this.gameState.state = 'checkmate';


        this.gameState.winner = this.state.turn === 'white' ? 'black' : 'white';

        this.endGame('checkmate');
        

       
      }else{
        this.state.isCheck = null;
      }


      this.switchTurn(this.state);
      
      
      this.broadcast("boardUpdate", this.state);
      

    });
    this.onMessage('chat' , (client, message) => {
    //  console.log(message.name , 'message.name');
 
      this.chat.push({
        sender: message.name,
        message: message.message,
      });
      this.broadcast("chat", {sender: message.name, message: message.message});

    })
    this.onMessage('resign' , (client, message) => {

      console.log(message , 'message.nameRR');
      


      if (message === 'white') {
        this.gameState.loser = 'white';
        this.gameState.winner = 'black';
      } else {
        this.gameState.loser = 'black';
        this.gameState.winner = 'white';
      }

      this.gameState.state = 'resign';

      this.state.turn = message;
      console.log( 'turn ' , this.state.turn );
      

      this.endGame('resign');
      this.clearTurnTimer();

      

     
     })

     this.onMessage('offerDraw' , (client, message) => {
     
     })





    this.onMessage("handleMove", (client, message) => {

      const exists = list.find(item => item[0] === message.toRow && item[1] === message.toCol) !== undefined;

      if (exists==undefined) {
        client.send("invalidMove", {message: "Invalid move"});
        return;
        
      }

      let pieceC = this.state.board[message.fromRow][message.fromCol];
      let color = pieceC > 0 ? 'white' : 'black';
      let castlingK = true ;

      if (this.state.castling[color].kingSide == false && this.state.castling[color].queenSide == false ){
        castlingK = false ;
      }

      GameState.updateMatrix(this.state.board, [message.fromRow, message.fromCol], [message.toRow, message.toCol] , this.state.gameMoves , castlingK);
      // console.log(this.state.turn);



        this.state.turn === 'white' ? 'black' : 'white';
       let res =  check.processMove(this.state.board,pieceC );

     

       
       if (Math.abs(pieceC) == 6 ) {
          //  console.log(pieceC , 'pieceC' , color);
           
         this.state.castling[color].kingSide = false;
         this.state.castling[color].queenSide = false;
         
       } else if (Math.abs(pieceC)==2) {
         if (message.fromCol == 7) {
           this.state.castling[color].kingSide = false;
           
         }else if(message.fromCol == 0) {
           this.state.castling[color].queenSide = false;
 
         }
         
       }


      this.switchTurn(this.state);
      // console.log(this.state.turn);

      // console.log(this.state.board);
      // console.log(this.state.timeRemaining);

      this.broadcast("newMove", {from :[message.fromRow, message.fromCol], to :[message.toRow, message.toCol] , p: pieceC , color: color});
      
      
      this.broadcast("boardUpdate", this.state);
      if (res.status==='check') {
      this.broadcast("check", pieceC);
      }
      if (res.status==='check') {
 
         this.state.isCheck = res.checkPath;
         
        //  this.broadcast("check", pieceC);

        }else if (res.status==='checkmate') {
 
        //  console.log(res);
        // console.log('checkmate');

        

        this.gameState.state = 'checkmate';


  
        this.endGame('checkmate');
        this.clearTurnTimer();
        // this.broadcast("checkmateWinner", this.state.turn);

        this.gameState.winner= this.state.turn === 'white' ? 'black' : 'white';
        this.gameState.loser = this.state.turn ;
        this.gameState.state= 'checkmate';


        //  this.disconnect();
         
 
        
       }else if (res.status==='stalemate') {
        console.log('stalmate from st');
       
        this.gameState.state= 'stalemate';


        
        this.endGame('stalemate');
        this.clearTurnTimer();

        
        
     

       }
       
       else{
         this.state.isCheck = null;
       }
  
    });


    }
    switchTurn(gameState) {
      this.clearTurnTimer();
      this.state.turn = this.state.turn === 'white' ? 'black' : 'white';
      this.startTurnTimer();
      // console.log("Turn switched to:", gameState.turn);
      return gameState;
    }

   

    onJoin(client, options) {
      // console.log(options);
      
      if (this.players < 2) {
        this.players++;
        
  
        if (this.players === 1) {
          this.state.whitePlayer = client.sessionId;
          // console.log(this.state.whitePlayer);
          this.state.whitePlayerData = { ...options };
          // this.state.whitePlayerData = {

          //   name: options.name,
          //   rating: options.rating,
          //   accountId: options.accountId,
          // };
          client.send("playerColor", "white");
        } else if (this.players === 2) {
          // console.log(this.state.whitePlayer);

          this.state.blackPlayer = client.sessionId;
          this.state.blackPlayerData = { ...options };
          client.send("playerColor", "black");

          // console.log(this.state.blackPlayerData);
          
  
          this.broadcast("gameStart", this.state);
          this.startTurnTimer();
        }
      }
  }

  async endGame(result) {

    // console.log("Game ended with result:" , result);
    await sendToLaravel({ name: "Hamza", score: 42 });

    const currentPlayer = this.state.turn;
    console.log("currentPlayer", currentPlayer);
    
    this.clearTurnTimer();
    // console.log(`${currentPlayer}'s turn has timed out.`);
   this.broadcast("gameOver", { winner: currentPlayer === 'white' ? 'black' : 'white'  , cause : result});

    
    
   setTimeout(() => {
    this.disconnect();
  }, 3000);
}


  onLeave(client) {
    // console.log(`Player ${client.sessionId} left.`);

    if (this.state) {
      if (client.sessionId === this.state.whitePlayer) {
        this.broadcast("playerLeft", { color: "white" });
      } else if (client.sessionId === this.state.blackPlayer) {
        this.broadcast("playerLeft", { color: "black" });
      }
    }
  }

  onDispose() {
    this.broadcast("onDispose");
    
  }




  startTurnTimer() {
    this.clearTurnTimer();
    const currentPlayer = this.state.turn;

    this.turnTimer = this.clock.setInterval(() => {
      // console.log(this.timeRemaining[currentPlayer]);
      // console.log(this.state);
      
      
      this.state.timeRemaining[currentPlayer]--;

      // console.log(currentPlayer + ' : time : ' + this.timeRemaining[currentPlayer]);
      

      if (this.state.timeRemaining[currentPlayer] <= 0) {
        this.handleTurnTimeout();
      } else {
        // this.broadcast('updateTime', {
        //   player: currentPlayer,
        //   timeRemaining: this.timeRemaining[currentPlayer],
        // });
      }
    }, 1000);
  }
  clearTurnTimer() {
    if (this.turnTimer) {
      this.turnTimer.clear();
      this.turnTimer = null;
    }
  }

  handleTurnTimeout() {

    // this.disconnect();
    this.endGame( 'timeout');
    // const currentPlayer = this.state.turn;
    // this.clearTurnTimer();
    // console.log(`${currentPlayer}'s turn has timed out.`);
    //  this.broadcast("gameOver", { winner: currentPlayer === 'white' ? 'black' : 'white' });
  }


}

export default GameRoom;