<?php
include("./control/number_control.php");   

?>

<!------------------------------

        **部門連絡先
    
-------------------------------->

<div class="detail-section" id="to-Fiejct">
<h4>部門連絡先</h4>

    <!-- *Filter 
       高橋20221201　新規追加画面にはフィルタ不要のため削除
    -->

    <!-- *Table -->
    <div class="uk-margin">
        <input type="hidden" id="count_fieid" value="0">
        <table width="100%" cellpadding="3" cellspacing="1" name="count_fie" id="table_fie" class="uk-table table-bordered tbl-form">
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

                //谷川　各要素に行番号にあわせたclass追加　例）fie-row1
            ?>

            <!-- fie_insert // SESSIONあり　ここから -->
            <?php 
                if(isset($fie_insert)):
                    foreach($fie_insert as $key=> $var){
                ?>
                    <tr>
                        <td><span class="rowno"><?php echo $j; ?></span></td><!-- 連番 -->
                        
                        <td><!-- 区分[プルダウン] -->
                            <select name="fie_insert[<?php echo $j; ?>][fie_div]" class="fie-row<?php echo $j;?>">
                                    <option value="" selected>---</option>
                            <?php   foreach($list_fie_div as $a): ?>
                                    <option value="<?php echo $a; ?>" <?php if($var['fie_div']===$a){ echo 'selected'; }?>><?php echo $a; ?></option>
                            <?php   endforeach; ?>
                            </select>
                        </td>

                        <td><!-- 部門名 -->
                            <input type="text" name="fie_insert[<?php echo $j; ?>][fie_name]" placeholder="例) 地域医療連携室" class="fie-row<?php echo $j;?>" value="<?php echo $var['fie_name']; ?>">
                        </td>

                        <td><!-- 電話番号 -->
                            <input type="text" name="fie_insert[<?php echo $j; ?>][fie_tel]" placeholder="例) 123-4567" class="fie-row<?php echo $j;?>" value="<?php echo $var['fie_tel']; ?>" maxlength="20">
                        </td>

                        <td><!-- FAX番号 -->
                            <input type="text" name="fie_insert[<?php echo $j; ?>][fie_fax]" placeholder="例) 123-4567" class="fie-row<?php echo $j;?>" value="<?php echo $var['fie_fax']; ?>" maxlength="20">
                        </td>

                        <td><!-- 備考 -->
                            <input type="text" name="fie_insert[<?php echo $j;?>][fie_note]" class="fie-row<?php echo $j;?>" value="<?php echo $var['fie_note']; ?>">
                        </td>
                        
                        <!-- 行削除ボタン
                                谷川　button要素に変更
                        -->
                        <td>
                            <button type="button" onclick="deleteTable_fie2 (getSort_fie(this.parentNode.parentNode));" class="fie-row<?php echo $j;?>">削除</button>
                        </td>
                    </tr>
            <!-- fie_insert // SESSIONあり　ここまで -->

                <?php
                        $j++;
                    }
                else: ?>

            <!-- fie_insert 先頭1行目 ここから -->
                    <tr>
                        <td><span class="rowno"><?php echo $j; ?></span></td><!-- 連番 -->

                        <td><!-- 区分[プルダウン] -->
                            <select name="fie_insert[<?php echo $j; ?>][fie_div]" class="fie-row<?php echo $j;?>">
                                    <option value="" selected>---</option>
                            <?php   foreach($list_fie_div as $a): ?>
                                    <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                            <?php   endforeach; ?>
                            </select>
                        </td>
        
                        <td><!-- 部門名 -->
                            <input type="text" name="fie_insert[<?php echo $j; ?>][fie_name]" placeholder="例) 地域医療連携室" class="fie-row<?php echo $j;?>">
                        </td>

                        <td><!-- 電話番号 -->
                            <input type="text" name="fie_insert[<?php echo $j; ?>][fie_tel]" placeholder="例) 123-4567" class="fie-row<?php echo $j;?>" maxlength="20">
                        </td>

                        <td><!-- FAX番号 -->
                            <input type="text" name="fie_insert[<?php echo $j; ?>][fie_fax]" placeholder="例) 123-4567" class="fie-row<?php echo $j;?>" maxlength="20">
                        </td>

                        <td><!-- 備考 -->
                            <input type="text" name="fie_insert[<?php echo $j;?>][fie_note]" class="fie-row<?php echo $j;?>">
                        </td>

                        <!-- 行削除ボタン
                                谷川　button要素に変更
                        -->
                        <td>
                            <button type="button" onclick="deleteTable_fie2 (getSort_fie(this.parentNode.parentNode));" class="fie-row<?php echo $j;?>">削除</button>
                        </td>
                    </tr>
            <!-- fie_insert 先頭1行目 ここまで -->
                <?php
                endif;
                ?>

            </tbody>
        </table>
        <!-- 行追加ボタン
                高橋20221205　button要素に変更
        -->
        <button type="button" onclick="insertTable_fie ()" class="rowInsert-btn">行を追加</button>
    </div>

</div>

<div class="detail-section" id="to-note4"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <!--櫻間20221130-->
    <div class="uk-form-controls">
        <textarea class="uk-textarea size-textarea-Notes" name="num_note" rows="7" maxlength="1000"><?php if(isset($num_note)){echo $num_note; }?></textarea> 
    </div>
    <!--櫻間20221130-->
</div>