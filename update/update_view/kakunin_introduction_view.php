<?php
//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');
$dbh = get_db_connect();

/* 高橋20230428 紹介・逆紹介データ */
   //紹介（附属病院）
   $intr_data = detail_intr($dbh,$hos_cd);
      $intr_sum = SUMs_intr($dbh,$hos_cd);
   //逆紹介（附属病院）
   $invintr_data = detail_invintr($dbh,$hos_cd);
      $invintr_sum = SUMs_invintr($dbh,$hos_cd);

$Years=get_10Years(); //＊過去10年配列$Years ?>


<div class="detail-section" id="to-kurashiki"><!--【附属病院】-->
<h4>附属病院</h4>
    <div class="uk-margin" id="kurashiki_intro"><!-- 紹介 -->
    <h5>紹介件数</h5>
        <?php if(!empty($intr_data)): ?>
        <div class="intro_tbl_wrap">
        <table class="uk-table uk-table-small table-green">
            <tr>
                <th>診療科</th>
                <th>合計</th>
            <?php foreach($Years as $var){ //過去10年自動取得 ?>
                <th><?php echo $var; ?></th>
            <?php } //過去10年自動取得 ?>
            </tr>

            <?php /* --附属病院 紹介_件数-- */
            foreach($intr_data as $var): ?>            
            <tr>
                 <td><?php echo $var['fie_name']; ?></td>
                <td><?php echo $var['sALL']; ?></td>
                <?php foreach($Years as $y){ //過去10年自動取得 ?>
                <td><?php echo $var[$y]; ?></td>
                <?php } //過去10年自動取得 ?>
            </tr>
            <?php 
            endforeach; ?>
            <?php /* --附属病院 紹介_総計-- *//*
            foreach($intr_sum as $var): ?>
            <tr>
                <td>総計</td>
                <td><?php echo $var['sALL']; ?></td>
                <?php foreach($Years as $y){ //過去10年自動取得 ?>
                <td><?php echo $var[$y]; ?></td>
                <?php } //過去10年自動取得 ?>
            </tr>
            <?php 
            endforeach; */?>
        </table>
        </div>
        <?php else: ?>
        <div class="uk-alert-secondary" uk-alert>
            データなし
        </div>
        <?php endif; ?>
    </div>

    <div class="uk-margin" id="kurashiki_inversintro">
    <h5>逆紹介件数</h5>
        <?php if(!empty($invintr_data)): ?>
        <div class="intro_tbl_wrap">
        <table class="uk-table uk-table-small table-green">
            <tr>
                <th>診療科</th>
                <th>合計</th>
            <?php foreach($Years as $var){ //過去10年自動取得 ?>
                <th><?php echo $var; ?></th>
            <?php } //過去10年自動取得 ?>
            </tr>

            <?php /* --附属病院 逆紹介_件数-- */
            foreach($invintr_data as $var): ?>            
            <tr>
                 <td><?php echo $var['fie_name']; ?></td>
                <td><?php echo $var['sALL']; ?></td>
                <?php foreach($Years as $y){ //過去10年自動取得 ?>
                <td><?php echo $var[$y]; ?></td>
                <?php } //過去10年自動取得 ?>
            </tr>
            <?php 
            endforeach; ?>

            <?php /* --附属病院 逆紹介_総計-- *//*
            foreach($invintr_sum as $var): ?>
            <tr>
                <td>総計</td>
                <td><?php echo $var['sALL']; ?></td>
                <?php foreach($Years as $y){ //過去10年自動取得 ?>
                <td><?php echo $var[$y]; ?></td>
                <?php } //過去10年自動取得 ?>
            </tr>
            <?php 
            endforeach; */?>

        </table>
        </div>
        <?php else: ?>
        <div class="uk-alert-secondary" uk-alert>
            データなし
        </div>
        <?php endif; ?>
    </div>
</div>



<div class="detail-section" id="to-okayama"><!--【総合医療センター】-->
<h4>総合医療センター</h4>
    <div class="uk-margin" id="okayama_intro"><!-- 紹介 -->
    <h5>紹介件数</h5>
        <?php if(!empty($intr_data2)): ?>
        <div class="intro_tbl_wrap">
        <table class="uk-table uk-table-small table-green">
            <tr>
                <th>診療科</th>
                <th>合計</th>
            <?php foreach($Years as $var){ //過去10年自動取得 ?>
                <th><?php echo $var; ?></th>
            <?php } //過去10年自動取得 ?>
            </tr>

            <?php /* --総合医療センター 紹介_件数-- */
            foreach($intr_data2 as $var): ?>            
            <tr >
                 <td><?php echo $var['fie_name']; ?></td>
                <td><?php echo $var['sALL']; ?></td>
                <?php foreach($Years as $y){ //過去10年自動取得 ?>
                <td><?php echo $var[$y]; ?></td>
                <?php } //過去10年自動取得 ?>
            </tr>
            <?php 
            endforeach; ?>

            <?php /* --総合医療センター 紹介_総計-- *//*
            foreach($intr_sum2 as $var): ?>
            <tr>
                <td>総計</td>
                <td><?php echo $var['sALL']; ?></td>
                <?php foreach($Years as $y){ //過去10年自動取得 ?>
                <td><?php echo $var[$y]; ?></td>
                <?php } //過去10年自動取得 ?>
            </tr>
            <?php 
            endforeach; */?>
        </table>
        </div>
        <?php else: ?>
        <div class="uk-alert-secondary" uk-alert>
            データなし
        </div>
        <?php endif; ?>
    </div>

    <div class="uk-margin" id="okayama_inversintro"><!-- 逆紹介 -->
    <h5>逆紹介件数</h5>
        <?php if(!empty($intr_data2)): ?>
        <div class="intro_tbl_wrap">
        <table class="uk-table uk-table-small table-green">
            <tr>
                <th>診療科</th>
                <th>合計</th>
            <?php foreach($Years as $var){ //過去10年自動取得 ?>
                <th><?php echo $var; ?></th>
            <?php } //過去10年自動取得 ?>
            </tr>

            <?php /* --総合医療センター 逆紹介_件数-- */
            foreach($invintr_data2 as $var): ?>            
            <tr>
                 <td><?php echo $var['fie_name']; ?></td>
                <td><?php echo $var['sALL']; ?></td>
                <?php foreach($Years as $y){ //過去10年自動取得 ?>
                <td><?php echo $var[$y]; ?></td>
                <?php } //過去10年自動取得 ?>
            </tr>
            <?php 
            endforeach; ?>


            <?php /* --総合医療センター 逆紹介_総計-- *//*
            foreach($invintr_sum2 as $var): ?>
            <tr>
                <td>総計</td>
                <td><?php echo $var['sALL']; ?></td>
                <?php foreach($Years as $y){ //過去10年自動取得 ?>
                <td><?php echo $var[$y]; ?></td>
                <?php } //過去10年自動取得 ?>
            </tr>
            <?php 
            endforeach; */?>
        </table>
        </div>
        <?php else: ?>
        <div class="uk-alert-secondary" uk-alert>
            データなし
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="detail-section" id="to-note5"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
        <textarea class="uk-textarea size-textarea-Notes" name="intr_note" rows="7" maxlength="1000" readonly><?php echo $intr_note; ?></textarea>
    </div>
</div>