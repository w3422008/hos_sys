$(function(){
    var fileSelected1 = false;

    // ドラッグしたままエリアに乗った＆外れたとき
    $(document).on('dragover', '#file_drag_drop_area1', function (event) {
        event.preventDefault();
        if (!fileSelected1) {
            $(this).css("background-color", "#daecda");
        }
    });
    $(document).on('dragleave', '#file_drag_drop_area1', function (event) {
        event.preventDefault();
        if (!fileSelected1) {
            $(this).css("background-color", "transparent");
        }
    });

    // ドラッグした時
    $(document).on('drop', '#file_drag_drop_area1', function (event) {
        let org_e = event;
        if (event.originalEvent) {
            org_e = event.originalEvent;
        }

        org_e.preventDefault();
        $('#myFile1')[0].files = org_e.dataTransfer.files;
        $(this).css("background-color", "#daecda"); // 背景色を#daecdaに設定
        fileSelected1 = true;
    });

    // ファイル選択時
    $('#myFile1').on('change', function() {
        if (this.files.length > 0) {
            $('#file_drag_drop_area1').css("background-color", "#daecda"); // 背景色を#daecdaに設定
            fileSelected1 = true;
        } else {
            $('#file_drag_drop_area1').css("background-color", "transparent"); // 背景色を元に戻す
            fileSelected1 = false;
        }
    });

    // ファイル選択がキャンセルされた場合
    $('#myFile1').on('click', function() {
        $(this).val(null); // ファイル選択をキャンセル
        $('#file_drag_drop_area1').css("background-color", "transparent"); // 背景色を元に戻す
        fileSelected1 = false;
    });

    // ドラッグしたままエリアに乗った＆外れたとき
    $(document).on('dragover', '#file_drag_drop_area2', function (event) {
        event.preventDefault();
        if (!fileSelected2) {
        $(this).css("background-color", "#daecda");
    }
    });
    $(document).on('dragleave', '#file_drag_drop_area2', function (event) {
        event.preventDefault();
        if (!fileSelected2) {
            $(this).css("background-color", "transparent");
        }
    });

    // ドラッグした時
    $(document).on('drop', '#file_drag_drop_area2', function (event) {
        let org_e = event;
        if (event.originalEvent) {
            org_e = event.originalEvent;
        }

        org_e.preventDefault();
        $('#myFile2')[0].files = org_e.dataTransfer.files;
        $(this).css("background-color", "#daecda"); // 背景色を#daecdaに設定
        fileSelected2 = true;
    });

    // ファイル選択時
    $('#myFile2').on('change', function() {
        if (this.files.length > 0) {
            $('#file_drag_drop_area2').css("background-color", "#daecda"); // 背景色を#daecdaに設定
            fileSelected2 = true;
        } else {
            $('#file_drag_drop_area2').css("background-color", "transparent"); // 背景色を元に戻す
            fileSelected2 = false;
        }
    });

    // ファイル選択がキャンセルされた場合
    $('#myFile2').on('click', function() {
        $(this).val(null); // ファイル選択をキャンセル
        $('#file_drag_drop_area2').css("background-color", "transparent"); // 背景色を元に戻す
        fileSelected2 = false;
    });

    // ページが読み込まれたときにファイル入力フィールドをリセット
    $(document).ready(function() {
        $('#myFile1').val(null);
        $('#file_drag_drop_area1').css("background-color", "transparent");
        fileSelected1 = false;

        $('#myFile2').val(null);
        $('#file_drag_drop_area2').css("background-color", "transparent");
        fileSelected2 = false;
    });


    // ファイルが選択されていない場合にフォームの送信をキャンセル
    $('form').not('#BackupForm').on('submit', function (e) {
        if ($('#myFile')[0].files.length === 0) {
            var fileInput1 = $('#myFile1')[0];
            var fileInput2 = $('#myFile2')[0];
            if (fileInput1.files.length === 0 && fileInput2.files.length === 0) {
                e.preventDefault();
                alert('ファイルが選択されていません。');
            }
        }
    });

    // backupFormをクリックした際にアラートを表示
    $('#BackupForm').on('click', function(e) {
    e.preventDefault(); // デフォルトのフォーム送信を防止
    var result = confirm('バックアップ時点に戻していいですか？');
    if (result) {
        // ユーザーが「はい」を選択した場合、フォームを送信
        $(this).closest('form').submit();
    } else {
        // ユーザーが「いいえ」を選択した場合、何もしない
        return false;
    }
    });
});