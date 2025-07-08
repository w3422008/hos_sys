<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // データベース接続情報
    $host = 'localhost';
    $db   = 'hosplistdb';
    $user = 'root';
    $pass = '';

    // PDOインスタンスを作成
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);

    try {
        // 1つ目のクエリ: training_backupテーブルを空にする
        $sql ='TRUNCATE TABLE training_backup';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    
        // 2つ目のクエリ: trainingをtraining_backupに複製（バックアップする）
        $sql ='INSERT INTO training_backup SELECT * FROM training';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    // セッションからCSVデータを取得
    if (isset($_SESSION['csv_data'])) {
        $csv_data = $_SESSION['csv_data'];

        // データベースにインポート
        try {
            // トランザクションを開始
            $pdo->beginTransaction();

            // テーブルロックをかける
            $lockSql = 'LOCK TABLES trainig WRITE';            
            $pdo->exec($lockSql);

            // CSVデータの1行目をスキップ
            $csv_data = array_slice($csv_data, 1);

            // CSVデータのyearとinsを取得
            $years_ins = array_map(function($row) {
                return [$row[1], $row[2]]; // yearとinsの組み合わせを取得
            }, $csv_data);
            $years_ins = array_unique($years_ins, SORT_REGULAR); // 重複を排除

            // 一致するデータを削除
            foreach ($years_ins as $year_ins) {
                $deleteSql = 'DELETE FROM training WHERE year = ? AND ins = ?';
                $deleteStmt = $pdo->prepare($deleteSql);
                $deleteStmt->execute([$year_ins[0], $year_ins[1]]);
            }

            // CSVデータをループしてデータベースに挿入
            foreach ($csv_data as $row) {
                $insertSql = '
                    INSERT INTO training (
                        hos_cd, year, ins, tra_name, dep, occ, name, start, end, dia_div, date, occ_turn
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
                $insertStmt = $pdo->prepare($insertSql);
                $insertStmt->execute([
                    $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11]
                ]);
            }

            // トランザクションをコミット
            $pdo->commit();

            // テーブルロックを解除
            $unlockSql = 'UNLOCK TABLES';
            $pdo->exec($unlockSql);
            
            include_once('import_view.php');

        } catch (Exception $e) {
            // エラーが発生した場合はロールバック
            $pdo->rollBack();
            $imp_err = "データのインポート中にエラーが発生しました: " . $e->getMessage();
            echo '<a href="file_select.php">戻る</a>';
        }

                }
            }
?>
