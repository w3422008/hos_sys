<?php include("./control/Medical_control.php"); ?> 
<style>
        .meddiv {
        padding: 1rem 2rem;
        border: 1px solid #000;
        }
        .table-h-green tr{
        padding:10rem;
        margin:3rem;
        }
</style>

<div class="detail-section" id="to-Medcare"><!-- 受入可能な診療内容 -->
<h4>受入可能な診療内容</h4>
        <div class="uk-margin"><!--全般-->
        <h5 class="meddiv">全般</h5>
        <?php foreach($med_depts['全般'] as $Div=>$Dep){ ?>
        <table class="uk-table table-h-green" style="display:inline;">
        <tr><th>【<b><?php echo $Dep; ?></b>】</th></tr>
                <?php 
                foreach($medCare_all as $Det){ 
                        if($Dep===$Det['med_dep']){ ?>
                <tr><td><label><input type="checkbox" class="uk-checkbox" name="med_care[<?php echo $Det['med_code']; ?>]" value="1" <?php if(isset($med_care[$Det['med_code']]) && $med_care[$Det['med_code']]==='1'){ echo 'checked'; } ?>><?php echo ($Det['med_det']);?></label><br></td></tr>
                <?php   } 
                }?>
        </table>
        <?php } ?>
        </div>

        <div class="uk-margin"><!--内科系-->
        <h5 class="meddiv">内科系</h5>
        <?php foreach($med_depts['内科系'] as $Div=>$Dep){ ?>
        <table class="uk-table table-h-green" style="display:inline;">
        <tr><th>【<b><?php echo $Dep; ?></b>】</th></tr>
                <?php 
                foreach($medCare_naika as $Det){
                        if($Dep===$Det['med_dep']){ ?>
                <tr><td><label><input type="checkbox" class="uk-checkbox" name="med_care[<?php echo $Det['med_code']; ?>]" value="1" <?php if(isset($med_care[$Det['med_code']]) && $med_care[$Det['med_code']]==='1'){ echo 'checked'; } ?>><?php echo ($Det['med_det']);?></label><br></td></tr>
                <?php   } 
                }?>
        </table>
        <?php } ?>
        </div>

        <div class="uk-margin"><!--外科系-->
        <h5 class="meddiv">外科系</h5>
        <?php foreach($med_depts['外科系'] as $Div=>$Dep){ ?>
        <table class="uk-table table-h-green" style="display:inline;">
        <tr><th>【<b><?php echo $Dep; ?></b>】</th></tr>
                <?php 
                foreach($medCare_geka as $Det){ 
                        if($Dep===$Det['med_dep']){ ?>
                <tr><td><label><input type="checkbox" class="uk-checkbox" name="med_care[<?php echo $Det['med_code']; ?>]" value="1" <?php if(isset($med_care[$Det['med_code']]) && $med_care[$Det['med_code']]==='1'){ echo 'checked'; } ?>><?php echo ($Det['med_det']);?></label><br></td></tr>
                <?php   } 
                }?>
        </table>
        <?php } ?>
        </div>
</div>

<div class="detail-section" id="to-note9"><!-- 備考 -->
<h4>備考
<label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
        <div class="uk-form-controls">
                <textarea class="uk-textarea size-textarea-Notes" name="mcare_note" rows="7" maxlength="1000"><?php if(isset($mcare_note)){echo $mcare_note; }?></textarea>
        </div>
</div>