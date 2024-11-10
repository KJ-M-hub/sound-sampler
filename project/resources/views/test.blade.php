<x-app-layout>
    

    <x-slot name="slot" class="">
        <div class="min-h-screen flex flex-col">
            <header class="bg-white dark:bg-gray-400 shadow">
                <div class="max-w-7xl mx-auto py-1 px-1 sm:px-6 lg:px-8 text-2xl md:text-6xl text-center">
                    SoundSampler
                </div>
            </header>
            <div class="flex-grow">
                {{-- sound button --}}
                <div class="grid grid-cols-2 gap-4 place-items-stretch">

                    <div id="soundBtm-1" class="flex items-center  justify-end mx-4 my-2 md:mt-8 lg:mt-10">
                        <div class="w-2/3 h-auto md:w-1/2 bg-red-400 border-4 border-gray-50 border-double rounded aspect-square min-w-28 max-w-56">
                            <div class="w-1/3 m-1 mb-3 p-1 bg-gray-300 rounded text-wrap">
                                <p class="text-xl text-center">1</p>
                                <p class="text-center">key</p>
                            </div>
                            <div class="text-center truncate"><Q>sounds->title111111</Q></div>
                        </div>
                    </div>
                    
                    <div id="soundBtm-2" class="flex items-center  justify-start mx-4 my-2 md:mt-8 lg:mt-10">
                        <div class="w-2/3 h-auto md:w-1/2 bg-red-400 border-4 border-gray-50 border-double rounded aspect-square min-w-28 max-w-56">
                            <div class="w-1/3 m-1 mb-3 p-1 bg-gray-300 rounded text-wrap">
                                <p class="text-xl text-center">2</p>
                                <p class="text-center">key</p>
                            </div>
                            <div class="text-center truncate"><Q>sounds->title111111</Q></div>
                        </div>
                    </div>

                    <div id="soundBtm-3" class="flex items-center  justify-end mx-4 my-2">
                        <div class="w-2/3 h-auto md:w-1/2 bg-red-400 border-4 border-gray-50 border-double rounded aspect-square min-w-28 max-w-56">
                            <div class="w-1/3 m-1 mb-3 p-1 bg-gray-300 rounded text-wrap">
                                <p class="text-xl text-center">Q</p>
                                <p class="text-center">key</p>
                            </div>
                            <div class="text-center truncate"><Q>sounds->title111111</Q></div>
                        </div>
                    </div>
                    
                    <div id="soundBtm-4" class="flex items-center  justify-start mx-4 my-2">
                        <div class="w-2/3 h-auto md:w-1/2 bg-red-400 border-4 border-gray-50 border-double rounded aspect-square min-w-28 max-w-56">
                            <div class="w-1/3 m-1 mb-3 p-1 bg-gray-300 rounded text-wrap">
                                <p class="text-xl text-center">W</p>
                                <p class="text-center">key</p>
                            </div>
                            <div class="text-center truncate"><Q>sounds->title111111</Q></div>
                        </div>
                    </div>

                    <div id="soundBtm-5" class="flex items-center  justify-end mx-4 my-2">
                        <div class="w-2/3 h-auto md:w-1/2 bg-red-400 border-4 border-gray-50 border-double rounded aspect-square min-w-28 max-w-56">
                            <div class="w-1/3 m-1 mb-3 p-1 bg-gray-300 rounded text-wrap">
                                <p class="text-xl text-center">A</p>
                                <p class="text-center">key</p>
                            </div>
                            <div class="text-center truncate"><Q>sounds->title111111</Q></div>
                        </div>
                    </div>
                    
                    <div id="soundBtm-6" class="flex items-center  justify-start mx-4 my-2">
                        <div class="w-2/3 h-auto md:w-1/2 bg-red-400 border-4 border-gray-50 border-double rounded aspect-square min-w-28 max-w-56">
                            <div class="w-1/3 m-1 mb-3 p-1 bg-gray-300 rounded text-wrap">
                                <p class="text-xl text-center">S</p>
                                <p class="text-center">key</p>
                            </div>
                            <div class="text-center truncate"><Q>sounds->title111111</Q></div>
                        </div>
                    </div>

                    <div id="soundBtm-7" class="flex items-center  justify-end mx-4 my-2">
                        <div class="w-2/3 h-auto md:w-1/2 bg-red-400 border-4 border-gray-50 border-double rounded aspect-square min-w-28 max-w-56">
                            <div class="w-1/3 m-1 mb-3 p-1 bg-gray-300 rounded text-wrap">
                                <p class="text-xl text-center">Z</p>
                                <p class="text-center">key</p>
                            </div>
                            <div class="text-center truncate"><Q>sounds->title111111</Q></div>
                        </div>
                    </div>
                    
                    <div id="soundBtm-8" class="flex items-center  justify-start mx-4 my-2">
                        <div class="w-2/3 h-auto md:w-1/2 bg-red-400 border-4 border-gray-50 border-double rounded aspect-square min-w-28 max-w-56">
                            <div class="w-1/3 m-1 mb-3 p-1 bg-gray-300 rounded text-wrap">
                                <p class="text-xl text-center">X</p>
                                <p class="text-center">key</p>
                            </div>
                            <div class="text-center truncate"><Q>sounds->title111111</Q></div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- footer --}}
            <footer class="flex justify-between border p-1 ">
                <div class="flex-1 flex justify-end pr-12 sm:pr-24" id="recording">
                    <a href="{{asset('Pasted Graphic.png')}}">
                        <img src="{{ asset('Pasted Graphic.png') }}" class="w-14 h-auto md:w-24 " alt="Description of image">
                    </a>
                </div>
                <div class="flex-1 flex justify-start pl-12 sm:pl-24" id="soundData">
                    <a href="{{asset('Pasted Graphic 2.png')}}">
                        <img src="{{ asset('Pasted Graphic 2.png') }}" class="w-14 h-auto md:w-24 " alt="Description of image">
                    </a>
                </div>
            </footer>
        </div>
    </x-slot>
</x-app-layout>

{{-- <div name="grid-item" class="w-1/2 h-24 m-5 border-4 border-gray-50 border-double rounded">
    <div name="square" class=" bg-red-400">aaa</div>
</div> --}}