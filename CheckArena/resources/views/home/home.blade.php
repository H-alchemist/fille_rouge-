@extends('app')

@section('title', 'Home')

@section('content')
<div class="flex flex-1">
  
  <aside class="w-72 bg-gray-800 border-r border-gray-700 p-5 flex flex-col">
    <div class="w-64 h-64 mb-5">
      <img src="board.png" alt="Chess board in starting position" class="w-full h-full object-contain">
    </div>

    
    <div class="flex flex-col gap-3 mb-5">
      <div class="text-lg font-bold text-blue-400 mb-3">Quick Play</div>
      <div class="flex flex-wrap gap-2 mb-4">
        <div class="px-3 py-2 bg-gray-700 rounded cursor-pointer hover:bg-blue-500 text-center flex-1 min-w-[70px]">Bullet</div>
        <div class="px-3 py-2 bg-blue-500 rounded cursor-pointer text-center flex-1 min-w-[70px]">Blitz</div>
        <div class="px-3 py-2 bg-gray-700 rounded cursor-pointer hover:bg-blue-500 text-center flex-1 min-w-[70px]">Rapid</div>
        <div class="px-3 py-2 bg-gray-700 rounded cursor-pointer hover:bg-blue-500 text-center flex-1 min-w-[70px]">Classical</div>
      </div>

      <div class="flex flex-wrap gap-2 mb-4">
        <div class="px-3 py-2 bg-gray-700 rounded cursor-pointer hover:bg-blue-500 text-center flex-1 min-w-[70px]">1+0</div>
        <div class="px-3 py-2 bg-blue-500 rounded cursor-pointer text-center flex-1 min-w-[70px]">3+2</div>
        <div class="px-3 py-2 bg-gray-700 rounded cursor-pointer hover:bg-blue-500 text-center flex-1 min-w-[70px]">5+3</div>
        <div class="px-3 py-2 bg-gray-700 rounded cursor-pointer hover:bg-blue-500 text-center flex-1 min-w-[70px]">10+5</div>
      </div>

      <button class="w-full py-3 bg-blue-500 text-white font-bold rounded hover:bg-green-600 mt-1">Start Game</button>
    </div>
    

    <div class="flex flex-col gap-3 mb-5">
      <div class="text-lg font-bold text-blue-400">Play Variants</div>
      <div class="flex flex-wrap gap-2 mb-4">
        <div class="px-3 py-2 bg-gray-700 rounded cursor-pointer hover:bg-blue-500 text-center flex-1 min-w-[70px]">Chess960</div>
        <div class="px-3 py-2 bg-gray-700 rounded cursor-pointer hover:bg-blue-500 text-center flex-1 min-w-[70px]">Crazyhouse</div>
        <div class="px-3 py-2 bg-gray-700 rounded cursor-pointer hover:bg-blue-500 text-center flex-1 min-w-[70px]">King of the Hill</div>
      </div>
      <div class="flex flex-wrap gap-2 mb-4">
        <div class="px-3 py-2 bg-gray-700 rounded cursor-pointer hover:bg-blue-500 text-center flex-1 min-w-[70px]">Three-check</div>
        <div class="px-3 py-2 bg-gray-700 rounded cursor-pointer hover:bg-blue-500 text-center flex-1 min-w-[70px]">Racing Kings</div>
        <div class="px-3 py-2 bg-gray-700 rounded cursor-pointer hover:bg-blue-500 text-center flex-1 min-w-[70px]">Horde</div>
      </div>
    </div>

    
    <div class="mt-auto p-4 bg-gray-700 rounded">
      <div class="flex justify-between mb-3">
        <span class="text-gray-400">Players Online:</span>
        <span class="font-bold text-blue-400">12,453</span>
      </div>
      <div class="flex justify-between mb-3">
        <span class="text-gray-400">Games in Progress:</span>
        <span class="font-bold text-blue-400">4,721</span>
      </div>
      <div class="flex justify-between">
        <span class="text-gray-400">Custom Games:</span>
        <span class="font-bold text-blue-400">289</span>
      </div>
    </div>
  </aside>

  
  <main class="flex-1 p-8">

    
    <section class="text-center py-10 px-8 mb-10 bg-gradient-to-b from-black/70 to-black/70 bg-cover rounded-lg" style="background-image: url('/api/placeholder/1000/300')">
      <h1 class="text-4xl mb-4">Create Your Perfect Chess Game</h1>
      <p class="text-xl mb-8 text-gray-400 max-w-3xl mx-auto">Set up custom games with unique rules, special positions, or classic variations. Play chess your way on CheckArena - no registration required.</p>
      <div class="flex justify-center gap-4">
        <a href="#" class="px-6 py-3 rounded font-semibold bg-blue-500 text-white hover:bg-green-600 text-lg">Create a Game</a>
        <a href="#" class="px-6 py-3 rounded font-semibold bg-transparent text-white border border-blue-500 hover:bg-blue-500/10 text-lg">Join a Game</a>
      </div>
    </section>

    
  
@endsection
