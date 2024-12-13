document.addEventListener('DOMContentLoaded', () => {
    const keyMap = {
        1: '1',
        2: '2',
        3: 'Q',
        4: 'W',
        5: 'A',
        6: 'S',
        7: 'Z',
        8: 'X'
    };

    fetch('/playlist')
    .then(response => {
        return response.json();
    })
    .then(data => {
        data.forEach(playlist => {
            const soundButton = document.querySelector(`#soundBtm-${playlist.button_id}`);
            if (soundButton) {
                // soundsテーブルからfile_pathを取得
                fetch(`/sounds/${playlist.sound_id}`)
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

    document.addEventListener('keydown', (event) => {
        const key = event.key.toUpperCase();
        const buttonId = Object.keys(keyMap).find(id => keyMap[id] === key);
        if (buttonId) {
            const soundButton = document.querySelector(`#soundBtm-${buttonId}`);
            if (soundButton) {
                soundButton.click();
            }
        }
    });
});