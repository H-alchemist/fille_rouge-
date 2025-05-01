@extends('dash/dashboard')

@section('title', 'CheckArena - Game History')

@section('dashboard-content')
<div class="mb-6">
  <h1 class="text-2xl text-[#4ca9f5] mb-2.5">Game History</h1>
 
</div>

<div class="w-4/5   flex   justify-evenly  mb-6 ">
  <div class="flex items-center gap-2.5">
    <span class="text-sm text-gray-400">Time Period:</span>
    <select id="time" class="py-2 px-3 bg-[#333] border border-[#333] rounded text-white text-sm cursor-pointer">
      <option value= 0 >All Time</option>
      <option value= 30>Last 30 Days</option>
      <option value= 7 >Last 7 Days</option>
      <option value= 1>Today</option>
    </select>
  </div>
  
  <div class="flex items-center gap-2.5">
    <span class="text-sm text-gray-400">Game Type:</span>
    <select id="type" class="py-2 px-3 bg-[#333] border border-[#333] rounded text-white text-sm cursor-pointer">
      <option value="0">All Types</option>
      <option value="3">Blitz</option>
      <option value="10">Rapid</option>
      <option value="1">Bullet</option>
      <option value="15">Classical</option>
    </select>
  </div>
  
  <div class="flex items-center gap-2.5">
    <span class="text-sm text-gray-400">Result:</span>
    <select id="result" class="py-2 px-3 bg-[#333] border border-[#333] rounded text-white text-sm cursor-pointer">
      <option>All Results</option>
      <option value="winner">Wins</option>
      <option value="losser">Losses</option>
      <option value="draw">Draws</option>
    </select>
  </div>

  <button id="filter" class="bg-[#4CA9F5] rounded  py-2 px-4">Filter</button>
  
 
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

<div  class="bg-[#262626] rounded-lg overflow-hidden shadow-lg max-w-5xl mx-auto">
    <div class="grid grid-cols-2 min-[768px]:grid-cols-4 lg:grid-cols-6 py-4 px-5 bg-[#333] font-semibold">
        <div class="flex items-center gap-1 cursor-pointer">Date <span class="text-xs opacity-70">▼</span></div>
        <div class="flex items-center gap-1 cursor-pointer">Opponent</div>
        <div class="hidden min-[768px]:flex items-center gap-1 cursor-pointer">Game Type</div>
        <div class="hidden min-[768px]:flex items-center gap-1 cursor-pointer">Result</div>
        <div class="hidden lg:flex items-center gap-1 cursor-pointer">Rating Change</div>
        <div class="hidden lg:flex items-center gap-1 cursor-pointer">Moves</div>
    </div>

    <div id="tableH" class="bg-[#262626] rounded-lg overflow-hidden shadow-lg max-w-5xl mx-auto"></div>
   
</div>



<div id='pagine' class="flex justify-center gap-1 mt-6 pagination">
  
</div>
@endsection

@push('scripts')

@endpush