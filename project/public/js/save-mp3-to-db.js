document.querySelectorAll('.save-to-db').forEach(button => {
    button.addEventListener('click', function() {
        const fileName = this.getAttribute('data-file-name');
        const title = fileName.replace('.mp3', '');
        const filePath = `sounds/${fileName}`;

        const formData = new FormData();
        formData.append('title', title);
        formData.append('file_path', filePath);

        // ユーザーIDを取得して追加
        const userIdMeta = document.querySelector('meta[name="user-id"]');
        if (!userIdMeta) {
            alert('ユーザーIDが取得できませんでした。ログインしていることを確認してください。');
            return;
        }
        const userId = userIdMeta.getAttribute('content');
        formData.append('user_id', userId);

        fetch('/save-soundMp3', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Sound already exists for this user!') {
                // 既に保存されている場合は関数を終了
                alert('このユーザーの音声は既に保存されています。');
                return;
            } else if (data.message === 'Sound saved successfully!') {
                alert('音声が保存されました。');
                location.reload(); // ページをリロードして保存を反映
            } else {
                alert('音声の保存に失敗しました。');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('音声の保存に失敗しました。');
        });
    });
});