<?php include("./control/basic_control.php"); ?>

    <div class="detail-section" id="to-kubun"><!-- 区分 -->
    <h4>区分
        <label class="uk-label uk-label-required">必須</label></h4>
        <div class="uk-margin">
        <h5>病院区分
            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></h5>
            <div class="uk-form-controls">
                <label><input class="uk-radio" type="radio" name="hos_div" value="病院" <?php if(isset($hos_div)&&$hos_div==='病院'){echo 'checked'; }else{echo'checked';} ?>> 病院</label>
                <label><input class="uk-radio" type="radio" name="hos_div" value="特定機能" <?php if(isset($hos_div)&&$hos_div==='特定機能'){echo 'checked'; } ?> > 特定機能</label>
                <label><input class="uk-radio" type="radio" name="hos_div" value="総合病院"<?php if(isset($hos_div)&&$hos_div==='総合病院'){echo 'checked'; } ?>> 総合病院</label>
                <label><input class="uk-radio" type="radio" name="hos_div" value="地域支援" <?php if(isset($hos_div)&&$hos_div==='地域支援'){echo 'checked'; } ?>> 地域支援</label>
                <label><input class="uk-radio" type="radio" name="hos_div" value="診療所" <?php if(isset($hos_div)&&$hos_div==='診療所'){echo 'checked'; } ?>> 診療所</label>
            </div>
        </div>

        <div class="uk-margin"><!--櫻間-->
        <h5>開院区分
            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です ※閉院日は任意; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></h5>
            <div uk-grid>
                <div>
                    <label><input type="radio" class="uk-radio" name="op_flg" value="1" onclick="entryChange1();" <?php if(isset($op_flg)&&$op_flg=='1'){echo 'checked=checked';}else{ echo 'checked=checked';} ?>>開院</label>
                    <!-- 表示非表示切り替え//櫻間java -->
                    <div id="firstBox"></div>
                </div>
                <div>
                    <label><input type="radio" class="uk-radio" name="op_flg" value="0" onclick="entryChange1();"<?php if(isset($op_flg)&&$op_flg=='0'){echo 'checked=checked';} ?> >閉院</label>
                    <!-- 表示非表示切り替え//櫻間java -->
                    <div class="uk-margin-left" id="secondBox">
                        <label for="f_cloday"><span uk-icon="calendar"></span>閉院日:</label><input type="date" class="uk-input uk-form-width-medium"  name="clo_day" id="f_cloday" value="<?php if(isset($clo_day)){echo $clo_day; } ?>" placeholder="1970-01-01">
                    </div>
                </div>
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


    <div class="detail-section" id="to-Medass"><!-- 医師会 -->
    <h4>医師会</h4>
        <input class="uk-input size-input-Medass" list="datalist_ass" type="text" name="med_ass" placeholder="例) 岡山市" value="<?php if(isset($med_ass)){echo $med_ass; }?>">
        <datalist id="datalist_ass">
        <?php foreach($datalist_ass as $var1){ ?>
            <option value="<?php echo $var1['med_ass'];?>">
        <?php } //高橋 ↑ 医師会データリスト ?><!--櫻間-->
        </datalist>
    </div>


    <div class="detail-section" id="to-area"><!-- 所在地 -->
    <h4>所在地
        <label class="uk-label uk-label-required">必須</label></h4>
        <div class="uk-margin">
        <label>郵便番号
            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></label>
            <div class="uk-form-controls">
                <i class="fas fa-tenge"></i> 
                <input class="uk-input size-input-zip pattern" type="text" name="zipcode" data-pattern="zip" maxlength="7" placeholder="例) 1234567　半角数字、ハイフンなし" value="<?php if(isset($zipcode)){echo $zipcode; }?>" ><br>
            </div>
        </div>

        <div class="uk-margin">
        <label>都道府県
        <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->
        </label>
            <div class="uk-form-controls">
                <select name="pre" class="uk-select size-input-pre" id="selbox" onchange="change();"><!-- 高橋20230513 -->
                    <option value="岡山県" <?php if(isset($pre) && $pre==='岡山県'){echo 'selected'; }?>>岡山県</option>
                    <option value="広島県" <?php if(isset($pre) && $pre==='広島県'){echo 'selected'; }?>>広島県</option>
                </select>
            </div>
        </div>
        
        <div class="uk-margin">
        <label>地域
        <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->
        </label>
            <!-- 高橋20230513 -->
            <div class="uk-form-controls">
                <!--岡山県-->
                <select class="uk-select size-select-area" name="area1" <?php if(isset($pre) && $pre!=='岡山県'){ ?>style="display:none"<?php }?> id="area1" onchange="change2();">
                <option value="" selected>選択してください</option>
                <?php 
                foreach($are_cds as $key1=>$var1):
                    if(strpos( $var1['sec_cd'], "33" ) === 0): ?>
                        <option value="<?php echo $var1['area2']; ?>" <?php if(isset($area) && $area === $var1['area2']){echo 'selected';}?>><?php echo $var1['area2'];?></option><!--櫻間20230502--><!--セッションが表示されていなかったので修正--><!-- →→高橋ありがとう！！ -->
                <?php 
                    endif;
                endforeach;?>
                </select>
                <!--広島県-->
                <select class="uk-select size-select-area" name="area2" <?php if(isset($pre) && $pre!=='広島県'){ ?>style="display:none"<?php }elseif(!isset($pre)){?>style="display:none"<?php }?> id="area2" onchange="change2();">
                <option value="" selected>選択してください</option>
                <?php 
                foreach($are_cds as $key1=>$var1):
                    if(strpos( $var1['sec_cd'], "34" ) === 0): ?>
                        <option value="<?php echo $var1['area2']; ?>" <?php if(isset($area) && $area === $var1['area2']){echo 'selected';}?>><?php echo $var1['area2'];?></option><!--櫻間20230502--><!--セッションが表示されていなかったので修正--><!-- →→高橋ありがとう！！ -->
                <?php 
                    endif;
                endforeach;?>
                </select>
            </div>
            <!-- 高橋20230513 -->
        </div>


        <div class="uk-margin">
        <label>地区コード
        <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->
        </label>
            <!-- 高橋20230513 -->
            <div class="uk-form-controls">

                <!--岡山県-->
                <select id="are_cd1" class="uk-select size-select-area" name="are_cd1" <?php if(isset($pre) && $pre!=='岡山県'){ ?>style="display:none"<?php }?> onchange="change3();">
                <option value="" selected>選択してください</option>
                <?php 
                foreach($are_cds as $key1=>$var1):
                    if(strpos( $var1['sec_cd'], "33" ) === 0): ?>
                    <option value="<?php echo $var1['sec_cd'];?>"<?php if(isset($are_cd) && $are_cd === (string)$var1['sec_cd']){echo 'selected';}?>><?php echo $var1['sec_cd']; ?>（<?php echo $var1['area2'];?>）</option>
                <?php 
                    endif;
                endforeach;?>
                </select>
                <!--広島県-->
                <select id="are_cd2" class="uk-select size-select-area" name="are_cd2" <?php if(isset($pre) && $pre!=='広島県'){ ?>style="display:none"<?php }elseif(!isset($pre)){?>style="display:none"<?php }?> onchange="change3();">
                <option value="" selected>選択してください</option>
                <?php 
                foreach($are_cds as $key1=>$var1):
                    if(strpos( $var1['sec_cd'], "34" ) === 0): ?>
                    <option value="<?php echo $var1['sec_cd'];?>"<?php if(isset($are_cd) && $are_cd === (string)$var1['sec_cd']){echo 'selected';}?>><?php echo $var1['sec_cd']; ?>（<?php echo $var1['area2'];?>）</option>
                <?php 
                    endif;
                endforeach;?>
                </select>

            </div>
            <!-- 高橋20230513 -->
        </div>


        <div class="uk-margin">
        <label>市</label>
            <div class="uk-form-controls">
                <input id="city" class="uk-input size-input-city" type="text" placeholder="例) 岡山市" name="city" value="<?php if(isset($city)){echo $city; }?>" >
            </div>
        </div>

        <div class="uk-margin">
        <label>区</label>
            <div class="uk-form-controls">
                <input id="zone" class="uk-input size-input-zone" type="text" placeholder="例) 北区" name="zone" value="<?php if(isset($zone)){echo $zone; }?>">
            </div>
        </div>

        <div class="uk-margin">
        <label>町</label>
            <div class="uk-form-controls">
                <input id="town" class="uk-input size-input-town" type="text" placeholder="" name="town" value="<?php if(isset($town)){echo $town; }?>" >
            </div>
        </div>

        <div class="uk-margin">
        <label>番地・建物名</label>
            <div class="uk-form-controls">
                <input id="str_num" class="uk-input size-input-strNum" type="text" placeholder="" name="str_num" value="<?php if(isset($str_num)){echo $str_num; }?>" >
            </div>
        </div>
    </div>

    <div class="detail-section" id="to-address"><!-- 連絡先 -->
    <h4>連絡先</h4>
        <div class="uk-margin">
        <label>電話番号</label>
            <div class="uk-form-controls">
                <i class="fas fa-phone"></i> 
                <input class="uk-input size-input-Tel pattern" type="text" name="tel" data-pattern="tel" placeholder="例)123-456-7890" value="<?php if(isset($tel)){echo $tel; }?>"><br>
            </div>
        </div>
        <div class="uk-margin">
        <label>FAX</label>
            <div class="uk-form-controls">
                <i class="fas fa-fax"></i> 
                <input class="uk-input size-input-Fax pattern" data-pattern="fax" type="text" name="fax" placeholder="例)123-456-7890" value="<?php if(isset($fax)){echo $fax; }?>"><br>
            </div>
        </div>
        <!--櫻間20230317-->        
        <div class="uk-margin">
        <label>MAIL</label>
            <div class="uk-form-controls">
                <i class="fas fa-envelope"></i> 
                <input class="uk-input size-input-Email pattern" type="text" name="mail" data-pattern="mail" placeholder="例)abc123@kawasaki.jp" value="<?php if(isset($mail)){echo $mail; }?>"><br>
            </div>
        </div>
        <!--櫻間20230317-->
    </div>


    <div class="detail-section" id="to-note1"><!-- 備考 -->
    <h4>備考
        <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
        <!--櫻間--><!-- 高橋20230106 maxlength属性追加 -->
        <textarea class="uk-textarea size-textarea-Notes" rows="7" name="note" maxlength="1000"><?php if(isset($note)){echo $note; }?></textarea>
    </div>

