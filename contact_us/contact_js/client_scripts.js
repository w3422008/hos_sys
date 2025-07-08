// history.php用の処理　------------------------------------------------
// 20250331　加藤　修正

if (adm_id == 0 || adm_id == 1 || adm_id == 2) {
    

    // 依頼入力：確認画面表示
    $('#openModalButton').on('click', function () {
        var emerg = $('input[name="emerg"]:checked').val();
        var consultationText = $('#consultationText').val();
        if ($('#consultationImage')[0].files[0]) {
            var consultationImage = $('#consultationImage')[0].files[0];
        }

        if (emerg && consultationText) {

            // フィールドから値を取得
            if (emerg == 1) {
                $('#modalEmerg').show();
                $('#modalEmerg').text('緊急');
                add_class('modalEmerg');
            } else {
                // 以前の緊急表示を削除
                $('#modalEmerg').removeClass("fa-solid", "fa-triangle-exclamation", "emerg-icon");
                $('#modalEmerg').text('');
                $('#modalEmerg').hide();
            }

            $('#modalConsultationText').text(html_escape(consultationText));
            if (!consultationImage) {
                $('#hide_imagetext').hide();
            }

            var reader = new FileReader();
            // 画像のプレビューを表示する処理
            if (consultationImage) {
                reader.onload = function (e) {
                    var img = new Image();
                    img.src = e.target.result;
                    img.onload = function () {
                        var canvas = document.createElement('canvas');
                        var ctx = canvas.getContext('2d');
                        // サイズ指定
                        var maxWidth = 500;
                        var maxHeight = 300;
                        var width = img.width;
                        var height = img.height;

                        if (width > maxWidth || height > maxHeight) {
                            if (width / height > maxWidth / maxHeight) {
                                height *= maxWidth / width;
                                width = maxWidth;
                            } else {
                                width *= maxHeight / height;
                                height = maxHeight;
                            }
                        }

                        canvas.width = width;
                        canvas.height = height;
                        ctx.drawImage(img, 0, 0, width, height);
                        $('#modalImagePreview').attr('src', canvas.toDataURL()).show();
                    };
                };
                reader.readAsDataURL(consultationImage);
            }else{
                $('#modalImagePreview').hide();
            }

            UIkit.modal('#confirmationModal').show();
        } else {
            alert('相談内容を入力してください。');
        }
    });

    // fetch処理が終わるまで、thenの処理をしないようにするために、async/awaitを使用します。
    document.getElementById('submitFormButton').addEventListener('click', async function () {
        let formData = new FormData();
        formData.append('emerg', document.querySelector('input[name="emerg"]:checked').value);
        formData.append('consultationText', document.getElementById('consultationText').value);
        const consultationImage = document.getElementById('consultationImage').files[0];
        if (consultationImage) {
            formData.append('consultationImage', consultationImage);
        }

        try {
            const response = await fetch('ajax/submit.php', {
                method: 'POST',
                body: formData
            });

            const responseText = await response.text();
            console.log(responseText);
            UIkit.modal('#confirmationModal').hide();
            document.getElementById('loadingOverlay').style.display = 'none';

            if (responseText.length == 17) {
                document.querySelector('#completionModal .uk-modal-body .uk-modal-title').style.display = 'block';
                document.querySelector('#completionModal .uk-modal-body .uk-modal-title').textContent = '送信完了';
            } else {
                document.querySelector('#completionModal .uk-modal-body .uk-modal-title').style.display = 'none';
            }
            document.querySelector('#completionModal .uk-modal-body .message').textContent = responseText;
            UIkit.modal('#completionModal').show();
        } catch (error) {
            alert('データの送信中にエラーが発生しました。');
            document.getElementById('loadingOverlay').style.display = 'none';
            console.error('Error:', error);
        }
    });

// 依頼入力：完了モーダル「ホームへ戻る」処理
    $('#goHomeButton').on('click', function () {
        window.location.href = '../menu/MENU_control.php'; // ホームページへのリンク
    });

    // 依頼入力：完了モーダル「再読み込み」処理
    $('#goHistoryButton').on('click', function () {
        location.reload();
    });

    // 内容変更：「送信」をクリックした場合の処理
    $(document).on('click', '#submitchangeorder', function (e) {
        e.preventDefault();

        // DBのid
        var que_id = $('#que_id').val();

        // 変更内容
        var order = $('#order_change').val();


        // 送信処理
        fetch('ajax/save_answer.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                que_id: que_id,
                order: order,
                history: 1,
            }),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(() => {
                alert('回答内容を変更しました。');

                // 画面再読み込み
                location.reload();
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('データの送信中にエラーが発生しました。');
            });
            
    });
}
