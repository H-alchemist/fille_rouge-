@extends('dash/dashboard')

@section('title', 'CheckArena - Game History')

@section('dashboard-content')
<div class="mb-6">
  <h1 class="text-2xl text-[#4ca9f5] mb-2.5">Game History</h1>
 
</div>

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



{{-- 
<div class="bg-[#262626] rounded-lg overflow-hidden shadow-lg">
    <div class="grid grid-cols-2 min-[768px]:grid-cols-4 lg:grid-cols-6 py-4 px-5 bg-[#333] font-semibold">
        <div class="flex items-center gap-1 cursor-pointer">Date <span class="text-xs opacity-70">▼</span></div>
        <div class="flex items-center gap-1 cursor-pointer">Opponent</div>
        <div class="hidden min-[768px]:flex items-center gap-1 cursor-pointer">Game Type</div>
        <div class="hidden min-[768px]:flex items-center gap-1 cursor-pointer">Result</div>
        <div class="hidden lg:flex items-center gap-1 cursor-pointer">Rating Change</div>
        <div class="hidden lg:flex items-center gap-1 cursor-pointer">Moves</div>
    </div>
    <div id="gamesH" class=" grid grid-cols-2 min-[768px]:grid-cols-4 lg:grid-cols-6 py-4 px-5 border-b border-[#333] transition-colors hover:bg-[rgba(255,255,255,0.05)] cursor-pointer">
     
  
    </div>
</div> --}}

<div id="tableH" class="bg-[#262626] rounded-lg overflow-hidden shadow-lg max-w-5xl mx-auto">
    <div class="grid grid-cols-2 min-[768px]:grid-cols-4 lg:grid-cols-6 py-4 px-5 bg-[#333] font-semibold">
        <div class="flex items-center gap-1 cursor-pointer">Date <span class="text-xs opacity-70">▼</span></div>
        <div class="flex items-center gap-1 cursor-pointer">Opponent</div>
        <div class="hidden min-[768px]:flex items-center gap-1 cursor-pointer">Game Type</div>
        <div class="hidden min-[768px]:flex items-center gap-1 cursor-pointer">Result</div>
        <div class="hidden lg:flex items-center gap-1 cursor-pointer">Rating Change</div>
        <div class="hidden lg:flex items-center gap-1 cursor-pointer">Moves</div>
    </div>
   
</div>



<div id='pagine' class="flex justify-center gap-1 mt-6 pagination">
  <div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] text-white cursor-pointer transition-all px-2.5">«</div>
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