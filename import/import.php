<?php
ob_clean();
header('Content-Type: application/json; charset=UTF-8');
session_start();
require_once('../functions.php');

// バックアップテーブルをCSVファイルとして保存する関数
function export_backup_table_to_csv($pdo, $backup_table, $backupFileName, $backupDir, $JP_columns, $table_check) {
    if (!is_dir($backupDir)) {
        mkdir($backupDir, 0777, true);
    }
    $backupFilePath = $backupDir . $backupFileName;

    $stmt = $pdo->query("SELECT * FROM $backup_table");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($rows) {
        $fp = fopen($backupFilePath, 'w');
        fwrite($fp, "\xEF\xBB\xBF"); // UTF-8 BOM付与
        // ★カラム名を1行目に出力
        fputcsv($fp, $JP_columns);
        foreach ($rows as $r) {
            // contact_backupの場合は1列目（id）をスキップ
            if ($table_check === 'contact') {
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // データ種別をPOSTで受け取る
    $data_type = $_POST['data_type'] ?? null;

    // テーブル情報
    $table_info = [
        'introY' => [
            'table' => 'intro',
            'backup' => 'intro_backup',
            'backupDir' => __DIR__ . '/BK_intro/',
            'backupFileName' => date('Ymd_His') . '_Year_import.csv',
            'columns' => ['hos_cd', 'ins', 'year', 'date', 'fie_cd', 'fie_name', 'intr'],
            'JP_columns' => ['医療機関CD','病院区分','年度','診療年月日','科コード','診療科','紹介件数'],
            'lock' => 'intro',
            'month_delete' => 'DELETE FROM intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
            'year_delete'  => 'DELETE FROM intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") BETWEEN ? AND ?',
        ],
        'introM' => [
            'table' => 'intro',
            'backup' => 'intro_backup',
            'backupDir' => __DIR__ . '/BK_intro/',
            'backupFileName' => date('Ymd_His') . '_Month_import.csv',
            'columns' => ['hos_cd', 'ins', 'year', 'date', 'fie_cd', 'fie_name', 'intr'],
            'JP_columns' => ['医療機関CD','病院区分','年度','診療年月日','科コード','診療科','紹介件数'],
            'lock' => 'intro',
            'month_delete' => 'DELETE FROM intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
            'year_delete'  => 'DELETE FROM intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") BETWEEN ? AND ?',
        ],
        'inversintroY' => [
            'table' => 'invers_intro',
            'backup' => 'invers_intro_backup',
            'backupDir' => __DIR__ . '/BK_invers_intro/',
            'backupFileName' => date('Ymd_His') . '_Year_import.csv',
            'columns' => ['hos_cd', 'ins', 'year', 'date', 'fie_cd', 'fie_name', 'invr_intr'],
            'JP_columns' => ['医療機関CD','病院区分','年度','診療年月日','科コード','診療科','紹介件数'],
            'lock' => 'invers_intro',
            'month_delete' => 'DELETE FROM invers_intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
            'year_delete'  => 'DELETE FROM invers_intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") BETWEEN ? AND ?',
        ],
        'inversintroM' => [
            'table' => 'invers_intro',
            'backup' => 'invers_intro_backup',
            'backupDir' => __DIR__ . '/BK_invers_intro/',
            'backupFileName' => date('Ymd_His') . '_Month_import.csv',
            'columns' => ['hos_cd', 'ins', 'year', 'date', 'fie_cd', 'fie_name', 'invr_intr'],
            'JP_columns' => ['医療機関CD','病院区分','年度','診療年月日','科コード','診療科','紹介件数'],
            'lock' => 'invers_intro',
            'month_delete' => 'DELETE FROM invers_intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
            'year_delete'  => 'DELETE FROM invers_intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") BETWEEN ? AND ?',
        ],
        'contactY' => [
            'table' => 'contact',
            'backup' => 'contact_backup',
            'backupDir' => __DIR__ . '/BK_contact/',
            'backupFileName' => date('Ymd_His') . '_Year_import.csv',
            'columns' => [
                'hos_cd', 'hos_name', 'year', 'ins', 'date', 'method', 'ex_dept', 'ex_position', 'ex_name', 'ex_subnames',
                'in_dept', 'in_name', 'in_subnames', 'detail', 'con_note', 'data_dept'
            ],
            'JP_columns' => ['医療機関CD','医療機関名','年度','施設区分','日付','方法','連携機関対応者部署','連携機関対応者役職','連携機関対応者氏名','連携機関対応人数・氏名','当院対応者所属','当院対応者氏名','当院対応人数・氏名','内容','備考','データ作成部署'],
            'lock' => 'contact',
            'month_delete' => 'DELETE FROM contact WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
            'year_delete'  => 'DELETE FROM contact WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") BETWEEN ? AND ?',
        ],
        'contactM' => [
            'table' => 'contact',
            'backup' => 'contact_backup',
            'backupDir' => __DIR__ . '/BK_contact/',
            'backupFileName' => date('Ymd_His') . '_Month_import.csv',
            'columns' => [
                'hos_cd', 'hos_name', 'year', 'ins', 'date', 'method', 'ex_dept', 'ex_position', 'ex_name', 'ex_subnames',
                'in_dept', 'in_name', 'in_subnames', 'detail', 'con_note', 'data_dept'
            ],
            'JP_columns' => ['医療機関CD','医療機関名','年度','施設区分','日付','方法','連携機関対応者部署','連携機関対応者役職','連携機関対応者氏名','連携機関対応人数・氏名','当院対応者所属','当院対応者氏名','当院対応人数・氏名','内容','備考','データ作成部署'],
            'lock' => 'contact',
            'month_delete' => 'DELETE FROM contact WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
            'year_delete'  => 'DELETE FROM contact WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") BETWEEN ? AND ?',
        ],
        'training' => [
            'table' => 'training',
            'backup' => 'training_backup',
            'backupDir' => __DIR__ . '/BK_training/',
            'backupFileName' => date('Ymd_His') . '_import.csv',
            'columns' => [
                'hos_cd', 'year', 'ins', 'tra_name', 'dep', 'occ', 'name', 'start', 'end', 'dia_div', 'date', 'occ_turn'
            ],
            'JP_columns' => ['医療機関CD','年度','施設','医療機関名','診療科','職名','氏名','開始日','終了日','診療支援区分','日時','役職順'],
            'lock' => 'training',
            'month_delete' => 'DELETE FROM training WHERE year = ? AND ins = ?',
            'year_delete'  => 'DELETE FROM training WHERE year = ? AND ins = ?',
        ]
    ];
    
    if (!isset($table_info[$data_type])) {
        echo json_encode([
            'judge' => 'false',
            'text' => "データ種別が不正です。"
        ]);
        exit;
    }

    //  データ種別に応じたテーブル情報を取得
    $info = $table_info[$data_type];

    // バックアップファイルパス、ファイル名 呼び出し
    $backupDir = $info['backupDir'];
    $backupFileName = $info['backupFileName'];
    $JP_columns = $info['JP_columns'];
    $table_check = $info['table'];

    // PDOインスタンスを作成
    $pdo = get_db_connect();

    try {
        // トランザクション開始
        $pdo->beginTransaction();

        // テーブルロック
        $pdo->exec('LOCK TABLES ' . $info['lock'] . ' WRITE, ' . $info['backup'] . ' WRITE, main READ');

        // ★ バックアップテーブルを空にする前にCSV化
        export_backup_table_to_csv($pdo, $info['backup'],  $backupFileName, $backupDir, $JP_columns, $table_check);


        // バックアップテーブルを空に
        $pdo->prepare('TRUNCATE TABLE ' . $info['backup'])->execute();

        // バックアップ
        $pdo->prepare('INSERT INTO ' . $info['backup'] . ' SELECT * FROM ' . $info['table'])->execute();

        // セッションからCSVデータを取得
        if (!isset($_SESSION['csv_data'])) {
            throw new Exception('CSVデータがありません。');
        }
        $csv_data = $_SESSION['csv_data'];

        // 1行目（ヘッダ）をスキップ
        $csv_data = array_slice($csv_data, 1);

        // 月単位インポート判定
        $is_month = $_POST['month'];

        // mainテーブルとの整合性チェック
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
            if ($data_type === 'contactY' || $data_type === 'contactM') {
                $csv_hos_name = trim($row[1] ?? ''); // contactの場合は1番目
            } elseif ($data_type === 'training') {
                $csv_hos_name = trim($row[3] ?? ''); // trainingの場合は3番目（tra_name）
            } else {
                // intro, inversintroの場合はhos_nameがないため、hos_cdのみチェック
                $csv_hos_name = null;
            }

            // hos_cdの存在チェック
            if (!isset($main_hospitals[$csv_hos_cd])) {
                $hos_data_errors[] = "・行" . ($row_index + 2) . ": 医療機関CD「{$csv_hos_cd}」がシステムに登録されていません。";
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
                    // 法人格を除去（医療法人、社会医療法人、財団法人、社団法人、学校法人、独立行政法人など）
                    // $legal_entities = [
                    //     '社会医療法人', '医療法人', '医療法人社団', '医療法人財団',
                    //     '財団法人', '社団法人', '一般財団法人', '一般社団法人', 
                    //     '公益財団法人', '公益社団法人', '学校法人', '独立行政法人',
                    //     '国立大学法人', '公立大学法人', '特定医療法人', '全仁会'
                    // ];
                    // foreach ($legal_entities as $entity) {
                    //     $str = str_replace($entity, '', $str);
                    // }
                    // 前後の空白を削除
                    return trim($str);
                };
                
                // 正規化した文字列で比較
                $normalized_expected = $normalize($expected_name);
                $normalized_input = $normalize($csv_hos_name);
                
                // 部分一致チェック：入力値がmainテーブルのhos_nameに含まれているかチェック
                if (strpos($normalized_expected, $normalized_input) === false) {
                    $hos_data_errors[] = "・行" . ($row_index + 2) . ": 医療機関CD「{$csv_hos_cd}」の医療機関名が一致しません。<br>　対応病院名: 「{$expected_name}」<br>　入力値: 「{$csv_hos_name}」<br>　正規化後比較: 「{$normalized_expected}」 ← 「{$normalized_input}」";
                }
            }
        }

        // エラーがある場合は処理を停止
        if (!empty($hos_data_errors)) {
            throw new Exception("医療機関情報に不整合があります。<br>" . implode('<br>', $hos_data_errors));
        }

        $debug = [
            'delete_sql' => [],
            'delete_keys' => [],
            'deleted_rows' => [],
            'delete_dates' => [],
        ];
        
        // 削除処理
        if ($data_type === 'training') {
            $keys = [];
            foreach ($csv_data as $row) {
                $keys[] = [$row[1], $row[2]];
            }
            $keys = array_unique($keys, SORT_REGULAR);
            // 重複を削除するためのキーを作成・デバッグ処理
            foreach ($keys as $key) {
                if ($is_month) {
                    $stmt = $pdo->prepare($info['month_delete']);
                    $stmt->execute($key);
                    $debug['delete_sql'][] = $info['month_delete'];
                    $debug['delete_keys'][] = $key;
                    $debug['deleted_rows'][] = $stmt->rowCount();
                    $debug['delete_dates'][] = $info['JP_columns'][4];
                } else {
                    $stmt = $pdo->prepare($info['year_delete']);
                    $stmt->execute($key);
                    $debug['delete_sql'][] = $info['year_delete'];
                    $debug['delete_keys'][] = $key;
                    $debug['deleted_rows'][] = $stmt->rowCount();
                }
            }
        } else {
            $keys = [];
            foreach ($csv_data as $row) {
                if ($is_month) {
                    if ($data_type === 'contactM' || $data_type === 'contactY') {
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
                    if ($data_type === 'contact') {
                        $data_ins = $row[3];
                    } else {
                        $data_ins = $row[1];
                    }
                    $keys[] = [$data_ins, $min, $max];
                }
            }
            $keys = array_unique($keys, SORT_REGULAR);
            // 重複を削除するためのキーを作成・デバッグ処理
            foreach ($keys as $key_idx => $key) {
                if ($is_month) {
                    $stmt = $pdo->prepare($info['month_delete']);
                    $stmt->execute($key);
                    $debug['delete_sql'][] = $info['month_delete'];
                    $debug['delete_keys'][] = $key;
                    $debug['deleted_rows'][] = $stmt->rowCount();
                    $debug['delete_date'][] = isset($csv_data[$key_idx][4]) ? $csv_data[$key_idx][4] : null;
                } else {
                    $stmt = $pdo->prepare($info['year_delete']);
                    $stmt->execute($key);
                    $debug['delete_sql'][] = $info['year_delete'];
                    $debug['delete_keys'][] = $key;
                    $debug['deleted_rows'][] = $stmt->rowCount();
                    $debug['delete_date'][] = isset($csv_data[$key_idx][4]) ? $csv_data[$key_idx][4] : null;
                }
            }
        }

        // 挿入処理
        $col_count = count($info['columns']);
        $insertSql = 'INSERT INTO ' . $info['table'] . ' (' . implode(',', $info['columns']) . ') VALUES (' . rtrim(str_repeat('?,', $col_count), ',') . ')';
        $insertStmt = $pdo->prepare($insertSql);
        foreach ($csv_data as $row) {
            $insertStmt->execute(array_slice($row, 0, $col_count));
        }

        // コミット
        $pdo->commit();

        // テーブルロック解除
        $pdo->exec('UNLOCK TABLES');

        // 成功時はJSONで返す
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode([
            'judge' => 'success',
            'text' => 'インポートが完了しました。',
            'debug' => $debug
        ]);
        exit;

    } catch (Exception $e) {
        // エラー時ロールバックとロック解除
        $pdo->rollBack();
        $pdo->exec('UNLOCK TABLES');
        $imp_err = "データのインポート中にエラーが発生しました: " . $e->getMessage();
        echo json_encode([
            'judge' => 'false',
            'text' => $imp_err
        ]);
        exit;
    }
}
