<?php
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

include_once('../config.php');

$ins1 = '0';
$user_adm = $_SESSION['member']['adm_user'];

// 編集時：セッションからユーザー情報を取得
if(isset($_SESSION['user'])){	
    $user_id1 = $_SESSION['user']['user_id'];	
    $user_name1 = $_SESSION['user']['user_name'];	
    $ins1 = $_SESSION['user']['ins'];	
    $bel1 = $_SESSION['user']['bel'];	
    $pw1 = $_SESSION['user']['pw'];	
    $pw4 = $_SESSION['user']['pw1'];	
    $adm_user1 = $_SESSION['user']['adm_user'];	
}
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

    <style>
        /* カスタムスタイルはここに */
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

    <!-- メインコンテンツ -->
    <div class="uk-card uk-card-small">
        <form action="registration_check.php" method="POST">
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
                                    <?php if(isset($user_id1)): ?>
                                        <input class="uk-input uk-form-width-medium" type="text" 
                                               name="user_id" id="user_id" value="<?php echo $user_id1; ?>" 
                                               style="border: none; font-size: 1.2rem;">
                                    <?php else: ?>
                                        <input type="text" class="uk-input uk-form-width-medium" 
                                               name="user_id" id="user_id">
                                    <?php endif; ?>
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
                                            <?php if(isset($user_name1)): ?>
                                                <input type="text" class="uk-input uk-form-width-large" 
                                                       name="user_name" id="user_name" value="<?php echo $user_name1; ?>">
                                            <?php else: ?>
                                                <input type="text" class="uk-input uk-form-width-large" 
                                                       name="user_name" id="user_name" placeholder="">
                                            <?php endif; ?>
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
                                                <?php if(isset($ins1)): ?>
                                                    <option value="0" <?php if($ins1 === '0') echo 'selected'; ?>>附属病院</option>	
                                                    <option value="1" <?php if($ins1 === '1') echo 'selected'; ?>>総合医療センター</option>
                                                    <option value="2" <?php if($ins1 === '2') echo 'selected'; ?>>高齢者医療センター</option>
                                                <?php else: ?>
                                                    <option value="0">附属病院</option>	
                                                    <option value="1">総合医療センター</option>	
                                                    <option value="2">高齢者医療センター</option>
                                                <?php endif; ?>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <!-- 所属選択 -->
                                    <tr>
                                        <th>
                                            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                               uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                            所属
                                        </th>
                                        <td>
                                            <!-- 附属病院の所属 -->
                                            <select id="txt1" class="uk-select uk-form-width-large" 
                                                    name="bel" <?php if($ins1 !== '0') echo 'style="display: none"'; ?>>
                                                <?php foreach($user_bel as $key => $var): ?>
                                                    <?php if(isset($bel1)): ?>
                                                        <option value="<?php echo $key; ?>" 
                                                                <?php if($bel1 === (string)$key) echo 'selected'; ?>>
                                                            <?php echo $var; ?>
                                                        </option>
                                                    <?php else: ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $var; ?></option>	
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                      
                                            <!-- 総合医療センターの所属 -->
                                            <select id="txt2" class="uk-select uk-form-width-large" 
                                                    name="bel2" <?php if($ins1 !== '1') echo 'style="display: none"'; ?>>
                                                <?php foreach($center_bel as $key1 => $var1): ?>
                                                    <?php if(isset($bel1)): ?>
                                                        <option value="<?php echo $key1; ?>" 
                                                                <?php if($bel1 === (string)$key1) echo 'selected'; ?>>
                                                            <?php echo $var1; ?>
                                                        </option>
                                                    <?php else: ?>
                                                        <option value="<?php echo $key1; ?>"><?php echo $var1; ?></option>	
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>

                                            <!-- 高齢者医療センターの所属 -->
                                            <select id="txt3" class="uk-select uk-form-width-large" 
                                                    name="bel3" <?php if($ins1 !== '2') echo 'style="display: none"'; ?>>
                                                <?php foreach($kourei_bel as $key2 => $var2): ?>
                                                    <?php if(isset($bel1)): ?>
                                                        <option value="<?php echo $key2; ?>" 
                                                                <?php if($bel1 === (string)$key2) echo 'selected'; ?>>
                                                            <?php echo $var2; ?>
                                                        </option>
                                                    <?php else: ?>
                                                        <option value="<?php echo $key2; ?>"><?php echo $var2; ?></option>	
                                                    <?php endif; ?>
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
                                            <?php if(isset($pw1) && isset($pw4)): ?>
                                                <input type="password" class="uk-input uk-width-medium" 
                                                       maxlength="20" id="pw" name="pw" 
                                                       placeholder="8文字以上、大文字小文字の英数字を含むもの"
                                                       value="<?php echo $pw1; ?>">
                                            <?php else: ?>
                                                <input type="password" class="uk-input uk-form-width-large" 
                                                       maxlength="20" id="pw" name="pw" 
                                                       placeholder="8文字以上、大文字小文字の英数字を含むもの">
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <!-- パスワード確認メッセージ -->
                                    <tr>
                                        <th colspan="2">
                                            <span id="pw_chk" style="display: none; color: red;">
                                                ※半角英字大文字・小文字と数字を組み合わせた8文字以上で設定してください。
                                            </span>
                                        </th>
                                    </tr>

                                    <!-- パスワード再入力 -->
                                    <tr>
                                        <th>
                                            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" 
                                               uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i>
                                            パスワード再入力
                                        </th>
                                        <td>
                                            <?php if(isset($pw1) && isset($pw4)): ?>
                                                <input type="password" class="uk-input uk-form-width-large" 
                                                       maxlength="20" id="repass" name="name" 
                                                       placeholder="8文字以上、大文字小文字の英数字を含むもの"
                                                       value="<?php echo $pw1; ?>">
                                            <?php else: ?>
                                                <input type="password" class="uk-input uk-form-width-large" 
                                                       maxlength="20" id="repass" name="name" 
                                                       placeholder="8文字以上、大文字小文字の英数字を含むもの">
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <!-- パスワード一致確認メッセージ -->
                                    <tr>
                                        <th colspan="2">
                                            <span id="repass_chk" style="display: none; color: red;">
                                                パスワードが一致しません。
                                            </span>
                                        </th>
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
                                                <?php if(isset($adm_user1)): ?>
                                                    <option value="0" <?php if($adm_user1 === '0') echo 'selected'; ?>>一般</option>
                                                    <option value="1" <?php if($adm_user1 === '1') echo 'selected'; ?>>管理者</option>
                                                    <option value="2" <?php if($adm_user1 === '2') echo 'selected'; ?>>一般（事務）</option>
                                                    <?php if($adm_user1 === '3'): ?>
                                                        <option value="3" selected>システム管理者</option>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <option value="0">一般</option>
                                                    <option value="2">一般（事務）</option>
                                                    <option value="1">管理者</option>
                                                    <?php if($user_adm === '3'): ?>
                                                        <option value="3">システム管理者</option>
                                                    <?php endif; ?>
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
                            <input type="submit" class="uk-button uk-button-primary" value="次へ" id="touroku">
                        </div>
                        <div class="uk-margin-left uk-flex-first">
                            <a href="user_MT_control.php" class="uk-button uk-button-primary">戻る</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        /**
         * 施設選択に応じて所属セレクトボックスを表示/非表示切り替え
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
         * フォーム送信時の入力チェック
         */
        document.getElementById("touroku").onclick = function() {
            const user_id = document.getElementById("user_id").value;
            const user_name = document.getElementById("user_name").value;     
            const pw = document.getElementById("pw").value;
            const repass = document.getElementById("repass").value;
            
            let flag = 0;
            
            // 必須項目のチェック
            if (user_id.length === 0) flag = 1;
            if (user_name.length === 0) flag = 1;
            if (pw.length === 0) flag = 1;    
            if (repass.length === 0) flag = 1;
            
            if (flag === 1) {
                alert('必須項目が未記入の箇所があります');
                return false;
            }
            
            let flag_chk = 0;
            
            // パスワードフォーマットのチェック（大文字・小文字・数字を含む8文字以上）
            const regexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/;
            if (!regexp.test(pw)) {
                document.getElementById('pw_chk').style.display = "block";
                flag_chk = 1;
            } else {
                document.getElementById('pw_chk').style.display = "none";
            }
            
            // パスワード一致確認
            if (pw !== repass) {
                document.getElementById('repass_chk').style.display = "block";
                flag_chk = 1;
            } else {
                document.getElementById('repass_chk').style.display = "none";
            }
            
            if (flag_chk === 1) {
                return false;
            } else {
                return true;
            }
        };
    </script>
</body>

</html>









