@extends('app')

@section('title', 'CheckArena - Play Online Chess')
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/colyseus.js@0.16.3/dist/colyseus.js"></script>
@endpush

@push('styles')
  
    
    @vite('resources/css/game/game.css')
@endpush

@section('content')

  <div id="gameStatus"  class="text-xl">none</div>

    <div class="h-[calc(100%-70px)] w-[94%] ml-[-10px] block min-[1100px]:flex min-[1100px]:flex-row-reverse items-center gap-[2%] pt-5 max-[750px]:w-full ">
        <section class="w-[73%] h-[100%] mb-2   flex justify-center items-center  max-[1100px]:w-full  max-[750px]:w-full  max-[750px]:flex-col">
            <div class="  h-auto w-[64%] -mt-6  min-[750px]:hidden">
                <div class="flex items-center p-2.5 bg-[#2a2a2a] rounded">
                    <div class="w-10 h-10 rounded-full bg-blue-500 mr-4 flex justify-center items-center text-white font-bold">
                        M
                    </div>
                    <div class="flex flex-col justify-center h-full w-auto">
                        <span id="apponent_name" class="font-bold text-base text-white max-[750px]:text-xs">MagnusCarlsen</span>
                        <span id="apponent_rating" class="text-gray-400 text-sm">2863</span>
                    </div>
                    <div id="apponent_time-short" class="bg-[#2a2a2a] p-2.5 text-center text-2xl font-semibold rounded ml-auto text-white h-auto w-auto min-w-[70px] max-[750px]:text-sm max-[750px]:p-1">
                        00:00
                    </div>
                </div>
            </div>


            <div class="w-[60%] h-9/10 mb-3 flex flex-col relative max-[750px]:w-[80%]  max-[400px]:w-[100%]"> 
                <div class="w-full h-auto aspect-square relative mx-auto">
                    <div class="chess-board relative bg-[url('https://images.chesscomfiles.com/chess-themes/boards/icy_sea/200.png')] bg-no-repeat bg-cover m-auto grid grid-cols-8 grid-rows-8 w-[90%] aspect-square border-2 border-black rounded" id=board>
                        <div class="absolute inset-0 pointer-events-none z-0">
                        <svg class="numLett" viewBox="0 0 100 100" class="coordinates"><text x="0.75" y="3.5" font-size="2.8" class="coordinate-light">8</text><text x="0.75" y="15.75" font-size="2.8" class="coordinate-dark">7</text><text x="0.75" y="28.25" font-size="2.8" class="coordinate-light">6</text><text x="0.75" y="40.75" font-size="2.8" class="coordinate-dark">5</text><text x="0.75" y="53.25" font-size="2.8" class="coordinate-light">4</text><text x="0.75" y="65.75" font-size="2.8" class="coordinate-dark">3</text><text x="0.75" y="78.25" font-size="2.8" class="coordinate-light">2</text><text x="0.75" y="90.75" font-size="2.8" class="coordinate-dark">1</text><text x="10" y="99" font-size="2.8" class="coordinate-dark">a</text><text x="22.5" y="99" font-size="2.8" class="coordinate-light">b</text><text x="35" y="99" font-size="2.8" class="coordinate-dark">c</text><text x="47.5" y="99" font-size="2.8" class="coordinate-light">d</text><text x="60" y="99" font-size="2.8" class="coordinate-dark">e</text><text x="72.5" y="99" font-size="2.8" class="coordinate-light">f</text><text x="85" y="99" font-size="2.8" class="coordinate-dark">g</text><text x="97.5" y="99" font-size="2.8" class="coordinate-light">h</text></svg>
                    </div>
                    </div>
                </div>
            </div>
            <div class="  h-auto w-[64%] -mt-12  min-[750px]:hidden">
                <div class="flex items-center p-2.5 bg-[#2a2a2a] rounded">
                    <div class="w-10 h-10 rounded-full bg-blue-500 mr-4 flex justify-center items-center text-white font-bold">
                        M
                    </div>
                    <div class="flex flex-col justify-center h-full w-auto">
                        <span id="apponent_name" class="font-bold text-base text-white max-[750px]:text-xs">Hikaru</span>
                        <span id="apponent_rating" class="text-gray-400 text-sm">2863</span>
                    </div>
                    <div id="My_time-short" class="bg-[#2a2a2a] p-2.5 text-center text-2xl font-semibold rounded ml-auto text-white h-auto w-auto min-w-[70px] max-[750px]:text-sm max-[750px]:p-1">
                        00:00
                    </div>
                </div>
            </div>
            {{-- h-[500px] --}}
            <div id="infoContainer" class="mb-3 w-[36%] min-h-[300px] max-h-[500px] bg-[#1e1e1e] p-2.5 flex flex-col gap-8 rounded max-[750px]:min-h-[80px]  max-[750px]:min-h-[40px] max-[750px]:max-h-[150px] max-[750px]:w-[70%]  ">
                <div class="h-auto w-full max-[750px]:hidden">
                    <div class="flex items-center p-2.5 bg-[#2a2a2a] rounded">
                        <div class="w-10 h-10 rounded-full bg-blue-500 mr-4 flex justify-center items-center text-white font-bold">
                            M
                        </div>
                        <div class="flex flex-col justify-center h-full w-auto">
                            <span id="apponent_nameFull" class="font-bold text-base text-white max-[750px]:text-xs">MagnusCarlsen</span>
                            <span id="apponent_ratingFull" class="text-gray-400 text-sm">2863</span>
                        </div>
                        <div id="apponent_time" class="bg-[#2a2a2a] p-2.5 text-center text-2xl font-semibold rounded ml-auto text-white h-auto w-auto min-w-[70px] max-[750px]:text-sm max-[750px]:p-1">
                            00:00
                        </div>
                    </div>
                </div>

                
                
                <div id="game_moves" class="flex-1 bg-[#2a2a2a] rounded shadow-[0px_0px_2px_1px_#2980b9] p-2.5 overflow-y-auto h-[400px] w-full hidden  max-[750px]:h-[150px]">
                    
                   
                </div> 
                
                <div id="game_buttons" class="  flex justify-evenly gap-2.5 mt-0.5 h-6 hidden">
                    <button id="resignBtn" class="flex items-center justify-center bg-red-500 text-white cursor-pointer rounded py-4 px-4 text-sm h-full w-[40%]">
                        Resign
                    </button>
                    <button class="flex items-center justify-center bg-transparent border border-blue-500 text-white cursor-pointer rounded py-4 px-4 text-sm h-full w-[40%] hover:bg-[#2a2a2a]">
                        Offer Draw
                    </button>
                </div>
                <div id='startGameContainer' class=" bg-[#2a2a2a] rounded shadow-[0px_0px_2px_1px_#2980b9] p-2.5 overflow-y-auto h-90px  w-full  ">
                     <button id="startGame" class="rounded bg-blue-500 text-white py-2 px-4 text-sm h-full w-full hover:bg-blue-900 pointer">

                        create game

                     </button>
                </div>

                
                <div class="h-auto w-full max-[750px]:hidden">
                    <div class="flex items-center p-2.5 bg-[#2a2a2a] rounded">
                        <div class="w-10 h-10 rounded-full bg-blue-500 mr-4 flex justify-center items-center text-white font-bold">
                            H
                        </div>
                        <div class="flex flex-col justify-center h-full w-auto">
                            <span class="font-bold text-base text-white">Hikaru</span>
                            <span class="text-gray-400 text-sm">2775</span>
                        </div>
                        <div id="My_time" class="bg-[#2a2a2a] p-2.5 text-center text-2xl font-semibold rounded ml-auto text-white h-auto w-auto min-w-[70px]">
                            00:00
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="w-[20%] h-[100%] bg-[#1e1e1e] flex flex-col gap-[2%] rounded max-[1100px]:w-[50%] max-[1100px]:h-[500px] max-[1100px]:w-[100%]">
            <div class="bg-[#2a2a2a] h-[90px] w-full rounded-t p-4 flex flex-col justify-center border-b border-[#333]">
                <div class="text-lg font-semibold mb-1 h-auto w-auto">Blitz Chess</div>
                <div class="flex items-center h-auto w-auto">
                    <div class="w-5 h-5 mr-1 bg-blue-500 rounded-full flex items-center justify-center text-xs">⏱</div>
                    <div class="text-sm text-gray-400 h-auto w-auto">5+1 • Rated</div>
                </div>
            </div>

            <div class="bg-[#1e1e1e] h-[500px] w-[100%] rounded-b flex flex-col">
                <div id="chatContainer" class="flex-1 overflow-y-auto p-4">
                    <div class="mb-4 py-1 h-auto w-full">
                        <span class="font-semibold mr-2 h-auto w-auto block mb-1">System :</span>
                        <span class="h-auto w-auto">gmae started</span>
                    </div>
                    
                </div>
                <div class="h-[50px] w-full flex p-2.5 border-t border-[#333]">
                    <input  id="chatInput" type="text" placeholder="Type a message..." class="w-[75%] px-1 border-none rounded bg-[#2a2a2a] text-white mr-2 h-[80%]">
                    <button id="chatButton" class="bg-blue-500 border-none text-white  py-0 px-1 rounded cursor-pointer h-[90%] w-[20%] hover:bg-blue-600">
                        Send
                    </button>
                </div>
            </div>
        </section>
    </div>
    <div id="promotion-popup" class="promotion-popup hidden">
        <img data-value="5" src="" alt="Queen" />
        <img data-value="2" src="" alt="Rook" />
        <img data-value="4" src="" alt="Bishop" />
        <img data-value="3" src="" alt="Knight" />
      </div>
      


      <div id="notificationBar" style="
    position: fixed;
    top: -100px;
    left: 0;
    width: 100%;
    background-color: #4CAF50;
    color: white;
    text-align: center;
    padding: 1rem;
    font-weight: bold;
    transition: top 0.4s ease;
    z-index: 9999;
