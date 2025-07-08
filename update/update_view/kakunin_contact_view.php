<?php
//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');
$dbh = get_db_connect();
$contact_data = detail_contact($dbh,$hos_cd);
?>

<div class="detail-section" id="to-Contact">
<h4>コンタクト履歴</h4>
</div>

<!-- 20240312　大橋フィルタ機能　JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.18.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.18.3/dist/js/uikit-icons.min.js"></script>
    </head>

<style>
/* 見出し文字透け解消 */
    .uk-table {
        border-collapse: separate;
    }
/* 見出し固定*/
    thead{
    white-space: nowrap;
    position: sticky; /* thを固定 */
    color:#ffffff;
    top: 0; /* thを固定 */
    left: 0; /* thを固定 */
    }

    /* 
    table-green2 緑色テーブル (contact,support)
    */

    /* 最初の列 */
    .table-green2 tr>*:first-child{
    /* color:rgb(55,86,35); /* ⇒深緑 */
    color:#000000; /* 高橋20230704　黒に変更 */
    }
    /* 最初から2番目までの列 */
    .table-green2 tr>*:nth-of-type(-n+2) {
    font-weight:bolder;
    }

    /* 最初の行：見出し行 */
    .table-green2 tr:first-child>*{
    /* background: rgb(112, 173, 71); */
    background:#419116;
    color: rgb(255,255,255); /* ⇒白 */
    }

    /*　th */
    .table-green2 tr th{
    font-weight:bolder;
    text-align:center;
    }
    /* td文字色 */
    .table-green2 tr td{
    /* color:rgb(84,130,53); /* ⇒濃い緑 */
    color:#000000; /* 高橋20230704　黒に変更 */
    }

    /*
    背景色（データ行）
    */
    /* 奇数行 */
        .table-green2 tbody:nth-child(odd) td{
        background: rgb(226,239,218);  /* （薄緑） */
        }
    /* 偶数行 */
        .table-green2 tbody:nth-child(even) td{
        background: rgb(255,255,255); /* （白） */
        }
</style>


<body>

<div uk-filter="target: .js-filter; animation: fade;" >

    <div class="uk-grid-small uk-flex-middle" uk-grid>
        <div>
            <ul class="uk-subnav uk-subnav-pill" uk-margin>
        　　 <i class="fas fa-filter fa-lg"></i>　
            <li class="uk-active" uk-filter-control style="border:solid 1px #008009; border-radius: 5px;"><a href="#">All</a></li>　
            </ul>
        </div>
        <div>
            <ul class="uk-subnav uk-subnav-pill" uk-margin>
            <li style="border:solid 1px #008009;border-radius: 5px;">
                <a href="#">年度 <span uk-icon="icon:  triangle-down"></span></a>
                <div uk-dropdown="mode: click;">
                <ul class="uk-nav uk-dropdown-nav">
                    <li uk-filter-control="filter: [data-nendo='2024']; group: nendo"><a href="#">2024</a></li>
                    <li uk-filter-control="filter: [data-nendo='2023']; group: nendo"><a href="#">2023</a></li>
                    <li uk-filter-control="filter: [data-nendo='2022']; group: nendo"><a href="#">2022</a></li>
                </ul>
                </div>
            </li>
            </ul>
        </div>
        <div>
            <ul class="uk-subnav uk-subnav-pill" uk-margin>
            　<li style="border:solid 1px #008009; border-radius: 5px;" uk-filter-control="filter: [data-kbn='0']; group: kbn"><a href="#">附属病院</a></li>
            &nbsp<li style="border:solid 1px #008009; border-radius: 5px;" uk-filter-control="filter: [data-kbn='1']; group: kbn"><a href="#">総合医療センター</a></li>
            &nbsp<li style="border:solid 1px #008009; border-radius: 5px;" uk-filter-control="filter: [data-kbn='2']; group: kbn"><a href="#">高齢者医療センター</a></li>
            </ul>
        </div>
        <!-- 昇順降順のソート機能未実装部分
        <div class="uk-width-auto uk-text-nowrap">
        <span uk-filter-control="sort: data-date"><a class="uk-icon-link" href="#" uk-icon="icon: arrow-down" aria-label="Sort ascending"></a></span>
        <span class="uk-active" uk-filter-control="sort: data-date; order: desc"><a class="uk-icon-link" href="#" uk-icon="icon: arrow-up" aria-label="Sort descending"></a></span>
        </div>
         -->
         </div>

