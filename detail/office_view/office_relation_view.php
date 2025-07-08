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
            <ul>
            <?php foreach($CorpPath as $cd => $path ){ ?>
                <li><span <?php if(isset($cPath_data1['cp'.$cd]) && $cPath_data1['cp'.$cd] === '1'){ echo 'style="color:red;"'; }else{ echo 'style="color:gray; text-decoration: line-through;"'; } ?>><?php echo $path; ?></span></li>
            <?php } ?>
            </ul>
        </div>
        <div>
        <label>総合医療センター</label>
            <ul>
            <?php foreach($CorpPath as $cd => $path ){ ?>
                <li><span <?php if(isset($cPath_data2['cp'.$cd]) && $cPath_data2['cp'.$cd] === '1'){ echo 'style="color:red;"'; }else{ echo 'style="color:gray; text-decoration: line-through;"'; } ?>><?php echo $path; ?></span></li>
            <?php } ?>
            </ul>
        </div>
    </div>
</div>

<?php /* 高橋20231121 懇話会追加 */ ?>
<div class="detail-section" id="to-socialMeeting"><!-- 医療連携懇話会 -->
<h4>医療連携懇話会　参加年度</h4>
    <div class="uk-width-4-5@xl uk-width-1-1@m uk-child-width-1-3@m" uk-grid>
        <div>
            <label>【 附属病院 】</label>
            <?php if(!empty($socialMeeting_data1)): ?>
                <ul>
                <?php foreach($socialMeeting_data1 as $sm_data){ ?>
                    <li><?php echo $sm_data['year']; ?></li>
                <?php } ?>
                </ul>
            <?php else: ?>
            <div class="uk-alert-secondary" uk-alert>
                データなし
            </div>
            <?php endif; ?>
        </div>
        <div>
            <label>【 総合医療センター 】</label>
            <?php if(!empty($socialMeeting_data2)): ?>
                <ul>
                <?php foreach($socialMeeting_data2 as $sm_data){ ?>
                    <li><?php echo $sm_data['year']; ?></li>
                <?php } ?>
                </ul>
            <?php else: ?>
            <div class="uk-alert-secondary" uk-alert>
                データなし
            </div>
            <?php endif; ?>
        </div>
        <div>
            <label>【 高齢者医療センター 】</label>
            <?php if(!empty($socialMeeting_data3)): ?>
                <ul>
                <?php foreach($socialMeeting_data3 as $sm_data){ ?>
                    <li><?php echo $sm_data['year']; ?></li>
                <?php } ?>
                </ul>
            <?php else: ?>
            <div class="uk-alert-secondary" uk-alert>
                データなし
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /* 高橋20231121 懇話会追加 */ ?>



<div class="detail-section" id="to-note7"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
    <?php foreach ($data as $key =>$var): ?>
        <span><?php echo html_escape(trim($var['coop_note'])) ?></span>
    <?php endforeach; ?>
    </div>
</div>