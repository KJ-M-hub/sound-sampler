// モーダルウィンドウを表示する
const modal = document.querySelector("#modal");
const close = document.querySelector("#modal-close");

const openModal = document.querySelector("#open-modal");

// モーダルを開くイベントリスナー
if (openModal) {
    openModal.addEventListener("click", () => {
        modal.classList.remove("invisible"); // モーダルを表示する
    });
}

// モーダルを閉じるイベントリスナー
if (close) {
    close.addEventListener("click", () => {
        modal.classList.add("invisible"); // モーダルを非表示にする
    });
}

document.querySelectorAll('#soundBtm').forEach(button => {
    button.addEventListener('click', function() {
        const soundId = this.getAttribute('data-sound-id');
        const soundTitle = this.getAttribute('data-sound-title');
        const soundUrl = this.getAttribute('data-sound-url');

        // main.blade.phpのsoundBtmに音声ファイルを追加
        const soundContainer = document.getElementById(`soundBtm-${soundId}`);
        if (soundContainer) {
            soundContainer.innerHTML = `
                <div class="w-2/3 h-auto md:w-1/2 bg-red-400 border-4 border-gray-50 border-double rounded aspect-square min-w-28 max-w-56" onclick="playSound('${soundUrl}')">
                    <div class="w-1/3 m-1 mb-3 p-1 bg-gray-300 rounded text-wrap">
                        <p class="text-xl text-center">${soundTitle}</p>
                        <p class="text-center">key</p>
                    </div>
                </div>
            `;
        }

        // モーダルを閉じる
        modal.classList.add("invisible");
    });
});