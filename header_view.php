<?php
//櫻間
  foreach ($data50 as $key =>$var):
  //櫻間
  $user_id = $_SESSION['member']['user_id'];
  $user_name = $_SESSION['member']['user_name'];
  $user_adm = $_SESSION['member']['adm_user'];
?>
    <link rel="stylesheet" href="<?php echo headerCss_URL; ?>" />
    <div class="uk-position-medium uk-position-top-right uk-position-z-index">
        <!-- Offcanvas -->
        <a class="uk-navbar-toggle uk-navbar-toggle-animate" href="#" uk-navbar-toggle-icon style="margin:0 0 0 auto;"></a>
    </div>

        <div class="uk-navbar-dropdown uk-width-auto" uk-dropdown="mode: click">
            <ul class="uk-nav uk-navbar-dropdown-nav" uk-margin>
                <li class="uk-nav-header">
                    <span uk-icon="icon: user"></span>
                </li>
                <li id="<?php echo $var['user_id']; ?>"><span>ID：<?php echo $var['user_id'];?></span></li>
                <li><span>ユーザー名：<?php echo $var['user_name'];?></span></li>
                <li><span><?php echo get_adm_label($var['adm_user']); ?></span> でログイン中</li>
                <li class="uk-nav-divider"></li>
                <li>
                    <div class="uk-margin-small">
                        <label class="uk-form-label" style="font-size: 12px; color: #666;">権限変更:</label>
                        <select class="uk-select uk-form-small" id="permission-change" style="font-size: 12px; min-width: 150px;">
                            <option value="3" <?php echo ($var['adm_user'] == '3') ? 'selected' : ''; ?>>システム管理者</option>
                            <option value="2" <?php echo ($var['adm_user'] == '2') ? 'selected' : ''; ?>>管理者</option>
                            <option value="1" <?php echo ($var['adm_user'] == '1') ? 'selected' : ''; ?>>一般(事務)</option>
                            <option value="0" <?php echo ($var['adm_user'] == '0') ? 'selected' : ''; ?>>一般</option>
                        </select>
                        <?php if (isset($is_temp_changed)): ?>
                        <button class="uk-button uk-button-small uk-button-secondary uk-margin-small-top" 
                                style="font-size: 11px; width: 100%;" 
                                onclick="">
                            元の権限に戻す
                        </button>
                        <?php endif; ?>
                    </div>
                </li>
                <li class="uk-nav-divider"></li>
                <li><a href="<?php echo password_URL; ?>"><span class="uk-margin-small-right" uk-icon="icon: cog"></span> パスワード変更</a></li>
                <li><a href="<?php echo logout_URL; ?>"><span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> ログアウト</a></li>
            </ul>
        </div>
<?php
  endforeach;
  //櫻間
?>
    </div>


<!-- 右側ドロップダウン表示ありのheader　//高橋 -->
<nav class="uk-navbar-container">
    <div class="uk-navbar uk-flex-middle bg-navbar3">
        <div><!--Logo-->
            <a class="uk-navbar-item uk-logo" href="<?php echo MENU_URL; ?>">医療機関情報システム</a>
        </div>
        <div class="uk-navbar uk-visible@m"><!-- Link -->

            <!-- 20241111 加藤 お問い合わせフォーム管理者/利用者 -->
            <ul class="uk-navbar-nav">
                <li class="uk-active">
                    <a href="<?php echo search_URL; ?>"><i class="fas fa-search fa-2x" id=''></i>検索</a>
                </li>
<?php
                if($user_adm === '3' || $user_adm === '1'){
?>
                <li>
                    <a href="<?php echo hospital_URL; ?>"><i class="far fa-hospital fa-2x"></i>医療機関管理</a>
                </li>
                
                <li>
                    <a href="<?php echo user_URL; ?>"><i class="fas fa-user fa-2x"></i>ユーザ管理</a>
                </li>
<?php 
                }
?>
                <li>
                    <a href="<?php echo comments_URL; ?>"><i class="fa-regular fa-comments fa-2x"></i>お問い合わせ</a>
                </li>

                <li>
                    <a class="uk-button uk-button-link" id="manual-btn" type="button"><i class="fa-solid fa-book fa-2x"></i>マニュアル</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
<!-- bodyの最後に追加 -->
<div id="manual-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body" style="min-width:60vw; min-height:80vh;">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">マニュアル</h2>
        <iframe id="manual-pdf-frame" src="<?php echo $user_adm == 3 ? adm_manual_URL : manual_URL; ?>" width="100%" height="600px" style="border:none;"></iframe>
    </div>
</div>

<script src="<?php echo SITE_URL; ?>js/html/manual.js"></script>

<?php
// // 通常時：自動ログアウト有効、メンテナンス時：自動ログアウト無効
if(!isset($_SESSION['token'])){
?>
    <script src="<?php echo SITE_URL; ?>js/html/auto_logout.js"></script>
<?php
}
?>