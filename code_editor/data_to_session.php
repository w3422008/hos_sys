<?php
session_start();
include_once("../functions.php");

if (isset($_GET['old_hospital_code']) && isset($_GET['hospital_code'])) {

    // GETパラメータの取得とエスケープ処理
    $old_hospital_code = html_escape($_GET['old_hospital_code']);
    $hospital_code = html_escape($_GET['hospital_code']);

    // 医療機関コードを基にデータを抽出し、セッションへ保存

    // 医療機関情報
    add_SESSION_info($old_hospital_code, $hospital_code);
    // 診療内容
    check_medical_care($old_hospital_code);
    // 連携パス
    check_cPath($old_hospital_code);
    // 親族情報
    check_relative($old_hospital_code);
    // 部門連絡先
    check_field_junction($old_hospital_code);
    
    // 新医療機関コードをセッションに保存
    $_SESSION['insert']['hos_cd'] = $hospital_code;

    echo json_encode(["success" => true]);

} else {

    echo json_encode(["success" => false, "error" => "No data received."]);

}

// 20251201加藤　医療機関コードを基に、セッションへデータを追加する
function add_SESSION_info($old_hospital_code,$new_hospital_code) {
    $data = get_hospital_data($old_hospital_code);
    if ($data) {
        foreach ($data as $key => $value){
            if ($key != 'hos_cd'){
                $_SESSION['insert'][$key] = $value ?? '';
            }
        }
        $_SESSION['insert']['hos_cd'] = $new_hospital_code;

        // email→mailへキー名変更

        $_SESSION['insert']['mail'] = $_SESSION['insert']['email'];
        unset($_SESSION['insert']['email']);

        if (!isset($_SESSION['insert']['note'])) {
            $_SESSION['insert']['note'] = "<br>";
        }
        $_SESSION['insert']['note'] .= "医療機関コードが変更されました。変更前：".$old_hospital_code;
    }else{
        // エラーハンドリング（必要に応じて）
        error_log("Error: Could not retrieve hospital data for hos_cd " . $_SESSION['insert']['old_hos_cd']);
    }
    
}

// 20251201加藤　旧医療機関コードを基に、医療機関情報を取得する
function get_hospital_data($hospital_code) {
    
    $pdo = get_db_connect();

    // カルナコネクト連携有無を確認
    $has_carna = detail_carna($pdo, $hospital_code);
    $_SESSION['insert']['carna'] = "";

    $sql = "SELECT * FROM main ";

    if ($has_carna) {
        $sql .= "LEFT JOIN carna_connect ON main.hos_cd = carna_connect.hos_cd ";
        $_SESSION['insert']['carna'] = "1";
    }

    $sql .= "WHERE main.hos_cd = :hos_cd";


    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':hos_cd', $hospital_code, PDO::PARAM_STR);
    $status = $stmt->execute();

    // データ取得
    if ($status) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } else {
        return null;
    }
}

// 20251201加藤　診療内容の有無を確認、セッションへ保存する
function check_medical_care(string $old_hospital_code) {
    $pdo = get_db_connect();
    // 診療内容有無を確認・取得
    $medical_care = detail_medCare($pdo, $old_hospital_code);
    // セッション保存用ID定義（1~164）
    $id=1;

    if(!$medical_care){
        $_SESSION['insert']['med_care'] = "";
        $_SESSION['insert']['mcare_note'] = "";
        return;
    }
    $_SESSION['insert']['med_care'] = [];
    foreach ($medical_care[0] as $key => $value){

        if($key != 'med_note' && $key != 'hos_cd'){
            $_SESSION['insert']['med_care'][$id] = strval($value);
            $id++;
        }else if($key == 'med_note'){
            $_SESSION['insert']['mcare_note'] = $value;
        }
        
    }

}


// 20251201加藤　連携パスの有無を確認、セッションへ保存する
function check_cPath(string $old_hospital_code) {
    $pdo = get_db_connect();
    // 連携パス有無を確認・取得
    $fuzoku_cPath_data = detail_cPath($pdo,$old_hospital_code,0); //附属病院
    $sogo_cPath_data = detail_cPath($pdo,$old_hospital_code,1); //総合医療センター

    if(!$fuzoku_cPath_data && !$sogo_cPath_data){
        return;
    }
    // 
    $_SESSION['insert']['kurashiki_path'] = [];
    $_SESSION['insert']['okayama_path'] = [];
    if($fuzoku_cPath_data){
        // hos_cdは不要なため削除し、値をSESSIONへ保存
        unset($fuzoku_cPath_data['hos_cd']);
        // pathのidを定義
        $id = 0;
        foreach ($fuzoku_cPath_data as $key => $value){
            $_SESSION['insert']['kurashiki_path'][$id] = strval($value);
            $id++;
        }
    }
    if($sogo_cPath_data){
        // hos_cdは不要なため削除し、値をSESSIONへ保存
        unset($sogo_cPath_data['hos_cd']);
        // pathのidを定義
        $id = 0;
        foreach ($sogo_cPath_data as $key => $value){
            $_SESSION['insert']['okayama_path'][$id] = strval($value);
            $id++;
        }
    }
}

// 20251201加藤　親族情報の有無を確認、セッションへ保存する
function check_relative($old_hospital_code) {
    $pdo = get_db_connect();
    // 親族情報有無を確認・取得
    $relative_data = detail_relative($pdo, $old_hospital_code);

    $_SESSION['insert']['rel_insert'] = [];
    if(!$relative_data){
        return;
    }

    foreach ($relative_data as $index => $relative){
        // hos_cdとrel_cdは不要なため削除
        unset($relative['hos_cd'], $relative['rel_cd']);
        // 'note'キーを'rel_note'に変更
        if (isset($relative['note'])) {
            $relative['rel_note'] = $relative['note'];
            unset($relative['note']);
        }
        $_SESSION['insert']['rel_insert'][$index] = $relative;
    }

}

// 20251201加藤　部門連絡先の有無を確認、セッションへ保存する
function check_field_junction(string $old_hospital_code) {
    $pdo = get_db_connect();
    // 部門連絡先情報を確認・取得
    $field_junction = detail_num($pdo, $old_hospital_code);

    $_SESSION['insert']['fie_insert'] = [];
    if(!$field_junction){
        return;
    }

    foreach ($field_junction as $index => $field){
        // hos_cdとdep_cdは不要なため削除
        unset($field['hos_cd'], $field['fie_cd'], $field['delete_flg']);
        // キー名を変更
        $field['fie_tel'] = $field['tel'];
        $field['fie_fax'] = $field['fax'];
        $field['fie_note'] = $field['note'];
        unset($field['tel'], $field['fax'], $field['note']);

        $_SESSION['insert']['fie_insert'][$index] = $field;
    }

    
}
