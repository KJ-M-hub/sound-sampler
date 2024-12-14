<x-app-layout>
    
￥
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
                
                <div id="modal-content" class="relative inline-block w-3/4 h-3/4 lg:w-1/2 bg-white  rounded-md overflow-auto">
                    <div id="modal-close" class="z-10 absolute flex right-3 text-3xl cursor-pointer">×</div>
                    <div class="p-5 flex flex-col items-center h-full">
                        <p>どのボタンに割り当てる？</p>

                        <div class="grid grid-cols-2 gap-4 mt-4 h-full w-full">
                            @for ($i = 1; $i <= 8; $i++)
                                <button class="border rounded w-full h-full bg-violet-400" id="select-soundBtm-{{ $i }}" data-sound-id="">Sound {{ $i }}</button>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- main content --}}
        <div class="p-4">
            {{-- recording sounds --}}
            @foreach($sounds as $sound)
                <article class="clip mb-4 p-4 border border-4 border-amber-400 rounded z-0" data-sound-id="{{ $sound->id }}">
                    <p class="clip-label">{{ $sound->title }}</p>
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
                    <button class="play-button border rounded p-1 mt-3 mr-3 bg-yellow-400" onclick="document.getElementById('audio-{{ $sound->id }}').play();">再生</button>
                    <button class="stop-button border rounded p-1 mt-3 mr-3 bg-red-400" onclick="document.getElementById('audio-{{ $sound->id }}').pause();">停止</button>
                    <button class="delete border rounded p-1 mt-3 mr-3 bg-red-400" data-sound-id="{{ $sound->id }}">削除</button>
                    <button class="select open-modal border rounded p-1 mt-3 bg-green-400"  data-sound-id="{{ $sound->id }}">選択</button>
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
                <h2>効果音 提供元</h2>
                <p>音楽素材MusMus (https://musmus.main.jp)</p>
                <p>オトロジック (https://otologic.jp)</p>
                @foreach(array_slice($soundFiles, 0, 100) as $soundFile) <!-- 最初の10個の音源を表示 -->
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
                        <button class="save-to-db  border rounded p-1 mt-3 mr-3 bg-green-400"  data-file-name="{{ $soundFile }}">保存</button>
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
