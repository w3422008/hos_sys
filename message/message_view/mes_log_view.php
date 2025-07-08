<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者画面　｜　医療機関システム</title>

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
    <!--------------------* -->
        <link rel="stylesheet" href="../css/bubble.css">
        <link rel="stylesheet" href="../css/mes_log.css">
 
</head>

<body>
    <!-- **header -->
    <?php include_once("./mes_header.php"); ?>
    <header uk-sticky>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><a href="./login.php">管理者ログイン</a></li>
            <li><span>メッセージ画面</span></li>
        </ul>
    </header>

    <!-- **footer ページ下部固定-->
    <footer uk-sticky="position: bottom">
        <!--  下から一番上に直ぐ戻ってくるボタン  -->
        <div style="position: relative;">
            <a href="#" class="to-top" uk-scroll><i class="fas fa-angle-up fa-lg"></i></a>
        </div>
        
        <?php include_once("./mes_footer.php"); ?>
    </footer>


    <!-- **main -->
    <main>
    <!-- 全体的に中央に寄る -->
    <div class=" uk-container uk-width-expand">

    <!-- 三宅20231127 新規追加の欄 -->
    <div class="uk-container uk-width-expand uk-width-5-6@l uk-card-default">
    <form action="mes_add.php" method="POST"  name="myform" onsubmit="return Check()" class="validationForm" >
        <p></p>
        <!-- 三宅20240220 新規追加タイトル -->
        <div class="uk-card-header">
            <h2>message新規追加</h2>
        </div>

        <div class="uk-margin" uk-grid>
            <div><!-- 依頼者　施設 -->
            <label>依頼者　施設</label>
                <div class="uk-form-controls">
                    <select name="req_fac" class="uk-select size-input-pre" id="selbox" onchange="change();">
                        <option value="附" <?php if(isset($req_fac) && $req_fac==='附'){echo 'selected'; }?>>附属病院</option>

                        <option value="総" <?php if(isset($req_fac) && $req_fac==='総'){echo 'selected'; }?>>総合医療センター</option> 

                        <option value="福祉大" <?php if(isset($req_fac) && $req_fac==='福祉大'){echo 'selected'; }?>>医療福祉大学</option>

                        <option value="その他" <?php if(isset($req_fac) && $req_fac==='その他'){echo 'selected'; }?>>その他</option>
                    </select>
                </div>
            </div>

            <div><!-- 依頼者　所属 -->
            <label>依頼者　所属</label>
                <div class="uk-form-controls">
                    <input type=text class="uk-input size-input-hosCd pattern" name="req_dep" maxlength="50" data-pattern="code" value="<?php if(isset($req_dep)){echo $req_dep; } ?>" required>
                </div>
            </div>



            <div><!-- 対応日 -->
                <label>依頼日</label>
                    <div><input type="date" class="uk-input size-input-hosCd pattern" name="req_date" value="<?php if(isset($req_date)){echo $req_date; } ?>" min="2000-01-01" max="2030-12-31" required></div>
            </div>

            <div><!-- 三宅20231219　表示・非表示 -->
            <label>表示／非表示</label>
                <div class="uk-form-controls">
                    <select name="view" class="uk-select size-input-pre" id="selbox3" onchange="change();">
                        <option value = 1 <?php if($view == '1'|| $view == ''){ echo 'selected' ;}?>>表示</option>

                        <option value = 0 <?php if($view == '0'){ echo 'selected' ;}?>>非表示</option> 

                    </select>
                </div>
            </div>
        </div>
        
        <div class="uk-margin" uk-grid>
            <div><!-- 変更箇所・内容 -->
                <label>変更箇所・内容(100文字以内)</label>    
                <div><textarea class="uk-textarea size-textarea-Notes meslog" rows="3" name="comment" maxlength="100"><?php if(isset($comment)){echo $comment; } ?></textarea></div>
            </div>

            <div class="uk-flex uk-flex-between"><!-- 追加ボタン -->
                <div class="position">
                    <button type="submit" name = "mes_sub" value="確認" class="uk-button uk-button-primary">確認画面</button> 
                </div>
            </div>
        </div>
    </div>

    </form>

    <!-- **Table -->
    <table class="uk-table uk-table-hover uk-table-responsive tbl-line fixed-thead">
        <thead>
            <tr>
                <th class="uk-width-small">依頼日</th> 
                <th class="uk-width-small">対応日</th>
                <th class="uk-width-auto">バージョン</th>
                <th class="uk-table-shrink">対応状況</th>
                <th class="uk-table-auto">変更箇所・内容</th>
                <th class="uk-width-medium">依頼者　所属</th>
                <th class="uk-table-shrink" colspan="3"></th>
        </tr>    
        </thead>

        <tbody>
            
            <?php foreach($mes_log as $key => $var): ?>
                <tr>

                    <td><?php if(!empty($var['req_date'])){echo htmlspecialchars($var['req_date'],ENT_QUOTES,'UTF-8');}?></td>    
                
                    <td><?php if(!empty($var['res_date'])){echo htmlspecialchars($var['res_date'],ENT_QUOTES,'UTF-8');} ?></td>

                    <td><?php if(!empty($var['version'])){echo htmlspecialchars($var['version'],ENT_QUOTES,'UTF-8');} ?></td>

                    <td>
                        <!-- 状況ごとにlabelの色を変更 -->
                        <?php if($var['situation'] === '0'){ ?>
                        <label class="uk-label uk-label-danger"><?php echo "未対応"; ?></label>
                        <?php }elseif($var['situation'] === '10'){ ?>
                        <label class="uk-label uk-label-success"><?php echo "対応中"; ?></label>
                        <?php }elseif($var['situation'] === '11'){ ?>
                        <label class="uk-label uk-label-primary"><?php echo "対応済"; ?></label>
                        <?php };?>
                    </td>

                    <td><?php echo htmlspecialchars($var['comment'],ENT_QUOTES,'UTF-8'); ?></td>

                    <td><?php echo htmlspecialchars($var['req_fac'],ENT_QUOTES,'UTF-8') .")". htmlspecialchars($var['req_dep'],ENT_QUOTES,'UTF-8'); ?></td>

                    <!-- 三宅20231226 0が非表示/1が表示 ボタン横並び-->
                    
                        <?php if($var["view"] === '0'){ ?>
                                        <td><a href="mes_display.php?id=<?php echo $var['id']; ?>"><i class="fas fa-eye-slash fa-lg"></i>　</a>
                                            <a href="mes_update.php?id=<?php echo $var['id']; ?>"><i class="fas fa-pen-to-square fa-lg"></i>　</a>
                                            <a href="mes_delete.php?id=<?php echo $var['id']; ?>"><i class="fas fa-circle-xmark fa-lg"></i></a>
                                        </td>
                                    </ul>
                                
                        <?php }elseif($var["view"] === '1'){ ?>
                                            <td><a href="mes_display.php?id=<?php echo $var['id']; ?>"><i class="fas fa-eye fa-lg"></i>　</a>
                                                <a href="mes_update.php?id=<?php echo $var['id']; ?>"><i class="fas fa-pen-to-square fa-lg"></i>　</a>
                                                <a href="mes_delete.php?id=<?php echo $var['id']; ?>"><i class="fas fa-circle-xmark fa-lg"></i></a>
                                            </td>
                                        </ul>

                        <?php } ?>

                </tr>
            <?php endforeach;?>
        </tbody>
</table>  
</div>
</main>
</body>

</html>