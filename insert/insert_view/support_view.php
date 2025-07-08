<?php include("./control/support_control.php"); ?> 

<div class="detail-section" id="to-SprtTrng"><!-- 院外支援・研修 -->
<h4>院外支援・研修</h4>
    <div class="uk-alert-secondary" uk-alert>
        ※ 読み取り専用データのため、編集できません ※
    </div>
</div>    

<div class="detail-section" id="to-note6"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
        <textarea class="uk-textarea size-textarea-Notes" name="tra_note" rows="7" maxlength="1000"><?php if(isset($tra_note)){echo $tra_note; }?></textarea>
    </div>
</div>