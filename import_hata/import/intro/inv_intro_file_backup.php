<?php
require_once('../../functions.php');

session_start();
$dbh = get_db_connect();



    try {
        // 1つ目のクエリ: invers_introテーブルを空にする
        $sql ='TRUNCATE TABLE invers_intro';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
    
        // 2つ目のクエリ: invers_intro_backupをinvers_introに複製（バックアップ復元）
        $sql ='INSERT INTO invers_intro SELECT * FROM invers_intro_backup';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
    
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

include_once('inv_intro_file_backup_view.php');

?>