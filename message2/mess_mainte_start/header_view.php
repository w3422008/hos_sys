<?php

//櫻間
  foreach ($data50 as $key =>$var):
  //櫻間
  $user_id = $_SESSION['member']['user_id'];
  $user_name = $_SESSION['member']['user_name'];
  $user_adm = $_SESSION['member']['adm_user'];
   //櫻間
//foreach($data as $key => $var):
?>

    <div class="uk-position-medium uk-position-top-right uk-position-z-index">
        <!-- Offcanvas -->
        <a class="uk-navbar-toggle uk-navbar-toggle-animate" href="#" uk-navbar-toggle-icon style="margin:0 0 0 auto;"></a>
    </div>

        <div class="uk-navbar-dropdown uk-width-auto" uk-dropdown="mode: click">
            <ul class="uk-nav uk-navbar-dropdown-nav" uk-margin>
                <li class="uk-nav-header">
                    <span uk-icon="icon: user"></span>
                </li>
                <li><span>ID：<?php echo $var['user_id'];?></span></li>
                <li><span>ユーザー名：<?php echo $var['user_name'];?></span></li>
                <li><span>
                <?php if($var['adm_user'] === '1'){ ?>
                    <label class="uk-label uk-label-danger"><?php echo "管理者"; ?>
                <?php }elseif($var['adm_user'] === '0'){ ?></label>
                    <label class="uk-label uk-label-success"><?php echo "一般"; ?>
                <?php }elseif($var['adm_user'] === '2'){ ?></label>
                    <label class="uk-label uk-label-Warning"><?php echo "一般（事務）"; ?></label>
                <?php };?>
                </span> でログイン中</li>
                <li class="uk-nav-divider"></li>
                <li><a href="/hos_sys/password/password_control.php"><span class="uk-margin-small-right" uk-icon="icon: cog"></span> パスワード変更</a></li>
                <li><a href="/hos_sys/login/logout.php"><span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> ログアウト</a></li>
            </ul>


            <p></p>
            <ul class="uk-nav uk-navbar-dropdown-nav" uk-margin>
                <li class="uk-nav-header">
                    <span uk-icon="icon: users"></span>
                </li>
                <li><span>ユーザー名：管理者　学生</span></li>
                <li><span><label class="uk-label uk-label-default"><?php echo "学生　管理者"; ?></span> でログイン中</li>
                <li class="uk-nav-divider"></li>
                <li><a href="/hos_sys/menu/MENU_control.php"><span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> ログアウト</a></li>
            </ul>
        </div>
<?php
  endforeach;
  //櫻間
?>



<!-- 右側ドロップダウン表示ありのheader　//高橋 -->
<nav class="uk-navbar-container">
    <div class="uk-navbar uk-flex-middle bg-navbar3">
        <div><!--Logo-->
            <a class="uk-navbar-item uk-logo" href="/hos_sys/menu/MENU_control.php">医療機関情報システム</a>
        </div>
        <div class="uk-navbar uk-visible@m"><!-- Link -->          
            <?php if($user_adm === '1'){ ?>
                <ul class="uk-navbar-nav">
                    <li class="uk-active">
                        <a href="/hos_sys/message/mess_mainte/mainte.php"><i class="fas fa-screwdriver-wrench fa-2x"></i></i>メンテナンス通知</a>
                    </li>
                    <li>
                        <a href="/hos_sys/message/mess_mainte_start/mainte.php"><i class="fas fa-screwdriver-wrench fa-2x"></i></i>メンテナンス開始・停止</a>
                    </li> 
                    <li>
                        <a href="/hos_sys/message/mes_log.php"><i class="far fa-comment fa-2x"></i></i>メッセージ</a>
                    </li>  
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>


