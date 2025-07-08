<?php

require_once('../functions.php');

session_start();

// fetchでJSONを返す
header('Content-Type: application/json; charset=UTF-8');

$dbh = get_db_connect();

// グローバル変数を定義
$mode = '';

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
        'columns' => ['医療機関CD','病院区分','年度','診療日','科コード','診療科','紹介件数'],
        'year_func' => function($dbh) {
            $intro_ym = get_intro_ym($dbh);
            return empty($intro_ym) ? 'データなし' : substr($intro_ym, 0, 4) . "年" . substr($intro_ym, 5, 2) . "月";
        },
        'year_col' => 3, // 診療日カラム
        'year_label' => '年度',
        'mode' => 'year'
    ],
    'introM' => [
        'name' => '紹介データ（月単位）',
        'columns' => ['医療機関CD','病院区分','年度','診療日','科コード','診療科','紹介件数'],
        'year_func' => function($dbh) {
            $intro_ym = get_intro_ym($dbh);
            return empty($intro_ym) ? 'データなし' : substr($intro_ym, 0, 4) . "年" . substr($intro_ym, 5, 2) . "月";
        },
        'year_col' => 3,
        'year_label' => '月',
        'mode' => 'month'
    ],
    'inversintroY' => [
        'name' => '紹介データ',
        'columns' => ['医療機関CD','病院区分','年度','診療日','科コード','診療科','紹介件数'],
        'year_func' => function($dbh) {
            $inv_ym = get_inv_intro_ym($dbh);
            return empty($inv_ym) ? 'データなし' : substr($inv_ym, 0, 4) . "年" . substr($inv_ym, 5, 2) . "月";
        },
        'year_col' => 3,
        'year_label' => '年度',
        'mode' => 'year'
    ],
    'inversintroM' => [
        'name' => '紹介データ（月単位）',
        'columns' => ['医療機関CD','病院区分','年度','診療日','科コード','診療科','紹介件数'],
        'year_func' => function($dbh) {
            $inv_ym = get_inv_intro_ym($dbh);
            return empty($inv_ym) ? 'データなし' : substr($inv_ym, 0, 4) . "年" . substr($inv_ym, 5, 2) . "月";
        },
        'year_col' => 3,
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
        'year_col' => 4, // 日付カラム
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
        'columns' => ['医療機関CD','年度','施設','医療機関名','診療科','職名','氏名','開始日','終了日','診療支援区分','日時','役職順'],
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
                    
                    // training(兼業)の場合は「区分」「期間」列（13列目・14列目、インデックス1,2）を除外
                    if ($type === 'training') {
                        unset($data[12], $data[13]);
                        $data = array_values($data); // 添字を詰め直す
                    }

                    // Shift-JIS から UTF-8 に変換
                    $utf8_data = array_map(function ($field) {
                        return mb_convert_encoding($field, 'UTF-8', 'UTF-8, SJIS-win');
                    }, $data);

                    // UTF-8へ返還したデータを配列に追加
                    $csv_data[] = $utf8_data;

                    $_SESSION['csv_data'] = $csv_data;
                }
                fclose($handle);
            }

            // 空の行を削除
            $csv_data = array_filter($csv_data, function($row) {
                return array_filter($row);
            });

            // カラム名チェック
            $col_ok = true;
            foreach ($setting['columns'] as $i => $col) {
                if (!isset($csv_data[0][$i]) || mb_ereg($col, $csv_data[0][$i]) != 1) {
                    $errors[] = "・カラムが異なります。定型に合わせてください。<br>定型: " . implode(', ', $setting['columns']) . "<br>今回: " . implode(', ', array_slice($csv_data[0], 0, count($setting['columns'])));
                    $col_ok = false;
                    break;
                }
            }

            if($type == 'introY' || $type == 'introM' || $type == 'inversintroY' || $type == 'inversintroM' || $type == 'training') {
                // 空のデータがあるかチェック（紹介・逆紹介・兼業）
                foreach ($csv_data as $rowIndex => $row) {
                    foreach ($row as $colIndex => $field) {
                        if (trim($field) === '') {
                            $errors[] = "・空のデータが含まれています。行: " . ($rowIndex + 1) . ", 列: " . ($colIndex + 1);
                        }
                    }
                }
            }

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

                    // 年月日形式
                    $minDateFmt = ($minDate !== null && strpos($minDate, '/') !== false)
                        ? sprintf("%d月%d日", (int)explode('/', $minDate)[1], (int)explode('/', $minDate)[2])
                        : "日付がありません";
                    $maxDateFmt = ($maxDate !== null && strpos($maxDate, '/') !== false)
                        ? sprintf("%d月%d日", (int)explode('/', $maxDate)[1], (int)explode('/', $maxDate)[2])
                        : "日付がありません";

                    if ($minDate === null || $maxDate === null) {
                        $errors[] = "日付がありません";
                    } else {
                        $diffDays = (strtotime($maxDate) - strtotime($minDate)) / (60 * 60 * 24);
                        // 31日以内ならOK
                        if ($diffDays <= 31) {
                            // 期間が1ヵ月でなくてもOK
                        } else {
                            if ($minYearMonth !== $maxYearMonth) {
                                $errors[] = "期間が１ヵ月ではないため、データを追加できません。";
                            }
                        }
                    }
                    
                    $year = "$minDateFmt ～ $maxDateFmt";
                }
                // --- ここまで contact_month 用 ---

                // 年単位（デフォルト）
                elseif ($setting['mode'] === 'year') {
                    if ($minDate === null || $maxDate === null) {
                        $minDate = "データがありません";
                        $maxDate = "データがありません";
                    } else {
                        $diffDays = (strtotime($maxDate) - strtotime($minDate)) / (60 * 60 * 24);

                        // 年月日形式（例: 2025/1/1）
                        $minDateFmt = ($minDate !== null && strpos($minDate, '/') !== false)
                            ? sprintf("%d年%d月%d日", (int)explode('/', $minDate)[0], (int)explode('/', $minDate)[1], (int)explode('/', $minDate)[2])
                            : $minDate;
                        $maxDateFmt = ($maxDate !== null && strpos($maxDate, '/') !== false)
                            ? sprintf("%d月%d日", (int)explode('/', $maxDate)[1], (int)explode('/', $maxDate)[2])
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
    }
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