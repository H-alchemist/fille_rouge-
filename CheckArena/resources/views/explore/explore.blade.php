@extends('app')

@section('title', 'Explore Opening')

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
    

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Left Column - Move Comments -->
        <div class="lg:col-span-1">
            <div class="bg-gray-800 rounded-lg border border-gray-700 h-[700px] flex flex-col">
                <div class="p-4 border-b border-gray-700 text-blue-400 font-semibold">
                    Move Comments
                </div>
                <h1 class="m-auto text-2xl text-blue-400">{{$openingName}}</h1>
                <div class="flex-1 p-4 overflow-y-auto flex flex-col gap-3">
                    @foreach($comments as $ply => $comment) 
                        <div class="bg-gray-700 p-3 rounded text-sm">
                            <div class="text-gray-400 mb-1">Move {{ $ply + 1 }}:</div>
                            <div class="text-white">{{ $comment }}</div>
                        </div> 
                    @endforeach 

                    @if(empty($comments))
                        <div class="text-gray-500 text-sm">No comments yet. Start adding insights!</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Middle Column - Chessboard -->
        <div class="lg:col-span-2 flex flex-col items-center">
            <div id="chessboard" class="w-full bg-[url('https://images.chesscomfiles.com/chess-themes/boards/icy_sea/200.png')] max-w-md aspect-square mb-4 border-2 border-gray-700 shadow-lg bg-cover relative grid grid-cols-8 grid-rows-8">
            </div>

            <div class="flex justify-center gap-4 mb-4">
                <button title="Previous move" id="prev-move" class="w-10 h-10 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center hover:bg-gray-600 transition">⏪</button>
                <button title="Next move" id="next-move" class="w-10 h-10 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center hover:bg-gray-600 transition">⏩</button>
                <button title="Flip board" id="flip-board" class="w-10 h-10 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center hover:bg-gray-600 transition">🔄</button>
            </div>

            <!-- Commentary Section -->
            <div class="w-full bg-gray-800 border border-gray-700 rounded-lg p-4 text-white text-sm">
                <div class="font-semibold text-blue-400 mb-2">Commentary</div>
                <div id="commentary-box" class="min-h-[80px] text-gray-300">
                    {{$opening->commentary}}
                </div>
            </div>
        </div>

     
<div class="lg:col-span-1">
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
        <div class="bg-gray-700 p-4 font-semibold">Move List</div>
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
                             data-ply="{{ $i+1 }}">
                            {{ $whiteMove ? getPieceIcon($whiteMove->piece_number) . ' ' . $whiteMove->from_position . ' → ' . $whiteMove->to_position : '' }}
                        </div>

                        <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer"
                             data-ply="{{ $i + 2 }}">
                            {{ $blackMove ? getPieceIcon($blackMove->piece_number) . ' ' . $blackMove->from_position . ' → ' . $blackMove->to_position : '' }}
                        </div>
                    </div>
                @endfor

                @if(empty($moves))
                    <div class="text-gray-500 text-sm text-center mt-4">No moves available</div>
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
    const moves = @json($moves);
    
</script>

@vite('resources/js/exploreOP/exploreOP.js')
@endpush
