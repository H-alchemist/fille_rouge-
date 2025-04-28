@extends('app')
@section('title', 'CheckArena - Dashboard')
@push('styles')
@vite('resources/css/game/dash.css')
@endpush
@section('content')
<div class="main-content flex flex-col min-[768px]:flex-row min-h-screen">
   
    <aside class="w-full min-[768px]:w-60 bg-[#262626] border-r border-[#333] p-5 flex flex-col min-[768px]:border-b-0 border-b">
        <div class="profile-summary flex min-[768px]:flex-col max-[768px]:flex-row max-[768px]:justify-between max-[768px]:items-center gap-2.5 pb-5 border-b border-[#333] mb-5">
            <div class="profile-info flex items-center gap-4">
                <div class="w-20 h-20 rounded-full bg-[#444] flex justify-center items-center text-3xl font-bold text-white max-[768px]:w-10 max-[768px]:h-10">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="text-lg font-bold">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-400">Member since {{ Auth::user()->created_at->format('M Y') }}</div>
                </div>
            </div>
            <div>
                <div class="text-[#4ca9f5] font-medium">Blitz Rating</div>
                <div class="text-2xl font-bold">{{ Auth::user()->rating ?? 1200 }}</div>
            </div>
        </div>
        <nav class="sidebar-menu flex min-[768px]:flex-col max-[768px]:flex-row max-[768px]:overflow-x-auto max-[768px]:pb-1 gap-1">
            <a href="/dash" class="text-white no-underline py-2.5 px-4 rounded flex items-center gap-2.5 transition-colors hover:bg-[rgba(255,255,255,0.1)] {{ request()->routeIs('stats') ? 'bg-[rgba(76,169,245,0.2)] text-[#4ca9f5]' : '' }}">
                <span class="opacity-80 text-lg">📈</span> Stats
            </a>
            <a href="/history" class="text-white no-underline py-2.5 px-4 rounded flex items-center gap-2.5 transition-colors hover:bg-[rgba(255,255,255,0.1)] {{ request()->routeIs('history') ? 'bg-[rgba(76,169,245,0.2)] text-[#4ca9f5]' : '' }}">
                <span class="opacity-80 text-lg">♟</span> History
            </a>
            <a href="" class="text-white no-underline py-2.5 px-4 rounded flex items-center gap-2.5 transition-colors hover:bg-[rgba(255,255,255,0.1)] {{ request()->routeIs('profile') ? 'bg-[rgba(76,169,245,0.2)] text-[#4ca9f5]' : '' }}">
                <span class="opacity-80 text-lg">👤</span> Profile
            </a>
        </nav>
    </aside>
    
    
    <main class="flex-1 p-7">
        @yield('dashboard-content')
    </main>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    const pageItems = document.querySelectorAll('.pagination div');
    if (pageItems.length) {
        pageItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                pageItems.forEach(p => p.classList.remove('bg-[#4ca9f5]', 'text-white'));
                if (!item.textContent.includes('«') && !item.textContent.includes('»')) {
                    item.classList.add('bg-[#4ca9f5]', 'text-white');
                }
            });
        });
    }
});
</script>
@endpush