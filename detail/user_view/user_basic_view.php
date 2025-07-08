<?php
include("./control/basic_control.php"); 
?>

<!--櫻間ここから-->

    <div class="detail-section" id="to-hospitalName"><!-- 医療機関名 -->
    <h4>医療機関名</h4>
        <span><?php if($var['hos_name'] !== ''){ echo $var['hos_name']; }else{ echo'データなし'; } ?></span>
    </div>

    <div class="detail-section" id="to-kubun"><!-- 区分 -->
    <h4>区分</h4>
        <div class="uk-margin">
        <label>病院区分</label>
            <span>：<?php if( $var['hos_div'] !== '' ) { echo $var['hos_div']; }else{ echo '<span class="uk-text-muted">' . 'データなし' . '</span>'; } ?></span>
        </div>

        <div class="uk-margin"><!--櫻間-->
        <label>開院区分</label>
            <span>：<?php
                    if(($var['op_flg'])==='1'){
                            echo '開院';
                    }else{
                        echo '閉院';
                    }
                    ?>
                        <?php
                        //閉院なら閉院日表示
                        if(($var['op_flg'])==='0'){
                        ?>
                        <div class="uk-margin">
                        （ 閉院日：<?php if($var['clo_day'] !== '') { echo $var['clo_day']; }else{ echo '<span class="uk-text-muted">' . 'データなし' . '</span>'; } ?> ）
                        </div>
                        <?php } ?>
            </span>
        </div>
    </div>


    <div class="detail-section" id="to-Medass"><!-- 医師会 -->
    <h4>医師会</h4>
        <span><?php if($var['med_ass'] !== ''){ echo ($var['med_ass']); }else{ echo'データなし'; } ?></span>
    </div>

    <div class="detail-section" id="to-area"><!-- 所在地 -->
    <h4>所在地</h4>
        <div class="uk-margin">
        <label>郵便番号</label>
            <div class="uk-form-controls">
                <i class="fas fa-tenge"></i> 
                <span><?php if( $var['zipcode'] !== '' ||$var['zipcode']=='0') { echo html_escape ($var['zipcode']); }else{ echo '<span class="uk-text-muted">' . '：--- ' . '</span>'; } ?></span>
            </div>
        </div>

        <div class="uk-margin">
        <label>都道府県</label>
            <div class="uk-form-controls">
                <span>：<?php if( $var['pre'] !== '' ) { echo html_escape ($var['pre']); }else{ echo '<span class="uk-text-muted">' . 'データなし' . '</span>'; } ?></span>
            </div>
        </div>

        <div class="uk-margin">
        <label>市</label>
            <div class="uk-form-controls">
                <span>：<?php if( $var['city'] !== '' ) { echo html_escape ($var['city']); }else{ echo '<span class="uk-text-muted">' . 'データなし' . '</span>'; } ?></span>
            </div>
        </div>

        <div class="uk-margin">
        <label>区</label>
            <div class="uk-form-controls">
                <span>：<?php if( $var['zone'] !== '' ) { echo html_escape ($var['zone']); }else{ echo '<span class="uk-text-muted">' . 'データなし' . '</span>'; }  ?></span>
            </div>
        </div>

        <div class="uk-margin">
        <label>町</label>
            <div class="uk-form-controls">
                <span>：<?php if( $var['town'] !== '' ) { echo $var['town']; }else{ echo '<span class="uk-text-muted">' . 'データなし' . '</span>'; } ?></span>
            </div>
        </div>

        <div class="uk-margin">
        <label>番地・建物名</label>
            <div class="uk-form-controls">
                <span>：<?php if( $var['str_num'] !== '' ) { echo $var['str_num']; }else{ echo '<span class="uk-text-muted">' . 'データなし' . '</span>'; } ?></span>
            </div>
        </div>
    </div>

    <div class="detail-section" id="to-address"><!-- 連絡先 -->
    <h4>連絡先</h4>
        <div class="uk-margin">
        <label>電話番号</label>
            <div class="uk-form-controls">
                <i class="fas fa-phone"></i> 
                <span>：<?php if( $var['tel'] !== '' ) { echo html_escape ($var['tel']); }else{ echo '<span class="uk-text-muted">' . '---' . '</span>'; }  ?></span>
            </div>
        </div>
        <div class="uk-margin">
        <label>FAX</label>
            <div class="uk-form-controls">
                <i class="fas fa-fax"></i> 
                <span>：<?php if( $var['fax'] !== '' ) { echo html_escape ($var['fax']); }else{ echo '<span class="uk-text-muted">' . '---' . '</span>'; } ?></span>
            </div>
        </div>
        <!--櫻間20230317-->
        <div class="uk-margin">
        <label>MAIL</label>
            <div class="uk-form-controls">
                <i class="fas fa-envelope"></i> 
                <span>：<?php if( $var['email'] !== '' ) { echo html_escape ($var['email']); }else{ echo '<span class="uk-text-muted">' . '---' . '</span>'; } ?></span>
            </div>
        </div>
    </div>

    <div class="detail-section" id="to-note1"><!-- 備考 -->
    <h4>備考
        <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
        <div class="uk-form-controls">
            <?php if( $var['note'] !== '' ) { echo nl2br(html_escape ($var['note'])); }else{ echo '<span class="uk-text-muted">' . '---' . '</span>'; } ?>
        </div>
    </div>

<!--櫻間ここまで-->
   