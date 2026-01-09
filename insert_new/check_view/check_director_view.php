<fieldset class="uk-fieldset">
    <legend class="uk-legend"><span uk-icon="triangle-right"></span> 理事長</legend>

    
    <div class="uk-margin">
        <label class="uk-form-label" for="form-h-text">氏名：</label>
        <span>
            <?php if(!empty($chi_name)){ echo $chi_name;} ?>
        </span>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-h-text">卒年：</label>
        <span>
            <?php if(!empty($chi_year)){ echo  $chi_year; }?>
        </span>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-h-text">出身校：</label>
        <span>
            <?php if(!empty($chi_sch)){ echo  $chi_sch; } ?>
        </span>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-h-text">備考：</label>
        <span>
            <?php if(!empty($chi_note)){ echo  $chi_note; } ?>
        </span>
    </div>

</fieldset>

<br>

<fieldset class="uk-fieldset">
    <legend class="uk-legend"><span uk-icon="triangle-right"></span> 病院長</legend>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-h-text">氏名：</label>
        <span>
            <?php if(!empty($pre_name)){ echo $pre_name;} ?>
        </span>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-h-datalist">専門科：</label>
        <span>
            <?php if(!empty($pre_spe)){ echo $pre_spe; }?>
        </span>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-h-text">卒年：</label>
        <span>
            <?php if(!empty($pre_year)){ echo $pre_year; } ?>
        </span>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-h-text">出身校：</label>
        <span>
            <?php if(!empty($pre_sch)){ echo $pre_sch; } ?>
        </span>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-h-text">備考：</label>
        <span>
            <?php if(!empty($pre_note)){ echo $pre_note; }?>
        </span>
    </div>


</fieldset>

<br>


<div>
<fieldset class="uk-fieldset">
    <legend class="uk-legend"><span uk-icon="triangle-right"></span> 親族情報</legend>

    <div>
    <table class="uk-table table-bordered">
        <tr>
            <th></th>
            <th>氏名</th>
            <th>続柄</th>
            <th>学校名</th>
            <th>入学年</th>
            <th>卒業年</th>
            <th>備考</th>
        </tr>

<?php 
    $i = 1; //連番（≠$key）の初期値
        foreach($rel_insert as $key=>$var):
?>

        <tr>
        <input type="hidden" name="rel_cd" value="<?php echo $key; //keyを送る（各行を区別する） ?>">
            <!-- 連番 -->
            <td><?php echo $i; ?></td>

            <!-- 氏名 -->
            <td class="uk-form-controls">
                <?php if(!empty($var['name'])){ echo $var['name']; }?>
            </td>

            <!-- 続柄[プルダウン] -->
            <td class="uk-form-controls">
                <?php if(!empty($var['conn'])){ echo $var['conn']; }?>
            </td>

            <!-- 学校名[プルダウン] -->
            <td class="uk-form-controls">
                <?php if(!empty($var['sch_name'])){ echo $var['sch_name']; }?>
            </td>

            <!-- 入学年 -->
            <td class="uk-form-controls">
                <?php if(!empty($var['ent_year'])){ echo $var['ent_year']; }?>
            </td>

            <!-- 卒業年 -->
            <td class="uk-form-controls">
                <?php if(!empty($var['gra_year'])){ echo $var['gra_year']; }?>
            </td>

            <!-- 備考 -->
            <td class="uk-form-controls">
                <?php if(!empty($var['rel_note'])){ echo $var['rel_note']; }?>
            </td>
        </tr>
<?php
        $i++;
        endforeach; 
?>
    
    </table>
    </div>

</fieldset>
</div>

<!--櫻間-->
<!-- 備考 -->
<div class="detail-section" id="to-note6"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
        <textarea class="uk-textarea size-textarea-Notes"  rows="7" maxlength="1000" readonly><?php echo $drct_note; ?></textarea>
    </div>
</div>
<!--櫻間-->
