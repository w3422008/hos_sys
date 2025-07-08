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
        // 1つ目のクエリ: contact_backupテーブルを空にする
        $sql ='TRUNCATE TABLE contact_backup';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    
        // 2つ目のクエリ: contactをcontact_backupに複製（バックアップする）
        $sql ='INSERT INTO contact_backup SELECT * FROM contact';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    
    // セッションからCSVデータを取得
    if (isset($_SESSION['csv_data'])) {
        $csv_data = $_SESSION['csv_data'];

        //1か月用のインポートかどうか判定
        if(isset($_POST['month'])){
            
            // データベースにインポート
            try {
                $pdo->beginTransaction();
            
                // CSVデータの1行目をスキップ
                $csv_data = array_slice($csv_data, 1);
                
            
                foreach ($csv_data as $row) {
                    $ins = $row[3]; // ins
                    $date = $row[4]; // date

                    // 年月を取得
                    $yearMonth = date('Y-m', strtotime($date));

                    // 一致するデータを削除
                    $deleteSql = 'DELETE FROM contact WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") = ?';
                    $deleteStmt = $pdo->prepare($deleteSql);
                    $deleteStmt->execute([$ins, $yearMonth]);
                }

                // CSVデータをループしてデータベースに挿入
                foreach ($csv_data as $row) {
                    $insertSql = '
                        INSERT INTO contact (
                            hos_cd, hos_name, year, ins, date, method, ex_dept, ex_position, ex_name, ex_subnames, 
                            in_dept, in_name, in_subnames, detail, con_note, data_dept
                        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
                    $insertStmt = $pdo->prepare($insertSql);
                    $insertStmt->execute([
                        $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], 
                        $row[10], $row[11], $row[12], $row[13], $row[14], $row[15]
                    ]);
                }
            
                // トランザクションをコミット
                $pdo->commit();
                include_once('import_view.php');
            
            } catch (Exception $e) {
                // エラーが発生した場合はロールバック
                $pdo->rollBack();
                $imp_err = "データのインポート中にエラーが発生しました: " . $e->getMessage();
                echo '<a href="file_select.php">戻る</a>';
            }
        //1年用のインポートの場合-------------------------------------------------------------------------
        }else{
             // データベースにインポート
             try {
                $pdo->beginTransaction();

                // CSVデータの1行目をスキップ
                $csv_data = array_slice($csv_data, 1);



                foreach ($csv_data as $row) {
                    $ins = $row[3]; // ins
                    $min = $_SESSION['minYearMonth']; // min
                    $max = $_SESSION['maxYearMonth']; // max
                    // 年月を取得
                    //$yearMonth = date('Y-m', strtotime($date));

                // 一致するデータを削除
                $deleteSql = 'DELETE FROM contact WHERE ins = ? AND DATE_FORMAT(date, "%Y-%m") BETWEEN ? AND ?';
                $deleteStmt = $pdo->prepare($deleteSql);
                $deleteStmt->execute([$ins, $min, $max]);
                }


                // CSVデータをループしてデータベースに挿入
                foreach ($csv_data as $row) {
                    $insertSql = '
                        INSERT INTO contact (
                            hos_cd, hos_name, year, ins, date, method, ex_dept, ex_position, ex_name, ex_subnames, 
                            in_dept, in_name, in_subnames, detail, con_note, data_dept
                        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
                    $insertStmt = $pdo->prepare($insertSql);
                    $insertStmt->execute([
                        $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], 
                        $row[10], $row[11], $row[12], $row[13], $row[14], $row[15]
                    ]);
                }
            
                // トランザクションをコミット
                $pdo->commit();
                include_once('import_view.php');
            
            } catch (Exception $e) {
                // エラーが発生した場合はロールバック
                $pdo->rollBack();
                $imp_err = "データのインポート中にエラーが発生しました: " . $e->getMessage();
                echo '<a href="file_select.php">戻る</a>';
            }
    }
    }
    }


?>
