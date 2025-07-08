    <div class="uk-margin">
        <table class="uk-table table-bordered">
            <tr>
                <th></th>
                <th>区分</th>
                <th>部門名</th>
                <th>電話番号</th>
                <th>FAX番号</th>
                <th>備考</th>
            </tr>

<?php 
    $j = 1; //連番（≠$key）の初期値
        foreach($fie_insert as $key=>$var):
?>
            <tr>
            <input type="hidden" name="fie_cd" value="<?php echo $key; //keyを送る（各行を区別する） ?>">
                <!-- 連番 -->
                <td><?php echo $j; ?></td>

                <!-- 区分 -->
                <td>
                    <?php if(!empty($var['fie_div'])){ echo $var['fie_div']; }?>
                </td>
                    
                <!-- 部門名 -->
                <td>
                    <?php if(!empty($var['fie_name'])){ echo $var['fie_name']; }
                    ?>
                </td>

                <!-- 電話番号 -->
                <td>
                    <?php if(!empty($var['fie_tel'])){ echo $var['fie_tel']; }
                    ?>
                </td>

                <!-- FAX番号 -->
                <td>
                    <?php if(!empty($var['fie_fax'])){ echo $var['fie_fax']; } ?>
                </td>

                <!-- 備考 -->
                <td>
                    <?php if(!empty($var['fie_note'])){ echo $var['fie_note']; }?>
                </td>
            </tr>
<?php 
        $j++;
        endforeach;
?>
        </table>

     <!--櫻間-->
<div class="detail-section" id="to-note6"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
        <textarea class="uk-textarea size-textarea-Notes"  rows="7" maxlength="1000" readonly><?php echo $num_note; ?></textarea>
    </div>
</div>


    </div>

