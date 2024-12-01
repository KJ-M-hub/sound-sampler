<x-app-layout>
    

    <x-slot name="slot" class="">
        {{-- header --}}
        <header class="bg-white dark:bg-gray-400 shadow flex px-0">
            <div class="grow">
                <div class=" pl-24 max-w-7xl mx-auto py-1 px-1 sm:px-6 lg:px-8 text-2xl md:text-6xl text-center">
                    サウンド一覧
                </div>
            </div>
            <div class="">
                {{-- ホームに戻るボタンを作成する --}}
            </div>
        </header>
    
        {{-- main content --}}
        <div class="p-4">
            @foreach($sounds as $sound)
                <article class="clip mb-4 p-4 border rounded" data-sound-id="{{ $sound->id }}">
                    <p class="clip-label">{{ $sound->title }}</p>
                    <audio controls>
                        <source src="{{ asset('storage/' . $sound->file_path) }}" type="{{ $sound->mime_type }}">
                        Your browser does not support the audio element.
                    </audio>
                    <button class="delete" data-sound-id="{{ $sound->id }}">削除</button>
                </article>
            @endforeach
        </div>
        <script src="{{ asset('js/recording.js') }}"></script>
        <script src="{{ asset('js/delete-button.js') }}"></script>
    </x-slot>  
</x-app-layout>
