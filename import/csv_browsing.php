<?php
function getCsvFolders() {
    return [
        'BK_contact'      => 'BK_contact',
        'BK_intro'        => 'BK_intro',
        'BK_invers_intro' => 'BK_invers_intro',
        'BK_training'     => 'BK_training',
    ];
}

function getCsvFiles($dir) {
    $files = [];
    if (is_dir($dir)) {
        foreach (glob($dir . '/*.csv') as $file) {
            $files[] = basename($file);
        }
    }
    return $files;
}

function getCsvTableHtml($baseDir, $folders, $viewFile) {
    $realPath = realpath($baseDir . $viewFile);
    $allow = false;
    foreach ($folders as $folder) {
        if (strpos($realPath, realpath($baseDir . $folder)) === 0) {
            $allow = true;
            break;
        }
    }
    if ($allow && is_file($realPath)) {
        if (($fp = fopen($realPath, 'r')) !== false) {
            $html = "<table class='stylish-csv-table'>";
            $isFirst = true;
            while (($row = fgetcsv($fp)) !== false) {
                $html .= "<tr>";
                foreach ($row as $cell) {
                    $tag = $isFirst ? "th" : "td";
                    $html .= "<$tag>" . htmlspecialchars($cell) . "</$tag>";
                }
                $html .= "</tr>";
                $isFirst = false;
            }
            $html .= "</table>";
            fclose($fp);
            return $html;
        }
    }
    return "<p style='color:red;'>ファイルが見つからないか、アクセスできません。</p>";
}
// require_once 'csv_browsing_model.php';

$folders = getCsvFolders();
$baseDir = __DIR__ . '/';

// AJAXリクエスト: CSV内容取得
if (isset($_GET['ajax_view'])) {
    $viewFile = $_GET['ajax_view'];
    echo getCsvTableHtml($baseDir, $folders, $viewFile);
    exit;
}

// ファイル一覧取得
$folderFiles = [];
foreach ($folders as $label => $folder) {
    $folderFiles[$label] = getCsvFiles($baseDir . $folder);
}

// ビューへ
require 'csv_browsing_view.php';