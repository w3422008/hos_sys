<?php
include("./control/director_control.php");   
?>


<!------------------------------

        **理事長・病院長情報
    
-------------------------------->

    <div class="detail-section" id="to-Chi"><!-- 理事長 -->
    <h4>理事長</h4>
        <table class="uk-table">
            <!-- **理事長 氏名//chi_name【データあり】 -->
                <tr>
                    <th>氏名</th>
                    <td>
                        <input class="uk-input size-input-dirName"type="text" name="chi_name" placeholder="例) 川崎 太郎" value="<?php if(isset($chi_name)){echo $chi_name; } ?>">
                    </td>
                </tr>
            <!-- **理事長 専門科//chi_spe【データあり】 -->
                <tr>
                    <th>専門科</th>
                    <td>
                        <input class="uk-input size-input-dirDept" list="datalist_dept" type="text" name="chi_spe" placeholder="例) 内科" value="<?php if(isset($chi_spe)){echo $chi_spe; } ?>">
                        <!--高橋診療科データリスト-->
                        <!--櫻間-->
                        <datalist id="datalist_dept">
                        <?php foreach($datalist_dept as $var1){ ?>
                            <option value="<?php echo $var1['dep_name'];?>" name="chi_spe">
                        <?php   } ?>
                        </datalist>
                    </td>
                </tr>
            <!-- **理事長 卒年//chi_year【データあり】 -->
                <tr>
                    <th>卒年</th>
                    <td>
                        <input class="uk-input size-input-dirYear pattern"type="text"  data-pattern="year" name="chi_year" placeholder="例) 2023" value="<?php if(isset($chi_year)){echo $chi_year; } ?>">
                    </td>
                </tr>

            <!-- **理事長 出身校//chi_sch【データあり】 -->
                <tr>
                    <th>出身校</th>
                    <td>
                        <input class="uk-input size-input-dirSchool"type="text" name="chi_sch" placeholder="例)川崎医療福祉大学" value="<?php if(isset($chi_sch)){echo $chi_sch; } ?>">
                    </td>
                </tr>

            <!-- **理事長 備考//chi_note【データあり】 -->
                <tr>
                    <th>備考</th>
                    <td>
                        <input class="uk-input size-input-dirNote"type="text" name="chi_note" value="<?php if(isset($chi_note)){echo $chi_note; } ?>">
                    </td>
                </tr>
        </table>
    </div>

    <div class="detail-section" id="to-Pre"><!-- 病院長 -->
    <h4>病院長</h4>
        <table class="uk-table">
            <!-- **病院長 氏名//pre_name【データあり】 -->
                <tr>
                    <th>氏名</th>
                    <td>
                        <input class="uk-input size-input-dirName"type="text" name="pre_name" placeholder="例) 川崎 太郎" value="<?php if(isset($pre_name)){echo $pre_name; } ?>">
                    </td>
                </tr>

            <!-- **病院長 専門科//pre_spe【データあり】 -->
                <tr>
                    <th>専門科</th>
                    <td>
                        <input class="uk-input size-input-dirDept" list="datalist_dept2" type="text" name="pre_spe" placeholder="例) 内科" value="<?php if(isset($pre_spe)){echo $pre_spe; } ?>">
                        <!--高橋診療科データリスト-->
                        <!--櫻間-->
                        <datalist id="datalist_dept2">
                        <?php foreach($datalist_dept as $var2){ ?>
                            <option value="<?php echo $var2['dep_name'];?>" name="pre_spe">
                        <?php   } //高橋 ↑ 診療科データリスト ?>
                        </datalist>
                    </td>
                </tr>

            <!-- **病院長 卒年//pre_year【データあり】 -->
                <tr>
                    <th>卒年</th>
                    <td>
                    <!--櫻間-->
                        <input class="uk-input size-input-dirYear pattern" type="text" data-pattern="year" name="pre_year" placeholder="例) 2023" value="<?php if(isset($pre_year)){echo $pre_year; } ?>">
                    </td>
                </tr>

            <!-- **病院長 出身校//pre_sch【データあり】 -->
                <tr>
                    <th>出身校</th>
                    <td>
                        <input class="uk-input size-input-dirSchool" type="text" name="pre_sch" placeholder="例)川崎医科大学" value="<?php if(isset($pre_sch)){echo $pre_sch; } ?>">
                    </td>
                </tr>

            <!-- **病院長 備考//pre_note【データあり】 -->
                <tr>
                    <th>備考</th>
                    <td>
                        <input class="uk-input size-input-dirNote"type="text" name="pre_note" value="<?php if(isset($pre_note)){echo $pre_note; } ?>">
                    </td>
                </tr>
        </table>
    </div>

<!----------------------------

        **親族情報
    
