<x-app-layout>
    

    <x-slot name="slot" class="">
        {{-- header --}}
        <header class="bg-white dark:bg-gray-400 shadow flex px-0">
            <div class="grow">
                <div class=" pl-24 max-w-7xl mx-auto py-1 px-1 sm:px-6 lg:px-8 text-2xl md:text-6xl text-center">
                    サウンド一覧
                </div>
            </div>
            <div class="flex items-center">
                <button class="border rounded p-1 mr-5 bg-blue-400 " onclick="location.href='{{ route('main') }}'">戻る</button> <!-- 戻るボタン -->
            </div>
        </header>
    
        
        {{-- modal window --}}
        <div id="modal" class=" fixed top-0 left-0 w-full h-full text-center bg-gray-300 bg-opacity-50 transition box-border z-10 invisible">
            <div id="modal-container" class="relative inline-block align-middle top-1/2 -translate-y-1/2 w-full h-full pt-10 ">
                
                <div id="modal-content" class="relative inline-block w-3/4 h-3/4 bg-white  rounded-md overflow-auto">
                    <div id="modal-close" class="z-10 absolute flex right-3 text-3xl cursor-pointer">×</div>
                    <div class="p-5 flex flex-col items-center h-full">
                        <p>どのボタンに割り当てる？</p>
                        <div class="grid grid-cols-2 gap-4 mt-4 h-full w-full">
                            <button class="border rounded w-full h-full bg-red-400" id="soundBtm-1">1</button>
                            <button class="border rounded w-full h-full bg-green-400" id="soundBtm-2">2</button>
                            <button class="border rounded w-full h-full bg-red-400" id="soundBtm-3">Q</button>
                            <button class="border rounded w-full h-full bg-green-400" id="soundBtm-4">W</button>
                            <button class="border rounded w-full h-full bg-red-400" id="soundBtm-5">A</button>
                            <button class="border rounded w-full h-full bg-green-400" id="soundBtm-6">S</button>
                            <button class="border rounded w-full h-full bg-red-400" id="soundBtm-7">Z</button>
                            <button class="border rounded w-full h-full bg-green-400" id="soundBtm-8">X</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- main content --}}
        <div class="p-4">
            @foreach($sounds as $sound)
                <article class="clip mb-4 p-4 border rounded z-0" data-sound-id="{{ $sound->id }}">
                    <p class="clip-label">{{ $sound->title }}</p>
                    <audio controls>
                        <source src="{{ asset('storage/' . $sound->file_path) }}" type="{{ $sound->mime_type }}">
                        Your browser does not support the audio element.
                    </audio>
                    <button class="delete border rounded p-1 mt-3 mr-3 bg-red-400" data-sound-id="{{ $sound->id }}">削除</button>
                    <button class="select border rounded p-1 mt-3 bg-green-400" id="open-modal" data-sound-id="{{ $sound->id }}">選択</button>
                </article>
            @endforeach

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

            <div class="p-4">
                <h2>効果音</h2>
                <p>音楽素材MusMus https://musmus.main.jp</p>
                @foreach(array_slice($soundFiles, 0, 20) as $soundFile) <!-- 最初の10個の音源を表示 -->
                    <article class="clip mb-4 p-4 border rounded z-0">
                        <p class="clip-label">{{ pathinfo($soundFile, PATHINFO_FILENAME) }}</p>
                        <div class="flex justify-center">
                            <audio id="audio-{{ $soundFile }}" class="w-full">
                                <source src="{{ asset('storage/sounds/' . $soundFile) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                        <button class="play-button border rounded p-1 mt-3 mr-3 bg-yellow-400" onclick="document.getElementById('audio-{{ $soundFile }}').play();">再生</button>
                        <button class="stop-button border rounded p-1 mt-3 mr-3 bg-red-400" onclick="document.getElementById('audio-{{ $soundFile }}').pause();">停止</button>
                        <button class="border rounded p-1 mt-3 mr-3 bg-green-400">選択</button>
                    </article>
                @endforeach
            </div>
        </div>
        <script src="{{ asset('js/recording.js') }}"></script>
        <script src="{{ asset('js/delete-button.js') }}"></script>
        <script src="{{ asset('js/modal.js') }}"></script>
    </x-slot>  
</x-app-layout>
