document.addEventListener('DOMContentLoaded', () => {
    fetch('/playlist')
        .then(response => response.json())
        .then(data => {
            data.forEach(playlist => {
                const soundButton = document.querySelector(`#soundBtm-${playlist.button_id}`);
                if (soundButton) {
                    // soundsテーブルからfile_pathを取得
                    fetch(`/playlist`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok ' + response.statusText);
                            }
                            return response.json();
                        })
                        .then(sounds => {
                            const audioElement = new Audio(`/storage/${sounds.file_path}`); // 音声ファイルのパスを設定
                            soundButton.addEventListener('click', () => {
                                audioElement.play().catch(error => {
                                    console.error('Error playing audio:', error);
                                });
                            });

                            // タイトルを設定
                            const titleElement = document.querySelector(`#title-sound${playlist.button_id}`);
                            if (titleElement) {
                                titleElement.textContent = playlist.sound_title;
                            } else {
                                console.error(`Title element not found for button ID: ${playlist.button_id}`);
                            }
                        })
                        .catch(error => console.error('Error fetching sound data:', error));
                } else {
                    console.error(`Sound button not found for button ID: ${playlist.button_id}`);
                }
            });
        })
        .catch(error => console.error('Error fetching playlist:', error));
});

document.querySelectorAll('.sound-button').forEach(div => {
    div.addEventListener('click', () => {
        const audioElement = div.querySelector('audio');
        if (audioElement) {
            audioElement.play().catch(error => {
                console.error('Error playing audio:', error);
            });
        } else {
            console.error('Audio element not found in div:', div);
        }
    });
});