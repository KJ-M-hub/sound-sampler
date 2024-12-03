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
