<?php
require_once('../../functions.php');

session_start();
$dbh = get_db_connect();



    try {
        // 1つ目のクエリ: introテーブルを空にする
        $sql ='TRUNCATE TABLE intro';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
    
        // 2つ目のクエリ: intro_backupをintroに複製（バックアップ復元）
        $sql ='INSERT INTO intro SELECT * FROM intro_backup';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
    
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

include_once('intro_file_backup_view.php');

?>