<?php
ob_clean();
header('Content-Type: application/json; charset=UTF-8');
session_start();
require_once('../functions.php');

// まず基本的なチェック
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        'judge' => 'false',
        'text' => "不正なリクエストです。"
    ]);
    exit;
}

$user_id = html_escape($_SESSION['member']['user_id']);

// テーブル情報の定義
$table_info = [
    'introM' => [
        'table' => 'intro',
        'backupDir' => __DIR__ . '/BK_intro/',
        'columns' => ['hos_cd', 'ins', 'year', 'date', 'fie_cd', 'fie_name', 'intr'],
        'JP_columns' => ['医療機関CD','病院区分','年度','診療年月日','科コード','診療科','紹介件数'],
        'lock' => 'intro',
        'month_delete' => 'DELETE FROM intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
    ],
    'inversintroM' => [
        'table' => 'invers_intro',
        'backupDir' => __DIR__ . '/BK_invers_intro/',
        'columns' => ['hos_cd', 'ins', 'year', 'date', 'fie_cd', 'fie_name', 'invr_intr'],
        'JP_columns' => ['医療機関CD','病院区分','年度','診療年月日','科コード','診療科','紹介件数'],
        'lock' => 'invers_intro',
        'month_delete' => 'DELETE FROM invers_intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
    ],
    'contactM' => [
        'table' => 'contact',
        'backupDir' => __DIR__ . '/BK_contact/',
        'columns' => [
            'hos_cd', 'hos_name', 'year', 'ins', 'date', 'method', 'ex_dept', 'ex_position', 'ex_name', 'ex_subnames',
            'in_dept', 'in_name', 'in_subnames', 'detail', 'con_note', 'data_dept'
        ],
        'JP_columns' => ['医療機関CD','医療機関名','年度','施設区分','日付','方法','連携機関対応者部署','連携機関対応者役職','連携機関対応者氏名','連携機関対応人数・氏名','当院対応者所属','当院対応者氏名','当院対応人数・氏名','内容','備考','データ作成部署'],
        'lock' => 'contact',
        'month_delete' => 'DELETE FROM contact WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
    ],
    'training' => [
        'table' => 'training',
        'backupDir' => __DIR__ . '/BK_training/',
        'columns' => [
            'hos_cd', 'year', 'ins', 'tra_name', 'dep', 'position', 'name', 'start', 'end', 'dia_div', 'date'
        ],
        'JP_columns' => ['医療機関CD','年度','施設','医療機関名','診療科','職名','氏名','開始日','終了日','診療支援区分','日時'],
        'lock' => 'training',
        'year_delete'  => 'DELETE FROM training WHERE hos_cd = ? AND year = ? AND ins = ?',
    ]
];

// バックアップテーブルをCSVファイルとして保存する関数
function export_table_to_csv($pdo, $table, $backupFileName, $backupDir, $JP_columns) {
    if (!is_dir($backupDir)) {
        mkdir($backupDir, 0777, true);
    }
    $backupFilePath = $backupDir . $backupFileName;

    $stmt = $pdo->query("SELECT * FROM $table");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($rows) {
        $fp = fopen($backupFilePath, 'w');
        fwrite($fp, "\xEF\xBB\xBF"); // UTF-8 BOM付与
        // ★カラム名を1行目に出力
        fputcsv($fp, $JP_columns);
        foreach ($rows as $r) {
            // contactの場合は1列目（id）をスキップ
            if ($table === 'contact') {
                // array_valuesで添字を振り直し、1番目以降を出力
                $row_data = array_values($r);
                array_shift($row_data); // 先頭(id)を削除
                fputcsv($fp, $row_data);
            } else {
                fputcsv($fp, $r); // 変換不要
            }
        }
        fclose($fp);
    }
}

