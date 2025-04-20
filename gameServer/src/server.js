import http from "http";
import express from "express";
import { Server } from "colyseus";
import { WebSocketTransport } from "@colyseus/ws-transport";

import  GameRoom  from "./room/gameRoom.js"; 

import  MatchmakingRoom  from "./room/matchMakingRoom.js"; 



const app = express();
const server = http.createServer(app);
const gameServer = new Server({
  transport: new WebSocketTransport({
    server,
  }),
});


gameServer.define("matchMaking_room", MatchmakingRoom);
gameServer.define("game_room", GameRoom);

server.listen(3001, () => {
  console.log("Colyseus server running on ws://localhost:3001");
});
