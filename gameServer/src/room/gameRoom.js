import { Room } from "colyseus";
import GameState from './gameState/GameState.js';

import * as check from '../calculmoves/check.js';


import {isPieceAligned , isClearBetween ,findThreatInDirection,checkPin} from '../calculmoves/helper.js';
import {calculatepieceMove,findKingPosition,WhitePawn,BlackPawn,whiteRook,blackRook,whiteBishop,blackBishop,whiteQueen,blackQueen,whiteKing,blackKing,whiteKnight,blackKnight} from '../calculmoves/calculMoves.js';


class GameRoom extends Room {
  onCreate(options) {
    
    
    this.turnTimer = null;
    this.timeRemaining = {
      white: options.timeControl?.initialTime || 600,
      black: options.timeControl?.initialTime || 600,
    };

    
   
    this.maxClients = 2;
    
    this.players = 0;

    let list =null;

    this.whitePlayer = null;
    this.blackPlayer = null;
    
    
    this.state = GameState.createGameState(
      null,
      null,
    
      options.timeControl
    );

   

    this.onMessage("selectPiece", (client, message) => {

      // console.log(`Received "selectPiece" from ${client.sessionId}:`, message);


      console.log("Received movePiece message:", message);

      list = calculatepieceMove(message.row,message.col, message.pieceN , this.state.board ,   this.state.castling ,this.state.isCheck  );

      // console.log(list);
      client.send("validMoves", {validMoves: list,selectedPiece: {row: message.row,col: message.col,pieceN: message.pieceN}});


    });

    this.onMessage("promote", (client, message) => {

        console.log(`Received "promote" from :`, message);
        

      GameState.updateMatrixPromote(this.state.board, [message.fromRow, message.fromCol], [message.toRow, message.toCol], message.promoteTo , this.state.gameMoves);
     
      let res =  check.processMove(this.state.board,message.promoteTo );

      console.log('from promo' , res , 'res');
       
      if (res.status==='check') {

        this.state.isCheck = res.checkPath;
        
       }else if (res.status==='checkmate') {

        console.log(res);
        

       
      }else{
        this.state.isCheck = null;
      }


      this.switchTurn(this.state);
      // console.log(this.state.turn);

      // console.log(this.state.board);
      
      this.broadcast("boardUpdate", this.state);
      

    });

    this.onMessage("handleMove", (client, message) => {


      console.log("promote: eeeeeeeeeeeeeeeeeeeee");
      const exists = list.find(item => item[0] === message.toRow && item[1] === message.toCol) !== undefined;

      if (exists==undefined) {
        client.send("invalidMove", {message: "Invalid move"});
        return;
        
      }

      let pieceC = this.state.board[message.fromRow][message.fromCol];
      let color = pieceC > 0 ? 'white' : 'black';

      GameState.updateMatrix(this.state.board, [message.fromRow, message.fromCol], [message.toRow, message.toCol] , this.state.gameMoves);
      // console.log(this.state.turn);
        this.state.turn === 'white' ? 'black' : 'white';
       let res =  check.processMove(this.state.board,pieceC );

      //  console.log(res);
       
       console.log('//::' , res , 'res');
       
       if (res.status==='check') {
 
         this.state.isCheck = res.checkPath;
         
        }else if (res.status==='checkmate') {
 
         console.log(res);
         
 
        
       }else{
         this.state.isCheck = null;
       }
       
       if (Math.abs(pieceC) == 6 ) {
           console.log(pieceC , 'pieceC' , color);
           
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
      
      this.broadcast("boardUpdate", this.state);
  
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
  
          this.broadcast("gameStart", this.state);
          this.startTurnTimer();
        }
      }
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
    console.log(this.state.gameMoves);
    
  }




  startTurnTimer() {
    this.clearTurnTimer();
    const currentPlayer = this.state.turn;

    this.turnTimer = this.clock.setInterval(() => {
      this.timeRemaining[currentPlayer]--;
      // console.log(currentPlayer + ' : time : ' + this.timeRemaining[currentPlayer]);
      

      if (this.timeRemaining[currentPlayer] <= 0) {
        this.handleTurnTimeout();
      } else {
        this.broadcast('updateTime', {
          player: currentPlayer,
          timeRemaining: this.timeRemaining[currentPlayer],
        });
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
    const currentPlayer = this.state.turn;
    // console.log(`${currentPlayer}'s turn has timed out.`);
    this.switchTurn();
  }


}

export default GameRoom;