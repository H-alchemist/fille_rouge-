@extends('app')

@section('title', 'CheckArena - Leaderboard')

@push('styles')
<style>
    .podium {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 2rem;
    }
    
    .podium-place {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 120px;
    }
    
    .podium-stand {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: bold;
        font-size: 1.5rem;
    }
    
    .first-place {
        height: 180px;
        background: linear-gradient(to bottom, #FFD700, #C9B037);
    }
    
    .second-place {
        height: 150px;
        background: linear-gradient(to bottom, #C0C0C0, #A8A8A8);
    }
    
    .third-place {
        height: 120px;
        background: linear-gradient(to bottom, #CD7F32, #B87333);
    }
    
    .player-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid white;
        margin-top: -30px;
    }
    
    .time-control-tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 2rem;
        border-bottom: 1px solid #333;
    }
    
    .time-control-tab {
        padding: 0.75rem 1.5rem;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        transition: all 0.2s;
    }
    
    .time-control-tab.active {
        border-bottom: 3px solid #4CA9F5;
        color: #4CA9F5;
    }
    
    .leaderboard-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .leaderboard-table th {
        background-color: #2a2a2a;
        padding: 0.75rem;
        text-align: left;
    }
    
    .leaderboard-table td {
        padding: 0.75rem;
        border-bottom: 1px solid #333;
    }
    
    .leaderboard-table tr:hover {
        background-color: #2a2a2a;
    }
    
    .rating-change {
        display: inline-flex;
        align-items: center;
    }
    
    .rating-up {
        color: #4CAF50;
    }
    
    .rating-down {
        color: #F44336;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-white mb-8">Chess Leaderboard</h1>
    
    <div class="time-control-tabs">
        <div class="time-control-tab active" data-time-control="bullet">Bullet</div>
        <div class="time-control-tab" data-time-control="blitz">Blitz</div>
        <div class="time-control-tab" data-time-control="rapid">Rapid</div>
        <div class="time-control-tab" data-time-control="classic">Classic</div>
    </div>
    
    
    <div id="bullet-leaderboard" class="time-control-content">
        <div class="podium">
            
            <div class="podium-place">
                <div class="podium-stand second-place">2</div>
                <img src="/storage/avatars/player2.jpg" class="player-avatar">
                <div class="text-center mt-2">
                    <div class="font-bold text-white">GarryKasparov</div>
                    <div class="text-gray-400">Rating: 2845</div>
                    <div class="rating-change rating-up">+12</div>
                </div>
            </div>
            
            
            <div class="podium-place">
                <div class="podium-stand first-place">1</div>
                <img src="/storage/avatars/player1.jpg" class="player-avatar">
                <div class="text-center mt-2">
                    <div class="font-bold text-white">MagnusCarlsen</div>
                    <div class="text-gray-400">Rating: 2886</div>
                    <div class="rating-change rating-up">+24</div>
                </div>
            </div>
            
            
            <div class="podium-place">
                <div class="podium-stand third-place">3</div>
                <img src="/storage/avatars/player3.jpg" class="player-avatar">
                <div class="text-center mt-2">
                    <div class="font-bold text-white">HikaruNakamura</div>
                    <div class="text-gray-400">Rating: 2832</div>
                    <div class="rating-change rating-down">-5</div>
                </div>
            </div>
        </div>
        
        <table class="leaderboard-table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Player</th>
                    <th>Rating</th>
                    <th>Change</th>
                    <th>Games</th>
                    <th>Win %</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>4</td>
                    <td class="flex items-center gap-3">
                        <img src="/storage/avatars/player4.jpg" class="w-8 h-8 rounded-full">
                        <span>FabianoCaruana</span>
                    </td>
                    <td>2812</td>
                    <td class="rating-change rating-up">+8</td>
                    <td>127</td>
                    <td>72%</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td class="flex items-center gap-3">
                        <img src="/storage/avatars/player5.jpg" class="w-8 h-8 rounded-full">
                        <span>LevonAronian</span>
                    </td>
                    <td>2798</td>
                    <td class="rating-change rating-down">-3</td>
                    <td>98</td>
                    <td>68%</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td class="flex items-center gap-3">
                        <img src="/storage/avatars/player6.jpg" class="w-8 h-8 rounded-full">
                        <span>WesleySo</span>
                    </td>
                    <td>2785</td>
                    <td class="rating-change rating-up">+15</td>
                    <td>112</td>
                    <td>70%</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td class="flex items-center gap-3">
                        <img src="/storage/avatars/player7.jpg" class="w-8 h-8 rounded-full">
                        <span>IanNepomniachtchi</span>
                    </td>
                    <td>2773</td>
                    <td class="rating-change rating-up">+7</td>
                    <td>105</td>
                    <td>65%</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    
    <div id="blitz-leaderboard" class="time-control-content hidden">
        
    </div>
    
    
    <div id="rapid-leaderboard" class="time-control-content hidden">
        
    </div>
    
    
    <div id="classic-leaderboard" class="time-control-content hidden">
        
    </div>
</div>


@endsection