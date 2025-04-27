@extends('app')

@section('title', 'CheckArena - Game History')

@push('styles')
    @vite('resources/css/game/dash.css')
@endpush

@section('content')
  <div class="main-content flex flex-col min-[768px]:flex-row flex-1">
    <aside class="w-full min-[768px]:w-60 bg-[#262626] border-r border-[#333] p-5 flex flex-col min-[768px]:border-b-0 border-b">
      <div class="profile-summary flex min-[768px]:flex-col max-[768px]:flex-row max-[768px]:justify-between max-[768px]:items-center gap-2.5 pb-5 border-b border-[#333] mb-5">
        <div class="profile-info flex items-center gap-4">
          <div class="w-20 h-20 rounded-full bg-[#444] flex justify-center items-center text-3xl font-bold text-white max-[768px]:w-10 max-[768px]:h-10">
            GM
          </div>
          <div>
            <div class="text-lg font-bold">GrandMaster42</div>
            <div class="text-sm text-gray-400">Member since Mar 2023</div>
          </div>
        </div>
        <div>
          <div class="text-[#4ca9f5] font-medium">Blitz Rating</div>
          <div class="text-2xl font-bold">1842</div>
        </div>
      </div>
      
      <div class="sidebar-menu flex min-[768px]:flex-col max-[768px]:flex-row max-[768px]:overflow-x-auto max-[768px]:pb-1 gap-1">
        <a href="#" class="text-white no-underline py-2.5 px-4 rounded flex items-center gap-2.5 transition-colors bg-[rgba(76,169,245,0.2)] text-[#4ca9f5]">
          <span class="opacity-80 text-lg">♟</span> Game History
        </a>
        <a href="#" class="text-white no-underline py-2.5 px-4 rounded flex items-center gap-2.5 transition-colors hover:bg-[rgba(255,255,255,0.1)]">
          <span class="opacity-80 text-lg">📈</span> Stats & Analysis
        </a>
      </div>
    </aside>
    
    <main class="flex-1 p-7">
      <div class="mb-6">
        <h1 class="text-2xl text-[#4ca9f5] mb-2.5">Game History</h1>
        <p class="text-base text-gray-400">Review your previous games and analyze your performance</p>
      </div>
      
      <!-- Stats Summary -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-7">
        <div class="bg-[#262626] rounded-lg p-5 flex flex-col items-center text-center">
          <div class="text-sm text-gray-400">Total Games</div>
          <div class="text-3xl font-bold my-2.5">483</div>
          <div class="text-sm text-gray-400">Lifetime</div>
        </div>
        
        <div class="bg-[#262626] rounded-lg p-5 flex flex-col items-center text-center">
          <div class="text-sm text-gray-400">Wins</div>
          <div class="text-3xl font-bold my-2.5 text-[#4caf50]">257</div>
          <div class="text-sm text-gray-400">53.2%</div>
        </div>
        
        <div class="bg-[#262626] rounded-lg p-5 flex flex-col items-center text-center">
          <div class="text-sm text-gray-400">Losses</div>
          <div class="text-3xl font-bold my-2.5 text-[#f44336]">198</div>
          <div class="text-sm text-gray-400">41.0%</div>
        </div>
        
        <div class="bg-[#262626] rounded-lg p-5 flex flex-col items-center text-center">
          <div class="text-sm text-gray-400">Draws</div>
          <div class="text-3xl font-bold my-2.5 text-[#ff9800]">28</div>
          <div class="text-sm text-gray-400">5.8%</div>
        </div>
      </div>
      
      <!-- Filters -->
      <div class="flex flex-col min-[768px]:flex-row flex-wrap gap-4 mb-6">
        <div class="flex items-center gap-2.5">
          <span class="text-sm text-gray-400">Time Period:</span>
          <select class="py-2 px-3 bg-[#333] border border-[#333] rounded text-white text-sm cursor-pointer">
            <option>All Time</option>
            <option>This Month</option>
            <option>Last 30 Days</option>
            <option>Last 7 Days</option>
            <option>Today</option>
          </select>
        </div>
        
        <div class="flex items-center gap-2.5">
          <span class="text-sm text-gray-400">Game Type:</span>
          <select class="py-2 px-3 bg-[#333] border border-[#333] rounded text-white text-sm cursor-pointer">
            <option>All Types</option>
            <option>Blitz</option>
            <option>Rapid</option>
            <option>Bullet</option>
            <option>Classical</option>
          </select>
        </div>
        
        <div class="flex items-center gap-2.5">
          <span class="text-sm text-gray-400">Result:</span>
          <select class="py-2 px-3 bg-[#333] border border-[#333] rounded text-white text-sm cursor-pointer">
            <option>All Results</option>
            <option>Wins</option>
            <option>Losses</option>
            <option>Draws</option>
          </select>
        </div>
        
        <div class="flex min-[768px]:ml-auto w-full min-[768px]:w-auto">
          <input type="text" placeholder="Search opponents..." class="py-2 px-3 bg-[#333] border border-[#333] rounded-l text-white w-full min-[768px]:w-52">
          <button class="bg-[#4ca9f5] text-white border-none rounded-r py-0 px-3 cursor-pointer">🔍</button>
        </div>
      </div>
      
      <!-- Game List -->
      <div class="bg-[#262626] rounded-lg overflow-hidden shadow-lg">
        <div class="grid grid-cols-2 min-[768px]:grid-cols-4 lg:grid-cols-6 py-4 px-5 bg-[#333] font-semibold">
          <div class="flex items-center gap-1 cursor-pointer">Date <span class="text-xs opacity-70">▼</span></div>
          <div class="flex items-center gap-1 cursor-pointer">Opponent</div>
          <div class="hidden min-[768px]:flex items-center gap-1 cursor-pointer">Game Type</div>
          <div class="hidden min-[768px]:flex items-center gap-1 cursor-pointer">Result</div>
          <div class="hidden lg:flex items-center gap-1 cursor-pointer">Rating Change</div>
          <div class="hidden lg:flex items-center gap-1 cursor-pointer">Moves</div>
        </div>
        
        <div class="grid grid-cols-2 min-[768px]:grid-cols-4 lg:grid-cols-6 py-4 px-5 border-b border-[#333] transition-colors hover:bg-[rgba(255,255,255,0.05)] cursor-pointer">
          <div class="text-gray-400 text-sm">Today, 14:32</div>
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-[#555] flex justify-center items-center text-xs font-bold text-white">KM</div>
            <div>
              <div class="font-medium">KnightMoves</div>
              <div class="text-gray-400 text-sm">1756</div>
            </div>
          </div>
          <div class="hidden min-[768px]:block">
            Blitz
            <div class="text-gray-400 text-sm">3+2</div>
          </div>
          <div class="hidden min-[768px]:block font-semibold text-[#4caf50] flex items-center gap-1">Win</div>
          <div class="hidden lg:block">+8</div>
          <div class="hidden lg:block text-gray-400 text-sm">32 moves</div>
        </div>
        
        <div class="grid grid-cols-2 min-[768px]:grid-cols-4 lg:grid-cols-6 py-4 px-5 border-b border-[#333] transition-colors hover:bg-[rgba(255,255,255,0.05)] cursor-pointer">
          <div class="text-gray-400 text-sm">Today, 13:15</div>
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-[#555] flex justify-center items-center text-xs font-bold text-white">QG</div>
            <div>
              <div class="font-medium">QueenGambit</div>
              <div class="text-gray-400 text-sm">1921</div>
            </div>
          </div>
          <div class="hidden min-[768px]:block">
            Blitz
            <div class="text-gray-400 text-sm">5+3</div>
          </div>
          <div class="hidden min-[768px]:block font-semibold text-[#f44336] flex items-center gap-1">Loss</div>
          <div class="hidden lg:block">-12</div>
          <div class="hidden lg:block text-gray-400 text-sm">45 moves</div>
        </div>
        
        <div class="grid grid-cols-2 min-[768px]:grid-cols-4 lg:grid-cols-6 py-4 px-5 border-b border-[#333] transition-colors hover:bg-[rgba(255,255,255,0.05)] cursor-pointer">
          <div class="text-gray-400 text-sm">Yesterday, 20:47</div>
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-[#555] flex justify-center items-center text-xs font-bold text-white">BP</div>
            <div>
              <div class="font-medium">BishopPower</div>
              <div class="text-gray-400 text-sm">1834</div>
            </div>
          </div>
          <div class="hidden min-[768px]:block">
            Blitz
            <div class="text-gray-400 text-sm">3+2</div>
          </div>
          <div class="hidden min-[768px]:block font-semibold text-[#4caf50] flex items-center gap-1">Win</div>
          <div class="hidden lg:block">+9</div>
          <div class="hidden lg:block text-gray-400 text-sm">28 moves</div>
        </div>
        
        <div class="grid grid-cols-2 min-[768px]:grid-cols-4 lg:grid-cols-6 py-4 px-5 border-b border-[#333] transition-colors hover:bg-[rgba(255,255,255,0.05)] cursor-pointer">
          <div class="text-gray-400 text-sm">Yesterday, 19:30</div>
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-[#555] flex justify-center items-center text-xs font-bold text-white">RK</div>
            <div>
              <div class="font-medium">RookRookie</div>
              <div class="text-gray-400 text-sm">1765</div>
            </div>
          </div>
          <div class="hidden min-[768px]:block">
            Blitz
            <div class="text-gray-400 text-sm">3+2</div>
          </div>
          <div class="hidden min-[768px]:block font-semibold text-[#4caf50] flex items-center gap-1">Win</div>
          <div class="hidden lg:block">+7</div>
          <div class="hidden lg:block text-gray-400 text-sm">36 moves</div>
        </div>
        
        <div class="grid grid-cols-2 min-[768px]:grid-cols-4 lg:grid-cols-6 py-4 px-5 border-b border-[#333] transition-colors hover:bg-[rgba(255,255,255,0.05)] cursor-pointer">
          <div class="text-gray-400 text-sm">Yesterday, 18:15</div>
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-[#555] flex justify-center items-center text-xs font-bold text-white">PM</div>
            <div>
              <div class="font-medium">PawnMaster</div>
              <div class="text-gray-400 text-sm">1901</div>
            </div>
          </div>
          <div class="hidden min-[768px]:block">
            Rapid
            <div class="text-gray-400 text-sm">10+5</div>
          </div>
          <div class="hidden min-[768px]:block font-semibold text-[#ff9800] flex items-center gap-1">Draw</div>
          <div class="hidden lg:block">+1</div>
          <div class="hidden lg:block text-gray-400 text-sm">52 moves</div>
        </div>
        
        <div class="grid grid-cols-2 min-[768px]:grid-cols-4 lg:grid-cols-6 py-4 px-5 border-b border-[#333] transition-colors hover:bg-[rgba(255,255,255,0.05)] cursor-pointer">
          <div class="text-gray-400 text-sm">Mar 18, 2025</div>
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-[#555] flex justify-center items-center text-xs font-bold text-white">CS</div>
            <div>
              <div class="font-medium">ChessStudent</div>
              <div class="text-gray-400 text-sm">1690</div>
            </div>
          </div>
          <div class="hidden min-[768px]:block">
            Bullet
            <div class="text-gray-400 text-sm">1+0</div>
          </div>
          <div class="hidden min-[768px]:block font-semibold text-[#4caf50] flex items-center gap-1">Win</div>
          <div class="hidden lg:block">+5</div>
          <div class="hidden lg:block text-gray-400 text-sm">24 moves</div>
        </div>
        
        <div class="grid grid-cols-2 min-[768px]:grid-cols-4 lg:grid-cols-6 py-4 px-5 border-b border-[#333] transition-colors hover:bg-[rgba(255,255,255,0.05)] cursor-pointer">
          <div class="text-gray-400 text-sm">Mar 18, 2025</div>
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-[#555] flex justify-center items-center text-xs font-bold text-white">EG</div>
            <div>
              <div class="font-medium">EndGameExpert</div>
              <div class="text-gray-400 text-sm">1925</div>
            </div>
          </div>
          <div class="hidden min-[768px]:block">
            Blitz
            <div class="text-gray-400 text-sm">5+2</div>
          </div>
          <div class="hidden min-[768px]:block font-semibold text-[#f44336] flex items-center gap-1">Loss</div>
          <div class="hidden lg:block">-10</div>
          <div class="hidden lg:block text-gray-400 text-sm">41 moves</div>
        </div>
        
        <div class="grid grid-cols-2 min-[768px]:grid-cols-4 lg:grid-cols-6 py-4 px-5 transition-colors hover:bg-[rgba(255,255,255,0.05)] cursor-pointer">
          <div class="text-gray-400 text-sm">Mar 17, 2025</div>
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-[#555] flex justify-center items-center text-xs font-bold text-white">TK</div>
            <div>
              <div class="font-medium">TacticalKing</div>
              <div class="text-gray-400 text-sm">1814</div>
            </div>
          </div>
          <div class="hidden min-[768px]:block">
            Classical
            <div class="text-gray-400 text-sm">15+10</div>
          </div>
          <div class="hidden min-[768px]:block font-semibold text-[#4caf50] flex items-center gap-1">Win</div>
          <div class="hidden lg:block">+11</div>
          <div class="hidden lg:block text-gray-400 text-sm">38 moves</div>
        </div>
      </div>
      
      <!-- Pagination -->
      <div class="flex justify-center gap-1 mt-6">
        <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] text-white cursor-pointer transition-all px-2.5">«</div>
        <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] bg-[#4ca9f5] text-white cursor-pointer transition-all">1</div>
        <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] text-white cursor-pointer transition-all hover:border-[#4ca9f5] hover:text-[#4ca9f5]">2</div>
        <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] text-white cursor-pointer transition-all hover:border-[#4ca9f5] hover:text-[#4ca9f5]">3</div>
        <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] text-white cursor-pointer transition-all hover:border-[#4ca9f5] hover:text-[#4ca9f5]">4</div>
        <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] text-white cursor-pointer transition-all hover:border-[#4ca9f5] hover:text-[#4ca9f5]">5</div>
        <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] text-white cursor-pointer transition-all px-2.5">»</div>
      </div>
    </main>
  </div>

  <footer class="bg-[#0d0d0d] py-5 px-10 border-t border-[#333]">
    <div class="flex justify-between items-center flex-col min-[768px]:flex-row gap-5">
      <div class="flex gap-5">
        <a href="#" class="text-gray-400 no-underline transition-colors hover:text-white">About</a>
        <a href="#" class="text-gray-400 no-underline transition-colors hover:text-white">FAQ</a>
        <a href="#" class="text-gray-400 no-underline transition-colors hover:text-white">Contact</a>
        <a href="#" class="text-gray-400 no-underline transition-colors hover:text-white">Privacy Policy</a>
        <a href="#" class="text-gray-400 no-underline transition-colors hover:text-white">Terms of Service</a>
      </div>
      
      <div class="flex gap-4">
        <a href="#" class="text-gray-400 no-underline transition-colors hover:text-white">Twitter</a>
        <a href="#" class="text-gray-400 no-underline transition-colors hover:text-white">Discord</a>
        <a href="#" class="text-gray-400 no-underline transition-colors hover:text-white">GitHub</a>
      </div>
    </div>
  </footer>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Make game items clickable to view game details
    const gameItems = document.querySelectorAll('.grid.grid-cols-2.border-b, .grid.grid-cols-2:not(.border-b)');
    gameItems.forEach(item => {
      item.addEventListener('click', () => {
        // In a real implementation, this would navigate to game details
        console.log('View game details');
      });
    });
    
    // Filter change event handlers
    const filterSelects = document.querySelectorAll('select');
    filterSelects.forEach(select => {
      select.addEventListener('change', () => {
        // In a real implementation, this would filter the games list
        console.log('Filter changed:', select.value);
      });
    });
    
    // Pagination click handlers
    const pageItems = document.querySelectorAll('.pagination div');
    const pageItemsArray = Array.from(document.querySelectorAll('.w-9.h-9'));
    pageItemsArray.forEach(item => {
      item.addEventListener('click', () => {
        // Remove active class from all items
        pageItemsArray.forEach(p => {
          p.classList.remove('bg-[#4ca9f5]');
          if (!p.textContent.includes('«') && !p.textContent.includes('»')) {
            p.classList.add('hover:border-[#4ca9f5]', 'hover:text-[#4ca9f5]');
          }
        });
        
        // Add active class to clicked item if it's not a navigation item
        if (!item.textContent.includes('«') && !item.textContent.includes('»')) {
          item.classList.add('bg-[#4ca9f5]');
          item.classList.remove('hover:border-[#4ca9f5]', 'hover:text-[#4ca9f5]');
        }
      });
    });
  });
</script>
@endpush