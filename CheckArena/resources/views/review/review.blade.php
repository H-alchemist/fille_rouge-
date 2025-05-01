@extends('app')

@section('title', 'Game Review')

@push('styles')
<style>
    :root {
        --win: #4caf50;
        --loss: #f44336;
        --draw: #ff9800;
        --highlight: rgba(76, 169, 245, 0.5);
        --move-highlight: rgba(255, 255, 0, 0.3);
        --check-highlight: rgba(255, 0, 0, 0.3);
    }


</style>
@endpush

@section('content')


<div class="container mx-auto px-4 py-6">
    
    <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
        <h1 class="text-2xl text-blue-400">{{ $game->title ?? 'Blitz Game vs. KnightMoves' }}</h1>
        
        <div class="flex gap-4 text-gray-300 text-sm flex-wrap">
            <div class="flex items-center gap-1">
                <span class="opacity-80">🕒</span>
                <span>{{ $game->date ?? 'Mar 20, 2025, 14:32' }}</span>
            </div>
            <div class="flex items-center gap-1">
                <span class="opacity-80">⏱️</span>
                <span>{{ $game->time_control ?? '3+2 Blitz' }}</span>
            </div>
            <div class="flex items-center gap-1">
                <span class="opacity-80">🏆</span>
                <span>Rating: {{ $game->rating_change ?? '+8 (1842)' }}</span>
            </div>
        </div>
    </div>
    
    <!-- Game Content -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Left Panel -->
        <div class="lg:col-span-1">
            <!-- Player Info -->
            <div class="bg-gray-800 rounded-lg border border-gray-700 p-4 mb-6 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
                        <span class="font-bold">KM</span>
                    </div>
                    <div>
                        <div class="font-semibold">{{ $game->opponent->name ?? 'KnightMoves' }}</div>
                        <div class="text-gray-400 text-sm">{{ $game->opponent->rating ?? '1756' }}</div>
                    </div>
                </div>
                <div class="px-3 py-1 rounded bg-opacity-20 bg-red-900 text-red-500 font-semibold">
                    Loss
                </div>
            </div>
            
            <div class="bg-gray-800 rounded-lg border border-gray-700 p-4 mb-6 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
                        <span class="font-bold">GM</span>
                        
                    </div>
                    <div>
                        <div class="font-semibold">{{ $user->name ?? 'GrandMaster42' }}</div>
                        <div class="text-gray-400 text-sm">{{ $user->rating ?? '1842 (+8)' }}</div>
                    </div>
                </div>
                <div class="px-3 py-1 rounded bg-opacity-20 bg-green-900 text-green-500 font-semibold">
                    Win
                </div>
            </div>
            
            <!-- Game Chat -->
            <div class="bg-gray-800 rounded-lg border border-gray-700 h-96 flex flex-col">
                <div class="flex-1 p-4 overflow-y-auto flex flex-col gap-3">
                    <!-- Chat messages -->
                    {{-- {{var_dump($messages)}} --}}
                    @foreach($messages ?? [] as $message)
                    <div class="flex gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-600 flex-shrink-0 flex items-center justify-center">
                            <span class="text-xs font-bold">{{ $message->sender_name[0] ?? 'U' }}</span>
                        </div>
                        <div>
                            <div class="font-semibold text-sm">{{ $message->sender_name ?? 'Unknown' }}</div>
                            <div class="text-gray-400 text-sm">{{ $message->content ?? '...' }}</div>
                        </div>
                    </div>
                @endforeach
                
                    
                  
                </div>
                
               
            </div>
        </div>
        
        
        <div class="lg:col-span-2 flex flex-col items-center">
            <div id="chessboard" class="w-full bg-[url('https://images.chesscomfiles.com/chess-themes/boards/icy_sea/200.png')] max-w-md aspect-square mb-4 border-2 border-gray-700 shadow-lg bg-cover relative grid grid-cols-8 grid-rows-8">
                
            </div>
            
            <div class="flex justify-center gap-4">
                
                <button title="Previous move" id="prev-move"
                        class="w-10 h-10 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center hover:bg-gray-600 transition">
                    ⏪
                </button>
               
                <button title="Next move" id="next-move"
                        class="w-10 h-10 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center hover:bg-gray-600 transition">
                    ⏩
                </button>
              
                <button title="Flip board" id="flip-board"
                        class="w-10 h-10 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center hover:bg-gray-600 transition">
                    🔄
                </button>
            </div>
        </div>
        
        <!-- Right Panel -->
        <div class=" lg:col-span-1 min-[1220]:mr-60">
            <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
                <div class="bg-gray-700 p-4 flex justify-between items-center">
                    <div class="font-semibold">Game Moves</div>
                    <div class="flex">
                        <div class="px-3 py-1 rounded cursor-pointer hover:bg-gray-600 bg-opacity-20 bg-blue-900 text-blue-400">
                            Moves
                        </div>
                    </div>
                </div>
                
                <div class="p-2 max-h-96 overflow-y-auto">
                    <div class="flex flex-col gap-1 text-sm">
                        @php
                         function getPieceIcon($pieceNumber) {
                             $icons = [
                                 1 => '♙', 3 => '♘', 4 => '♗', 2 => '♖', 5 => '♕', 6 => '♔',
                                 -1 => '♟︎', -4 => '♞', -3 => '♝', -2 => '♜', -5 => '♛', -6 => '♚'
                             ];
                             return $icons[$pieceNumber] ?? '';
                         }
                     @endphp
                       @for($i = 0; $i < count($moves); $i += 2)
                       <div class="flex gap-1">
                           <div class="w-0 text-gray-400">{{ ($i / 2) + 1 }}.</div>
                   
                           @php
                               $whiteMove = $moves[$i] ?? null;
                               $blackMove = $moves[$i + 1] ?? null;
                           @endphp
                   
                           <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer"
                                data-ply="{{ $i }}">
                               {{ $whiteMove ? getPieceIcon($whiteMove->piece_number) . ' ' . $whiteMove->from_position . ' → ' . $whiteMove->to_position : '' }}
                           </div>
                   
                           <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer {{ $i == 4 ? 'bg-opacity-20 bg-blue-900 text-blue-400' : '' }}"
                                data-ply="{{ $i + 1 }}">
                               {{ $blackMove ? getPieceIcon($blackMove->piece_number) . ' ' . $blackMove->from_position . ' → ' . $blackMove->to_position : '' }}
                           </div>
                       </div>
                   @endfor

                        

                        @if(empty($moves))
                            <div class="flex gap-3">
                                <div class="w-8 text-gray-400">1.</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="0">e4</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="1">c5</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-8 text-gray-400">2.</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="2">Nf3</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="3">d6</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-8 text-gray-400">3.</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="4">d4</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer bg-opacity-20 bg-blue-900 text-blue-400" data-ply="5">cxd4</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-8 text-gray-400">4.</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="6">Nxd4</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="7">Nf6</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-8 text-gray-400">5.</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="8">Nc3</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="9">a6</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-8 text-gray-400">6.</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="10">Be3</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="11">e5</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-8 text-gray-400">7.</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="12">Nb3</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="13">Be7</div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-8 text-gray-400">8.</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="14">Be2</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="15">O-O</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    const moves = @json($partie->moves);
</script>

@vite('resources/js/review/review.js')



@endpush