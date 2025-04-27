@extends('dash/dashboard')

@section('title', 'CheckArena - Game History')

@section('dashboard-content')
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
  
  <!-- Additional game entries... -->
  <!-- The rest of your game entries would go here -->
  
  <!-- I'm including only a couple more for brevity -->
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
  
  <!-- Rest of your game entries would go here -->
</div>

<!-- Pagination -->
<div class="flex justify-center gap-1 mt-6 pagination">
  <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] text-white cursor-pointer transition-all px-2.5">«</div>
  <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] bg-[#4ca9f5] text-white cursor-pointer transition-all">1</div>
  <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] text-white cursor-pointer transition-all hover:border-[#4ca9f5] hover:text-[#4ca9f5]">2</div>
  <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] text-white cursor-pointer transition-all hover:border-[#4ca9f5] hover:text-[#4ca9f5]">3</div>
  <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] text-white cursor-pointer transition-all hover:border-[#4ca9f5] hover:text-[#4ca9f5]">4</div>
  <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] text-white cursor-pointer transition-all hover:border-[#4ca9f5] hover:text-[#4ca9f5]">5</div>
  <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] text-white cursor-pointer transition-all px-2.5">»</div>
</div>
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
    const pageItemsArray = Array.from(document.querySelectorAll('.pagination div'));
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