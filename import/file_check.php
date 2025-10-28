<?php

require_once('../functions.php');

session_start();

// fetchでJSONを返す
header('Content-Type: application/json; charset=UTF-8');

try {
    $dbh = get_db_connect();
} catch (Exception $e) {
    echo json_encode([
        'judge' => 'false',
        'text' => 'データベース接続エラーが発生しました。',
    ]);
    exit;
}

// グローバル変数を定義
$mode = '';
$latest_year = '';
$year = '';
$file_name = '';

// データ種別ごとの設定
$data_types = [

    //  配列内情報 補足
    // [
    //     'name' => データ名（確認画面で使用）
    //     'columns' => [CSVファイルのカラム(列)名の定義]
    //     'year_func' => function($dbh) {
    //         DBより最新年度を取得する関数を実行し、
    //         4桁の数字＋年を入れる（例：'2023年'）
    //     },
    //     'year_col' => 年度（または日付）がCSVの何列目にあるか（0始まりのインデックス）
    //     'year_label' => '年度' or '月'　(期間を表すラベル、確認画面・エラーメッセージで使用)
    //     'mode' => データ種別が「年単位（'year'）」か「月単位（'month'）」かを表す
    // ]

    'introY' => [
        'name' => '紹介データ',
        'columns' => ['医療機関CD','病院区分','年度','診療年月日','科コード','診療科','紹介件数'],
        'year_func' => function($dbh) {
            $intro_ym = get_intro_ym($dbh);
            return empty($intro_ym) ? 'データなし' : substr($intro_ym, 0, 4) . "年" . substr($intro_ym, 5, 2) . "月";
        },
        'year_col' => 3, // 年度
        'year_label' => '年度',
        'mode' => 'year'
    ],
    'introM' => [
        'name' => '紹介データ（月単位）',
        'columns' => ['医療機関CD','病院区分','年度','診療年月日','科コード','診療科','紹介件数'],
        'year_func' => function($dbh) {
            $intro_ym = get_intro_ym($dbh);
            return empty($intro_ym) ? 'データなし' : substr($intro_ym, 0, 4) . "年" . substr($intro_ym, 5, 2) . "月";
        },
        'year_col' => 3, // 診療年月日カラム
        'year_label' => '月',
        'mode' => 'month'
    ],
    'inversintroY' => [
        'name' => '紹介データ',
        'columns' => ['医療機関CD','病院区分','年度','診療年月日','科コード','診療科','紹介件数'],
        'year_func' => function($dbh) {
            $inv_ym = get_inv_intro_ym($dbh);
            return empty($inv_ym) ? 'データなし' : substr($inv_ym, 0, 4) . "年" . substr($inv_ym, 5, 2) . "月";
        },
        'year_col' => 3, // 年度
        'year_label' => '年度',
        'mode' => 'year'
    ],
    'inversintroM' => [
        'name' => '紹介データ（月単位）',
        'columns' => ['医療機関CD','病院区分','年度','診療年月日','科コード','診療科','紹介件数'],
        'year_func' => function($dbh) {
            $inv_ym = get_inv_intro_ym($dbh);
            return empty($inv_ym) ? 'データなし' : substr($inv_ym, 0, 4) . "年" . substr($inv_ym, 5, 2) . "月";
        },
        'year_col' => 3, // 診療年月日カラム
        'year_label' => '月',
        'mode' => 'month'
    ],
    'contactY' => [
        'name' => 'コンタクト履歴データ',
        'columns' => ['医療機関CD','医療機関名','年度','施設区分','日付','方法','連携機関対応者部署','連携機関対応者役職','連携機関対応者氏名','連携機関対応人数・氏名','当院対応者所属','当院対応者氏名','当院対応人数・氏名','内容','備考','データ作成部署'],
        'year_func' => function($dbh) {
            $contact_ym = get_contact_ym($dbh);
            return empty($contact_ym) ? 'データなし' : substr($contact_ym, 0, 4) . "年" . substr($contact_ym, 5, 2) . "月";
        },
        'year_col' => 4, // 年度
        'year_label' => '年',
        'mode' => 'year' // デフォルトは年単位
    ],
    'contactM' => [
        'name' => 'コンタクト履歴データ（月単位）',
        'columns' => ['医療機関CD','医療機関名','年度','施設区分','日付','方法','連携機関対応者部署','連携機関対応者役職','連携機関対応者氏名','連携機関対応人数・氏名','当院対応者所属','当院対応者氏名','当院対応人数・氏名','内容','備考','データ作成部署'],
        'year_func' => function($dbh) {
            $contact_ym = get_contact_ym($dbh);
            return empty($contact_ym) ? 'データなし' : substr($contact_ym, 0, 4) . "年" . substr($contact_ym, 5, 2) . "月";
        },
        'year_col' => 4, // 日付カラム
        'year_label' => '月',
        'mode' => 'month' // 月単位
    ],
    'training' => [
        'name' => '兼業データ',
        'columns' => ['医療機関CD','年度','施設','医療機関名','診療科','職名','氏名','開始日','終了日','診療支援区分','日時'],
        'year_func' => function($dbh) {
            $training_year = get_training_year($dbh);
            return empty($training_year) ? 'データなし' : substr($training_year, 0, 4) . "年度";
        },
        'year_col' => 1,
        'year_label' => '年度',
        'mode' => 'year'
    ]
];

