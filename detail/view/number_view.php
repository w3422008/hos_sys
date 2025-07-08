<?php
include("./control/number_control.php");   
?>

<!------------------------------

        **部門連絡先
    
-------------------------------->
<div class="detail-section" id="to-Fiejct">
<h4>部門連絡先</h4>
    <!-- *Filter -->
    <div class="uk-margin">
    <label class="uk-form-label"><i class="fas fa-filter fa-lg"></i>フィルタ機能：</label>
        <label><input class="uk-radio" type="radio" name="maker" value="zenken" onclick="formSwitch()" checked> 全件</label>
        <label><input class="uk-radio" type="radio" name="maker" value="gairai" onclick="formSwitch()"> 外来</label>
        <label><input class="uk-radio" type="radio" name="maker" value="renkei" onclick="formSwitch()"> 連携</label>
        <label><input class="uk-radio" type="radio" name="maker" value="sonota" onclick="formSwitch()"> その他</label>
    </div>

    <!-- *Table -->
    <div class="uk-margin">
        <input type="hidden" id="count_fieid" value="0">
        <table width="100%" cellpadding="3" cellspacing="1" name="count_fie" id="table_fie" class="uk-table table-bordered uk-width-auto@m tbl-form">
            <tbody>
                <tr>
                    <th></th>
                    <th>区分</th>
                    <th>部門名</th>
                    <th>電話番号</th>
                    <th>FAX番号</th>
                    <th>備考</th>
                    <th>削除</th>
                </tr>
            <?php 
                $j = 1; //連番 初期値
                foreach($num_data as $key=>$var): //全件データ取得

                    //フィルターid《fid》
                    if($var['fie_div']==='外来'){ 
                        $num_fid='gairai';
                    }elseif($var['fie_div']==='連携'){
                        $num_fid='renkei';
                    }elseif($var['fie_div']==='その他'){
                        $num_fid='sonota';
                    }else{
                        $num_fid='zenken'; //全件
                    }

                //谷川　各要素に行番号にあわせたclass追加　例）fie-row1
            ?>

            <!-- row_update 既存データ ここから -->
                <tr class="<?php echo $num_fid;?>">

                <!--**主キーを送る ※updateのみ -->
                <input type="hidden" name="fie_update[<?php echo $j; ?>][fie_cd]" value="<?php echo $var['fie_cd'];?>">

                    <td><span class="rowno"><?php echo $j; ?></span></td><!-- 連番 -->

                    <td><!-- 区分[プルダウン] -->
                        <select name="fie_update[<?php echo $j; ?>][fie_div]" class="fie-row<?php echo $j;?>">
                                <option value="" selected>---</option>
                        <?php   foreach($list_fie_div as $a): ?>
                                <option value="<?php echo $a; ?>" <?php if($a ===$var['fie_div']){ echo 'selected'; } ?>><?php echo $a; ?></option>
                        <?php   endforeach; ?>
                        </select>
                    </td>

                    <td><!-- 部門名 -->
                        <input type="text" name="fie_update[<?php echo $j; ?>][fie_name]" placeholder="例) 地域医療連携室" 
                        value="<?php if(isset($var['fie_name'])){ echo html_escape ($var['fie_name']); } ?>" class="fie-row<?php echo $j;?>">
                    </td>

                    <td><!-- 電話番号 -->
                        <input type="text" name="fie_update[<?php echo $j; ?>][fie_tel]" placeholder="例) 123-4567" 
                        value="<?php if(isset($var['tel'])){ echo html_escape ($var['tel']); } ?>" class="fie-row<?php echo $j;?>" maxlength="20">
                    </td>

                    <td><!-- FAX番号 -->
                        <input type="text" name="fie_update[<?php echo $j; ?>][fie_fax]" placeholder="例) 123-4567" 
                        value="<?php if(isset($var['fax'])){ echo html_escape ($var['fax']); } ?>" class="fie-row<?php echo $j;?>" maxlength="20">
                    </td>

                    <td><!-- 備考 -->
                        <input type="text" name="fie_update[<?php echo $j; ?>][fie_note]" 
                        value="<?php if(isset($var['note'])){ echo html_escape ($var['note']); } ?>" class="fie-row<?php echo $j;?>">
                    </td>

                    <!-- 行削除ボタン
                            谷川　button要素に変更
                    -->
                    <td>
                        <button type="button" onclick="deleteTable_fie2 (getSort_fie(this.parentNode.parentNode));" class="fie-row<?php echo $j;?>">
                        削除
                        </button>
                    </td>
                    
                </tr>
            <!-- row_update 既存データ ここまで -->
        <?php 
                $j++;
                endforeach; 
        ?>
            </tbody>
        </table>

        <!-- 行追加ボタン
                1205　button要素に変更
        -->
        <button type="button" onclick="insertTable_fie ()" class="rowInsert-btn">行を追加</button>
        
    </div>
</div>


<div class="detail-section" id="to-note4"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
    <?php foreach($data as $var): ?>
        <textarea class="uk-textarea size-textarea-Notes" name="num_note" rows="7" maxlength="1000"><?php echo html_escape(trim($var['num_note'])) ?></textarea>
    <?php endforeach; ?>
    </div>
</div>

<!-- 
<script>
    let j = <?php //echo $j; ?>; //PHPからデータを受け取る。
</script>
 -->