------------------------------>
<div class="detail-section" id="to-relative"><!-- 親族情報 -->
<h4>親族情報</h4>
    <input type="hidden" name="count_rel" id="count_relid" value="0">
    <table width="100%" cellpadding="3" cellspacing="1" name="count_rel" id="table_rel" class="uk-table table-bordered tbl-form">
        <tbody>
            <tr>
                <th></th>
                <th>氏名</th>
                <th>続柄</th>
                <th>学校名</th>
                <th>入学年</th>
                <th>卒業年</th>
                <th>備考</th>
                <th>削除</th>
            </tr>
        <?php 
            $i = 1; //連番 初期値
            //谷川　各要素に行番号にあわせたclass追加　例）rel-row1
        ?>


        <!-- row_insert // SESSIONあり　ここから -->
            <?php 
            if(isset($rel_insert)):
                foreach($rel_insert as $key=> $var){
            ?>
                <tr>
                    <td><span class="rowno"><?php echo $i; ?></span></td><!-- 連番 -->
                    
                    <td><!-- 氏名 -->
                        <input type="text" name="rel_insert[<?php echo $i; ?>][name]" placeholder="例) 川崎 太郎" class="rel-row<?php echo $i;?>" value="<?php echo $var['name']; ?>">
                    </td>
                    
                    <td><!-- 続柄[プルダウン] -->
                        <select name="rel_insert[<?php echo $i; ?>][conn]" class="rel-row<?php echo $i;?>">
                                <option value="" selected>---</option>
                        <?php   foreach($list_conn as $b){ ?>
                                <option value="<?php echo $b; ?>" <?php if($var['conn']===$b){ echo 'selected'; }?>>
                                    <?php echo $b; ?>
                                </option>
                        <?php   } ?>
                        </select>
                    </td>
                    
                    <td><!-- 学校名[プルダウン] -->
                        <select name="rel_insert[<?php echo $i; ?>][sch_name]" class="rel-row<?php echo $i;?>">
                                <option value="" selected>---</option>
                        <?php   foreach($list_sch_name as $b){ ?>
                                <option value="<?php echo $b; ?>" <?php if($var['sch_name']===$b){ echo 'selected'; }?>>
                                    <?php echo $b; ?>
                                </option>
                        <?php } ?>
                        </select>
                    </td>
                    
                    <td><!-- 入学年 -->
                        <input type="text" name="rel_insert[<?php echo $i; ?>][ent_year]" placeholder="例) 20XX" size="5" class="rel-row<?php echo $i;?>" value="<?php echo $var['ent_year']; ?>" maxlength="4">
                    </td>
                    
                    <td><!-- 卒業年 -->
                        <input type="text" name="rel_insert[<?php echo $i; ?>][gra_year]" placeholder="例) 20XX" size="5" class="rel-row<?php echo $i;?>" value="<?php echo $var['gra_year']; ?>" maxlength="4">
                    </td>
                    
                    <td><!-- 備考 -->
                        <input type="text" name="rel_insert[<?php echo $i; ?>][rel_note]" class="rel-row<?php echo $i;?>" value="<?php echo $var['rel_note']; ?>">
                    </td>
                    <!-- 行削除ボタン
                            谷川　button要素に変更
                    -->
                    <td>
                        <button type="button" onclick="deleteTable_rel2 (getSort_rel(this.parentNode.parentNode));" class="rel-row<?php echo $i;?>">削除</button>
                    </td>
                </tr>
        <!-- row_insert // SESSIONあり　ここまで -->

            <?php
                    $i++;
                }
            else: ?>

        <!-- row_insert 先頭1行目 ここから -->
                <tr>
                    <td><span class="rowno"><?php echo $i; ?></span></td><!-- 連番 -->
                    
                    <td><!-- 氏名 -->
                        <input type="text" name="rel_insert[<?php echo $i; ?>][name]" placeholder="例) 川崎 太郎" class="rel-row<?php echo $i;?>">
                    </td>
                    
                    <td><!-- 続柄[プルダウン] -->
                        <select name="rel_insert[<?php echo $i; ?>][conn]" class="rel-row<?php echo $i;?>">
                                <option value="" selected>---</option>
                        <?php   foreach($list_conn as $b){ ?>
                                <option value="<?php echo $b; ?>"><?php echo $b; ?></option>
                        <?php   } ?>
                        </select>
                    </td>
                    
                    <td><!-- 学校名[プルダウン] -->
                        <select name="rel_insert[<?php echo $i; ?>][sch_name]" class="rel-row<?php echo $i;?>">
                                <option value="" selected>---</option>
                        <?php   foreach($list_sch_name as $b){ ?>
                                <option value="<?php echo $b; ?>"><?php echo $b; ?></option>
                        <?php } ?>
                        </select>
                    </td>
                    
                    <td><!-- 入学年 -->
                        <input type="text" name="rel_insert[<?php echo $i; ?>][ent_year]" placeholder="例) 20XX" size="5" class="rel-row<?php echo $i;?>" maxlength="4">
                    </td>
                    
                    <td><!-- 卒業年 -->
                        <input type="text" name="rel_insert[<?php echo $i; ?>][gra_year]" placeholder="例) 20XX" size="5" class="rel-row<?php echo $i;?>" maxlength="4">
                    </td>
                    
                    <td><!-- 備考 -->
                        <input type="text" name="rel_insert[<?php echo $i; ?>][rel_note]" class="rel-row<?php echo $i;?>">
                    </td>
                    <!-- 行削除ボタン
                            谷川　button要素に変更
                    -->
                    <td>
                        <button type="button" onclick="deleteTable_rel2 (getSort_rel(this.parentNode.parentNode));" class="rel-row<?php echo $i;?>">削除</button>
                    </td>
                </tr>
        <!-- row_insert 先頭1行目 ここまで -->
            <?php
            endif;
            ?>

        </tbody>
    </table>

    <!-- 行追加ボタン
            高橋20221205　button要素に変更
    -->
    <button type="button" onclick="insertTable_rel()" class="rowInsert-btn">行を追加</button>
</div>

<div class="detail-section" id="to-note3"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <!--櫻間20221130-->
    <div class="uk-form-controls">
        <textarea class="uk-textarea size-textarea-Notes" name="drct_note" rows="7" maxlength="1000"><?php if(isset($drct_note)){echo $drct_note; }?></textarea>
    </div>
    <!--櫻間20221130-->
</div>