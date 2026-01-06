    <?php
/**
 * ユーザー新規追加統合ファイル
 * 
 * 機能：
 * - registration.php（フォーム入力画面）
 * - registration_check.php（入力値チェック）
 * - registration_check_view.php（確認画面）
 * の処理を統合し、効率化したもの
 */

// ========================================
// セッション開始と設定読み込み（一度だけ実行）
// ========================================
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

require_once('../functions.php');
include_once('../config.php');

// ========================================
// ユーザー権限テキスト取得（権限表示用）
// ========================================
$user_adm = $_SESSION['member']['adm_user'];

// ========================================
// 初期値設定（デフォルト値）
// ※セッションから既存データを取得する場合はJSで実装
// ========================================
$user_id1 = '';
$user_name1 = '';
$ins1 = '0';
$bel1 = '';
$pw1 = '';
$pw4 = '';
$adm_user1 = '0';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー新規追加 | 医療機関情報システム</title>

    <!-- UIkit -->
    <link rel="stylesheet" href="../css/uikit.min.css" />
    <script src="../js/uikit.min.js"></script>
    <script src="../js/uikit-icons.min.js"></script>

    <!-- スタイル -->
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/form_parts.css" />
    <link rel="stylesheet" href="../css/marker.css"/>
    <link rel="stylesheet" href="../css/all.min.css" />

    <!-- バリデーションテンプレートライブラリ -->
    <script src="../js/validation-template.js"></script>

    <style>
        /* カスタムスタイルはここに */
        
        /* ※リアルタイムバリデーション表示のオーバーレイスタイル */
        #user_id_requirements,
        #user_name_requirements,
        #pw_requirements,
        #repass_requirements {
            position: fixed;
            background: white;
            border: 2px solid #e7e7e7ff;
            border-radius: 8px;
            padding: 15px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1050;
            min-width: 280px;
            max-width: 350px;
        }
        
        #user_id_requirements p,
        #user_name_requirements p,
        #pw_requirements p,
        #repass_requirements p {
            margin: 0 0 8px 0;
            font-size: 0.95rem;
            font-weight: bold;
            color: #333;
        }
        
        #user_id_requirements ul,
        #user_name_requirements ul,
        #pw_requirements ul,
        #repass_requirements ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        
        #user_id_requirements ul li,
        #user_name_requirements ul li,
        #pw_requirements ul li,
        #repass_requirements ul li {
            font-size: 0.85rem;
            margin: 6px 0;
            padding-left: 20px;
            position: relative;
            transition: color 0.3s ease;
        }
        
        /* チェック済み条件（緑色） */
        #user_id_requirements ul li.checked,
        #user_name_requirements ul li.checked,
        #pw_requirements ul li.checked,
        #repass_requirements ul li.checked {
            color: #28a745;
        }
        
        #user_id_requirements ul li.checked span,
        #user_name_requirements ul li.checked span,
        #pw_requirements ul li.checked span,
        #repass_requirements ul li.checked span {
            color: #28a745;
            font-weight: bold;
        }
        
        /* 未チェック条件（赤色） */
        #user_id_requirements ul li.unchecked,
        #user_name_requirements ul li.unchecked,
        #pw_requirements ul li.unchecked,
        #repass_requirements ul li.unchecked {
            color: #dc3545;
        }
        
        #user_id_requirements ul li.unchecked span,
        #user_name_requirements ul li.unchecked span,
        #pw_requirements ul li.unchecked span,
        #repass_requirements ul li.unchecked span {
            color: #dc3545;
            font-weight: bold;
        }
        
        /* ※モーダルのパスワード表示/非表示トグルボタンのスタイル */
        .password-toggle-btn {
            background: none;
            border: none;
            color: #2e8b57;
            cursor: pointer;
            font-size: 1rem;
            padding: 5px 10px;
            margin-left: 10px;
            transition: color 0.3s ease;
            vertical-align: middle;
        }
        
        .password-toggle-btn:hover,
        .password-toggle-btn:active {
            color: #2aa15e;
        }

        /* オーバーレイボックス矢印（下向き） */
    </style>
</head> 

