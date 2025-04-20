@extends('app')

@section('title', 'CheckArena - Play Online Chess')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@endpush

@section('content')
    <div class="h-[calc(100%-70px)] w-[94%] ml-[-10px] block min-[1100px]:flex min-[1100px]:flex-row-reverse items-center gap-[2%] pt-5 ">
        <section class="w-[73%] h-[100%]  flex justify-center items-center  max-[1100px]:w-full">
            <div class="w-[60%] h-9/10  flex flex-col relative">
                <div class="w-full h-auto aspect-square relative mx-auto">
                    <div class="chess-board relative bg-[url('https://images.chesscomfiles.com/chess-themes/boards/icy_sea/200.png')] bg-no-repeat bg-cover m-auto grid grid-cols-8 grid-rows-8 w-[90%] aspect-square border-2 border-black rounded" id=board>
                        <div class="absolute inset-0 pointer-events-none z-0">
                        <svg class="numLett" viewBox="0 0 100 100" class="coordinates"><text x="0.75" y="3.5" font-size="2.8" class="coordinate-light">8</text><text x="0.75" y="15.75" font-size="2.8" class="coordinate-dark">7</text><text x="0.75" y="28.25" font-size="2.8" class="coordinate-light">6</text><text x="0.75" y="40.75" font-size="2.8" class="coordinate-dark">5</text><text x="0.75" y="53.25" font-size="2.8" class="coordinate-light">4</text><text x="0.75" y="65.75" font-size="2.8" class="coordinate-dark">3</text><text x="0.75" y="78.25" font-size="2.8" class="coordinate-light">2</text><text x="0.75" y="90.75" font-size="2.8" class="coordinate-dark">1</text><text x="10" y="99" font-size="2.8" class="coordinate-dark">a</text><text x="22.5" y="99" font-size="2.8" class="coordinate-light">b</text><text x="35" y="99" font-size="2.8" class="coordinate-dark">c</text><text x="47.5" y="99" font-size="2.8" class="coordinate-light">d</text><text x="60" y="99" font-size="2.8" class="coordinate-dark">e</text><text x="72.5" y="99" font-size="2.8" class="coordinate-light">f</text><text x="85" y="99" font-size="2.8" class="coordinate-dark">g</text><text x="97.5" y="99" font-size="2.8" class="coordinate-light">h</text></svg>
                    </div>
                    </div>
                </div>
            </div>

            <div class="w-[36%] h-[95%] bg-[#1e1e1e] p-2.5 flex flex-col gap-8 rounded max-[1100px]:h-[500px]">
                <div class="h-auto w-full">
                    <div class="flex items-center p-2.5 bg-[#2a2a2a] rounded">
                        <div class="w-10 h-10 rounded-full bg-blue-500 mr-4 flex justify-center items-center text-white font-bold">
                            M
                        </div>
                        <div class="flex flex-col justify-center h-full w-auto">
                            <span class="font-bold text-base text-white">MagnusCarlsen</span>
                            <span class="text-gray-400 text-sm">2863</span>
                        </div>
                        <div class="bg-[#2a2a2a] p-2.5 text-center text-2xl font-semibold rounded ml-auto text-white h-auto w-auto min-w-[70px]">
                            4:23
                        </div>
                    </div>
                </div>
                
                <div class="flex-1 bg-[#2a2a2a] rounded shadow-[0px_0px_2px_1px_#2980b9] p-2.5 overflow-y-auto h-full w-full ">
                    <div class="flex mb-2 h-auto w-full">
                        <span class="text-gray-400 mr-2.5 w-6 h-auto">1.</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">e4</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">e5</span>
                    </div>
                    <div class="flex mb-2 h-auto w-full">
                        <span class="text-gray-400 mr-2.5 w-6 h-auto">2.</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">Nf3</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">Nc6</span>
                    </div>
                    <div class="flex mb-2 h-auto w-full">
                        <span class="text-gray-400 mr-2.5 w-6 h-auto">3.</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">Bb5</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">a6</span>
                    </div>
                    <div class="flex mb-2 h-auto w-full">
                        <span class="text-gray-400 mr-2.5 w-6 h-auto">4.</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">Ba4</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">Nf6</span>
                    </div>
                    <div class="flex mb-2 h-auto w-full">
                        <span class="text-gray-400 mr-2.5 w-6 h-auto">5.</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">O-O</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">Be7</span>
                    </div>
                    <div class="flex mb-2 h-auto w-full">
                        <span class="text-gray-400 mr-2.5 w-6 h-auto">6.</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">Re1</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">b5</span>
                    </div>
                    <div class="flex mb-2 h-auto w-full">
                        <span class="text-gray-400 mr-2.5 w-6 h-auto">7.</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">Bb3</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">d6</span>
                    </div>
                    <div class="flex mb-2 h-auto w-full">
                        <span class="text-gray-400 mr-2.5 w-6 h-auto">8.</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">c3</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">O-O</span>
                    </div>
                    <div class="flex mb-2 h-auto w-full">
                        <span class="text-gray-400 mr-2.5 w-6 h-auto">9.</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded h-auto w-auto hover:bg-[#333]">h3</span>
                        <span class="mr-2.5 cursor-pointer py-0.5 px-1.5 rounded bg-blue-500 text-white h-auto w-auto hover:bg-[#333]">Na5</span>
                    </div>
                </div>
                
                <div class="flex justify-evenly gap-2.5 mt-0.5 h-6">
                    <button class="flex items-center justify-center bg-red-500 text-white cursor-pointer rounded py-4 px-4 text-sm h-full w-[40%]">
                        Resign
                    </button>
                    <button class="flex items-center justify-center bg-transparent border border-blue-500 text-white cursor-pointer rounded py-4 px-4 text-sm h-full w-[40%] hover:bg-[#2a2a2a]">
                        Offer Draw
                    </button>
                </div>
                
                <div class="h-auto w-full">
                    <div class="flex items-center p-2.5 bg-[#2a2a2a] rounded">
                        <div class="w-10 h-10 rounded-full bg-blue-500 mr-4 flex justify-center items-center text-white font-bold">
                            H
                        </div>
                        <div class="flex flex-col justify-center h-full w-auto">
                            <span class="font-bold text-base text-white">Hikaru</span>
                            <span class="text-gray-400 text-sm">2775</span>
                        </div>
                        <div class="bg-[#2a2a2a] p-2.5 text-center text-2xl font-semibold rounded ml-auto text-white h-auto w-auto min-w-[70px]">
                            3:51
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="w-[20%] h-[100%] bg-[#1e1e1e] flex flex-col gap-[2%] rounded max-[1100px]:w-[50%] max-[1100px]:h-[500px]">
            <div class="bg-[#2a2a2a] h-[90px] w-full rounded-t p-4 flex flex-col justify-center border-b border-[#333]">
                <div class="text-lg font-semibold mb-1 h-auto w-auto">Blitz Chess</div>
                <div class="flex items-center h-auto w-auto">
                    <div class="w-5 h-5 mr-1 bg-blue-500 rounded-full flex items-center justify-center text-xs">⏱</div>
                    <div class="text-sm text-gray-400 h-auto w-auto">5+1 • Rated</div>
                </div>
            </div>

            <div class="bg-[#1e1e1e] h-[500px] w-[100%] rounded-b flex flex-col">
                <div class="flex-1 overflow-y-auto p-4">
                    <div class="mb-4 py-1 h-auto w-full">
                        <span class="font-semibold mr-2 h-auto w-auto block mb-1">MagnusCarlsen:</span>
                        <span class="h-auto w-auto">gl hf</span>
                    </div>
                    <div class="mb-4 py-1 h-auto w-full">
                        <span class="font-semibold mr-2 h-auto w-auto block mb-1">Hikaru:</span>
                        <span class="h-auto w-auto">you too</span>
                    </div>
                </div>
                <div class="h-[50px] w-full flex p-2.5 border-t border-[#333]">
                    <input type="text" placeholder="Type a message..." class="w-[75%] px-1 border-none rounded bg-[#2a2a2a] text-white mr-2 h-[80%]">
                    <button class="bg-blue-500 border-none text-white  py-0 px-1 rounded cursor-pointer h-[90%] w-[20%] hover:bg-blue-600">
                        Send
                    </button>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
    @vite('resources/js/game/game.js')
    @endpush
    
    
@endsection