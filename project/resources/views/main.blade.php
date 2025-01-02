<x-app-layout>
    <x-slot name="slot" class="">
            
        {{-- main content --}}
        <div class="flex flex-col max-w-[1000px] mx-auto">
            {{-- modal window --}}
            <div id="modal" class=" fixed top-0 left-0 w-full h-full text-center bg-gray-300 bg-opacity-50 transition box-border invisible">
                <div id="modal-container" class="relative inline-block align-middle top-1/2 -translate-y-1/2 w-full h-full pt-10">
                    <div id="modal-content" class="relative inline-block w-3/4 h-3/4 bg-gray-300  rounded-md overflow-auto">
                        <div id="modal-close" class="z-10 absolute flex right-3 text-3xl cursor-pointer">×</div>
                        <div class="p-2">
                            @include('recording')
                        </div>
                    </div>
                </div>
            </div>
            {{-- header --}}
            <header class="bg-gray-900 flex px-0 justify-between">
               
                <div class="mx-auto pl-8  text-5xl sm:text-6xl sm:pl-16 md:text-7xl md:pl-16 text-gray-200 lobster-regular">
                    Sound Sampler
                </div>

                <!-- ハンバーガーメニューのボタン -->
                <button id="hamburger-button" class="block p-2 focus:outline-none text-gray-100">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10 lg:w-12 lg:h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>

                <!-- メニュー -->
                <div id="hamburger-menu" class="hidden flex-col">
                    <x-dropdown-link :href="route('profile.edit')" class="text-sm sm:text-base md:text-lg lg:text-xl menu-item font-noto-sans-jp">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                
                        <x-dropdown-link :href="route('logout')" class="text-sm sm:text-base md:text-lg lg:text-xl menu-item font-noto-sans-jp"
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
                <style>
                    .sound-button {
                        width: 46%; /* 2列表示のための幅設定 */
                        margin: 2%; /* 各ボタンの間隔を設定 */
                        padding:rem;
                    }
                </style>
                <div class="flex flex-wrap max-w-[500px] mx-auto px-4">
                    @for ($i = 1; $i <= 8; $i++)
                            <div  class="sound-button" data-key="{{ $i }}" data-sound-id="">
                                <div id="soundBtm-{{ $i }}" class=" h-auto rounded aspect-square bg-gradient-to-b from-teal-500 from-0% via-teal-500 via-50% to-teal-400 to-100% shadow-inner shadow-slate-100 border  border-gray-300">
                                    <div class="w-1/3 m-1 mb-3 p-1 bg-gray-300 shadow rounded text-wrap">
                                        <p class="text-xl text-center font-noto-sans-jp">{{ $keyMap[$i] }}</p>
                                        <p class="text-center font-noto-sans-jp">key</p>
                                    </div>
                                    <div class="mt-8 xs:text-xl xs:mt-4 sm:text-xl sm:mt-8 md:text-2xl md:mt-12 text-center truncate font-noto-sans-jp"><Q id="title-sound{{ $i }}" class="">Loading...</Q></div>
                                    <audio id="audio-sound{{ $i }}" class="hidden"></audio>
                                </div>
                            </div>
                    @endfor
                </div>

            {{-- footer --}}
            <footer class="flex flex-wrap mx-8 my-4 p-1 gap-24 justify-center sm:gap-32 sm:my-8 md:gap-40">
                    <a  class="w-14 h-14 md:w-24 md:h-24 open-modal cursor-pointer border rounded-full  border-teal-500">
                        <img src="{{ asset('microphone-duotone.png') }}" class=" w-14 h-auto md:w-24 " alt="Description of image">
                    </a>
                    <a class="w-14 h-14 md:w-24 md:h-24 cursor-pointer border rounded-full  border-teal-500" href="{{ route('user-sounds') }}">
                        <img src="{{ asset('playlist-duotone.png') }}" class="w-14 h-auto md:w-24 " alt="Description of image">
                    </a>
            </footer>
        </div>
        <script src="{{asset('js/modal.js')}}"></script>
        <script src="{{asset('js/play-sound.js')}}"></script>
    </x-slot>
</x-app-layout>

