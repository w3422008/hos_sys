
<?php
require_once('../update/update_control/kakunin_basic_contrl.php');
?>





    <div class="detail-section" id="to-hospitalName"><!-- 医療機関名 -->
    <h4>医療機関名
        <label class="uk-label uk-label-required">必須</label></h4>
        <span><?php echo $hos_name;?></span>
        <!-- <input class="uk-input size-input-hosName" type="text" name="hos_name"　placeholder="例) ◯◯医院" value="<?php //echo ($var['hos_name']);?>"> -->
        <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom" tabindex="-1"></i><!--高橋20230331追加　tabindex-->
    </div>

    <div class="detail-section" id="to-kubun"><!-- 区分 -->
    <h4>区分
        <label class="uk-label uk-label-required">必須</label></h4>
        <div uk-grid>
            <div>
            <h5>病院区分
                <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></h5>
                <div class="uk-form-controls">
                <span><?php echo $hos_div;?></span>
                </div>
            </div>

            <div><!--櫻間-->
            <h5>開院区分
                <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です ※閉院日は任意; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></h5>
                <div class="uk-form-control">
                    <span>
                        <?php
                        if($op_flg ==='1'){
                                echo '開院';
                        }else{
                            echo '閉院';
                        }
                        ?>
                    </span>
                    <?php 
                    //閉院なら閉院日表示
                    if($op_flg ==='0'){
                    ?>
                    （ 閉院日：
                    <span><?php if($clo_day !== '') { echo $clo_day; }else{ echo '<span class="uk-text-muted">' . 'データなし' . '</span>'; } ?> </span>）
                    <?php
                    }
                    ?> 
                </div>
                <!--櫻間java-->
                <script type="text/javascript">
                    function entryChange1(){
                    radio = document.getElementsByName('op_flg') 
                    if(radio[0].checked) {
                    //フォーム
                    document.getElementById('firstBox').style.display = "";
                    document.getElementById('secondBox').style.display = "none";

                    }else if(radio[1].checked) {
                    //フォーム
                    document.getElementById('firstBox').style.display = "none";
                    document.getElementById('secondBox').style.display = "";
                    }
                    }
                    //オンロードさせ、リロード時に選択を保持
                    window.onload = entryChange1;
                </script>
            </div>
        </div>
    </div>
    
    <div class="detail-section" id="to-Medass"><!-- 医師会 -->
    <h4>医師会</h4>
        <span><?php echo $med_ass;?></span>
    </div>

    <div class="detail-section" id="to-area"><!-- 所在地 -->
    <h4>所在地
    <label class="uk-label uk-label-required">必須</label>
    </h4>
        <table class="uk-table uk-table-responsive">
            <tr>
                <td colspan="2">
                    <label for="">郵便番号
                    <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->
                    </label>
                    <i class="fas fa-tenge"></i> 
                    <span><?php echo $zipcode;?></span>
                </td>
            </tr>
            <tr>
                <th>都道府県
                <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->
                </th>
                <td>
                <span><?php echo $pre;?></span> 
                </td>
            </tr>
            <tr>
                <th>地域</th>
                <td>
                <span><?php echo $area;?></span> 
                </td>
            </tr>
            <tr>
                <th>地区コード
                <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->
                </th>
                <td>
                <span><?php echo $are_cd;?></span>
                </td>
            </tr>
            <tr>
                <th>市</th>
                <td>
                <span><?php echo $city;?></span>
                </td>
            </tr>
            <tr>
                <th>区</th>
                <td>
                <span><?php echo $zone;?></span>
                </td>
            </tr>
            <tr>
                <th>町</th>
                <td>
                <span><?php echo $town;?></span>
                </td>
            </tr>
            <tr>
                <th>番地・建物名</th>
                <td>
                <span><?php echo $str_num;?></span>
                </td>
            </tr>
        </table>
    </div>

    <div class="detail-section" id="to-address"><!-- 連絡先 -->
    <h4>連絡先</h4>
        <table class="uk-table uk-table-responsive">
            <tr>
                <th>電話番号
                </th>
                <!--櫻間-->
                <td>
                    <i class="fas fa-phone"></i> 
                    <span><?php echo $tel;?></span>
                </td>
            </tr>
            <tr>
                <th>FAX
                    <!--半角数字、ハイフンあり-->
                </th>
                <!--櫻間-->
                <td>
                    <i class="fas fa-fax"></i> 
                    <span><?php echo $fax;?></span>
                </td>
            </tr>
         <!--櫻間20230317-->
            <tr>
                <th>MAIL</th>
                <td>
                    <i class="fas fa-envelope"></i> 
                    <span><?php echo $mail;?></span>
                </td>
            </tr>
            
        </table>
    </div>

    <div class="detail-section" id="to-note1"><!-- 備考 -->
    <h4>備考
        <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
        <!--櫻間--><!-- 高橋20230106 maxlength属性追加 -->
        <textarea class="uk-textarea size-textarea-Notes" rows="7" name="note" maxlength="1000" readonly><?php  echo $note; ?></textarea>
    </div>
