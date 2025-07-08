<?php include("./control/relation_control.php"); ?> 

<div class="detail-section" id="to-carna"><!-- カルナコネクト -->
<h4>カルナコネクト</h4>
    <div class="uk-margin">
    <?php 
    if(!empty($carna_data)){
    foreach($carna_data as $cd ){
        ?>
        <label><input class="uk-checkbox" type="checkbox" name="carna" value="1" <?php if($cd === $hos_cd){ echo 'checked'; } ?>> 登録済み</label>
        <?php 
    }
    }else{
    ?>
        <label><input class="uk-checkbox" type="checkbox" name="carna" value="1"> 登録済み</label>
    <?php
    }
    ?>
    
    <p>※当該医療機関から附属病院・総合医療センターの予約を取るための登録</p>
    </div>
</div>

<div class="detail-section" id="to-path"><!-- 連携パス -->
<h4>連携パス</h4>
    <div class="uk-margin uk-child-width-1-3@l uk-child-width-1-2@s" uk-grid>
        <div>
            <h5>附属病院</h5>
            <?php foreach($CorpPath as $cd => $path ){ ?>
            <label><input class="uk-checkbox" type="checkbox" name="c_path1[<?php echo $cd; ?>]" value="1" <?php if(!empty($cPath_data1) && $cPath_data1['cp'.$cd] === '1'){ echo 'checked'; } ?>> <?php echo $path; ?></label><br>
        <?php 
        } ?>
        </div>
        <div>
        <h5>総合医療センター</h5>
        <?php foreach($CorpPath as $cd => $path ): ?>
        <label><input class="uk-checkbox" type="checkbox" name="c_path2[<?php echo $cd; ?>]" value="1" <?php if(!empty($cPath_data2) && $cPath_data2['cp'.$cd] === '1'){ echo 'checked'; } ?>> <?php echo $path; ?></label><br>
        <?php endforeach; ?>
        </div>
    </div>
</div>

<?php /* 高橋20231121 懇話会追加 */ ?>
<div class="detail-section" id="to-note7"><!-- 医療連携懇話会 -->
<h4>医療連携懇話会　参加年度</h4>
    <div class="uk-width-4-5@xl uk-width-1-1@m uk-child-width-1-3@m" uk-grid>
        <div class="uk-form-controls">
            <label>【 附属病院 】</label>
            <div class="uk-margin-small-left" style="width:50%">
            <textarea id="txt_sm1" class="uk-textarea size-textarea-socialmeeting" name="kurashiki_sm" rows="7" oninput="arr_strCheck(0)"><?php foreach($socialMeeting_data1 as $sm_data){ echo $sm_data['year'].'&#13;'; } ?></textarea>
            </div>
            <div style="display:none; font-size: 0.8em; color:red;" id="err_sm1"></div>
            <select id="years_kurashiki" onchange="plus(0);">
                <option value="" selected>追加</option>
                <?php for($y = date("Y"); $y >= 2000; $y--){ ?>
                <option value="<?php echo $y?>"><?php echo $y; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="uk-form-controls">
            <label>【 総合医療センター 】</label><br>
            <div class="uk-margin-small-left" style="width:50%">
            <textarea id="txt_sm2" class="uk-textarea size-textarea-socialmeeting" name="okayama1_sm" rows="7"  oninput="arr_strCheck(1)"><?php foreach($socialMeeting_data2 as $sm_data){ echo $sm_data['year'].'&#13;'; } ?></textarea>
            </div>
            <div style="display:none; font-size: 0.8em; color:red;" id="err_sm2"></div>
            <select id="years_okayama1" onchange="plus(1);">
                <option value="" selected>追加</option>
                <?php for($y = date("Y"); $y >= 2000; $y--){ ?>
                <option value="<?php echo $y?>"><?php echo $y; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="uk-form-controls">
            <label>【 高齢者医療センター 】</label><br>
            <div class="uk-margin-small-left" style="width:50%">
            <textarea id="txt_sm3" class="uk-textarea size-textarea-socialmeeting" name="okayama2_sm" rows="7"  oninput="arr_strCheck(2)"><?php foreach($socialMeeting_data3 as $sm_data){ echo $sm_data['year'].'&#13;'; } ?></textarea>
            </div>
            <div style="display:none; font-size: 0.8em; color:red;" id="err_sm3"></div>
            <select id="years_okayama2" onchange="plus(2);">
                <option value="" selected>追加</option>
                <?php for($y = date("Y"); $y >= 2000; $y--){ ?>
                <option value="<?php echo $y?>"><?php echo $y; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<?php /* 高橋20231121 懇話会追加 */ ?>


<div class="detail-section" id="to-note7"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
    <?php foreach ($data as $key =>$var): ?>
        <textarea class="uk-textarea size-textarea-Notes" name="coop_note" rows="7" maxlength="1000"><?php echo html_escape(trim($var['coop_note'])) ?></textarea>
    <?php endforeach; ?>
    </div>
</div>

