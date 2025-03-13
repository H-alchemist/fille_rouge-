const http = require("http");
const express = require("express");
const { Server } = require("colyseus");
const { WebSocketTransport } = require("@colyseus/ws-transport");
const { MyRoom } = require("./room/gameRoom");

const app = express();
const server = http.createServer(app);
const gameServer = new Server({
  transport: new WebSocketTransport({
    server,
  }),
});

gameServer.define("my_room", MyRoom);

server.listen(3000, () => {
  console.log("Colyseus server running on ws://localhost:9876");
});
