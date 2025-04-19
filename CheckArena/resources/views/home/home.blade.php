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
    
@endsection
