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
                    <div class="chess-board relative bg-[url('https://images.chesscomfiles.com/chess-themes/boards/icy_sea/200.png')] bg-no-repeat bg-cover m-auto grid grid-cols-8 grid-rows-8 w-[90%] aspect-square border-2 border-black rounded">
                        <!-- Chess board squares will be generated here -->
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
                
               
            </div>
        </section>
        
       
    </div>
    
    
@endsection