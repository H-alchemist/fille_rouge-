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
    <!-- Game Header -->
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
                    @foreach($messages ?? [] as $message)
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-600 flex-shrink-0 flex items-center justify-center">
                                <span class="text-xs font-bold">{{ $message->user_initial ?? 'KM' }}</span>
                            </div>
                            <div>
                                <div class="font-semibold text-sm">{{ $message->username ?? 'KnightMoves' }}</div>
                                <div class="text-gray-400 text-sm">{{ $message->text ?? 'Good luck, have fun!' }}</div>
                            </div>
                        </div>
                    @endforeach
                    
                    <!-- Fallback messages if no data provided -->
                    @if(empty($messages))
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-600 flex-shrink-0 flex items-center justify-center">
                                <span class="text-xs font-bold">KM</span>
                            </div>
                            <div>
                                <div class="font-semibold text-sm">KnightMoves</div>
                                <div class="text-gray-400 text-sm">Good luck, have fun!</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-600 flex-shrink-0 flex items-center justify-center">
                                <span class="text-xs font-bold">GM</span>
                            </div>
                            <div>
                                <div class="font-semibold text-sm">GrandMaster42</div>
                                <div class="text-gray-400 text-sm">You too!</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-600 flex-shrink-0 flex items-center justify-center">
                                <span class="text-xs font-bold">KM</span>
                            </div>
                            <div>
                                <div class="font-semibold text-sm">KnightMoves</div>
                                <div class="text-gray-400 text-sm">Nice Sicilian defense</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-600 flex-shrink-0 flex items-center justify-center">
                                <span class="text-xs font-bold">GM</span>
                            </div>
                            <div>
                                <div class="font-semibold text-sm">GrandMaster42</div>
                                <div class="text-gray-400 text-sm">Thanks! I've been practicing it</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-600 flex-shrink-0 flex items-center justify-center">
                                <span class="text-xs font-bold">KM</span>
                            </div>
                            <div>
                                <div class="font-semibold text-sm">KnightMoves</div>
                                <div class="text-gray-400 text-sm">Good game!</div>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="flex border-t border-gray-700 p-3">
                    <input type="text" placeholder="Type a message..." 
                           class="flex-1 bg-gray-700 border border-gray-600 rounded-l-md px-3 py-2 text-white focus:outline-none focus:border-blue-500">
                    <button class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-r-md text-white transition">
                        Send
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Chessboard -->
        <div class="lg:col-span-2 flex flex-col items-center">
            <div id="chessboard" class="w-full max-w-md aspect-square mb-4 border-2 border-gray-700 shadow-lg bg-cover relative">
                <!-- Chessboard will be generated by JavaScript -->
            </div>
            
            <div class="flex justify-center gap-4">
                <button title="First move" id="first-move" 
                        class="w-10 h-10 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center hover:bg-gray-600 transition">
                    ⏮️
                </button>
                <button title="Previous move" id="prev-move"
                        class="w-10 h-10 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center hover:bg-gray-600 transition">
                    ⏪
                </button>
                <button title="Play/Pause" id="play-pause"
                        class="w-12 h-12 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center hover:bg-gray-600 transition text-xl">
                    ▶️
                </button>
                <button title="Next move" id="next-move"
                        class="w-10 h-10 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center hover:bg-gray-600 transition">
                    ⏩
                </button>
                <button title="Last move" id="last-move"
                        class="w-10 h-10 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center hover:bg-gray-600 transition">
                    ⏭️
                </button>
                <button title="Flip board" id="flip-board"
                        class="w-10 h-10 rounded-full bg-gray-700 border border-gray-600 flex items-center justify-center hover:bg-gray-600 transition">
                    🔄
                </button>
            </div>
        </div>
        
        <!-- Right Panel -->
        <div class="lg:col-span-1">
            <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
                <div class="bg-gray-700 p-4 flex justify-between items-center">
                    <div class="font-semibold">Game Moves</div>
                    <div class="flex">
                        <div class="px-3 py-1 rounded cursor-pointer hover:bg-gray-600 bg-opacity-20 bg-blue-900 text-blue-400">
                            Moves
                        </div>
                    </div>
                </div>
                
                <div class="p-4 max-h-96 overflow-y-auto">
                    <div class="flex flex-col gap-1">
                        @foreach($moves ?? [] as $index => $move)
                            <div class="flex gap-3">
                                <div class="w-8 text-gray-400">{{ $index + 1 }}.</div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer" data-ply="{{ $index * 2 }}">
                                    {{ $move->white ?? '' }}
                                </div>
                                <div class="flex-1 px-3 py-1 rounded hover:bg-gray-700 cursor-pointer {{ $index == 2 ? 'bg-opacity-20 bg-blue-900 text-blue-400' : '' }}" 
                                     data-ply="{{ $index * 2 + 1 }}">
                                    {{ $move->black ?? '' }}
                                </div>
                            </div>
                        @endforeach
                        
                        <!-- Fallback moves if no data provided -->
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
    document.addEventListener('DOMContentLoaded', function() {
        // Define the piece map
        const pieceMap = {
            '1': 'https://assets-themes.chess.com/image/ejgfv/150/wp.png',
            '2': 'https://assets-themes.chess.com/image/ejgfv/150/wr.png',
            '3': 'https://assets-themes.chess.com/image/ejgfv/150/wn.png',
            '4': 'https://assets-themes.chess.com/image/ejgfv/150/wb.png',
            '5': 'https://assets-themes.chess.com/image/ejgfv/150/wq.png',
            '6': 'https://assets-themes.chess.com/image/ejgfv/150/wk.png',
            '-1': 'https://assets-themes.chess.com/image/ejgfv/150/bp.png',
            '-2': 'https://assets-themes.chess.com/image/ejgfv/150/br.png',
            '-3': 'https://assets-themes.chess.com/image/ejgfv/150/bn.png',
            '-4': 'https://assets-themes.chess.com/image/ejgfv/150/bb.png',
            '-5': 'https://assets-themes.chess.com/image/ejgfv/150/bq.png',
            '-6': 'https://assets-themes.chess.com/image/ejgfv/150/bk.png'
        };
        
        // Initial board position (Sicilian Defense after 3...cxd4)
        let currentPosition = [
            [-2, -3, -4, -5, -6, -4, -3, -2],
            [-1, -1, 0, -1, -1, -1, -1, -1],
            [0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, -1, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0, 3, 0, 0],
            [1, 1, 1, 0, 0, 1, 1, 1],
            [2, 3, 4, 5, 6, 4, 0, 2]
        ];
        
        // Current move index
        let currentMoveIndex = 5; // 3...cxd4
        
        // Board flipped state
        let boardFlipped = false;
        
        // Generate the chessboard
        function generateBoard() {
            const chessboard = document.getElementById('chessboard');
            chessboard.innerHTML = '';
            chessboard.style.backgroundImage = "url('https://images.chesscomfiles.com/chess-themes/boards/icy_sea/200.png')";
            chessboard.style.display = 'grid';
            chessboard.style.gridTemplateColumns = 'repeat(8, 1fr)';
            chessboard.style.gridTemplateRows = 'repeat(8, 1fr)';
            
            // Create squares
            for (let row = 0; row < 8; row++) {
                for (let col = 0; col < 8; col++) {
                    const square = document.createElement('div');
                    square.className = 'relative flex items-center justify-center';
                    
                    // Add coordinates
                    if (col === 0) {
                        const rankCoord = document.createElement('span');
                        rankCoord.className = 'absolute top-0.5 left-1 text-xs text-white z-10 drop-shadow-md';
                        rankCoord.textContent = boardFlipped ? row + 1 : 8 - row;
                        square.appendChild(rankCoord);
                    }
                    
                    if (row === 7) {
                        const fileCoord = document.createElement('span');
                        fileCoord.className = 'absolute bottom-0.5 right-1 text-xs text-white z-10 drop-shadow-md';
                        fileCoord.textContent = String.fromCharCode(97 + (boardFlipped ? 7 - col : col));
                        square.appendChild(fileCoord);
                    }
                    
                    // Get piece at this position
                    const pieceValue = boardFlipped 
                        ? currentPosition[7 - row][7 - col] 
                        : currentPosition[row][col];
                    
                    if (pieceValue !== 0) {
                        const piece = document.createElement('div');
                        piece.className = 'w-full h-full bg-no-repeat bg-center bg-contain cursor-pointer z-10';
                        piece.style.backgroundImage = `url(${pieceMap[pieceValue]})`;
                        square.appendChild(piece);
                    }
                    
                    chessboard.appendChild(square);
                }
            }
        }
        
        // Initialize the board
        generateBoard();
        
        // Make moves clickable
        const moves = document.querySelectorAll('[data-ply]');
        moves.forEach(move => {
            move.addEventListener('click', function() {
                // Remove active class from all moves
                moves.forEach(m => {
                    m.classList.remove('bg-opacity-20', 'bg-blue-900', 'text-blue-400');
                });
                
                // Add active class to clicked move
                this.classList.add('bg-opacity-20', 'bg-blue-900', 'text-blue-400');
                
                // Update current move index
                currentMoveIndex = parseInt(this.getAttribute('data-ply'));
                
                // In a real implementation, this would update the board position
                console.log('Move clicked:', this.textContent, 'Ply:', currentMoveIndex);
            });
        });
        
        // Board control buttons
        document.getElementById('first-move').addEventListener('click', function() {
            console.log('First move');
            // Would set currentMoveIndex to 0 and update board
        });
        
        document.getElementById('prev-move').addEventListener('click', function() {
            console.log('Previous move');
            // Would decrement currentMoveIndex and update board
        });
        
        document.getElementById('play-pause').addEventListener('click', function() {
            console.log('Play/Pause');
            // Would toggle auto-play of moves
        });
        
        document.getElementById('next-move').addEventListener('click', function() {
            console.log('Next move');
            // Would increment currentMoveIndex and update board
        });
        
        document.getElementById('last-move').addEventListener('click', function() {
            console.log('Last move');
            // Would set currentMoveIndex to last move and update board
        });
        
        document.getElementById('flip-board').addEventListener('click', function() {
            boardFlipped = !boardFlipped;
            generateBoard();
            console.log('Board flipped:', boardFlipped);
        });
        
        // Chat functionality
        const chatInput = document.querySelector('input[placeholder="Type a message..."]');
        const chatButton = document.querySelector('.bg-blue-500.rounded-r-md');
        const chatMessages = document.querySelector('.flex-1.p-4.overflow-y-auto');
        
        if (chatButton && chatInput && chatMessages) {
            chatButton.addEventListener('click', function() {
                if (chatInput.value.trim() !== '') {
                    // Create new message element
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'flex gap-3';
                    messageDiv.innerHTML = `
                        <div class="w-8 h-8 rounded-full bg-gray-600 flex-shrink-0 flex items-center justify-center">
                            <span class="text-xs font-bold">GM</span>
                        </div>
                        <div>
                            <div class="font-semibold text-sm">GrandMaster42</div>
                            <div class="text-gray-400 text-sm">${chatInput.value}</div>
                        </div>
                    `;
                    
                    // Add message to chat
                    chatMessages.appendChild(messageDiv);
                    
                    // Clear input
                    chatInput.value = '';
                    
                    // Scroll to bottom
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            });
            
            // Allow Enter key to send message
            chatInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    chatButton.click();
                }
            });
        }
    });
</script>
@endpush