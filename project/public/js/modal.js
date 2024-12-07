// モーダルウィンドウを表示する
const modal = document.querySelector("#modal");
const close = document.querySelector("#modal-close");
const openModalButtons = document.querySelectorAll(".open-modal");
const soundButtons = document.querySelectorAll("[id^='select-soundBtm-']");

// ページが読み込まれたときにプレイリストの情報を取得
document.addEventListener('DOMContentLoaded', () => {
    fetch('/playlist')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            data.forEach(playlist => {
                const soundButton = document.querySelector(`#select-soundBtm-${playlist.button_id}`);
                if (soundButton) {
                    soundButton.textContent = playlist.sound_title;
                    soundButton.setAttribute("data-existing-sound-id", playlist.id);
                }
            });
        })
        .catch(error => console.error('Error fetching playlist:', error));
});

openModalButtons.forEach(button => {
    button.addEventListener("click", () => {
        modal.classList.remove("invisible"); // モーダルを表示する
        const soundId = button.getAttribute("data-sound-id");
        soundButtons.forEach(soundButton => {
            soundButton.setAttribute("data-sound-id", soundId);
        });
    });
});

// モーダルを閉じるイベントリスナー
if (close) {
    close.addEventListener("click", () => {
        modal.classList.add("invisible"); // モーダルを非表示にする
    });
}

soundButtons.forEach(soundButton => {
    soundButton.addEventListener("click", () => {
        const soundId = soundButton.getAttribute("data-sound-id");
        // ここで選択した音声をボタンに割り当てる処理を追加
        const selectedSound = document.querySelector(`article[data-sound-id="${soundId}"] .clip-label`).textContent;
        soundButton.textContent = selectedSound; // ボタンに音声タイトルを表示

        // 既存のエントリを取得
        const existingSoundId = soundButton.getAttribute("data-existing-sound-id");

        const method = existingSoundId ? 'PUT' : 'POST';
        const url = existingSoundId ? `/playlist/${existingSoundId}` : '/playlist';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ sound_id: soundId, button_id: soundButton.id.split('-').pop(), sound_title: selectedSound })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            // 新しいエントリの場合、IDを設定
            if (!existingSoundId) {
                soundButton.setAttribute("data-existing-sound-id", data.playlist.id);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });

        modal.classList.add("invisible"); // モーダルを閉じる
    });
});