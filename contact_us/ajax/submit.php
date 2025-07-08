<?php
// 依頼者用
// 依頼送信時、画像が保存要件に適合しているかどうかをチェック
session_start();
require_once('../../functions.php');
$dbh = get_db_connect();

// 依頼者の職員番号を取得
$staff_id = $_SESSION['member']['user_id'];

// POSTされた情報を取得（client_scripts.js:215行目付近）
$emerg = htmlspecialchars($_POST['emerg'] ?? null); // 緊急度
$consultationText = htmlspecialchars($_POST['consultationText'] ?? "");
$consultationImage = $_FILES['consultationImage'] ?? null; // 画像ファイル

// 画像ファイルが適合しているかどうかのフラグ
$uploadOk = 1;

// 画像取得関連
if(isset($consultationImage)){
    // 画像ファイルの保存先指定
    $date = date('d');
    $date_Ym = date('Ym');

    // 年月フォルダ
    $target_dir_Ym = '../images/' . $date_Ym . '/';
    // 保存先フォルダ
    $target_dir = $target_dir_Ym . $date . '/'; 

    // 日付フォルダが存在しない場合は作成
    if (!is_dir($target_dir_Ym)) {
        // 年月フォルダが存在しない場合は年月、日付フォルダを作成
        mkdir($target_dir_Ym, 0777, true);
        mkdir($target_dir, 0777, true);
    }else{
        // 年月フォルダが存在する場合は、日付フォルダを作成
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
    }

    // 画像の拡張子を取得
    $imageFileType = strtolower(pathinfo($consultationImage["name"], PATHINFO_EXTENSION));

    // 元のファイル名 ⇒ 「職員番号+日時」形式へ変更
    $nowDT = new DateTime('now');
    $nowT = $nowDT->format('His');
    $newFileName = $staff_id . '_' . $nowT . '.' . $imageFileType;
    $consultationImage["name"] = $newFileName;
    
    // 画像を保存するフォルダ（画像ファイルをimagesへ保存するパス）
    $target_file = $target_dir . basename($consultationImage["name"]);
    
    // 画像のファイルパスをDBへ保存（view画面から正しく参照するパス）
    $true_dir = 'images/' . $date_Ym . '/' . $date . '/'; 
    $true_file = $true_dir . basename($consultationImage["name"]);

    // 画像ファイルが実際の画像かどうかをチェック
    $check = getimagesize($consultationImage["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<h2>ファイルは画像ではありません</h2>画像を選択してください。";
        $uploadOk = 0;
    }

    // ファイルが既に存在するかどうかをチェック
    if (file_exists($target_file)) {
        echo "<h2>同じファイル名が既に存在します</h2>名称を変更してください。";
        $uploadOk = 0;
    }

    // ファイルサイズをチェック
    if ($consultationImage["size"] > 5000000) {
        echo "<h2>ファイルが大きすぎます</h2>画像サイズを変更してください。";
        $uploadOk = 0;
    }

    // 特定のファイル形式を許可
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "<h2>正しいファイルを選択してください</h2>JPG, JPEG, PNG, GIF ファイルのみ許可されています。";
        $uploadOk = 0;
    }
}
// $uploadOk が 0 の場合、ファイルはアップロードされない
// 全てのチェックを通過した場合、ファイルをアップロードする
if($uploadOk == 1) {

    // ユーザー情報を取得
    $user_id = $_SESSION['member']['user_id'];

    // データが正常に保存されるとき
    if (isset($consultationImage["tmp_name"])) {

        // 画像あり
        // imagesフォルダに画像を保存
        move_uploaded_file($consultationImage["tmp_name"], $target_file);
        insert_request_data($dbh, $emerg, $consultationText, $true_file, $consultationImage["name"] , $user_id);
    
    }else{

        // 画像なし
        insert_request_data($dbh, $emerg, $consultationText, "" , null , $user_id);

    }
    
    echo "データが正常に保存されました。";

}

?>