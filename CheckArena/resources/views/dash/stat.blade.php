@extends('dash/dashboard')

@section('title', 'CheckArena - Game History')

@push('styles')

<style>
    .chartStyle {
        width: 350px !important;
        height: 350px !important;
    }
    </style>

@endpush



@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@endpush
@section('dashboard-content')
<div class="mb-6">
  <h1 class="text-2xl text-[#4ca9f5] mb-2.5">Games Stats</h1>
</div>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-7">
  <div class="bg-[#262626] rounded-lg p-5 flex flex-col items-center text-center">
    <div class="text-sm text-gray-400">Total Games</div>
    <div class="text-3xl font-bold my-2.5">{{$total}}</div>
    <div class="text-sm text-gray-400">Lifetime</div>
  </div>
  
  <div class="bg-[#262626] rounded-lg p-5 flex flex-col items-center text-center">
    <div class="text-sm text-gray-400">Wins</div>
    <div class="text-3xl font-bold my-2.5 text-[#4caf50]">{{$wins}}</div>
    <div class="text-sm text-gray-400">{{$winPercentage}}%</div>
  </div>
  
  <div class="bg-[#262626] rounded-lg p-5 flex flex-col items-center text-center">
    <div class="text-sm text-gray-400">Losses</div>
    <div class="text-3xl font-bold my-2.5 text-[#f44336]">{{$losses}}</div>
    <div class="text-sm text-gray-400">{{$lossPercentage}}%</div>
  </div>
  
  <div class="bg-[#262626] rounded-lg p-5 flex flex-col items-center text-center">
    <div class="text-sm text-gray-400">Draws</div>
    <div class="text-3xl font-bold my-2.5 text-[#ff9800]">{{$draws}}</div>
    <div class="text-sm text-gray-400">{{$drawPercentage}}%</div>
  </div>
</div>


<div class="flex justify-between items-center mb-6">

    <div>
        <label for="wins_and_losses_draws">All Games Stats</label>

        <canvas id="myChart"  class="chartStyle"></canvas>
        
    </div>
    <div>
        <label for="wins">Wins</label>
        <canvas id="winsChart" class="chartStyle"></canvas>
        
        
    </div>
    
    <div>

          <label for="losses">Loses</label>
        <canvas id="lossesChart" class="chartStyle"></canvas>
    </div>
    
</div>




@push('scripts')



<script>
    const ctx = document.getElementById('myChart').getContext('2d');

    const myChart = new Chart(ctx, {
        type: 'doughnut', 
        data: {
            labels: ['Wins', 'Losses', 'Draws'],
            datasets: [{
                data: [{{ $wins }}, {{ $losses }}, {{ $draws }}],
                backgroundColor: [
    'rgba(26, 37, 58, 0.7)',   // Wins color (softer dark navy)
    'rgba(239, 83, 80, 0.7)',  // Losses color (softer red)
    'rgba(102, 187, 106, 0.7)' // Draws color (softer green)
],

                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });


    const winsCtx = document.getElementById('winsChart').getContext('2d');
    const winsChart = new Chart(winsCtx, {
        type: 'doughnut', 
        data: {
            labels: ['Resign', 'Timeout', 'Checkmate'],
            datasets: [{
                data: [{{ $winsByResign }}, {{ $winsByTimeout }}, {{ $winsByCheckmate }}],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.7)',    
                    'rgba(255, 159, 64, 0.7)',    
                    'rgba(54, 162, 235, 0.7)'     
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    const lossesCtx = document.getElementById('lossesChart').getContext('2d');
    const lossesChart = new Chart(lossesCtx, {
        type: 'doughnut', 
        data: {
            labels: ['Resign', 'Timeout', 'Checkmate'],
            datasets: [{
                data: [{{ $lossesByResign }}, {{ $lossesByTimeout }}, {{ $lossesByCheckmate }}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',    
                    'rgba(255, 159, 64, 0.7)',    
                    'rgba(54, 162, 235, 0.7)'     
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>


@endpush






@endsection


@push('scripts')

<script>

    let Pname =  @json($playerName);

    const playerInfo = {
        name: Pname ,
        id: {{$playerId}},
        rating: {{$playerElo}}
    };
    console.log(playerInfo);
    

    localStorage.setItem('Info', JSON.stringify(playerInfo));
</script>

@endpush
    

