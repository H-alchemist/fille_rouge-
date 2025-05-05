# ♟️ CheckArena

CheckArena is an online multiplayer chess platform built for real-time play, game tracking, and a smooth chess experience. It uses modern technologies like **Colyseus.js**, **Express.js**, **Laravel**, **Blade**, and **Vanilla JavaScript** to deliver a dynamic and responsive application.

---

## 📌 Project Overview

CheckArena allows players to:

- Play real-time chess online with others
- Get live updates of the game state
- Chat in-game
- Track win/loss/draw results
- Enforce chess rules like check, checkmate, stalemate, and pins
---

## 🧰 Tech Stack

### 🧠 Backend

#### 🔵 Laravel (PHP)
- RESTful API (authentication, users, match history)
- Eloquent ORM for database access
- Sanctum for token-based API authentication
- Blade for rendering static/admin views

#### ⚡ Express.js (Node.js)
- Lightweight Node server for WebSocket handling
- Hosts Colyseus game rooms

---

### 🎮 Game Engine

#### 🎲 Colyseus.js
- Multiplayer game framework (WebSockets)
- Manages game rooms, player sessions, state sync
- Broadcasts moves, timers, chat, and end game status
