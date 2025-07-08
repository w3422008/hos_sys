<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー管理 | 医療機関情報システム</title>
    <!--CSS/JS-->
    <!-- *全画面必須 ---------->
        <!--UIkit3-->
        <link rel="stylesheet" href="../css/uikit.min.css" />
        <script src="../js/uikit.min.js"></script>
        <script src="../js/uikit-icons.min.js"></script>
        <link rel="stylesheet" href="../css/uk-custom.css">

        <!--style.css-->
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="../css/form_parts.css" />
        <link rel="stylesheet" href="../css/marker.css"/>
        <link rel="stylesheet" href="../css/tables.css" />

        <!--*font awesome-->
        <link rel="stylesheet" href="../css/all.min.css" />
<!--20231031櫻間-->

        <style>
            /*停止中ユーザ―の背景色をグレーに*/
            .hide-tbl-bgd {
                background: #f8f8f8;
            }

            /* 高橋 今度やる
            .fixed-thead {
                position: relative;
            }
            .fixed-thead th {
                position: sticky;
                top: 0px;
            }
            */
        </style>

</head> 

<body>
    <!-- **header -->
    <?php include_once("../header.php"); ?>
    <header uk-sticky>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><span>ユーザー管理</span></li>
        </ul>
    </header>

    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
        <?php include_once("../footer.php"); ?>
    </footer>

    <!-- **main -->
    <main>
    <div class="uk-container uk-width-expand">
        <!-- *main_header -->
            <div class="uk-card-header uk-flex uk-flex-middle uk-flex-between">
                <h2>ユーザー管理</h2>
                <div>
                    <a href="registration.php" class="bubble_none">
                        <p><i class="fas fa-user-plus fa-lg"></i><b class="uk-visible@s">ユーザ新規追加</b></p>
                    </a>
                </div>
            </div>

        <!-- *main_body -->
            <div class="filter_items">
                <!-- 絞込条件 -->
                <!--form action="user_MT_control.php" method="GET">
                    <span>
                        <i class="fas fa-filter fa-lg"></i>
                        絞込み条件：
                    </span>
                    <div class="uk-inline">
                        <button class="filter_select" type="button">
                            権限
                        </button>
                        <div uk-dropdown="mode: click">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="uk-nav-header">権限</li>
                                <li><label><input type="checkbox" name="FIL_adm[]" value="" class="uk-checkbox" <?php //if($FIL_adm === null){?> checked <?php //} ?>>ALL</label></li>
                                <li class="uk-nav-divider"></li>
                                <li><label><input type="checkbox" name="FIL_adm[]" value="1" class="uk-checkbox" onchange="submit(this.form)" <?php //if($FIL_adm === '1'){?> checked <?php //} ?>>管理者</label></li>
                                <li><label><input type="checkbox" name="FIL_adm[]" value="0" class="uk-checkbox" onchange="submit(this.form)" <?php //if($FIL_adm === '0'){?> checked <?php //} ?>>一般</label></li>
                                <li><label><input type="checkbox" name="FIL_adm[]" value="2" class="uk-checkbox" onchange="submit(this.form)" <?php //if($FIL_adm === '2'){?> checked <?php //} ?>>一般（事務）</label></li>
                            </ul>
                        </div>
                    </div>

                    <div class="uk-inline">
                        <button class="filter_select" type="button">
                            施設
                        </button>
                        <div uk-dropdown="mode: click">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="uk-nav-header">施設</li>
                                <li><label><input type="radio" name="ins" class="uk-radio" checked>ALL</label></li>
                                <li class="uk-nav-divider"></li>
                                <li><label><input type="radio" name="ins" class="uk-radio">附属病院</label></li>
                                <li><label><input type="radio" name="ins" class="uk-radio">総合医療センター</label></li>
                            </ul>
                        </div>
                    </div>

                    <div class="uk-inline">
                        <button class="filter_select" type="button">
                            所属
                        </button>
                        <div uk-dropdown="mode: click">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="uk-nav-header">所属</li>
                                <li><label><input type="checkbox" name="" class="uk-checkbox" checked>ALL</label></li>
                                <li class="uk-nav-divider"></li>
                                <li><label><input type="checkbox" name="" class="uk-checkbox">医事課</label></li>
                                <li><label><input type="checkbox" name="" class="uk-checkbox">庶務課</label></li>
                                <li><label><input type="checkbox" name="" class="uk-checkbox">地域医療連携室</label></li>
                                <li><label><input type="checkbox" name="" class="uk-checkbox">医療資料部</label></li>
                            </ul>
                        </div>
                    </div>
                </form-->

                <!--ID検索-->
                <form action="user_MT_control.php" method="GET" class="validationForm" novalidate>
                    <span>ID検索：</span>
                    <!-- textbox -->
                    <?php if(isset($id)){ ?>
                        <input type="text" class="required user_id" id="user_id" name="user_id" value="<?php echo $id ; ?>" placeholder="ユーザーIDを入力" data-pattern="user">
                    <?php }else{ ?>
                        <input type="text" class="required user_id" id="user_id" name="user_id" placeholder="ユーザーIDを入力" data-pattern="user">
                    <?php } ?>

                    <!-- button -->
                    <button type="submit" class="filter_btn"><i class="fas fa-arrow-alt-circle-right"></i></button>
                    
                    <?php if(isset($id)&&$id!==''){ //解除 ?>
                    <a href="user_MT_control.php" class="filter_btn"><i class="far fa-times-circle"></i></a>
                    <?php } ?>                
                </form>
            </div>

            <div class="filter_items uk-flex uk-flex-between">
                <form action="user_MT_control.php" method="GET">
                    <select class="filter_select" name="onf" onchange="submit(this.form)">
                        <option value="ALL" <?php if($onf === null){?> selected <?php } ?>>すべてのユーザー</option>
                        <option value="Active" <?php if($onf === '0'){?> selected <?php } ?>>利用中</option>
                        <option value="InActive" <?php if($onf === '1'){?> selected <?php } ?>>停止中</option>
                    </select>
                </form>

                <?php if(!empty($data)){ ?>
                    <!-- 高橋20221211
                        件数表示変更　✅必要に応じてカスタマイズ
                    -->
                    <form action="user_MT_control.php" method="POST">
                        <span>表示件数：</span>
                        <select name="display" onchange="submit(this.form)">
                            <option value="5" <?php if($disp_cnt === '5'){?> selected <?php } ?>>5</option>
                            <option value="10" <?php if($disp_cnt === '10'){?> selected <?php } ?>>10</option>
                            <option value="15" <?php if($disp_cnt === '15'){?> selected <?php } ?>>15</option>
                            <option value="20" <?php if($disp_cnt === '20'){?> selected <?php } ?>>20</option>
                            <option value="50" <?php if($disp_cnt === '50'){?> selected <?php } ?>>50</option>
                            <option value="全件" <?php if($disp_cnt === '全件'){?> selected <?php } ?>>全件</option>
                        </select>
                        <button type="submit" class="filter_btn"><i class="fas fa-exchange-alt"></i></button>
                    </form>
                    <!-- 件数表示変更ここまで -->
                <?php } ?>
            </div>

        <?php //高橋20221224 修正
            if(!empty($data)){
        ?>               
                <!-- 1120
                    Pagination
                -->
                <ul class="uk-pagination uk-flex-center" uk-margin>
                    <!-- 最初のページへのリンク（<<）uk-pagination-previous -->
                    <?php if ($page > 1) { ?>
                        <li><a href="?page=1" title="最初のページへ"><span uk-icon="chevron-double-left"></span></a></li>
                    <?php } else { ?>
                        <li class="uk-disabled"><span uk-icon="chevron-double-left"></span></li>
                    <?php } ?>

                    <!-- 前のページへのリンク（前へ）uk-pagination-previous -->
                    <?php if ($page > 1) { ?>
                        <li><a href="?page=<?php echo $prev; ?>" title="前のページへ"><span  uk-icon="chevron-left"></span></a></li>
                    <?php } else { ?>
                        <li class="uk-disabled"><span uk-icon="chevron-left"></span></li>
                    <?php } ?>

                    <!-- 最初のページ番号へのリンク（1） -->
                    <?php if ($page > 1) { ?>
                        <li><a href="?page=1">1</a></li>
                    <?php } else { ?>
                        <li class="uk-disabled"><span>1</span></li>
                    <?php } ?>

                    <!-- ドットの表示（...） -->
                    <?php if ($page_start > $pageRange){ ?>
                        <li class="uk-disabled"><span>…</span></li>
                    <?php } ?>
                
                    <!-- ページリンク表示ループ -->
                    <?php 
                    foreach ($nums as $num):
                        if ($num == $page) { //現在地のページ番号 ?>
                            <li class="uk-active"><span><?php echo $num; ?></span></li>            
                    <?php
                        } else { //ページ番号リンク表示
                    ?>
                            <li><a href="?page=<?php echo $num; ?>"><?php echo $num; ?></a></li>
                    <?php 
                        } 
                    endforeach;
                    ?>

                    <!-- ドットの表示（...） -->
                    <?php if (($totalPage - 1) > $page_end){ ?>
                        <li class="uk-disabled"><span>…</span></li>
                    <?php } ?> 

                    <!-- 最後のページ番号へのリンク（$totalPage） -->
                    <?php if ($page < $totalPage) { ?>
                        <li><a href="?page=<?php echo $totalPage; ?>"><?php echo $totalPage; ?></a></li>
                    <?php } elseif($totalPage == 1) { ?>
                        <li></li>
                    <?php } else { ?>
                        <li class="uk-disabled"><span><?php echo $totalPage; ?></span></li>
                    <?php } ?>

                    <!-- 次のページへのリンク（次へ）uk-pagination-next -->
                    <?php if ($page < $totalPage) { ?>
                        <li><a href="?page=<?php echo $next; ?>" title="次のページへ"><span uk-icon="chevron-right"></span></a></li>
                    <?php } else { ?>
                        <li class="uk-disabled"><span uk-icon="chevron-right"></span></li>
                    <?php } ?>

                    <!-- 最後のページへのリンク（>>）uk-pagination-next -->
                    <?php if ($page < $totalPage) { ?>
                        <li><a href="?page=<?php echo $totalPage; ?>" title="最後のページへ"><span uk-icon="chevron-double-right"></span></a></li>
                    <?php } else { ?>
                        <li class="uk-disabled"><span uk-icon="chevron-double-right"></span></li>
                    <?php } ?>
                </ul>
                <!-- Paginationここまで -->

                <!-- **Table -->
                <table class="uk-table uk-table-hover uk-table-responsive tbl-line fixed-thead">
                    <thead>
                        <tr>
                            <th class="uk-table-shrink"></th>
                            <th class="uk-table-shrink"></th>
                            <th class="uk-table-shrink"></th>
                            <th class="uk-table-expand">ID／氏名</th>
                            <th class="uk-width-medium">施設／所属</th>
                            <th class="uk-width-medium">履歴</th>
                            <th class="uk-table-shrink"></th>
                            <!-- <th class="uk-table-shrink uk-text-nowrap">Shrink + Nowrap</th> -->
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach($disp_data as $key => $var):
                        //foreach($data1 as $key => $var):
                        ?>
                        <tr <?php if($var['onf']==='1'){ echo 'class="hide-tbl-bgd" uk-tooltip="title:停止中ユーザ; pos: top-left" '; }else{ echo 'uk-tooltip="title:利用中ユーザ; pos: top-left" '; } ?>>
                            <td>
                                <?php /*if($var['onf']==='0'){ ?>
                                    <i class="fas fa-check-circle"></i>
                                <?php }else */if($var['onf']==='1'){ ?>
                                    <i class="fas fa-lock"></i>
                                <?php } ?>
                            </td>
                            <td>
                                <i class="fas fa-user-circle fa-2x" style="color:#aaa;"></i>
                            </td>
                            <td>            
                                <!-- 権限ごとにlabelの色を変更 -->
                                <?php echo get_adm_label($var['adm_user']); ?>
                            </td>
                            <td>
                                <div>
                                    <label for="user_id">ID：</label>
                                    <u><?php echo html_escape($var['user_id']); ?></u>
                                </div>
                                <div>
                                    <span style="font-size:1.2em;">
                                    <?php echo html_escape($var['user_name']); ?>
                                    </span>
                                </div>
                            </td>
                            <td class="uk-text-truncate">
                                <div>
                                    <?php if($var['ins'] === '0'){ ?>
                                        <span><?php echo "附属病院"; ?></span>
                                    <?php }elseif($var['ins'] === '1'){ ?>
                                        <span><?php echo "総合医療センター"; ?></span>
                                    <?php }elseif($var['ins'] === '2'){ ?>
                                        <span><?php echo "高齢者医療センター"; ?></span>
                                    <?php };?>                      
                                </div>
                                <div>（
                                    <?php //嶋津
                                    if($var['ins'] === '0'){
                                        foreach($user_bel as $key=>$row):?>
                                        <?php if($var['bel'] === (string)$key){
                                                echo $row;
                                        };?>
                                        <?php endforeach;
                                    }elseif($var['ins'] === '1'){
                                        foreach($center_bel as $key=>$row):?>
                                            <?php if($var['bel'] === (string)$key){
                                                    echo $row;
                                            };?>
                                            <?php endforeach;                               
                                    }elseif($var['ins'] === '2'){
                                        foreach($kourei_bel as $key=>$row):?>
                                            <?php if($var['bel'] === (string)$key){
                                                echo $row;
                                            };?>
                                    <?php endforeach;
                                    }?>
                                ）</div>
                            </td>
                            <td>
                                <?php if($var['onf']==='0'){ ?>
                                <div>開始日：<?php echo html_escape($var['start']); ?></div>
                                <div>変更日：<?php echo html_escape($var['up_date']); ?></div>
                                <?php }elseif($var['onf']==='1'){ ?>
                                <div>利用停止日：<?php echo html_escape($var['end']); ?></div>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($var['onf']==='0'){ ?>
                                <a class="uk-button"><i class="fas fa-ellipsis-h fa-lg"></i></a>
                                <div class="uk-width-small" uk-dropdown="mode: click">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li><a href="update.php?id=<?php echo $var['user_id']; ?>"><i class="fas fa-user-edit fa-lg"></i> 変更</a></li>
                                        <li class="uk-nav-divider"></li>
                                        <li><a href="hide.php?id=<?php echo $var['user_id']; ?>"><i class="fas fa-user-slash fa-lg"></i> 利用停止</a></li>
                                        <li class="uk-nav-divider"></li>
                                        <li><a href="clear.php?id=<?php echo $var['user_id']; ?>"><i class="fas fa-key fa-lg"></i> パスワード初期化</a></li>
                                    </ul>
                                </div>
                                <?php }elseif($var['onf']==='1'){ ?>
                                <a class="uk-button"><i class="fas fa-ellipsis-h fa-lg"></i></a>
                                <div class="uk-width-small" uk-dropdown="mode: click">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <li><a href="undoing.php?id=<?php echo $var['user_id']; ?>"><i class="fas fa-lock-open fa-lg"></i> 停止解除</a></li>
                                        <li class="uk-nav-divider"></li>
                                        <li><a href="deleate.php?id=<?php echo $var['user_id']; ?>"><i class="far fa-trash-alt fa-lg"></i> 削除</a></li>
                                    </ul>
                                </div>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                        endforeach; 
                        ?>
                    </tbody>

                </table>
                <!-- **Tableここまで -->

                <!-- 1120
                    Pagination
                -->
                <ul class="uk-pagination uk-flex-center uk-margin-top" uk-margin>
                    <!-- 最初のページへのリンク（<<）uk-pagination-previous -->
                    <?php if ($page > 1) { ?>
                        <li><a href="?page=1" title="最初のページへ"><span uk-icon="chevron-double-left"></span></a></li>
                    <?php } else { ?>
                        <li class="uk-disabled"><span uk-icon="chevron-double-left"></span></li>
                    <?php } ?>

                    <!-- 前のページへのリンク（前へ）uk-pagination-previous -->
                    <?php if ($page > 1) { ?>
                        <li><a href="?page=<?php echo $prev; ?>" title="前のページへ"><span  uk-icon="chevron-left"></span></a></li>
                    <?php } else { ?>
                        <li class="uk-disabled"><span uk-icon="chevron-left"></span></li>
                    <?php } ?>

                    <!-- 最初のページ番号へのリンク（1） -->
                    <?php if ($page > 1) { ?>
                        <li><a href="?page=1">1</a></li>
                    <?php } else { ?>
                        <li class="uk-disabled"><span>1</span></li>
                    <?php } ?>

                    <!-- ドットの表示（...） -->
                    <?php if ($page_start > $pageRange){ ?>
                        <li class="uk-disabled"><span>…</span></li>
                    <?php } ?>
                
                    <!-- ページリンク表示ループ -->
                    <?php 
                    foreach ($nums as $num):
                        if ($num == $page) { //現在地のページ番号 ?>
                            <li class="uk-active"><span><?php echo $num; ?></span></li>            
                    <?php
                        } else { //ページ番号リンク表示
                    ?>
                            <li><a href="?page=<?php echo $num; ?>"><?php echo $num; ?></a></li>
                    <?php 
                        } 
                    endforeach;
                    ?>

                    <!-- ドットの表示（...） -->
                    <?php if (($totalPage - 1) > $page_end){ ?>
                        <li class="uk-disabled"><span>…</span></li>
                    <?php } ?> 

                    <!-- 最後のページ番号へのリンク（$totalPage） -->
                    <?php if ($page < $totalPage) { ?>
                        <li><a href="?page=<?php echo $totalPage; ?>"><?php echo $totalPage; ?></a></li>
                    <?php } elseif($totalPage == 1) { ?>
                        <li></li>
                    <?php } else { ?>
                        <li class="uk-disabled"><span><?php echo $totalPage; ?></span></li>
                    <?php } ?>

                    <!-- 次のページへのリンク（次へ）uk-pagination-next -->
                    <?php if ($page < $totalPage) { ?>
                        <li><a href="?page=<?php echo $next; ?>" title="次のページへ"><span uk-icon="chevron-right"></span></a></li>
                    <?php } else { ?>
                        <li class="uk-disabled"><span uk-icon="chevron-right"></span></li>
                    <?php } ?>

                    <!-- 最後のページへのリンク（>>）uk-pagination-next -->
                    <?php if ($page < $totalPage) { ?>
                        <li><a href="?page=<?php echo $totalPage; ?>" title="最後のページへ"><span uk-icon="chevron-double-right"></span></a></li>
                    <?php } else { ?>
                        <li class="uk-disabled"><span uk-icon="chevron-double-right"></span></li>
                    <?php } ?>
                </ul>
                <!-- Paginationここまで -->

        <?php  
            }else{
                if(isset($_GET['user_id'])){ 
                /*検索結果なし*/ ?>
                <div class="uk-margin-top uk-container uk-container-center uk-width-1-1@l">
                    <p class="uk-text-danger"><span uk-icon="warning"></span> <b style="border-bottom:1px solid;">検索結果なし</b>：該当するユーザーIDがございません。</p>
                </div>
        <?php   }else{
                /*データなし*/ ?>
                <div class="uk-margin-top uk-container uk-container-center uk-width-1-1@l">
                    <p class="uk-text-danger"><span uk-icon="warning"></span> <b style="border-bottom:1px solid;">データなし</b>：ユーザ情報がありません</p>
                </div>
        <?php  
                }
            }
        ?>
        </div>
    </main>


</body>
    
<script>  
    //class="validationForm" と novalidate 属性を指定した form 要素を独自に検証
    document.addEventListener('DOMContentLoaded', () => {
      //.validationForm を指定した最初の form 要素を取得
      const validationForm = document.querySelector('.validationForm');
      //.validationForm を指定した form 要素が存在すれば
      if(validationForm) {
        //エラーを表示する span 要素に付与するクラス名（エラー用のクラス）
        const errorClassName = 'error';
        
        //required クラスを指定された要素の集まり  
        const requiredElems = document.querySelectorAll('.required');
        //user_id クラスを指定された要素の集まり
        const user_idElems =  document.querySelectorAll('.user_id');
        
        //エラーメッセージを表示する span 要素を生成して親要素に追加する関数
        //elem ：対象の要素
        //errorMessage ：表示するエラーメッセージ
        const createError = (elem, errorMessage) => {
          //span 要素を生成
          const errorSpan = document.createElement('span');
          //エラー用のクラスを追加（設定）
          errorSpan.classList.add(errorClassName);
          //aria-live 属性を設定
          errorSpan.setAttribute('aria-live', 'polite');
          //引数に指定されたエラーメッセージを設定
          errorSpan.textContent = errorMessage;
          //elem の親要素の子要素として追加
          elem.parentNode.appendChild(errorSpan);
        }
     
        //form 要素の submit イベントを使った送信時の処理
        validationForm.addEventListener('submit', (e) => {
          //エラーを表示する要素を全て取得して削除（初期化）
          const errorElems = validationForm.querySelectorAll('.' + errorClassName);
          errorElems.forEach( (elem) => {
            elem.remove(); 
          });
          
          //.required を指定した要素を検証
          requiredElems.forEach( (elem) => {
            //値（value プロパティ）の前後の空白文字を削除
            const elemValue = elem.value.trim(); 
            //値が空の場合はエラーを表示してフォームの送信を中止
            if(elemValue.length === 0) {
              createError(elem, '入力は必須です');
              e.preventDefault();
            }
          });
          
          //.user_id を指定した要素を検証
          user_idElems.forEach( (elem) => {
            //user_id の検証に使用する正規表現パターン
            const pattern = /^[0-9a-zA-Z]+$/;
            //値が空でなければ
            if(elem.value !=='') {
              //test() メソッドで値を判定し、マッチしなければエラーを表示してフォームの送信を中止
              if(!pattern.test(elem.value)) {
                createError(elem, 'ユーザIDは半角で入力してください。');
                e.preventDefault();
              }
            }
          });
          
      
          //エラーの最初の要素を取得
          const errorElem =  validationForm.querySelector('.' + errorClassName);
          //エラーがあればエラーの最初の要素の位置へスクロール
          if(errorElem) {
            const errorElemOffsetTop = errorElem.offsetTop;
            window.scrollTo({
              top: errorElemOffsetTop - 40,  //40px 上に位置を調整
              //スムーススクロール
              behavior: 'smooth'
            });
          }
        }); 
      }
    });
    </script>
</html>