$errors = [];
// データ種別をPOSTまたはGETで受け取る
$type = $_POST['data_type'] ?? $_GET['data_type'] ?? null;

if (!$type || !isset($data_types[$type])) {
    $errors[] = "・データ種別が不正です。";
    echo json_encode([
        'judge' => 'false',
        'text' => "・データ種別が不正です。"
    ]);
    exit;
}

// データ種別に応じた設定を取得
$setting = $data_types[$type];

// 月単位 or 年単位かの情報を取得
$mode = $setting['mode'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ファイルが正しくアップロードされたか確認
    if (isset($_FILES["filename"]) && $_FILES["filename"]["error"] == 0) {
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        $file_name = $_FILES["filename"]["name"];
        $file_tmp = $_FILES["filename"]["tmp_name"];
        $file_size = $_FILES["filename"]["size"];

        // 拡張子チェック
        if (pathinfo($file_name, PATHINFO_EXTENSION) !== 'csv'):
            $errors[] = "・拡張子がcsvではありません。";
        
        else:

            // CSV読み込み
            $csv_data = [];
            if (($handle = fopen($file_tmp, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    
                    // まず文字エンコーディングを変換
                    $utf8_data = array_map(function ($field) {
                        return mb_convert_encoding($field, 'UTF-8', 'UTF-8, SJIS-win');
                    }, $data);
                    
                    // training(兼業)の場合は12列目以降を除外
                    if ($type === 'training') {
                        // インデックス0～10までの要素のみを残す（11以降を除外）
                        $utf8_data = array_slice($utf8_data, 0, 11);
                    }

                    // UTF-8変換済みデータを配列に追加
                    $csv_data[] = $utf8_data;
                }
                fclose($handle);
                
                // BOM除去処理（最初の行の最初のカラムから\ufeffを除去）
                if (!empty($csv_data) && isset($csv_data[0][0])) {
                    $csv_data[0][0] = preg_replace('/^\xEF\xBB\xBF/', '', $csv_data[0][0]);
                }
                
                // 空の行を削除
                $csv_data = array_filter($csv_data, function($row) {
                    return array_filter($row);
                });

                // $csv_data Array([0])のデータが7桁でなければ、先頭へ0を付与
                // 1行目はスキップ
                foreach ($csv_data as $rowIndex => $row) {
                    foreach ($row as $colIndex => $field) {
                        if ($colIndex === 0 && strlen($field) < 7) {
                            $csv_data[$rowIndex][$colIndex] = str_pad($field, 7, '0', STR_PAD_LEFT);
                        }
                    }
                }

                // 処理完了後にセッションに保存
                $_SESSION['csv_data'] = $csv_data;
            }

            // カラム名チェック
            $col_ok = true;
            
            foreach ($setting['columns'] as $i => $col) {
                if (!isset($csv_data[0][$i]) || $csv_data[0][$i] !== $col) {
                    $errors[] = "・カラムが異なります。定型に合わせてください。<br>定型: " . implode(', ', $setting['columns']) . "<br>今回: " . implode(', ', array_slice($csv_data[0], 0, count($setting['columns'])));
                    $col_ok = false;
                    break;
                }
            }

            // if($type == 'introY' || $type == 'introM' || $type == 'inversintroY' || $type == 'inversintroM' || $type == 'training') {
            //     // 空のデータがあるかチェック（紹介・逆紹介・兼業）
            //     foreach ($csv_data as $rowIndex => $row) {
            //         foreach ($row as $colIndex => $field) {
            //             if (trim($field) === '') {
            //                 $errors[] = "・空のデータが含まれています。行: " . ($rowIndex + 1) . ", 列: " . ($colIndex + 1);
            //             }
            //         }
            //     }
            // }

            if ($col_ok) {
                $_SESSION['csv_data'] = $csv_data;
            
                // 年度・日付範囲チェック
                $year = null;
                // 1行目（ヘッダ）を除外
                $csv_data = array_slice($csv_data, 1);

                $dateIndex = $setting['year_col'];
                $minDate = null;
                $maxDate = null;

                foreach ($csv_data as $row) {
                    if (!isset($row[$dateIndex])) continue;
                    $date = trim($row[$dateIndex]);
                    if ($date === '') continue;
                    if ($minDate === null || strtotime($date) < strtotime($minDate)) $minDate = $date;
                    if ($maxDate === null || strtotime($date) > strtotime($maxDate)) $maxDate = $date;
                }
                

                // --- ここから contact_month 用の月単位チェック ---
                if ($setting['mode'] === 'month') {
                    // 年月形式
                    $minYearMonth = ($minDate !== null) ? date('Y-m', strtotime($minDate)) : null;
                    $maxYearMonth = ($maxDate !== null) ? date('Y-m', strtotime($maxDate)) : null;

                    // セッションに保存
                    $_SESSION['minYearMonth'] = $minYearMonth;
                    $_SESSION['maxYearMonth'] = $maxYearMonth;
                    
                    // 年月日形式
                    $minDateFmt = ($minDate !== null && strpos($minDate, '/') !== false)
                        ? sprintf("%d年%d月%d日", ...explode('/', $minDate))
                        : "日付がありません";
                    $maxDateFmt = ($maxDate !== null && strpos($maxDate, '/') !== false)
                        ? sprintf("%d年%d月%d日", ...explode('/', $maxDate))
                        : "日付がありません";

                    if ($minDate === null || $maxDate === null) {
                        $errors[] = "日付がありません";
                    }
                    if ($minYearMonth !== $maxYearMonth) {
                        $errors[] = "期間が１ヵ月ではないため、データを追加できません。";
                    }
                    
                    $year = "$minDateFmt ～ $maxDateFmt";
                }
                // --- ここまで contact_month 用 ---
                
                // 年単位（デフォルト）
                elseif ($setting['mode'] === 'year') {
                    if ($minDate === null || $maxDate === null) {
                        $minDate = "データがありません";
                        $maxDate = "データがありません";
                        // セッションにnullを設定
                        $_SESSION['minYearMonth'] = null;
                        $_SESSION['maxYearMonth'] = null;
                    } else {
                        // 年月形式を計算してセッションに保存
                        $minYearMonth = date('Y-m', strtotime($minDate));
                        $maxYearMonth = date('Y-m', strtotime($maxDate));
                        
                        $_SESSION['minYearMonth'] = $minYearMonth;
                        $_SESSION['maxYearMonth'] = $maxYearMonth;
                        
                        $diffDays = (strtotime($maxDate) - strtotime($minDate)) / (60 * 60 * 24);

                        // 年月日形式（例: 2025/1/1）
                        $minDateFmt = ($minDate !== null && strpos($minDate, '/') !== false)
                            ? sprintf("%d年%d月%d日", (int)explode('/', $minDate)[0], (int)explode('/', $minDate)[1], (int)explode('/', $minDate)[2])
                            : $minDate;
                        $maxDateFmt = ($maxDate !== null && strpos($maxDate, '/') !== false)
                            ? sprintf("%d年%d月%d日", (int)explode('/', $maxDate)[0], (int)explode('/', $maxDate)[1], (int)explode('/', $maxDate)[2])
                            : $maxDate;

                        // 365日以内ならOK
                        if ($diffDays <= 365) {
                            if ($minDate === $maxDate) {
                                $year = $minDateFmt;
                            } else {
                                $year = $minDateFmt . " ～ " . $maxDateFmt;
                                // 1年分であればエラーを出さない
                            }
                        } else {
                            if ($minDate === $maxDate) {
                                $year = $minDateFmt;
                            } else {
                                $year = $minDateFmt . " ～ " . $maxDateFmt;
                                $errors[] = "・1" . $setting['year_label'] . "分のデータに変更してください。";
                            }
                        }
                    }
                }
            }
            
            // チェックメッセージ
            $latest_year = $setting['year_func']($dbh);

        endif;
    } else {
        // ファイルアップロードエラーの場合
        $errors[] = "・ファイルのアップロードに失敗しました。";
    }
} else {
    // POST以外のリクエストの場合
    $errors[] = "・不正なリクエストです。";
}

// 変数が未定義の場合のデフォルト値設定
if (!isset($latest_year)) {
    $latest_year = '';
}
if (!isset($year)) {
    $year = '';
}
if (!isset($file_name)) {
    $file_name = '';
}

// 成功・失敗で返却
if (empty($errors)) {
    echo json_encode([
        'judge' => 'success',
        'name' => $setting['name'],
        'first_year' => $setting['year_label'],
        'latest_year' => $latest_year,
        'file_name' => $file_name,
        'year' => $year,
        'data_type' => $type,
        'mode' => $mode,
    ]);
} else {
    echo json_encode([
        'judge' => 'false',
        'text' => !empty($errors) ? implode('<br>', $errors) : 'ファイルがアップロードされていません。',
    ]);
}