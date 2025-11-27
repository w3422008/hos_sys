<?php
if(isset($_SESSION)==null){
    session_start();
}
require_once('../functions.php');

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

$dbh = get_db_connect();

// ★ リアルタイム検索処理（AJAX対応）
if(isset($_GET['ajax']) && $_GET['ajax'] === '1') {
    header('Content-Type: application/json; charset=UTF-8');
    
    try {
        $search_keyword = $_GET['keyword'] ?? '';
        $filter_status = $_GET['status'] ?? 'ALL';
        $page = (int)($_GET['page'] ?? 1);
        // ★ per_page パラメータを正しく取得
        $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 5;
        
        // ★ per_page が合理的な範囲か確認
        if($per_page <= 0 || $per_page > 99999) {
            $per_page = 5;
        }
        
        // ページ番号の検証
        if($page < 1) {
            $page = 1;
        }
        
        error_log("AJAX Debug: per_page={$per_page}, page={$page}");
        
        // 検索実行
        if(!empty($search_keyword)) {
            $results = search_users($dbh, $search_keyword, $filter_status);
        } else {
            $results = get_users_by_status($dbh, $filter_status);
        }
        
        // ページネーション処理
        $total = count($results);
        $offset = ($page - 1) * $per_page;
        
        // ★ array_slice の第4引数を false に設定
        $display_data = array_slice($results, $offset, $per_page, false);
        $display_data = array_values($display_data);
        
        // ★ ceil で正確に計算
        $total_pages = ceil($total / $per_page);
        
        error_log("Response Debug: total={$total}, offset={$offset}, display_count=" . count($display_data) . ", total_pages={$total_pages}");
        
        // JSON返却
        echo json_encode([
            'success' => true,
            'total' => $total,
            'current_page' => $page,
            'total_pages' => $total_pages,
            'data' => $display_data,
            'debug' => [
                'keyword' => $search_keyword,
                'status' => $filter_status,
                'offset' => $offset,
                'per_page' => $per_page,
                'count' => count($display_data),
                'total_pages' => $total_pages
            ]
        ], JSON_UNESCAPED_UNICODE);
        exit;
        
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage(),
            'line' => $e->getLine()
        ]);
        exit;
    }
}

// ★ 初期表示用（ページロード時）
$search_keyword = $_GET['keyword'] ?? '';
$filter_status = $_GET['status'] ?? 'ALL';
$page = (int)($_GET['page'] ?? 1);
$per_page = 5; // ★ 初期表示は常に5

if($page < 1) {
    $page = 1;
}

if(!empty($search_keyword)) {
    $data = search_users($dbh, $search_keyword, $filter_status);
} else {
    $data = get_users_by_status($dbh, $filter_status);
}

$total = count($data);
$offset = ($page - 1) * $per_page;
$display_data = array_slice($data, $offset, $per_page, false);
$display_data = array_values($display_data);
$total_pages = ceil($total / $per_page);

// ユーザー統計
$active_user = count(get_result1($dbh));
$hide_user = count(get_result2($dbh));
$total_user = count(get_result3($dbh));

if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
}

include_once('user_MT_view.php');
?>