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
        $j = 1; //連番
           
        /* 配列fie_update */
        foreach($fie_update as $key=>$var):

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

            if(!isset($var['fie_div'])&&!isset($var['fie_name'])&&!isset($var['fie_tel'])&&!isset($var['fie_fax'])&&!isset($var['fie_note'])){ 
        ?>

        <tr>
            <th><?php echo $j; //連番 ?></th>
            <td class="uk-form-controls" colspan="5" style="text-align:center;">
                この行は削除されます
            </td>
        </tr>

<?php 
        }else{
?>

            <input type="hidden" name="fie_cd" value="<?php echo $var['fie_cd']; //主キー?>">

            <tr>
                <td><?php echo $j; ?></td>

                <td>
                    <?php if(!empty($var['fie_div'])){ echo $var['fie_div']; }?>
                </td>
                    
                <td>
                    <?php if(!empty($var['fie_name'])){ echo $var['fie_name']; }
                    ?>
                </td>

                <td>
                    <?php if(!empty($var['fie_tel'])){ echo $var['fie_tel']; }
                    ?>
                </td>

                <td>
                    <?php if(!empty($var['fie_fax'])){ echo $var['fie_fax']; } ?>
                </td>

                <td>
                    <?php if(!empty($var['fie_note'])){ echo $var['fie_note']; }?>
                </td>

            </tr>
<?php 
            }
        $j++;
        endforeach;
?>

<?php 
            foreach($fie_insert as $key=>$var):
?>
            <tr>
                <td><?php echo $j; ?></td>
                <td>
                    <?php if(!empty($var['fie_div'])){ echo $var['fie_div']; }?>
                </td>
                    
                <td>
                    <?php if(!empty($var['fie_name'])){ echo $var['fie_name']; }
                    ?>
                </td>

                <td>
                    <?php if(!empty($var['fie_tel'])){ echo $var['fie_tel']; }
                    ?>
                </td>

                <td>
                    <?php if(!empty($var['fie_fax'])){ echo $var['fie_fax']; } ?>
                </td>

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
    <div class="detail-section" id="to-note1"><!-- 備考 -->
    <h4>備考
        <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
        <!--櫻間--><!-- 高橋20230106 maxlength属性追加 -->
        <textarea class="uk-textarea size-textarea-Notes" rows="7" name="note" maxlength="1000" readonly><?php  echo $num_note; ?></textarea>
    </div>


    </div>

<script type="text/javascript" src="filter.js"></script>