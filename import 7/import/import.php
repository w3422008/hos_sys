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
            'backupFileName' => date('Ymd_His') . '_backup.csv',
            'columns' => ['hos_cd', 'ins', 'year', 'date', 'fie_cd', 'fie_name', 'intr'],
            'JP_columns' => ['医療機関CD','病院区分','年度','診療日','科コード','診療科','紹介件数'],
            'lock' => 'intro',
            'month_delete' => 'DELETE FROM intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
            'year_delete'  => 'DELETE FROM intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") BETWEEN ? AND ?',
        ],
        'introM' => [
            'table' => 'intro',
            'backup' => 'intro_backup',
            'backupDir' => __DIR__ . '/BK_intro/',
            'backupFileName' => date('Ymd_His') . '_backup.csv',
            'columns' => ['hos_cd', 'ins', 'year', 'date', 'fie_cd', 'fie_name', 'intr'],
            'JP_columns' => ['医療機関CD','病院区分','年度','診療日','科コード','診療科','紹介件数'],
            'lock' => 'intro',
            'month_delete' => 'DELETE FROM intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
            'year_delete'  => 'DELETE FROM intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") BETWEEN ? AND ?',
        ],
        'inversintroY' => [
            'table' => 'invers_intro',
            'backup' => 'invers_intro_backup',
            'backupDir' => __DIR__ . '/BK_invers_intro/',
            'backupFileName' => date('Ymd_His') . '_backup.csv',
            'columns' => ['hos_cd', 'ins', 'year', 'date', 'fie_cd', 'fie_name', 'invr_intr'],
            'JP_columns' => ['医療機関CD','病院区分','年度','診療日','科コード','診療科','紹介件数'],
            'lock' => 'invers_intro',
            'month_delete' => 'DELETE FROM invers_intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
            'year_delete'  => 'DELETE FROM invers_intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") BETWEEN ? AND ?',
        ],
        'inversintroM' => [
            'table' => 'invers_intro',
            'backup' => 'invers_intro_backup',
            'backupDir' => __DIR__ . '/BK_invers_intro/',
            'backupFileName' => date('Ymd_His') . '_backup.csv',
            'columns' => ['hos_cd', 'ins', 'year', 'date', 'fie_cd', 'fie_name', 'invr_intr'],
            'JP_columns' => ['医療機関CD','病院区分','年度','診療日','科コード','診療科','紹介件数'],
            'lock' => 'invers_intro',
            'month_delete' => 'DELETE FROM invers_intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
            'year_delete'  => 'DELETE FROM invers_intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") BETWEEN ? AND ?',
        ],
        'contactY' => [
            'table' => 'contact',
            'backup' => 'contact_backup',
            'backupDir' => __DIR__ . '/BK_contact/',
            'backupFileName' => date('Ymd_His') . '_backup.csv',
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
            'backupFileName' => date('Ymd_His') . '_backup.csv',
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
            'backupFileName' => date('Ymd_His') . '_backup.csv',
            'columns' => [
                'hos_cd', 'year', 'ins', 'tra_name', 'dep', 'occ', 'name', 'start', 'end', 'dia_div', 'date', 'occ_turn'
            ],
            'JP_columns' => ['医療機関CD','年度','施設','医療機関名','診療科','職名','氏名','開始日','終了日','診療支援区分','日時','役職順'],
            'lock' => 'training',
            'month_delete' => 'DELETE FROM training WHERE year = ? AND ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
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
        $pdo->exec('LOCK TABLES ' . $info['lock'] . ' WRITE, ' . $info['backup'] . ' WRITE');

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

        // 重複削除処理
        if ($data_type === 'training') {
            // trainingはyear, insで削除（年単位）、月単位はdateも考慮
            $keys = [];
            foreach ($csv_data as $row) {
                if ($is_month) {
                    // 月単位
                    $keys[] = [$row[1], $row[2], date('Y-m', strtotime($row[10]))];
                } else {
                    // 年単位
                    $keys[] = [$row[1], $row[2]];
                }
            }

            $keys = array_unique($keys, SORT_REGULAR);
            foreach ($keys as $key) {
                if ($is_month) {
                    // 月単位
                    $stmt = $pdo->prepare($info['month_delete']);
                    $stmt->execute($key);
                } else {
                    // 年単位
                    $stmt = $pdo->prepare($info['year_delete']);
                    $stmt->execute($key);
                }
            }
        } else {
            // intro, invers_intro, contact
            $keys = [];
            foreach ($csv_data as $row) {
                if ($is_month) {
                    // データ種別ごとに日付カラムのインデックスを切り替え
                    if ($data_type === 'contact') {
                        $date_col = 4; // contactは5番目（0始まり）
                    } else {
                        $date_col = 3; // intro, invers_introは4番目（0始まり）
                    }
                    $keys[] = [$row[1], date('Y-m', strtotime($row[$date_col]))];
                } else {
                    $min = $_SESSION['minYearMonth'] ?? null;
                    $max = $_SESSION['maxYearMonth'] ?? null;
                    $keys[] = [$row[1], $min, $max];
                }
            }
            $keys = array_unique($keys, SORT_REGULAR);
            foreach ($keys as $key) {
                if ($is_month) {
                    $stmt = $pdo->prepare($info['month_delete']);
                    $stmt->execute($key);
                } else {
                    $stmt = $pdo->prepare($info['year_delete']);
                    $stmt->execute($key);
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
        // 成功時JSONで返す
        echo json_encode([
            'judge' => 'success',
            'message' => 'インポートが完了しました。'
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
?>