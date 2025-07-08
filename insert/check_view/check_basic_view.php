    <div class="detail-section" id="to-kubun"><!-- 区分 -->
    <h4>区分
        <label class="uk-label uk-label-required">必須</label></h4>
        <div class="uk-margin">
        <label>病院区分：
            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></label>
            <span><?php echo $hos_div;?></span>
        </div>

        <div class="uk-margin"><!--櫻間-->
        <label>開院区分：
            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です ※閉院日は任意; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></label>
                <span><?php if($op_flg ==='1'){ echo '開院'; }else{ echo '閉院'; } ?></span>
            <?php //閉院なら閉院日表示
                if($op_flg ==='0'){
                ?>
                （ 閉院日：
                <?php if($clo_day !== ''){ ?>
                    <span><?php echo $clo_day; ?></span>
                <?php }else{ ?>
                    <span class="uk-text-muted">データなし</span>
                <?php } ?>
                ）
            <?php 
                }
            ?>
        </div>
    </div>


    <div class="detail-section" id="to-Medass"><!-- 医師会 -->
    <h4>医師会</h4>
        <label>医師会：</label>
        <span><?php echo $med_ass;?></span>           
    </div>


    <div class="detail-section" id="to-area"><!-- 所在地 -->
    <h4>所在地
        <label class="uk-label uk-label-required">必須</label></h4>
        <div class="uk-margin">
        <label>郵便番号
            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->：</label>
            <span><?php echo $zipcode;?></span>
        </div>

        <div class="uk-margin">
        <label>都道府県
            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->：</label>
            <span><?php echo $pre;?></span> 
        </div>
        
        <div class="uk-margin">
        <label>地域
            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->：</label>
            <span><?php echo $area;?></span> 
        </div>


        <div class="uk-margin">
        <label>地区コード
            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->：</label>
            <span><?php echo $are_cd;?></span>
        </div>


        <div class="uk-margin">
        <label>市：</label>
            <span><?php echo $city;?></span>
        </div>

        <div class="uk-margin">
        <label>区：</label>
            <span><?php echo $zone;?></span>
        </div>

        <div class="uk-margin">
        <label>町：</label>
            <span><?php echo $town;?></span>
        </div>

        <div class="uk-margin">
        <label>番地・建物名：</label>
            <span><?php echo $str_num;?></span>
        </div>
    </div>


    <div class="detail-section" id="to-address"><!-- 連絡先 -->
    <h4>連絡先</h4>
        <div class="uk-margin">
        <label>電話番号：</label>
            <span><?php echo $tel;?></span>
        </div>
        <div class="uk-margin">
        <label>FAX：</label>
            <span><?php echo $fax;?></span>
        </div>
      <!--櫻間20230317-->        
        <div class="uk-margin">
        <label>MAIL：</label>
            <span><?php echo $mail;?></span>
        </div>
        <!--櫻間20230317-->
    </div>


<div class="detail-section" id="to-note6"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
        <textarea class="uk-textarea size-textarea-Notes"  rows="7" maxlength="1000" readonly><?php echo $note; ?></textarea>
    </div>
</div>

<!--櫻間-->
