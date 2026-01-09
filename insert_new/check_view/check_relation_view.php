<?php include("./control/relation_control.php"); ?>
<div class="detail-section" id="to-carna"><!-- カルナコネクト -->
<h4>カルナコネクト</h4>
    <div class="uk-margin">
        <span>カルナコネクト：<?php if(isset($carna)&&$carna==='1'){ ?>登録済み<?php }else{ ?>未登録<?php } ?></span>
        <p>※当該医療機関から附属病院・総合医療センターの予約を取るための登録</p>
    </div>
</div>

<div class="detail-section" id="to-path"><!-- 連携パス -->
<h4>連携パス</h4>
    <div class="uk-margin uk-child-width-1-3@l uk-child-width-1-2@s" uk-grid>
        <div>
        <label>附属病院</label>
            <ul><?php 
            foreach($CorpPath as $cd => $path ){
                if(isset($kurashiki_path[$cd]) && $kurashiki_path[$cd] === '1'){ ?>
                <li><span><?php echo $path; ?></span></li>
            <?php 
                }
            } ?></ul>
        </div>
        <div>
        <label>総合医療センター</label>
            <ul><?php 
            foreach($CorpPath as $cd => $path ){
                if(isset($okayama_path[$cd]) && $okayama_path[$cd] === '1'){ ?>
                <li><span><?php echo $path; ?></span></li>
            <?php 
                }
            } ?></ul>
        </div>
    </div>
</div>

<?php /*高橋20231121 懇話会追加 */ ?>
<div class="detail-section" id="to-socialMeeting"><!-- 医療連携懇話会 -->
<h4>医療連携懇話会　参加年度</h4>
    <div class="uk-width-4-5@m uk-width-1-1@m uk-child-width-1-3@m" uk-grid>
        <div class="uk-form-controls">
            <label>【 附属病院 】</label>
            <ul>
                <?php 
                if(!empty($kurashiki_sm)){
                    foreach($kurashiki_sm as $sm){ ?>
                    <li><?php echo html_escape($sm); ?></li>
                <?php 
                    }
                } ?>
            </ul>
        </div>
        <div class="uk-form-controls">
            <label>【 総合医療センター 】</label>
            <ul>
                <?php 
                if(!empty($okayama1_sm)){
                    foreach($okayama1_sm as $sm){ ?>
                    <li><?php echo html_escape($sm); ?></li>
                <?php 
                    }
                } ?>
            </ul>
        </div>
        <div class="uk-form-controls">
            <label>【 高齢者医療センター 】</label>
            <ul>
                <?php 
                if(!empty($okayama2_sm)){
                    foreach($okayama2_sm as $sm){ ?>
                    <li><?php echo html_escape($sm); ?></li>
                <?php 
                    }
                } ?>
            </ul>
        </div>
    </div>
</div>
<?php /*高橋20231121 懇話会追加 */ ?>



<div class="detail-section" id="to-note7"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
        <textarea class="uk-textarea size-textarea-Notes" name="coop_note" rows="7" maxlength="1000" readonly><?php echo $coop_note; ?></textarea>
    </div>
</div>