">
    <span id="notificationMessage"></span>
</div>


<div id="gameOverPopup" class="fixed top-0 left-0 w-full h-full   flex items-center justify-center z-50 hidden">
    <div class="bg-[#1e1e1e] text-white rounded-xl p-6 w-[90%] max-w-md shadow-lg text-center">
      <h2 id="gameOverTitle" class="text-2xl font-bold mb-2">Game Over</h2>
      <p id="gameOverReason" class="text-gray-400 text-lg mb-4">Reason goes here...</p>
      <button id="closeGameOverPopup" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
        Close
      </button>
    </div>
  </div>
  



  <div id="createGamePopup" class="fixed top-0 left-0 w-full h-full flex items-center justify-center z-50  bg-black/60 hidden">
    <div class="w-[30%] bg-[#1e1e1e] p-6 rounded shadow-lg flex flex-col gap-4">
        <button data-time="1" class="bg-gray-800 text-white p-2 rounded hover:bg-gray-700">Bullet: 1 min</button>
        <button data-time="3" class="bg-gray-800 text-white p-2 rounded hover:bg-gray-700">Blitz: 3 min</button>
        <button data-time="10" class="bg-gray-800 text-white p-2 rounded hover:bg-gray-700">Rapid: 10 min</button>
        <button data-time="15" class="bg-gray-800 text-white p-2 rounded hover:bg-gray-700">Classic: 15 min</button>

        <button id="cancelPopUp" class="m-4 bg-red-800 rounded"> cancel</button>
    </div>
    
   
  </div>


    @push('scripts')
    @vite('resources/js/game/game.js')
    @endpush

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

    
    
@endsection