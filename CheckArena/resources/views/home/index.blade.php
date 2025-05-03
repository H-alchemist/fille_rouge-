@extends('app')

@section('title', 'Home')

@section('content')
<div class="flex flex-1">
  
  
  
  <aside class="w-72 bg-gray-800 border-r border-gray-700 p-5 flex flex-col">
    <div class="w-64 h-64 mb-5">
      <img src="storage/board.png" alt="Chess board in starting position" class="w-full h-full object-contain">
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
        {{-- <a href="#" class="px-6 py-3 rounded font-semibold bg-transparent text-white border border-blue-500 hover:bg-blue-500/10 text-lg">Join a Game</a> --}}
      </div>
    </section>

    
    <section class="bg-gray-800 rounded-lg p-6 mb-10">
      <div class="flex justify-between items-center mb-5">
        <h2 class="text-2xl text-blue-400">Openings</h2>
        {{-- <a href="#" class="px-4 py-2 rounded font-semibold border border-blue-500 text-white hover:bg-blue-500/10">Explore More</a> --}}
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
       
        @php
        function getPieceIcon($pieceNumber) {
            $icons = [
                1 => '♙', 3 => '♘', 4 => '♗', 2 => '♖', 5 => '♕', 6 => '♔',
                -1 => '♟︎', -4 => '♞', -3 => '♝', -2 => '♜', -5 => '♛', -6 => '♚'
            ];
            return $icons[$pieceNumber] ?? '';
        }

        
        @endphp
        @foreach ($openings as $opening)
  <a href="/explore/{{$opening->id}}" class="bg-gray-700 rounded-lg p-4 transition hover:shadow-md poiter">
    <h3 class="text-lg mb-2 font-bold text-white">{{ $opening->title }}</h3>
    <p class="text-sm text-gray-300 mb-2">{{ $opening->commentary }}</p>

    <!-- Display the first 5 moves -->
    <div class="text-xs text-blue-300 font-mono">
      @foreach ($opening->openingMoves as $move)
        <span>
          {{ getPieceIcon($move->piece_number) }} 
          {{ $move->from_position }} → {{ $move->to_position }}
        </span>
      @endforeach
    </div>
  </a>
@endforeach
      

      </div>
    </section>
    <section class="bg-gray-800 rounded-lg p-6 mb-10">
      <div class="flex justify-between items-center mb-5">
        <h2 class="text-2xl text-blue-400">Tactics</h2>
        {{-- <a href="#" class="px-4 py-2 rounded font-semibold border border-blue-500 text-white hover:bg-blue-500/10">Explore More</a> --}}
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @php
          $openings = [
            ['name' => 'The Vienna Gambit', 'desc' => 'An aggressive opening that sacrifices a pawn for rapid development and attacking chances.', 'moves' => '1. e4 e5 2. Nc3 Nf6 3. f4'],
            ['name' => 'The Elephant Gambit', 'desc' => 'A surprising counterattack that challenges White\'s center control from the very beginning.', 'moves' => '1. e4 e5 2. Nf3 d5'],
            ['name' => 'The Halloween Gambit', 'desc' => 'A tricky opening where White sacrifices a knight for a strong pawn center and attacking chances.', 'moves' => '1. e4 e5 2. Nf3 Nc6 3. Nc3 Nf6 4. Nxe5'],
            ['name' => 'The Stafford Gambit', 'desc' => 'A dangerous trap-filled gambit that can lead to quick victories with creative tactical play.', 'moves' => '1. e4 e5 2. Nf3 Nf6 3. Nxe5 Nc6']
          ];
        @endphp

        @foreach ($openings as $opening)
          <div class="bg-gray-700 rounded-lg p-4 transition hover:shadow-md">
            <h3 class="text-lg mb-2 font-bold text-white">{{ $opening['name'] }}</h3>
            <p class="text-sm text-gray-300 mb-2">{{ $opening['desc'] }}</p>
            <div class="text-xs text-blue-300 font-mono">{{ $opening['moves'] }}</div>
          </div>
        @endforeach
      </div>
    </section>

    <section class="bg-gray-800 rounded-lg p-6 mb-10">
      <div class="flex justify-between items-center mb-5">
        <h2 class="text-2xl text-blue-400">EndGames</h2>
        {{-- <a href="#" class="px-4 py-2 rounded font-semibold border border-blue-500 text-white hover:bg-blue-500/10">Explore More</a> --}}
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
       
    
    @foreach ($endgames as $endgame)
        <a href="/exploreEndGame/{{$endgame->id}}" class="bg-gray-700 rounded-lg p-4 transition hover:shadow-md">
            <h3 class="text-lg mb-2 font-bold text-white">{{ $endgame->title }}</h3>
            <p class="text-sm text-gray-300 mb-2">{{ $endgame->commentary }}</p>
            
            <div class="grid grid-cols-8 gap-1 text-white text-center text-xl">
                @php
                    $position = json_decode($endgame->starting_position, true);
                    $rowCount = 0;
                @endphp
    
                @foreach ($position as $row)
                    @php $rowCount++; @endphp
                    @if ($rowCount > 2)
                        @break
                    @endif
                    
                @endforeach
            </div>
          </a>
    @endforeach
    
      </div>
    </section>
  </main>
</div>
@endsection
