<?php
session_start();
include_once("../functions.php");

if (isset($_GET['old_hospital_code']) && isset($_GET['hospital_code'])) {
    
    // 医療機関コードを基にデータを抽出し、セッションへ保存
    add_SESSION_info(html_escape($_GET['old_hospital_code']), html_escape($_GET['hospital_code']));
    check_medical_care(html_escape($_GET['old_hospital_code']));
    $_SESSION['insert']['hos_cd'] = html_escape($_GET['hospital_code']);

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


// 連携パス
// detail_cPath($dbh,$hos_cd,0); //附属病院
// detail_cPath($dbh,$hos_cd,1); //総合医療センター

// 医療連携懇話会参加年度
//$socialMeeting_data1 = detail_socialMeeting($dbh,$hos_cd,0); //附属病院
//$socialMeeting_data2 = detail_socialMeeting($dbh,$hos_cd,1); //総合医療センター
//$socialMeeting_data3 = detail_socialMeeting($dbh,$hos_cd,2); //高齢者医療センター