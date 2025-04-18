<header class="bg-gray-950 py-4 px-10 shadow-lg border-b border-gray-800 flex justify-between items-center">
    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-400 flex items-center">
      <span class="text-3xl mr-2">♚</span>
      CheckArena
    </a>
    <div class="flex gap-5">
      <a href="{{ route('play') }}" class="text-white hover:bg-white/10 px-3 py-2 rounded transition">Play</a>
      <a href="{{ route('puzzles') }}" class="text-white hover:bg-white/10 px-3 py-2 rounded transition">Puzzles</a>
      <a href="{{ route('learn') }}" class="text-white hover:bg-white/10 px-3 py-2 rounded transition">Learn</a>
      <a href="{{ route('community') }}" class="text-white hover:bg-white/10 px-3 py-2 rounded transition">Community</a>
      <a href="{{ route('tools') }}" class="text-white hover:bg-white/10 px-3 py-2 rounded transition">Tools</a>
    </div>
  </header>