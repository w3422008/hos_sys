<?php
//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');
$dbh = get_db_connect();
$training_data = detail_training($dbh,$hos_cd);

?>

<div class="detail-section" id="to-SprtTrng"><!-- 兼業 -->
<h4>兼業</h4>

<!-- 20240312　大橋フィルタ機能　JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.18.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.18.3/dist/js/uikit-icons.min.js"></script>
    </head>




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

    <div class="uk-margin">
    <?php if(!empty($training_data)): ?>
    <div class="support_tbl_wrap">
    <table class="uk-table table-green2" style="white-space:nowrap;">
    <tr>
            <th style="border: solid 1px #FFFFFF";>年度</th>
            <th style="border: solid 1px #FFFFFF";>施設</th>
            <th style="border: solid 1px #FFFFFF";>診療料</th>
            <th style="border: solid 1px #FFFFFF";>職名</th>
            <th style="border: solid 1px #FFFFFF";>氏名</th>
            <th style="border: solid 1px #FFFFFF";>開始日</th>
            <th style="border: solid 1px #FFFFFF";>終了日</th>
            <th style="border: solid 1px #FFFFFF";>診療支援区分</th>
            <th style="border: solid 1px #FFFFFF";>日時</th>
        </tr>
        <?php
        foreach($training_data as $key=>$var): ?>
        <tbody class="js-filter">
        <tr  data-nendo="<?php echo $var['year'];?>" data-kbn="<?php echo $var['ins'];?>" data-date="<?php echo $var['date'];?>">    
            <td style="color:black;"><?php echo $var['year'];?></td>
            <td style="color:black;"><?php if($var['ins']==='0'){ echo '附属病院'; }elseif($var['ins']==='1'){ echo '総合医療センター';}elseif($var['ins']==='2'){ echo '高齢者医療センター';}?></td>
            <td style="color:black;"><?php echo $var['dep'];?></td>
            <td style="color:black;"><?php echo $var['occ'];?></td>
            <td style="color:black;"><?php echo $var['name'];?>
            </td style="color:black;">
            <td style="color:black;"><?php echo $var['start'];?></td>
            <td style="color:black;"><?php echo $var['end'];?></td>
            <td style="color:black;"><?php echo $var['dia_div'];?></td>
            <td style="color:black;"><?php echo $var['date'];?></td>
        </tr>         
        </tbody> 
        <?php endforeach;?>
    </table>

    </div>

    
    <?php else: ?>
    <div class="uk-alert-secondary" uk-alert>
        データなし
    </div>
    <?php endif; ?>
    </div>
    </div>



<div class="detail-section" id="to-note6"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
        <textarea class="uk-textarea size-textarea-Notes"  rows="7" maxlength="1000" readonly><?php echo $tra_note; ?></textarea>
    </div>
</div>

</div>