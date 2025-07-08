<?php
require_once('../../functions.php');

session_start();
$dbh = get_db_connect();



    try {
        // 1つ目のクエリ: contactテーブルを空にする
        $sql ='TRUNCATE TABLE contact';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
    
        // 2つ目のクエリ: contact_backupをcontact_introに複製（バックアップ復元）
        $sql ='INSERT INTO contact SELECT * FROM contact_backup';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
    
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

include_once('file_backup_view.php');

?>