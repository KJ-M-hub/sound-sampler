<x-app-layout>
    

    <x-slot name="slot" class="">
        {{-- modal window --}}
        <div id="modal" class=" fixed top-0 left-0 w-full h-full text-center bg-gray-300 bg-opacity-50 transition box-border invisible">
            <div id="modal-container" class="relative inline-block align-middle top-1/2 -translate-y-1/2 w-full h-full pt-10">
            <div id="modal-close" class="z-10 absolute flex justify-center top-8 right-12 text-3xl">×</div>
            <div id="modal-content" class="relative inline-block w-3/4 h-3/4 bg-white  rounded-md">
                @include('recording') <!-- recording.blade.phpの内容を挿入 -->
            </div>
            </div>
        </div>
        <div class="min-h-screen flex flex-col">
            
        {{-- header --}}
        <header class="bg-white dark:bg-gray-400 shadow flex px-0">
            <div class="grow">
                <div class=" pl-24 max-w-7xl mx-auto py-1 px-1 sm:px-6 lg:px-8 text-2xl md:text-6xl text-center">
                    SoundSampler
                </div>
            </div>
            <div class="">
                <x-dropdown-link :href="route('profile.edit')" class="">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
        </header>
        
        {{-- main content --}}
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
            <div class="flex-1 flex justify-end pr-12 sm:pr-24">
                <a id="open-modal">
                    <img src="{{ asset('Pasted Graphic.png') }}" class="w-14 h-auto md:w-24 " alt="Description of image">
                </a>
            </div>
            <div class="flex-1 flex justify-start pl-12 sm:pl-24">
                <a>
                    <img src="{{ asset('Pasted Graphic 2.png') }}" class="w-14 h-auto md:w-24 " alt="Description of image">
                </a>
            </div>
        </footer>
        <script src="{{asset('js/modal.js')}}"></script>
    </x-slot>
</x-app-layout>

{{-- <div name="grid-item" class="w-1/2 h-24 m-5 border-4 border-gray-50 border-double rounded">
    <div name="square" class=" bg-red-400">aaa</div>
</div> --}}