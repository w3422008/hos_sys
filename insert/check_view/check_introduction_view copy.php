<?php $Years=get_10Years(); //＊過去10年配列$Years ?>

<div class="detail-section" id="to-kurashiki"><!--【附属病院】-->
<h4>附属病院</h4>
    <div class="uk-margin" id="kurashiki_intro"><!-- 紹介 -->
    <h5>紹介件数</h5>
        <div class="intro_tbl_wrap">
        <table class="uk-table uk-table-small table-green">
            <tr>
                <th>診療科</th>
                <th>合計</th>
                <?php foreach($Years as $Y){ ?><th><?php echo $Y; ?></th><?php } //過去10年自動取得 ?>
            </tr>
            <tr>
                <td style="text-align:center; height:200px; font-size:20px;" colspan="12">データなし</td>
            </tr>
        </table>
        </div>
    </div>

    <div class="uk-margin" id="kurashiki_inversintro">
    <h5>逆紹介件数</h5>
        <div class="intro_tbl_wrap">
        <table class="uk-table uk-table-small table-green">
            <tr>
                <th>診療科</th>
                <th>合計</th>
                <?php foreach($Years as $var){ ?><th><?php echo $var; ?></th><?php } //過去10年自動取得 ?>
            </tr>
            <tr>
                <td style="text-align:center; height:200px; font-size:20px;" colspan="12">データなし</td>
            </tr>
        </table>
        </div>
    </div>
</div>


<div class="detail-section" id="to-okayama"><!--【総合医療センター】-->
<h4>総合医療センター</h4>
    <div class="uk-margin" id="okayama_intro"><!-- 紹介 -->
    <h5>紹介件数</h5>
        <div class="intro_tbl_wrap">
        <table class="uk-table uk-table-small table-green">
            <tr>
                <th>診療科</th>
                <th>合計</th>
                <?php foreach($Years as $var){ ?><th><?php echo $var; ?></th><?php } //過去10年自動取得 ?>
            </tr>
            <tr>
                <td style="text-align:center; height:200px; font-size:20px;" colspan="12">データなし</td>
            </tr>
        </table>
        </div>
    </div>

    <div class="uk-margin" id="okayama_inversintro"><!-- 逆紹介 -->
    <h5>逆紹介件数</h5>
        <div class="intro_tbl_wrap">
        <table class="uk-table uk-table-small table-green">
            <tr>
                <th>診療科</th>
                <th>合計</th>
                <?php foreach($Years as $var){ ?><th><?php echo $var; ?></th><?php } //過去10年自動取得 ?>
            </tr>
            <tr>
                <td style="text-align:center; height:200px; font-size:20px;" colspan="12">データなし</td>
            </tr>
        </table>
        </div>
    </div>
</div>

<div class="detail-section" id="to-note5"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
        <textarea class="uk-textarea size-textarea-Notes" name="intr_note" rows="7" maxlength="1000" readonly><?php echo $intr_note; ?></textarea>
    </div>
</div>