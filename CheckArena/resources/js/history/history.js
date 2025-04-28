document.addEventListener('DOMContentLoaded', function () {
    
     


   

    fetchHistory(1); // Load history on page load
});


 function fetchHistory(num) {
        fetch(`/api/getHistory/1/${num}`)
            .then(response => response.json())
            .then(data => {
               
                renderGameHistory(data);
                // Loop over the fetched game data (data.res is the array of games)
                data.res
            }).catch(error => console.error('Error fetching history:', error));
  }

function renderGameHistory(data) {
    let gamesHistory = document.getElementById('tableH');
    
    
    console.log(data.res);
    
    data.res.forEach(game => {
        const gameItem = document.createElement('div');
        gameItem.classList.add(
            'grid', 
            'grid-cols-7', 
            'min-[768px]:grid-cols-4', 
            'lg:grid-cols-6', 
            'py-4', 
            'px-5', 
            'border-b', 
            'border-[#333]', 
            'transition-colors', 
            'hover:bg-[rgba(255,255,255,0.05)]', 
            'cursor-pointer'
        );
    
        const formattedDate = new Date(game.created_at).toLocaleString();
        const isWin = game.winner === game.white_player;  // win if white_player wins
        const resultClass = isWin ? 'text-green-400' : 'text-red-400';
        const ratingChange = isWin ? `+${game.move_count * 2}` : `-${game.move_count * 2}`;
        
        gameItem.innerHTML = `
            <div class="flex items-center text-sm">${formattedDate}</div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center overflow-hidden">
                    ${game.opponent_avatar ? 
                      `<img src="${game.opponent_avatar}" alt="${game.opponent_name}" class="w-full h-full object-cover">` :
                      `<span class="text-xs font-semibold">${game.opponent_name.slice(0, 2).toUpperCase()}</span>`}
                </div>
                <div>
                    <div class="text-sm font-medium">${game.opponent_name}</div>
                    <div class="text-xs opacity-70">${game.opponent_elo}</div>
                </div>
            </div>
            <div class="hidden min-[768px]:flex items-center text-sm">${game.timeControl} min</div>
            <div class="hidden min-[768px]:flex items-center ${resultClass} text-sm">${isWin ? 'Win' : 'Loss'} (${game.partie_status})</div>
            <div class="hidden lg:flex items-center ${resultClass} text-sm font-medium">${ratingChange}</div>
            <div class="hidden lg:flex items-center text-sm">${game.move_count} moves</div>
        `;
        
        gamesHistory.appendChild(gameItem);
    });



    
}
    
   


function paginBtn(btNnum){


    let btn = document.getElementById('pagine') ; 


    for (let index = 0; index < array.length; index++) {
       
        let button = document.createElement('button');
        button.classList.add('w-9 h-9 flex justify-center items-center rounded border border-[#333] bg-[#4ca9f5] text-white cursor-pointer transition-all');
        button.textContent = index;
        btn.insertAdjacentElement( )
    }


    `<div class="w-9 h-9 flex justify-center items-center rounded border border-[#333] bg-[#4ca9f5] text-white cursor-pointer transition-all"></div>`



}