// バックアップファイル数制限関数
function cleanup_backup_files($backupDir, $maxFiles = 6) {
    if (!is_dir($backupDir)) {
        return;
    }
    
    // ディレクトリ内のCSVファイルを取得
    $files = [];
    $handle = opendir($backupDir);
    while (($file = readdir($handle)) !== false) {
        if ($file !== '.' && $file !== '..' && pathinfo($file, PATHINFO_EXTENSION) === 'csv') {
            $filePath = $backupDir . $file;
            $files[] = [
                'name' => $file,
                'path' => $filePath,
                'mtime' => filemtime($filePath)
            ];
        }
    }
    closedir($handle);
    
    // ファイル数が制限以下の場合は何もしない
    if (count($files) <= $maxFiles) {
        return;
    }
    
    // 更新日時で降順ソート（新しいファイルが先頭）
    usort($files, function($a, $b) {
        return $b['mtime'] <=> $a['mtime'];
    });
    
    // 制限を超えた古いファイルを削除
    for ($i = $maxFiles; $i < count($files); $i++) {
        $fileToDelete = $files[$i]['path'];
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // データ種別をPOSTで受け取る（JavaScriptからはdataTypeで送信される）
    $data_type = $_POST['dataType'] ?? $_POST['data_type'] ?? null;
    // データ種別が空または存在しない場合の詳細チェック
    if (empty($data_type)) {
        echo json_encode([
            'judge' => 'false',
            'confirmation_required' => false,
            'text' => "データ種別が指定されていません。ファイルを再選択してください。",
        ]);
        exit;
    }
    
    if (!isset($table_info[$data_type])) {
        echo json_encode([
            'judge' => 'false',
            'confirmation_required' => false,
            'text' => "データ種別が不正です。（{$data_type}）",
        ]);
        exit;
    }

    //  データ種別に応じたテーブル情報を取得
    $info = $table_info[$data_type];

    

    // バックアップファイルパス、ファイル名 呼び出し
    $backupDir = $info['backupDir'];
    $backupFileName = date('YmdHis') . '_' . $user_id . '_import.csv';
    $JP_columns = $info['JP_columns'];
    
    // PDOインスタンスを作成
    $pdo = get_db_connect();


    try {
        // トランザクション開始
        $pdo->beginTransaction();

        // テーブルロック
        $pdo->exec('LOCK TABLES ' . $info['lock'] . ' WRITE, main READ');
        
        if (!isset($_SESSION['csv_data'])) {
            echo json_encode([
                'judge' => 'false',
                'confirmation_required' => false,
                'text' => 'CSVデータがありません。ファイルを再選択してからインポートしてください。',
            ]);
            exit;
        }

        $csv_data = $_SESSION['csv_data'];

        // BOM除去処理（最初の行の最初のカラムから\ufeffを除去）
        if (!empty($csv_data) && isset($_COOKIEcsv_data[0][0])) {
            $csv_data[0][0] = preg_replace('/^\xEF\xBB\xBF/', '', $csv_data[0][0]);
        }

        // 1行目（ヘッダ）をスキップ
        $csv_data = array_slice($csv_data, 1);

        // 月単位インポート判定（JavaScriptからはmodeで送信される）
        $is_month = $_POST['mode'] ?? $_POST['month'] ?? null;

        // 強制インポートフラグをチェック
        $force_import = isset($_POST['force_import']) && $_POST['force_import'] === '1';

        // mainテーブルとの整合性チェック（強制インポートでない場合のみ）
        if (!$force_import) {
            $hos_data_errors = [];
            $main_hospitals = [];
            
            // mainテーブルから医療機関情報を取得
            $main_stmt = $pdo->query("SELECT hos_cd, hos_name FROM main WHERE onf = 0");
            while ($row = $main_stmt->fetch(PDO::FETCH_ASSOC)) {
                $main_hospitals[$row['hos_cd']] = $row['hos_name'];
            }

            // CSVデータの医療機関情報をチェック
            foreach ($csv_data as $row_index => $row) {
                $csv_hos_cd = trim($row[0] ?? ''); // hos_cd は常に0番目
                
                // データ種別に応じてhos_nameの位置を特定
                if ($data_type === 'contactM') {
                    $csv_hos_name = trim($row[1] ?? ''); // contactの場合は1番目
                } elseif ($data_type === 'training') {
                    $csv_hos_name = trim($row[3] ?? ''); // trainingの場合は3番目（tra_name）
                } else {
                    // intro, inversintroの場合はhos_nameがないため、hos_cdのみチェック
                    $csv_hos_name = null;
                }

                // hos_cdの存在チェック
                if (!isset($main_hospitals[$csv_hos_cd])) {
                    // データ種別に応じてhos_nameの位置を特定（登録なしの場合の表示用）
                    $csv_hos_name_for_display = '';
                    if ($data_type === 'contactM') {
                        $csv_hos_name_for_display = trim($row[1] ?? ''); // contactの場合は1番目
                    } elseif ($data_type === 'training') {
                        $csv_hos_name_for_display = trim($row[3] ?? ''); // trainingの場合は3番目（tra_name）
                    }
                    
                    // 表形式表示用の統一フォーマット
                    if (!empty($csv_hos_name_for_display)) {
                        $hos_data_errors[] = "・行" . ($row_index + 2) . ": 医療機関CD「{$csv_hos_cd}」がシステムに登録されていません。<br>　マスタ病院名: 「登録がありません」<br>　CSVデータ: 「{$csv_hos_name_for_display}」";
                    } else {
                        $hos_data_errors[] = "・行" . ($row_index + 2) . ": 医療機関CD「{$csv_hos_cd}」がシステムに登録されていません。<br>　マスタ病院名: 「登録がありません」<br>　CSVデータ: 「-」";
                    }
                    continue;
                }

                // hos_nameの一致チェック（hos_nameがある場合のみ）
                if ($csv_hos_name !== null) {
                    $expected_name = $main_hospitals[$csv_hos_cd];
                    
                    // 文字列の正規化関数
                    $normalize = function($str) {
                        // 半角英数字を全角に変換
                        $str = mb_convert_kana($str, 'AS', 'UTF-8');
                        // 全角・半角スペースを全て削除
                        $str = str_replace(['　', ' ', '\t', '\n', '\r'], '', $str);
                        // 前後の空白を削除
                        return trim($str);
                    };
                    
                    // 正規化した文字列で比較
                    $normalized_expected = $normalize($expected_name);
                    $normalized_input = $normalize($csv_hos_name);
                    
                    // 部分一致チェック：入力値がmainテーブルのhos_nameに含まれているかチェック
                    if (strpos($normalized_expected, $normalized_input) === false) {
                        $hos_data_errors[] = "・行" . ($row_index + 2) . ": 医療機関CD「{$csv_hos_cd}」の医療機関名が一致しません。<br>　マスタ病院名: 「{$expected_name}」<br>　CSVデータ: 「{$csv_hos_name}」<br>　正誤比較: 正：「{$normalized_expected}」  誤：「{$normalized_input}」";
                    }
                }
            }

            // データに不整合がある場合は確認画面を表示
            if (!empty($hos_data_errors)) {
                echo json_encode([
                    'judge' => false,
                    'confirmation_required' => true,
                    'errors' => $hos_data_errors,
                    'text' => "医療機関情報に不整合があります。以下の項目を確認してください。",
                    'dataType' => $data_type,
                    'mode' => $is_month === '1' ? 'month' : 'year'
                ]);
                exit;
            }
        }

        // 削除処理
        if ($data_type === 'training') {
            $keys = [];
            foreach ($csv_data as $row) {
                $keys[] = [$row[0], $row[1], $row[2]]; // hos_cd, year, ins
            }
            $keys = array_unique($keys, SORT_REGULAR);
            // 重複を削除するためのキーを作成・デバッグ処理
            foreach ($keys as $key) {
                $stmt = $pdo->prepare($info['year_delete']);
                $stmt->execute($key);
            }
        } else {
            $keys = [];
            foreach ($csv_data as $row) {
                if ($is_month) {
                    if ($data_type === 'contactM') {
                        $date_col = 4;
                        $data_ins = $row[3];
                    } else {
                        $date_col = 3;
                        $data_ins = $row[1];
                    }

                    $date_str = isset($row[$date_col]) ? trim($row[$date_col]) : '';
                    $formatted_date = '';
                    // 1. 正規表現で年月を抜き出す（例: 2023/12/1 → 2023-12）
                    if (preg_match('/(\d{4})[\/\-](\d{1,2})/', $date_str, $m)) {
                        $formatted_date = sprintf('%04d-%02d', $m[1], $m[2]);
                    }
                    if ($data_ins !== '' && $formatted_date !== '') {
                        $keys[] = [$data_ins, $formatted_date];
                    }
                } else {
                    $min = $_SESSION['minYearMonth'] ?? null;
                    $max = $_SESSION['maxYearMonth'] ?? null;
                    // contactM/contactYとcontactの判定を統一
                    if ($data_type === 'contactM') {
                        $data_ins = $row[3];
                    } else {
                        $data_ins = $row[1];
                    }
                    $keys[] = [$data_ins, $min, $max];
                }
            }
            $keys = array_unique($keys, SORT_REGULAR);
            // 重複を削除するためのキーを作成
            foreach ($keys as $key_idx => $key) {
                $stmt = $pdo->prepare($info['month_delete']);
                $stmt->execute($key);
            }
        }

        // 挿入処理
        $col_count = count($info['columns']);
        $insertSql = 'INSERT INTO ' . $info['table'] . ' (' . implode(',', $info['columns']) . ') VALUES (' . rtrim(str_repeat('?,', $col_count), ',') . ')';

        $insertStmt = $pdo->prepare($insertSql);
        // $insertStmt->execute($info['columns']);
            
        foreach ($csv_data as $row_index => $row) {
            $insert_data = array_slice($row, 0, $col_count);
            $actual_count = count($insert_data);
            // trainingのposition項目の数字を半角に統一
            if ($data_type === 'training' && isset($info['columns'])) {
                $pos_idx = array_search('position', $info['columns']);
                if ($pos_idx !== false && isset($insert_data[$pos_idx])) {
                    // 全角数字を半角に変換
                    $insert_data[$pos_idx] = mb_convert_kana($insert_data[$pos_idx], 'n', 'UTF-8');
                }
            }
                
            // 不足分を空文字で埋める
            $insert_data = array_pad($insert_data, $col_count, '');

            // インサート実行
            $insertStmt->execute($insert_data);
        }

        // ★ バックアップテーブルを空にする前のみCSV化（1回のみ）
        export_table_to_csv($pdo, $info['table'], $backupFileName, $backupDir, $JP_columns);


        // コミット
        $pdo->commit();

        // テーブルロック解除
        $pdo->exec('UNLOCK TABLES');

        // ★ バックアップファイル数制限処理を追加（CSVファイル作成直後）
        cleanup_backup_files($backupDir, 6);

        // 成功時はJSONで返す
        header('Content-Type: application/json; charset=UTF-8');
        
        echo json_encode([
            'judge' => 'success',
            'confirmation_required' => false,
            'text' => 'インポートが完了しました。',
        ]);
        exit;

    } catch (Exception $e) {
        
        if (isset($pdo)) {
            $pdo->rollBack();
            $pdo->exec('UNLOCK TABLES');
        }
                
        $imp_err = "データのインポート中にエラーが発生しました: " . $e->getMessage();
        
        echo json_encode([
            'judge' => 'false',
            'confirmation_required' => false,
            'text' => $imp_err
        ]);
        exit;
    }
}
