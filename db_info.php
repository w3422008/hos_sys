<?php
require_once('functions.php');

try {
    $pdo = get_db_connect();

    echo "=== データベース情報 ===\n";
    echo "データベース名: hosplistdb\n";
    echo "接続先: localhost\n\n";

    echo "=== テーブル一覧 ===\n";
    $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
    foreach($tables as $table) {
        echo "- $table\n";
    }

    echo "\n=== 重要なテーブルの詳細 ===\n";
    
    // 主要なテーブル（import処理関連）の詳細を表示
    $important_tables = ['training', 'intro', 'invers_intro', 'contact'];
    
    foreach($important_tables as $table) {
        if (in_array($table, $tables)) {
            echo "\n【$table テーブル】\n";
            $columns = $pdo->query("SHOW COLUMNS FROM $table")->fetchAll(PDO::FETCH_ASSOC);
            foreach($columns as $col) {
                $key = $col['Key'] ? ' [' . $col['Key'] . ']' : '';
                $null = $col['Null'] === 'NO' ? ' NOT NULL' : '';
                $default = $col['Default'] ? ' DEFAULT: ' . $col['Default'] : '';
                echo "  - $col[Field]: $col[Type]$key$null$default\n";
            }
            
            // 主キー情報を取得
            echo "  主キー情報:\n";
            $keys = $pdo->query("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'")->fetchAll(PDO::FETCH_ASSOC);
            if ($keys) {
                $pk_columns = array_column($keys, 'Column_name');
                echo "    PRIMARY KEY: (" . implode(', ', $pk_columns) . ")\n";
            }
        }
    }
    
    echo "\n=== データベース文字セット ===\n";
    $charset = $pdo->query("SELECT DEFAULT_CHARACTER_SET_NAME FROM information_schema.SCHEMATA WHERE SCHEMA_NAME = 'hosplistdb'")->fetchColumn();
    echo "文字セット: $charset\n";
    
} catch (Exception $e) {
    echo "エラー: " . $e->getMessage() . "\n";
}
?>
