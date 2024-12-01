document.querySelectorAll('.delete').forEach(button => {
    button.addEventListener('click', function() {
        const soundId = this.getAttribute('data-sound-id');
        if (confirm('本当に削除しますか？')) {
            fetch(`/delete-sound/${soundId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    alert('音声が削除されました。');
                    location.reload(); // ページをリロードして削除を反映
                } else {
                    alert('削除に失敗しました。');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('削除中にエラーが発生しました。');
            });
        }
    });
});