<header class="bg-gray-950 py-4 px-10  border-b border-gray-900 flex justify-between items-center">
    <a href="/home" class="text-2xl font-bold text-blue-400 flex items-center">
      <span class="text-3xl mr-2">♚</span>
      CheckArena
    </a>
    <div class="flex gap-5">
      <a href="/" class="text-white hover:bg-white/10 px-3 py-2 rounded transition">Home</a>
      <a href="/play" class="text-white hover:bg-white/10 px-3 py-2 rounded transition">Play</a>
      
    </div>

    <div class="auth-buttons">

    
      @if (!auth()->check())
      <a href="/login" class="px-4 py-2 rounded font-semibold transition-colors cursor-pointer bg-blue-700 text-white hover:bg-blue-900">Sign Up</a>
  @else
      <a href="/logout" class="px-4 py-2 rounded font-semibold transition-colors cursor-pointer bg-blue-700 text-white hover:bg-blue-900">Log Out</a>
  @endif
     
    </div>
  </header>