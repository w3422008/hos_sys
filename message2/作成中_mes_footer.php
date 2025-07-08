
<!-- **button_ to-TOP(↑) -->
<div style="position: relative;">
    <a href="#" class="to-top" uk-scroll><i class="fas fa-angle-up fa-lg"></i></a>
</div>

<div class="uk-hidden@m"><!--レスポンシブ-->
    <!-- **TabNavigation ここから -->
    <?php if($user_adm === '1'){ ?>
    <div class="TabNavigation uk-flex uk-flex-middle uk-child-width-1-3">
            <a class="TabNav_link" href="../search/checkbox_control.php?search="><i class="fas fa-search fa-2x"></i><span>検索</span></a>
            <a class="TabNav_link" href="#modal-user" uk-toggle><i class="fas fa-user fa-2x"></i><span>ユーザ管理</span></a>
            <a class="TabNav_link" href="#modal-hosp" uk-toggle><i class="far fa-hospital fa-2x"></i><span>医療機関管理</span></a>

        <!-- *Modal -->
        <div id="modal-user" class="uk-modal-full" uk-modal><!--Modal_user-->
            <div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" uk-height-viewport>
                <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                <div class="uk-width-2xlarge uk-padding-large">
                    <h1><a href="../user/user_MT_control.php">ユーザ管理</a></h1>
                    <p><a href="../user/user_MT_control.php?onf=Active">利用ユーザ一覧</a></p>
                    <p><a href="../user/user_MT_control.php?onf=InActive">停止ユーザ一覧</a></p>
                    <p><a href="../user/registration.php">新規追加</a></p>
                </div>
            </div>
        </div>
        <div id="modal-hosp" class="uk-modal-full" uk-modal><!--Modal_hosp-->
            <div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" uk-height-viewport>
                <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                <div class="uk-width-2xlarge uk-padding-large">
                    <h1><a href="../hos_management/manage_control.php">医療機関管理</a></h1>
                    <p><a href="../insert/insert_control.php">新規追加</a></p>
                    <p><!-- <a href=""> -->メンテナンス<!-- </a> --></p>
                    <p><a href="../delete/hide_hos_control.php">削除</a></p>
                </div>
            </div>
        </div>

    </div>
    <?php } ?>
    <!-- **TabNavigation ここまで -->
</div>