<!-- JSここまで -->


    <?php
        if(empty($contact_data)){ 
    ?><div class="uk-alert-secondary" uk-alert>
            データなし
    </div><?php
            }else{
    ?>
    <p>     

    <div class="support_tbl_wrap" style="overflow-x: scroll">
    <table class="uk-table table-green2" style="white-space:nowrap; ">
    <thead>
        <tr class="table-success ">
            <th rowspan='2'style="border: solid 1px #FFFFFF";>年度</td>
            <th rowspan='2'style="border: solid 1px #FFFFFF";>施設区分</th>
            <th rowspan='2'style="border: solid 1px #FFFFFF";>日付</th>
            <th rowspan='2'style="border: solid 1px #FFFFFF";>方法</th>
            <th rowspan='2'style="border: solid 1px #FFFFFF";>内容</th>    
            <th colspan='4'style="border: solid 1px #FFFFFF";>連携機関対応者</th>
            <th colspan='3'style="border: solid 1px #FFFFFF";>当院対応者所属</th>

            <th rowspan='2'style="border: solid 1px #FFFFFF";>備考</th>
            <th rowspan='2'style="border: solid 1px #FFFFFF";>データ作成部署</th>
        </tr>

        <tr >
            <th bgcolor=#419116 style="color:rgb(255,255,255); border: solid 1px #FFFFFF";>部署</th>
            <th bgcolor=#419116 style="color:rgb(255,255,255); border: solid 1px #FFFFFF";>役職</th>
            <th bgcolor=#419116 style="color:rgb(255,255,255); border: solid 1px #FFFFFF";>氏名</th>
            <th bgcolor=#419116 style="color:rgb(255,255,255); border: solid 1px #FFFFFF";>人数・その他の対応者</th>  
            <th bgcolor=#419116 style="color:rgb(255,255,255); border: solid 1px #FFFFFF";>所属</th>
            <th bgcolor=#419116 style="color:rgb(255,255,255); border: solid 1px #FFFFFF";>氏名</th>
            <th bgcolor=#419116 style="color:rgb(255,255,255); border: solid 1px #FFFFFF";>人数・その他の対応者</th>  
     </tr>
    </thead>
<?php
    foreach ($contact_data as $key =>$var):
?>        
<!-- 20240305 大橋フィルタ機能html/php（なぜか文字が白くなるため原因がわかるまでstyleで対応）  -->
<!-- 20240312 白くなる原因はtbodyに対するCSSが以前に実装されていたため　直接style記入のままでOK -->
<tbody class="js-filter">
<tr  data-nendo="<?php echo $var['year'];?>" data-kbn="<?php echo $var['ins'];?>" data-date="<?php echo $var['date'];?>">       
            <td style="color:black;"><?php if(!empty($var['year'])){ echo $var['year']; } ?></td>
             <!--　2023/12/5/大橋 施設区分の追加変更 -->
            <td style="color:black;"><?php if($var['ins'] == 0){
                        $ins = '附属病院';
                    }elseif($var['ins'] == 1){
                        $ins = '総合医療センター';
                    }elseif($var['ins'] == 2){
                        $ins = '高齢者医療センター';
                    }

                     echo $ins;  ?></td>
            <td style="color:black;"><?php if(!empty($var['MMDD'])){ echo $var['MMDD']; } ?></td>
            <td style="color:black;">
            <?php   /*　2023/12/5/大橋 プルダウンである必要がなさそうなので、表示形式を変更 */
                    if($var['method'] == 0){
                        $method = '訪問';
                    }elseif($var['method'] == 1){
                        $method = '来院';
                    }else{
                        $method = 'オンライン';
                    }
                                echo $method;  ?>

</td>
            <td style="color:black;"> <?php if(!empty($var['detail'])){ echo $var['detail']; } ?></td>
            <td style="color:black;"><?php if(!empty($var['ex_dept'])){ echo $var['ex_dept']; } ?></td>
            <td style="color:black;"><?php if(!empty($var['ex_position'])){ echo $var['ex_position']; } ?></td>            
            <td style="color:black;"><?php if(!empty($var['ex_name'])){ echo $var['ex_name']; } ?></td>
            <td style="color:black;"><?php if(!empty($var['ex_subnames'])){ echo $var['ex_subnames']; } ?></td>
            <td style="color:black;"><?php if(!empty($var['in_dept'])){ echo $var['in_dept']; } ?></td>
            <td style="color:black;"><?php if(!empty($var['in_name'])){ echo $var['in_name']; } ?></td>
            <td style="color:black;"><?php if(!empty($var['in_subnames'])){ echo $var['in_subnames']; } ?></td>
            <td style="color:black;"><?php if(!empty($var['con_note'])){ echo $var['con_note']; } ?></td>
            <td style="color:black;"><?php if(!empty($var['data_dept'])){ echo $var['data_dept']; } ?></td>
        </tr>  
</tbody>          
<?php
endforeach;
?>       
    </table>
    </div>
    <?php 
    }
    ?>
    </p>
</div>

<div class="detail-section" id="to-note5"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
        <textarea class="uk-textarea size-textarea-Notes" name="con_note" rows="7" maxlength="1000" readonly><?php echo $con_note; ?></textarea>
    </div>
</div>