<body>
    <!-- ヘッダー -->
    <header uk-sticky>
        <?php include_once("../header.php"); ?>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><a href="user_MT_control.php">ユーザー管理</a></li>
            <li><span>新規追加</span></li>
        </ul>
    </header>

    <!-- ========================================
         メインコンテンツ：入力フォーム
         ※JSで検証 → モーダルで確認画面を表示
         ======================================== -->
    <div class="uk-card uk-card-small">
        <form id="userRegistrationForm" method="POST">
            <div class="uk-card-default uk-container uk-container-center uk-width-2-3@m">
                <!-- ヘッダー -->
                <div class="uk-card-header">
                    <h2 class="uk-heading-primary">ユーザー 新規追加</h2>
                    <span>ユーザー情報を入力してください。</span>
                </div>

                <!-- フォーム本体 -->
                <div class="uk-margin uk-container uk-container-center uk-width-1-1@m">
                    <div class="uk-margin uk-card" style="padding: 1em;">
                        <div class="uk-width-1-1@m">
                            <div>
                                <!-- ユーザーID -->
                                <h5>
                                    <i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                       uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                    ID：
                                    <input class="uk-input uk-form-width-medium" type="text" 
                                           name="user_id" id="user_id">
                                </h5>

                                <!-- ユーザー情報テーブル -->
                                <table class="uk-table uk-table-divider">
                                    <!-- 氏名 -->
                                    <tr>
                                        <th>
                                            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                               uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                            氏名
                                        </th>
                                        <td>
                                            <input type="text" class="uk-input uk-form-width-large" 
                                                   name="user_name" id="user_name">
                                        </td>
                                        <td></td>
                                    </tr>

                                    <!-- 施設選択 -->
                                    <tr>
                                        <th>
                                            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                               uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                            施設
                                        </th>
                                        <td>
                                            <select class="uk-select uk-form-width-large" 
                                                    name="ins" id="selbox" onchange="change();">
                                                <!-- ※施設選択肢 -->
                                                <option value="0">附属病院</option>	
                                                <option value="1">総合医療センター</option>
                                                <option value="2">高齢者医療センター</option>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <!-- 所属選択（施設ごとに異なる） -->
                                    <tr>
                                        <th>
                                            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                               uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                            所属
                                        </th>
                                        <td>
                                            <!-- 附属病院の所属 -->
                                            <select id="txt1" class="uk-select uk-form-width-large" 
                                                    name="bel">
                                                <?php foreach($user_bel as $key => $var): ?>
                                                    <option value="<?php echo $key; ?>">
                                                        <?php echo $var; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                  
                                            <!-- 総合医療センターの所属 -->
                                            <select id="txt2" class="uk-select uk-form-width-large" 
                                                    name="bel2" style="display: none;">
                                                <?php foreach($center_bel as $key1 => $var1): ?>
                                                    <option value="<?php echo $key1; ?>">
                                                        <?php echo $var1; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>

                                            <!-- 高齢者医療センターの所属 -->
                                            <select id="txt3" class="uk-select uk-form-width-large" 
                                                    name="bel3" style="display: none;">
                                                <?php foreach($kourei_bel as $key2 => $var2): ?>
                                                    <option value="<?php echo $key2; ?>">
                                                        <?php echo $var2; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <!-- パスワード -->
                                    <tr>
                                        <th>
                                            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                               uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                            パスワード
                                        </th>
                                        <td>
                                            <input type="password" class="uk-input uk-form-width-large" 
                                                   maxlength="20" id="pw" name="pw" 
                                                   placeholder="8文字以上、大文字小文字の英数字を含むもの">
                                        </td>
                                    </tr>

                                    <!-- パスワード再入力 -->
                                    <tr>
                                        <th>
                                            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                               uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                            パスワード再入力
                                        </th>
                                        <td>
                                            <input type="password" class="uk-input uk-form-width-large" 
                                                   maxlength="20" id="repass" name="repass" 
                                                   placeholder="8文字以上、大文字小文字の英数字を含むもの">
                                        </td>
                                    </tr>

                                    <!-- 権限 -->
                                    <tr>
                                        <th>
                                            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                               uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                            権限
                                        </th>
                                        <td>
                                            <select class="uk-select uk-form-width-large" name="adm_user">
                                                <!-- ※権限選択肢 -->
                                                <option value="0">一般</option>
                                                <option value="1">管理者</option>
                                                <option value="2">一般（事務）</option>
                                                <?php if($user_adm === '3'): ?>
                                                    <option value="3">システム管理者</option>
                                                <?php endif; ?>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ボタン -->
                <div class="uk-margin-top uk-container uk-width-1-1@m">
                    <div class="uk-flex uk-flex-between">
                        <div class="uk-margin-right uk-flex-last">
                            <!-- ※JSで検証 → モーダル表示 -->
                            <button type="button" class="uk-button uk-button-primary" id="registration">次へ</button>
                        </div>
                        <div class="uk-margin-left uk-flex-first">
                            <a href="user_MT_control.php" class="uk-button uk-button-primary">戻る</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- ========================================
         モーダル：確認画面
         ※JSで検証OK時に動的に表示
         ======================================== -->
    <div id="confirmModal" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <h2 class="uk-modal-title">新規登録内容確認</h2>
            <p>この内容でよろしいですか？</p>

            <form action="completion.php" method="POST">
                <div class="uk-card uk-card-small">
                    <div class="uk-margin uk-card" style="padding:1em;">
                        <div class="uk-width-1-1@m">
                            <div>
                                <div>
                                    <span class="uk-icon-button uk-margin-small-right" uk-icon="user"></span>
                                    <i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                       uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                    ID：<span id="modal_user_id"></span>
                                    <input type="hidden" id="hidden_user_id" name="user_id">
                                </div>

                                <table class="uk-table uk-table-divider">
                                    <tr>
                                        <th><i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                               uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                            氏名</th>
                                        <td id="modal_user_name"></td><input type="hidden" id="hidden_user_name" name="user_name">
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                               uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                            施設</th>
                                        <td id="modal_facility"></td><input type="hidden" id="hidden_ins" name="ins">
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                               uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                            所属</th>
                                        <td id="modal_affiliation"></td><input type="hidden" id="hidden_bel" name="bel">
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                               uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                            パスワード</th>
                                        <td style="position: relative;">
                                            <!-- ※パスワード表示/非表示トグル機能付き -->
                                            <span id="modal_password_display">******</span>
                                            <button type="button" id="modal_password_toggle" class="password-toggle-btn" uk-tooltip="title:パスワードを表示/非表示; pos: bottom">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td><input type="hidden" id="hidden_pw" name="pw">
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                               uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                            権限</th>
                                        <td id="modal_authority"></td><input type="hidden" id="hidden_adm_user" name="adm_user">
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- モーダルボタン -->
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">戻る</button>
                    <button class="uk-button uk-button-primary" type="submit">登録</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================
         オーバーレイ：ユーザーID検証表示
         ※JSでフォーカス時に動的に表示・配置
         ======================================== -->
    <div id="user_id_requirements" style="display: none;">
        <p>入力条件：</p>
        <ul>
            <li id="user_id_req_required" data-requirement="user_id_required"><span>✓</span> 入力は必須です</li>
            <li id="user_id_req_length" data-requirement="user_id_length"><span>✓</span> 1文字以上</li>
        </ul>
    </div>

    <!-- ========================================
         オーバーレイ：ユーザー名検証表示
         ※JSでフォーカス時に動的に表示・配置
         ======================================== -->
    <div id="user_name_requirements" style="display: none;">
        <p>入力条件：</p>
        <ul>
            <li id="user_name_req_required" data-requirement="user_name_required"><span>✓</span> 入力は必須です</li>
            <li id="user_name_req_length" data-requirement="user_name_length"><span>✓</span> 2文字以上</li>
        </ul>
    </div>

    <!-- ========================================
         オーバーレイ：パスワード条件チェック表示
         ※JSでフォーカス時に動的に表示・配置
         ======================================== -->
    <div id="pw_requirements" style="display: none;">
        <p>入力条件：</p>
        <ul>
            <li id="pw_req_length" data-requirement="password_length"><span>✓</span> 8文字以上</li>
            <li id="pw_req_upper" data-requirement="password_uppercase"><span>✓</span> 大文字を含む</li>
            <li id="pw_req_lower" data-requirement="password_lowercase"><span>✓</span> 小文字を含む</li>
            <li id="pw_req_number" data-requirement="password_number"><span>✓</span> 数字を含む</li>
        </ul>
    </div>

    <!-- ========================================
         オーバーレイ：パスワード再入力確認表示
         ※JSでフォーカス時に動的に表示・配置
         ======================================== -->
    <div id="repass_requirements" style="display: none;">
        <p>確認：</p>
        <ul>
            <li id="repass_req_match" data-requirement="repass_match"><span>✓</span> パスワードが一致している</li>
        </ul>
    </div>

    <script>
        /**
         * =====================================================
         * バリデーション設定と初期化処理
         * =====================================================
         * 
         * 汎用関数は validation-template.js で定義されています
         * ここでは、フィールド設定とページ固有の処理のみを記述
         */

        /**
         * フィールド設定オブジェクト
         * ※新しいバリデーションフィールドを追加する場合は、
         *   このオブジェクトに設定を追加してください
         * 
         * 詳細は ValidationTemplate_Manual.md を参照
         */
        const validationFieldsConfig = {
            user_id: {
                inputId: "user_id",
                overlayId: "user_id_requirements",
                rules: {
                    required: { label: "必須項目", test: (val) => val.length > 0 },
                    length: { label: "1文字以上", test: (val) => val.length >= 1 }
                },
                requirements: ["required", "length"]
            },
            user_name: {
                inputId: "user_name",
                overlayId: "user_name_requirements",
                rules: {
                    required: { label: "必須項目", test: (val) => val.length > 0 },
                    length: { label: "2文字以上", test: (val) => val.length >= 2 }
                },
                requirements: ["required", "length"]
            },
            password: {
                inputId: "pw",
                overlayId: "pw_requirements",
                rules: {
                    length: { label: "8文字以上", test: (val) => val.length >= 8 },
                    uppercase: { label: "大文字を含む", test: (val) => /[A-Z]/.test(val) },
                    lowercase: { label: "小文字を含む", test: (val) => /[a-z]/.test(val) },
                    number: { label: "数字を含む", test: (val) => /[0-9]/.test(val) }
                },
                requirements: ["length", "uppercase", "lowercase", "number"]
            },
            repass: {
                inputId: "repass",
                overlayId: "repass_requirements",
                specialValidation: true,
                rules: {
                    match: { label: "パスワード一致", test: (val) => {
                        const pw = document.getElementById("pw").value;
                        return val === pw && val.length > 0;
                    }}
                },
                requirements: ["match"]
            }
        };

        /**
         * DOMが読み込まれたら、バリデーションテンプレートを初期化
         */
        document.addEventListener("DOMContentLoaded", function() {
            initializeAllValidationFields();
        });

        /**
         * 施設選択に応じて所属セレクトボックスを表示/非表示切り替え
         * ※元の registration.php から統合
         */
        function change() {
            const selboxValue = document.getElementById("selbox").value;
            
            // すべてを非表示にしてからターゲットを表示
            document.getElementById("txt1").style.display = "none";
            document.getElementById("txt2").style.display = "none";
            document.getElementById("txt3").style.display = "none";
            
            // 選択された施設に対応する所属セレクトボックスを表示
            if (selboxValue === "0") {
                document.getElementById("txt1").style.display = "";
            } else if (selboxValue === "1") {
                document.getElementById("txt2").style.display = "";
            } else if (selboxValue === "2") {
                document.getElementById("txt3").style.display = "";
            }
        }

        /**
         * 入力値の検証とモーダル表示処理（テンプレート対応版）
         * ※元の registration.php のバリデーションをJS側で実施
         * ※REQUEST_METHOD処理は削除（JS側で完全に処理）
         */
        document.getElementById("registration").addEventListener("click", function(e) {
            e.preventDefault();
            
            const user_id = document.getElementById("user_id").value;
            const user_name = document.getElementById("user_name").value;
            const ins = document.getElementById("selbox").value;
            const pw = document.getElementById("pw").value;
            const repass = document.getElementById("repass").value;
            
            // ※選択された施設に応じて所属を取得
            let bel = '';
            if(ins === '0'){
                bel = document.getElementById("txt1").value;
            }else if(ins === '1'){
                bel = document.getElementById("txt2").value;
            }else if(ins === '2'){
                bel = document.getElementById("txt3").value;
            }
            
            const adm_user = document.querySelector('select[name="adm_user"]').value;
            
            // ※テンプレート対応：すべての検証フィールドをチェック
            const validationResults = validateAllFields(["user_id", "user_name", "password", "repass"]);
            
            // ※必須項目チェック（フィールドが空の場合）
            if (user_id.length === 0 || user_name.length === 0 || pw.length === 0 || repass.length === 0) {
                alert('必須項目が未記入の箇所があります');
                return false;
            }
            
            // ※すべての検証を確認
            if (!isAllValidationsPassed(validationResults)) {
                alert('入力項目の形式が正しくありません。各フィールドの条件をご確認ください。');
                return false;
            }
            
            // ※バリデーション成功時：モーダルに入力値を表示して開く
            displayConfirmModal(user_id, user_name, ins, bel, pw, adm_user);
        });

        /**
         * 確認画面（モーダル）に入力値を表示して開く
         * ※確認画面表示ロジック（元の registration_check_view.php から統合）
         */
        function displayConfirmModal(user_id, user_name, ins, bel, pw, adm_user) {
            // 施設名の表示用マッピング
            const facility_names = {
                '0': '附属病院',
                '1': '総合医療センター',
                '2': '高齢者医療センター'
            };
            
            // ※所属名を取得するためのマッピング（PHPの$user_bel, $center_bel, $kourei_belに相当）
            // ここではダミーデータを使用。実際にはサーバーから取得するか、PHPで埋め込む
            const affiliation_names = {
                '0': {}, // 附属病院の所属
                '1': {}, // 総合医療センターの所属
                '2': {}  // 高齢者医療センターの所属
            };
            
            // ※権限名の表示用マッピング（元の get_adm_txt() 関数に相当）
            const authority_names = {
                '0': '一般',
                '1': '管理者',
                '2': '一般（事務）',
                '3': 'システム管理者'
            };
            
            // モーダル内の要素に値を設定
            document.getElementById("modal_user_id").textContent = user_id;
            document.getElementById("modal_user_name").textContent = user_name;
            document.getElementById("modal_facility").textContent = facility_names[ins];
            
            // ※所属名を表示（後述のスクリプトで動的に取得）
            let affiliation_display = '';
            if(ins === '0'){
                const select = document.getElementById("txt1");
                affiliation_display = select.options[select.selectedIndex].text;
            }else if(ins === '1'){
                const select = document.getElementById("txt2");
                affiliation_display = select.options[select.selectedIndex].text;
            }else if(ins === '2'){
                const select = document.getElementById("txt3");
                affiliation_display = select.options[select.selectedIndex].text;
            }
            document.getElementById("modal_affiliation").textContent = affiliation_display;
            
            // ※パスワード表示処理：初期表示時は「*********」で表示
            const maskedPassword = '*'.repeat(Math.ceil(pw.length));
            document.getElementById("modal_password_display").textContent = maskedPassword;
            // ※実際のパスワードを隠し属性に保存（トグル表示用）
            document.getElementById("modal_password_display").setAttribute("data-actual-password", pw);
            
            document.getElementById("modal_authority").textContent = authority_names[adm_user];
            
            // ※隠しフィールドに値を設定（登録時に送信）
            document.getElementById("hidden_user_id").value = user_id;
            document.getElementById("hidden_user_name").value = user_name;
            document.getElementById("hidden_ins").value = ins;
            document.getElementById("hidden_bel").value = bel;
            document.getElementById("hidden_pw").value = pw;
            document.getElementById("hidden_adm_user").value = adm_user;
            
            // ※パスワードトグルボタンのイベントリスナー設定
            const passwordToggleBtn = document.getElementById("modal_password_toggle");
            const passwordDisplay = document.getElementById("modal_password_display");
            let isPasswordVisible = false; // ※初期状態は非表示
            
            // ※以前のリスナーを削除（重複登録防止）
            const newPasswordToggleBtn = passwordToggleBtn.cloneNode(true);
            passwordToggleBtn.parentNode.replaceChild(newPasswordToggleBtn, passwordToggleBtn);
            const finalPasswordToggleBtn = document.getElementById("modal_password_toggle");
            
            finalPasswordToggleBtn.addEventListener("click", function(e) {
                e.preventDefault();
                isPasswordVisible = !isPasswordVisible;
                const actualPassword = passwordDisplay.getAttribute("data-actual-password");
                
                if(isPasswordVisible) {
                    // ※パスワード表示状態
                    passwordDisplay.textContent = actualPassword;
                    finalPasswordToggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
                    finalPasswordToggleBtn.setAttribute("uk-tooltip", "title:パスワードを非表示; pos: bottom");
                } else {
                    // ※パスワード非表示状態
                    const maskedPassword = '*'.repeat(Math.ceil(actualPassword.length));
                    passwordDisplay.textContent = maskedPassword;
                    finalPasswordToggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
                    finalPasswordToggleBtn.setAttribute("uk-tooltip", "title:パスワードを表示; pos: bottom");
                }
            });
            
            // ※モーダルを開く
            UIkit.modal(document.getElementById('confirmModal')).show();
        }
    </script>
</body>

</html>
