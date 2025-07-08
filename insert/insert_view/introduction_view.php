<?php include("./control/introduction_control.php"); ?> 
<?php $Years=get_10Years(); //＊過去10年配列$Years ?>

<div class="detail-section" id="to-kurashiki"><!--【附属病院】-->
<h4>附属病院</h4>
    <div class="uk-alert-secondary" uk-alert>
        ※ 読み取り専用データのため、編集できません ※
    </div>
</div>


<div class="detail-section" id="to-okayama"><!--【総合医療センター】-->
<h4>総合医療センター</h4>
    <div class="uk-alert-secondary" uk-alert>
        ※ 読み取り専用データのため、編集できません ※
    </div>
</div>

<div class="detail-section" id="to-note5"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
        <textarea class="uk-textarea size-textarea-Notes" name="intr_note" rows="7" maxlength="1000"><?php if(isset($intr_note)){echo $intr_note; }?></textarea>
    </div>
</div>