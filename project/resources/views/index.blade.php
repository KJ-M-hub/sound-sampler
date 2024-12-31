<x-app-layout>
    
￥
    <x-slot name="slot" class="">
        {{-- header --}}
        <header class="bg-gray-900 shadow flex px-0 justify-between items-center">

            <div class="mt-2 max-w-7xl ml-4 py-1 px-1 sm:px-6 lg:px-8 text-3xl md:text-6xl text-center text-gray-200 lobster-regular">
                Sound List
            </div>

            <a href="#_" onclick="location.href='{{ route('main') }}'" class="w-auto box-border relative z-2 inline-flex items-center justify-center mx-4 my-2 px-8 py-3 overflow-hidden font-bold text-white transition-all duration-300 bg-teal-600 rounded-md cursor-pointer group ring-offset-2 ring-1 ring-teal-300 ring-offset-teal-200 hover:ring-offset-teal-500 ease focus:outline-none">
                <span class="absolute bottom-0 right-0 w-8 h-16 -mb-8 -mr-5 transition-all duration-300 ease-out transform rotate-45 translate-x-1 bg-white opacity-10 group-hover:translate-x-0"></span>
                <span class="absolute top-0 left-0 w-16 h-4 -mt-1 -ml-12 transition-all duration-300 ease-out transform -rotate-45 -translate-x-1 bg-white opacity-10 group-hover:translate-x-0"></span>
                <span class="relative z-3 flex items-center text-sm">
                    Back
                </span>
            </a>
        </header>
    
        
        {{-- modal window --}}
        <div id="modal" class=" fixed top-0 left-0 w-full h-full text-center bg-gray-300 bg-opacity-50 transition box-border z-10 invisible">
            <div id="modal-container" class="relative inline-block align-middle top-1/2 -translate-y-1/2 w-full h-full pt-10 ">
                
                <div id="modal-content" class="relative inline-block w-3/4 h-3/4 lg:w-1/2 bg-gray-300  rounded-md overflow-auto">
                    <div id="modal-close" class="z-10 absolute flex right-3 text-3xl cursor-pointer">×</div>
                    <div class="p-5 flex flex-col items-center h-full">
                        <p class="text-lg">Which button do you want?</p>

                        <div class="grid grid-cols-2 gap-4 mt-4 h-full w-full">
                            @for ($i = 1; $i <= 8; $i++)
                                <button class="border rounded-xl w-full h-full bg-gradient-to-b from-teal-500 from-0% via-teal-500 via-50% to-teal-400 to-100%" id="select-soundBtm-{{ $i }}" data-sound-id="">Sound {{ $i }}</button>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- main content --}}
        <div class="p-4">
            {{-- recording sounds --}}
            @foreach($sounds->reverse() as $sound)
                <article class="clip mb-4 p-4 border border-1 border-teal-400 rounded z-0" data-sound-id="{{ $sound->id }}">
                    <p class="ml-2 mb-2 clip-label text-gray-200 font-noto-sans-jp">{{ $sound->title }}</p>
                    {{-- <audio controls>
                        <source src="{{ asset('storage/' . $sound->file_path) }}" type="{{ $sound->mime_type }}">
                        Your browser does not support the audio element.
                    </audio> --}}
                    <div class="flex justify-center">
                        <audio id="audio-{{ $sound->id }}" class="w-full">
                            <source src="{{ asset('storage/' . $sound->file_path) }}" type="{{ $sound->mime_type }}">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                    <a href="#_" onclick="document.getElementById('audio-{{ $sound->id }}').play();" class="play-button w-8 h-4 mx-1 my-2 relative inline-flex items-center justify-center px-10 py-4 overflow-hidden font-mono font-medium tracking-tighter text-white bg-gray-800 rounded-lg group">
                        <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-amber-500 rounded-full group-hover:w-56 group-hover:h-56"></span>
                        <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-gray-700"></span>
                        <span class="relative">play</span>
                    </a>
                    <a href="#_" onclick="document.getElementById('audio-{{ $sound->id }}').pause();" class="stop-button w-8 h-4 mx-1 my-2 relative inline-flex items-center justify-center px-10 py-4 overflow-hidden font-mono font-medium tracking-tighter text-white bg-gray-800 rounded-lg group">
                        <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-fuchsia-500 rounded-full group-hover:w-56 group-hover:h-56"></span>
                        <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-gray-700"></span>
                        <span class="relative">stop</span>
                    </a>
                    <a href="#_" data-sound-id="{{ $sound->id }}" class="delete w-8 h-4 mx-1 my-2 relative inline-flex items-center justify-center px-10 py-4 overflow-hidden font-mono font-medium tracking-tighter text-white bg-gray-800 rounded-lg group">
                        <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-red-500 rounded-full group-hover:w-56 group-hover:h-56"></span>
                        <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-gray-700"></span>
                        <span class="relative">delete</span>
                    </a>
                    <a href="#_" data-sound-id="{{ $sound->id }}" class="select open-modal w-8 h-4 mx-1 my-2 relative inline-flex items-center justify-center px-10 py-4 overflow-hidden font-mono font-medium tracking-tighter text-white bg-gray-800 rounded-lg group">
                        <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-green-500 rounded-full group-hover:w-56 group-hover:h-56"></span>
                        <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-gray-700"></span>
                        <span class="relative">select</span>
                    </a>
                </article>
            @endforeach
            
            

            {{-- default sounds --}}
            @php
                $soundFiles = [];
                $directory = '../storage/app/public/sounds';
                $files = array_diff(scandir($directory), array('..', '.')); // ディレクトリ内のファイルを取得

                foreach ($files as $file) {
                    if (pathinfo($file, PATHINFO_EXTENSION) === 'mp3') {
                        $soundFiles[] = $file; // mp3ファイルを配列に追加
                    }
                }
            @endphp

            <div class="">
                <div class=" my-4 text-gray-200 font-noto-sans-jp">
                    <h2>効果音 提供元</h2>
                    <p>音楽素材MusMus (https://musmus.main.jp)</p>
                    <p>オトロジック (https://otologic.jp)</p>
                </div>
                @foreach(array_slice($soundFiles, 0, 100) as $soundFile) <!-- 最初の10個の音源を表示 -->
                    <article class="clip mb-4 p-4 border rounded z-0">
                        <p class="ml-2 mb-2 clip-label text-gray-200 font-noto-sans-jp">{{ pathinfo($soundFile, PATHINFO_FILENAME) }}</p>
                        <div class="flex justify-center">
                            <audio id="audio-{{ $soundFile }}" class="w-full">
                                <source src="{{ asset('storage/sounds/' . $soundFile) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                        <a href="#_" onclick="document.getElementById('audio-{{ $soundFile }}').play();" class="play-button w-8 h-4 mx-1 my-2 relative inline-flex items-center justify-center px-10 py-4 overflow-hidden font-mono font-medium tracking-tighter text-white bg-gray-800 rounded-lg group">
                            <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-amber-500 rounded-full group-hover:w-56 group-hover:h-56"></span>
                            <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-gray-700"></span>
                            <span class="relative">play</span>
                        </a>
                        <a href="#_" onclick="document.getElementById('audio-{{ $soundFile }}').pause();" class="w-8 h-4 mx-1 my-1 relative inline-flex items-center justify-center px-10 py-4 overflow-hidden font-mono font-medium tracking-tighter text-white bg-gray-800 rounded-lg group">
                            <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-fuchsia-500 rounded-full group-hover:w-56 group-hover:h-56"></span>
                            <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-gray-700"></span>
                            <span class="relative">stop</span>
                        </a>
                        <a href="#_" data-file-name="{{ $soundFile }}" class="save-to-db w-8 h-4 mx-1 my-1 relative inline-flex items-center justify-center px-10 py-4 overflow-hidden font-mono font-medium tracking-tighter text-white bg-gray-800 rounded-lg group">
                            <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-cyan-500 rounded-full group-hover:w-56 group-hover:h-56"></span>
                            <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-gray-700"></span>
                            <span class="relative">save</span>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
        <script src="{{ asset('js/recording.js') }}"></script>
        <script src="{{ asset('js/delete-button.js') }}"></script>
        <script src="{{ asset('js/modal.js') }}"></script>
        <script src="{{ asset('js/save-mp3-to-db.js') }}"></script>
    </x-slot>  
</x-app-layout>
