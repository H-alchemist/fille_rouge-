@extends('app')

@section('title', 'CheckArena - Leaderboard')

@push('styles')
<style>
    /* Simple layout styling */
    .leaderboard-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }
    
    .time-control-section {
        width: calc(25% - 20px);
        min-width: 250px;
        margin-bottom: 20px;
    }
    
    .section-header {
        font-size: 1.5rem;
        font-weight: bold;
        color: white;
        margin-bottom: 1rem;
        text-align: center;
        padding: 10px;
        border-bottom: 2px solid #4CA9F5;
    }
    
    /* Podium styling */
    .podium {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        gap: 10px;
        margin-bottom: 1.5rem;
    }
    
    .podium-place {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 80px;
    }
    
    .podium-stand {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: bold;
    }
    
    .first-place {
        height: 100px;
        background: linear-gradient(to bottom, #FFD700, #C9B037);
    }
    
    .second-place {
        height: 80px;
        background: linear-gradient(to bottom, #C0C0C0, #A8A8A8);
    }
    
    .third-place {
        height: 60px;
        background: linear-gradient(to bottom, #CD7F32, #B87333);
    }
    
    .player-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid white;
        margin-top: -20px;
    }
    
    /* Player list styling */
    .player-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    
    .player-list li {
        padding: 8px;
        border-bottom: 1px solid #333;
        display: flex;
        align-items: center;
    }
    
    .player-list li:last-child {
        border-bottom: none;
    }
    
    .player-rank {
        min-width: 20px;
        margin-right: 10px;
        font-weight: bold;
    }
    
    .player-info {
        display: flex;
        align-items: center;
        flex-grow: 1;
    }
    
    .player-list .player-avatar {
        width: 30px;
        height: 30px;
        margin: 0 10px 0 0;
    }
    
    .player-name {
        flex-grow: 1;
    }
    
    .player-rating {
        margin-left: auto;
    }
    
    .rating-change {
        display: inline-flex;
        align-items: center;
        margin-left: 5px;
        font-size: 0.8rem;
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
    <h1 class="text-3xl font-bold text-white mb-8 text-center">Chess Leaderboard</h1>
    
    <div class="leaderboard-container">
        <!-- BULLET SECTION -->
        <div class="time-control-section">
            <div class="section-header">Bullet</div>
            
            <!-- Top 3 Podium -->
            <div class="podium">
                <div class="podium-place">
                    <div class="podium-stand second-place">2</div>
                    <img src="/storage/avatars/player2.jpg" class="player-avatar">
                    <div class="text-center mt-1">
                        <div class="text-white text-sm">GarryK</div>
                        <div class="text-gray-400 text-xs">2845</div>
                    </div>
                </div>
                
                <div class="podium-place">
                    <div class="podium-stand first-place">1</div>
                    <img src="/storage/avatars/player1.jpg" class="player-avatar">
                    <div class="text-center mt-1">
                        <div class="text-white text-sm">MagnusC</div>
                        <div class="text-gray-400 text-xs">2886</div>
                    </div>
                </div>
                
                <div class="podium-place">
                    <div class="podium-stand third-place">3</div>
                    <img src="/storage/avatars/player3.jpg" class="player-avatar">
                    <div class="text-center mt-1">
                        <div class="text-white text-sm">HikaruN</div>
                        <div class="text-gray-400 text-xs">2832</div>
                    </div>
                </div>
            </div>
            
            <!-- Players 4-7 List -->
            <ul class="player-list">
                <li>
                    <span class="player-rank">4</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player4.jpg" class="player-avatar">
                        <span class="player-name">FabianoC</span>
                    </div>
                    <span class="player-rating">2812 <span class="rating-change rating-up">+8</span></span>
                </li>
                <li>
                    <span class="player-rank">5</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player5.jpg" class="player-avatar">
                        <span class="player-name">LevonA</span>
                    </div>
                    <span class="player-rating">2798 <span class="rating-change rating-down">-3</span></span>
                </li>
                <li>
                    <span class="player-rank">6</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player6.jpg" class="player-avatar">
                        <span class="player-name">WesleyS</span>
                    </div>
                    <span class="player-rating">2785 <span class="rating-change rating-up">+15</span></span>
                </li>
                <li>
                    <span class="player-rank">7</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player7.jpg" class="player-avatar">
                        <span class="player-name">IanN</span>
                    </div>
                    <span class="player-rating">2773 <span class="rating-change rating-up">+7</span></span>
                </li>
            </ul>
        </div>
        
        <!-- BLITZ SECTION -->
        <div class="time-control-section">
            <div class="section-header">Blitz</div>
            
            <!-- Top 3 Podium -->
            <div class="podium">
                <div class="podium-place">
                    <div class="podium-stand second-place">2</div>
                    <img src="/storage/avatars/player2.jpg" class="player-avatar">
                    <div class="text-center mt-1">
                        <div class="text-white text-sm">GarryK</div>
                        <div class="text-gray-400 text-xs">2845</div>
                    </div>
                </div>
                
                <div class="podium-place">
                    <div class="podium-stand first-place">1</div>
                    <img src="/storage/avatars/player1.jpg" class="player-avatar">
                    <div class="text-center mt-1">
                        <div class="text-white text-sm">MagnusC</div>
                        <div class="text-gray-400 text-xs">2886</div>
                    </div>
                </div>
                
                <div class="podium-place">
                    <div class="podium-stand third-place">3</div>
                    <img src="/storage/avatars/player3.jpg" class="player-avatar">
                    <div class="text-center mt-1">
                        <div class="text-white text-sm">HikaruN</div>
                        <div class="text-gray-400 text-xs">2832</div>
                    </div>
                </div>
            </div>
            
            <!-- Players 4-7 List -->
            <ul class="player-list">
                <li>
                    <span class="player-rank">4</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player4.jpg" class="player-avatar">
                        <span class="player-name">FabianoC</span>
                    </div>
                    <span class="player-rating">2812 <span class="rating-change rating-up">+8</span></span>
                </li>
                <li>
                    <span class="player-rank">5</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player5.jpg" class="player-avatar">
                        <span class="player-name">LevonA</span>
                    </div>
                    <span class="player-rating">2798 <span class="rating-change rating-down">-3</span></span>
                </li>
                <li>
                    <span class="player-rank">6</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player6.jpg" class="player-avatar">
                        <span class="player-name">WesleyS</span>
                    </div>
                    <span class="player-rating">2785 <span class="rating-change rating-up">+15</span></span>
                </li>
                <li>
                    <span class="player-rank">7</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player7.jpg" class="player-avatar">
                        <span class="player-name">IanN</span>
                    </div>
                    <span class="player-rating">2773 <span class="rating-change rating-up">+7</span></span>
                </li>
            </ul>
        </div>
        
        <!-- RAPID SECTION -->
        <div class="time-control-section">
            <div class="section-header">Rapid</div>
            
            <!-- Top 3 Podium -->
            <div class="podium">
                <div class="podium-place">
                    <div class="podium-stand second-place">2</div>
                    <img src="/storage/avatars/player2.jpg" class="player-avatar">
                    <div class="text-center mt-1">
                        <div class="text-white text-sm">GarryK</div>
                        <div class="text-gray-400 text-xs">2845</div>
                    </div>
                </div>
                
                <div class="podium-place">
                    <div class="podium-stand first-place">1</div>
                    <img src="/storage/avatars/player1.jpg" class="player-avatar">
                    <div class="text-center mt-1">
                        <div class="text-white text-sm">MagnusC</div>
                        <div class="text-gray-400 text-xs">2886</div>
                    </div>
                </div>
                
                <div class="podium-place">
                    <div class="podium-stand third-place">3</div>
                    <img src="/storage/avatars/player3.jpg" class="player-avatar">
                    <div class="text-center mt-1">
                        <div class="text-white text-sm">HikaruN</div>
                        <div class="text-gray-400 text-xs">2832</div>
                    </div>
                </div>
            </div>
            
            <!-- Players 4-7 List -->
            <ul class="player-list">
                <li>
                    <span class="player-rank">4</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player4.jpg" class="player-avatar">
                        <span class="player-name">FabianoC</span>
                    </div>
                    <span class="player-rating">2812 <span class="rating-change rating-up">+8</span></span>
                </li>
                <li>
                    <span class="player-rank">5</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player5.jpg" class="player-avatar">
                        <span class="player-name">LevonA</span>
                    </div>
                    <span class="player-rating">2798 <span class="rating-change rating-down">-3</span></span>
                </li>
                <li>
                    <span class="player-rank">6</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player6.jpg" class="player-avatar">
                        <span class="player-name">WesleyS</span>
                    </div>
                    <span class="player-rating">2785 <span class="rating-change rating-up">+15</span></span>
                </li>
                <li>
                    <span class="player-rank">7</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player7.jpg" class="player-avatar">
                        <span class="player-name">IanN</span>
                    </div>
                    <span class="player-rating">2773 <span class="rating-change rating-up">+7</span></span>
                </li>
            </ul>
        </div>
        
        <!-- CLASSIC SECTION -->
        <div class="time-control-section">
            <div class="section-header">Classic</div>
            
            <!-- Top 3 Podium -->
            <div class="podium">
                <div class="podium-place">
                    <div class="podium-stand second-place">2</div>
                    <img src="/storage/avatars/player2.jpg" class="player-avatar">
                    <div class="text-center mt-1">
                        <div class="text-white text-sm">GarryK</div>
                        <div class="text-gray-400 text-xs">2845</div>
                    </div>
                </div>
                
                <div class="podium-place">
                    <div class="podium-stand first-place">1</div>
                    <img src="/storage/avatars/player1.jpg" class="player-avatar">
                    <div class="text-center mt-1">
                        <div class="text-white text-sm">MagnusC</div>
                        <div class="text-gray-400 text-xs">2886</div>
                    </div>
                </div>
                
                <div class="podium-place">
                    <div class="podium-stand third-place">3</div>
                    <img src="/storage/avatars/player3.jpg" class="player-avatar">
                    <div class="text-center mt-1">
                        <div class="text-white text-sm">HikaruN</div>
                        <div class="text-gray-400 text-xs">2832</div>
                    </div>
                </div>
            </div>
            
            <!-- Players 4-7 List -->
            <ul class="player-list">
                <li>
                    <span class="player-rank">4</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player4.jpg" class="player-avatar">
                        <span class="player-name">FabianoC</span>
                    </div>
                    <span class="player-rating">2812 <span class="rating-change rating-up">+8</span></span>
                </li>
                <li>
                    <span class="player-rank">5</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player5.jpg" class="player-avatar">
                        <span class="player-name">LevonA</span>
                    </div>
                    <span class="player-rating">2798 <span class="rating-change rating-down">-3</span></span>
                </li>
                <li>
                    <span class="player-rank">6</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player6.jpg" class="player-avatar">
                        <span class="player-name">WesleyS</span>
                    </div>
                    <span class="player-rating">2785 <span class="rating-change rating-up">+15</span></span>
                </li>
                <li>
                    <span class="player-rank">7</span>
                    <div class="player-info">
                        <img src="/storage/avatars/player7.jpg" class="player-avatar">
                        <span class="player-name">IanN</span>
                    </div>
                    <span class="player-rating">2773 <span class="rating-change rating-up">+7</span></span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection