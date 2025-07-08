        <div class="detail-section" id="to-Chi"><!-- 理事長 -->
        <h4>理事長</h4>
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

        <div class="detail-section" id="to-Pre"><!-- 病院長 -->
        <h4>病院長</h4>
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

<div class="detail-section" id="to-relative"><!-- 親族情報 -->
<h4>親族情報</h4>
    <div>
    <table class="uk-table table-bordered">
        <tr>
            <th> </th>
            <th>氏名</th>
            <th>続柄</th>
            <th>学校名</th>
            <th>入学年</th>
            <th>卒業年</th>
            <th>備考</th>
        </tr>

<?php 
    $i = 1; //連番
    /* 配列rel_update */
    foreach($rel_update as $key=>$var):
        if(!isset($var['name'])&&!isset($var['conn'])&&!isset($var['sch_name'])&&!isset($var['ent_year'])&&!isset($var['gra_year'])&&!isset($var['rel_note'])){ 
?>
        <tr>
            <th><?php echo $i; //連番 ?></th>
            <td class="uk-form-controls" colspan="6" style="text-align:center;">
                この行は削除されます
            </td>
        </tr>
<?php 
        }else{
?>
        <tr>
        <!--**主キー-->
        <input type="hidden" name="rel_cd[]" value="<?php echo $var['rel_cd']; //主キー?>">
            <!-- 連番 -->
            <th><?php echo $i; ?></th>
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
        }

    $i++;
    endforeach; 
?>
    

    <?php 
        /* 配列rel_insert */
        foreach($rel_insert as $key=>$var):
?>
        <tr>
            <!-- 連番 -->
            <th><?php echo $i; ?></th>
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

<!-- 櫻間 -->
<!-- 備考 -->
    <div class="detail-section" id="to-note1"><!-- 備考 -->
    <h4>備考
        <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
        <!--櫻間--><!-- 高橋20230106 maxlength属性追加 -->
        <textarea class="uk-textarea size-textarea-Notes" rows="7" name="note" maxlength="1000" readonly><?php  echo $drct_note; ?></textarea>
    </div>
<!-- 櫻間 -->
<!--高橋ここまで-->
