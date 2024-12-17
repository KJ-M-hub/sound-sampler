<x-app-layout>
    <x-slot name="slot" class="">
        {{-- modal window --}}
        <div id="modal" class=" fixed top-0 left-0 w-full h-full text-center bg-gray-300 bg-opacity-50 transition box-border invisible">
            <div id="modal-container" class="relative inline-block align-middle top-1/2 -translate-y-1/2 w-full h-full pt-10">
                
                <div id="modal-content" class="relative inline-block w-3/4 h-3/4 bg-white  rounded-md overflow-auto">
                    <div id="modal-close" class="z-10 absolute flex right-3 text-3xl cursor-pointer">×</div>
                    <div class="p-2">
                        @include('recording')
                    </div>
                </div>
            </div>
        </div>
        <div class="min-h-screen flex flex-col max-w-[1000px] mx-auto">
            
            {{-- header --}}
            <header class="bg-gray-600 flex px-0 justify-between items-center">
                <div class="flex-grow flex justify-center">
                    <div class="ml-[6vw] mr-[1vw] max-w-7xl mx-auto py-1 px-1 sm:px-6 lg:px-8 text-2xl sm:text-6xl text-center text-gray-200">
                        SoundSampler
                    </div>
                </div>
                <!-- ハンバーガーメニューのボタン -->
                <button id="hamburger-button" class="block p-2 focus:outline-none text-gray-100">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10 lg:w-12 lg:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>

                <!-- メニュー -->
                <div id="hamburger-menu" class="hidden flex flex-col">
                    <x-dropdown-link :href="route('profile.edit')" class="text-sm sm:text-base md:text-lg lg:text-xl menu-item">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                
                        <x-dropdown-link :href="route('logout')" class="text-sm sm:text-base md:text-lg lg:text-xl menu-item"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>

                <!-- JavaScript for toggling the menu -->
                <script>
                    document.getElementById('hamburger-button').addEventListener('click', function(event) {
                        var menu = document.getElementById('hamburger-menu');
                        var button = document.getElementById('hamburger-button');
                        menu.classList.toggle('hidden');
                        button.classList.toggle('hidden');
                        event.stopPropagation(); // クリックイベントが親要素にバブリングするのを防ぐ
                    });

                    // メニュー項目をクリックした際にメニューを非表示にする
                    document.querySelectorAll('.menu-item').forEach(function(item) {
                        item.addEventListener('click', function() {
                            var menu = document.getElementById('hamburger-menu');
                            var button = document.getElementById('hamburger-button');
                            menu.classList.add('hidden');
                            button.classList.remove('hidden');
                        });
                    });

                    // メニュー項目以外の場所をクリックした際にメニューを非表示にする
                    document.addEventListener('click', function(event) {
                        var menu = document.getElementById('hamburger-menu');
                        var button = document.getElementById('hamburger-button');
                        if (!menu.classList.contains('hidden') && !menu.contains(event.target) && !button.contains(event.target)) {
                            menu.classList.add('hidden');
                            button.classList.remove('hidden');
                        }
                    });
                </script>
                
            </header>
            
            {{-- main content --}}
            <div class="flex-grow">
                {{-- sound button --}}
                @php
                    $keyMap = [
                        1 => '1',
                        2 => '2',
                        3 => 'Q',
                        4 => 'W',
                        5 => 'A',
                        6 => 'S',
                        7 => 'Z',
                        8 => 'X'
                    ];
                @endphp
                <div class="grid grid-cols-2 gap-2 place-items-stretch">
                    @for ($i = 1; $i <= 8; $i++)
                        <div  class="flex items-center justify-center mx-2 my-1 md:mt-8 lg:mt-10 sound-button" data-key="{{ $i }}" data-sound-id="">
                            <div id="soundBtm-{{ $i }}" class="w-2/3 h-auto md:w-1/2 bg-teal-500 shadow-lg shadow-teal-500/50 border-4 border-gray-50 border-double rounded aspect-square min-w-28 max-w-48">
                                <div class="w-1/3 m-1 mb-3 p-1 bg-gray-300 rounded text-wrap">
                                    <p class="text-xl text-center">{{ $keyMap[$i] }}</p>
                                    <p class="text-center">key</p>
                                </div>
                                <div class="text-center truncate"><Q id="title-sound{{ $i }}">Loading...</Q></div>
                                <audio id="audio-sound{{ $i }}" class="hidden"></audio>
                            </div>
                        </div>
                    @endfor
                </div>

            {{-- footer --}}
            <footer class="flex justify-between p-1 ">
                <div class="flex-1 flex justify-end pr-12 sm:pr-24">
                    <a  class="open-modal cursor-pointer">
                        <img src="{{ asset('Pasted Graphic.png') }}" class="w-14 h-auto md:w-24 " alt="Description of image">
                    </a>
                </div>
                <div class="flex-1 flex justify-start pl-12 sm:pl-24">
                    <a class="cursor-pointer" href="{{ route('user-sounds') }}">
                        <img src="{{ asset('Pasted Graphic 2.png') }}" class="w-14 h-auto md:w-24 " alt="Description of image">
                    </a>
                </div>
            </footer>
        </div>
        <script src="{{asset('js/modal.js')}}"></script>
        <script src="{{asset('js/play-sound.js')}}"></script>
    </x-slot>
</x-app-layout>

