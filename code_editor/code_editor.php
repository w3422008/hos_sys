<?php
if(isset($_SESSION)==null){
    session_start();
}
require_once('../config.php');
require_once('../functions.php');

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

$dbh = get_db_connect();

// ★ AJAX検索処理
if(isset($_GET['ajax']) && $_GET['ajax'] === '1') {
    header('Content-Type: application/json; charset=UTF-8');
    
    try {
        $keyword = $_GET['keyword'] ?? '';
        $keyword = trim($keyword);
        $page = (int)($_GET['page'] ?? 1);
        $per_page = 12;
        
        // キーワード未入力時は全件取得
        if(empty($keyword)) {
            $sql = "SELECT hos_cd, hos_name, hos_div, bed, pre, area, town, str_num 
                    FROM main 
                    ORDER BY hos_cd ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
        } else {
            // キーワード検索（コード、名前、住所で検索）
            $like_keyword = "%{$keyword}%";
            $sql = "SELECT hos_cd, hos_name, hos_div, bed, pre, area, town, str_num 
                    FROM main 
                    WHERE hos_cd LIKE :keyword 
                       OR hos_name LIKE :keyword 
                       OR CONCAT(pre, area, town) LIKE :keyword
                    ORDER BY hos_cd ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':keyword', $like_keyword, PDO::PARAM_STR);
            $stmt->execute();
        }
        
        $all_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // ★ paginate() 関数を使用してページネーション処理を実行
        $pagination_result = paginate($all_results, $page, $per_page);
        
        // ★ 数値型のキャストを明示的に行う
        foreach($pagination_result['data'] as &$row) {
            $row['bed'] = isset($row['bed']) ? (int)$row['bed'] : 0;
        }
        unset($row);
        
        echo json_encode([
            'success' => true,
            'data' => $pagination_result['data'],
            'count' => $pagination_result['count'],
            'total' => $pagination_result['total'],
            'current_page' => $pagination_result['current_page'],
            'total_pages' => $pagination_result['total_pages']
        ], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        exit;
        
    } catch(Exception $e) {
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// ★ 初期表示は view に任せる
include_once('code_editor_view.php');
?>