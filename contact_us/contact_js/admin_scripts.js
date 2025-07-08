// 管理者画面での処理　------------------------------------------------
// 20250331　加藤　修正
if (adm_id == 3) {

    // 返信内容保存（管理者）
    $(document).on('click', '.submitAnswer', function(e) {
        e.preventDefault();
        // 20241214　加藤

        // DBから取得した対応可否
        var db_adv = null;
        if(typeof $('#que_id').data('adv') !== 'undefined'){
            db_adv = $('#que_id').data('adv');
        }

        // DBのid
        var que_id = $('#que_id').val();

        // 回答内容
        var answer = $('#answer').val();

        // 対応可否　初期化
        var advisability = null;
        var supp_status = null;

        // 対応可否の判定
        if($('input[name="advisability"]:checked').val()=="対応不可"){
            advisability = 1;
        }else if($('input[name="advisability"]:checked').val()=="対応可"){
            advisability = 0;
        }

        // 対応状況の判定
        if($('input[name="status_middle"]:checked').val()=="対応中"){
            supp_status = 1;
        }else if($('input[name="status_middle"]:checked').val()=="対応済"){
            supp_status = 2;
        }else{
            // 対応状況 未選択
            supp_status = 3;
        }

        // 送信処理
        $.ajax({
            url: 'ajax/save_answer.php',
            type: 'POST',
            data: {
                que_id: que_id,
                answer: answer,
                advisability: advisability,
                supp_status: supp_status,
                db_adv : db_adv
            },
            success: function(response) {

                alert('回答内容を保存しました。');

                // 画面再読み込み
                location.reload();

            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        });
    });

}
