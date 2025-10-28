<?php
session_start();
header('Content-Type: application/json; charset=UTF-8');

// ログイン確認
if (!isset($_SESSION['member'])) {
    echo json_encode(['success' => false, 'message' => 'ログインが必要です']);
    exit;
}

// 現在の権限を確認（デバッグ用ログ）
$current_user_permission = $_SESSION['member']['adm_user'];
error_log("Permission change attempt: User ID {$_SESSION['member']['user_id']}, Current permission: {$current_user_permission}");

// リクエストデータの取得
$input = json_decode(file_get_contents('php://input'), true);

// デバッグ用ログ
error_log("Request input: " . print_r($input, true));

if (!$input || !isset($input['user_id']) || !isset($input['new_permission'])) {
    echo json_encode(['success' => false, 'message' => '必要なパラメータが不足しています']);
    exit;
}

$user_id = $input['user_id'];
$new_permission = $input['new_permission'];

// デバッグ用ログ
error_log("Permission change request: User ID {$user_id}, New permission: {$new_permission}, Session User ID: {$_SESSION['member']['user_id']}");

// バリデーション
if (!in_array($new_permission, ['0', '1', '2', '3'])) {
    echo json_encode(['success' => false, 'message' => '無効な権限値です: ' . $new_permission]);
    exit;
}

// 自分自身の権限変更のみ許可
if ($user_id !== $_SESSION['member']['user_id']) {
    echo json_encode(['success' => false, 'message' => '自分の権限のみ変更可能です']);
    exit;
}

try {
    // セッションの権限のみ更新（データベースは変更しない）
    $old_permission = $_SESSION['member']['adm_user'];
    $_SESSION['member']['adm_user'] = $new_permission;
    
    // ログに記録（システム上での一時的な権限変更）
    error_log("Session permission changed: User {$user_id} changed permission from {$old_permission} to {$new_permission} (session only)");
    
    echo json_encode([
        'success' => true, 
        'message' => 'システム上の権限を変更しました（一時的な変更）',
        'old_permission' => $old_permission,
        'new_permission' => $new_permission
    ]);

} catch (Exception $e) {
    error_log("Session permission change error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'システムエラーが発生しました']);
}
?>
