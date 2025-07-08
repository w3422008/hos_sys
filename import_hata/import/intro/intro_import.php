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
        // トランザクションを開始
        $pdo->beginTransaction();

        // テーブルロックをかける
        $lockSql = 'LOCK TABLES intro WRITE';            
        $pdo->exec($lockSql);

        // 1つ目のクエリ: intro_backupテーブルを空にする
        $sql = 'TRUNCATE TABLE intro_backup';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // 2つ目のクエリ: introをintro_backupに複製（バックアップする）
        $sql = 'INSERT INTO intro_backup SELECT * FROM intro';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

// セッションからCSVデータを取得
if (isset($_SESSION['csv_data'])) {
    $csv_data = $_SESSION['csv_data'];

    // 1か月用のインポートかどうか判定
    if (isset($_POST['month'])) {
        // CSVデータの1行目をスキップ
        $csv_data = array_slice($csv_data, 1);

        foreach ($csv_data as $row) {
            $ins = $row[1];   // ins
            $date = $row[3];  // date

            // 年月を取得
            $yearMonth = date('Y-m', strtotime($date));

            // 一致するデータを削除
            $deleteSql = 'DELETE FROM intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?';
            $deleteStmt = $pdo->prepare($deleteSql);
            $deleteStmt->execute([$ins, $yearMonth]);
        }

        // 挿入
        foreach ($csv_data as $row) {
            $insertSql = '
                INSERT INTO intro (
                    hos_cd, ins, year, date, fie_cd, fie_name, intr
                ) VALUES (?, ?, ?, ?, ?, ?, ?)';
            $insertStmt = $pdo->prepare($insertSql);
            $insertStmt->execute([
                $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]
            ]);
        }

    // 1年用のインポートの場合
    } else {
        // CSVデータの1行目をスキップ
        $csv_data = array_slice($csv_data, 1);

        foreach ($csv_data as $row) {
            $ins = $row[1]; // ins
            $min = $_SESSION['minYearMonth'];
            $max = $_SESSION['maxYearMonth'];
            // insと年月範囲で削除
            $deleteSql = 'DELETE FROM intro WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") BETWEEN ? AND ?';
            $deleteStmt = $pdo->prepare($deleteSql);
            $deleteStmt->execute([$ins, $min, $max]);
        }

        // 挿入
        foreach ($csv_data as $row) {
            $insertSql = '
                INSERT INTO intro (
                    hos_cd, ins, year, date, fie_cd, fie_name, intr
                ) VALUES (?, ?, ?, ?, ?, ?, ?)';
            $insertStmt = $pdo->prepare($insertSql);
            $insertStmt->execute([
                $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]
            ]);
        }
    }
}
        // トランザクションをコミット
        $pdo->commit();

        // テーブルロックを解除
        $unlockSql = 'UNLOCK TABLES';
        $pdo->exec($unlockSql);

        include_once('intro_import_view.php');

    } catch (Exception $e) {
        // エラーが発生した場合はロールバック
        $pdo->rollBack();

        // テーブルロックを解除
        $unlockSql = 'UNLOCK TABLES';
        $pdo->exec($unlockSql);

        $imp_err = "データのインポート中にエラーが発生しました: " . $e->getMessage();
        echo '<a href="file_select.php">戻る</a>';
    }
}

?>