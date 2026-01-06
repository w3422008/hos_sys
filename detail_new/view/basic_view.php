<?php
// detail_control.phpから$data, $user_type等が渡されている
$is_editable = ($user_type === 'admin');
$is_readonly = !$is_editable;

foreach ($data as $key => $var):
?>
    <!-- 医療機関名 -->
    <div class="detail-section" id="to-hospitalName">
        <h4>医療機関名 <?php if($is_editable): ?><label class="uk-label uk-label-required">必須</label><?php endif; ?></h4>
        <?php if($is_editable): ?>
            <input class="uk-input size-input-hosName" type="text" name="hos_name" placeholder="例) ◯◯医院" value="<?php echo html_escape($var['hos_name']); ?>">
            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom" tabindex="-1"></i>
        <?php else: ?>
            <span><?php echo !empty($var['hos_name']) ? html_escape($var['hos_name']) : 'データなし'; ?></span>
        <?php endif; ?>
    </div>

    <!-- 区分 -->
    <div class="detail-section" id="to-kubun">
        <h4>区分 <?php if($is_editable): ?><label class="uk-label uk-label-required">必須</label><?php endif; ?></h4>
        
        <div class="uk-margin">
            <h5>病院区分 <?php if($is_editable): ?><i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><?php endif; ?></h5>
            <?php if($is_editable): ?>
                <div class="uk-form-controls">
                    <label><input class="uk-radio" type="radio" name="hos_div" value="病院" <?php echo ($var['hos_div'] === '病院') ? 'checked' : ''; ?>> 病院</label>
                    <label><input class="uk-radio" type="radio" name="hos_div" value="特定機能" <?php echo ($var['hos_div'] === '特定機能') ? 'checked' : ''; ?>> 特定機能</label>
                    <label><input class="uk-radio" type="radio" name="hos_div" value="総合病院" <?php echo ($var['hos_div'] === '総合病院') ? 'checked' : ''; ?>> 総合病院</label>
                    <label><input class="uk-radio" type="radio" name="hos_div" value="地域支援" <?php echo ($var['hos_div'] === '地域支援') ? 'checked' : ''; ?>> 地域支援</label>
                    <label><input class="uk-radio" type="radio" name="hos_div" value="診療所" <?php echo ($var['hos_div'] === '診療所') ? 'checked' : ''; ?>> 診療所</label>
                </div>
            <?php else: ?>
                <span>：<?php echo !empty($var['hos_div']) ? html_escape($var['hos_div']) : '<span class="uk-text-muted">データなし</span>'; ?></span>
            <?php endif; ?>
        </div>

        <div class="uk-margin">
            <h5>開院区分 <?php if($is_editable): ?><i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です ※閉院日は任意; pos: bottom-left" tabindex="-1"></i><?php endif; ?></h5>
            <?php if($is_editable): ?>
                <div uk-grid>
                    <div>
                        <label><input type="radio" class="uk-radio" name="op_flg" value="1" onclick="entryChange1();" <?php echo ($var['op_flg'] == '1') ? 'checked' : ''; ?>>開院</label>
                        <div id="firstBox"></div>
                    </div>
                    <div>
                        <label><input type="radio" class="uk-radio" name="op_flg" value="0" onclick="entryChange1();" <?php echo ($var['op_flg'] == '0') ? 'checked' : ''; ?>>閉院</label>
                        <div class="uk-margin-left" id="secondBox">
                            <span><i class="fas fa-calendar-times fa-lg"></i> 閉院日：</span>
                            <input type="date" class="uk-input uk-form-width-medium" name="clo_day" id="f_cloday" value="<?php echo html_escape($var['clo_day']); ?>" placeholder="1970-01-01">
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    function entryChange1(){
                        let radio = document.getElementsByName('op_flg');
                        if(radio[0].checked) {
                            document.getElementById('firstBox').style.display = "";
                            document.getElementById('secondBox').style.display = "none";
                        } else if(radio[1].checked) {
                            document.getElementById('firstBox').style.display = "none";
                            document.getElementById('secondBox').style.display = "";
                        }
                    }
                    window.onload = entryChange1;
                </script>
            <?php else: ?>
                <span>：<?php 
                    if($var['op_flg'] == '1') {
                        echo '開院';
                    } else {
                        echo '閉院';
                        if(!empty($var['clo_day'])) {
                            echo ' (' . html_escape($var['clo_day']) . ')';
                        }
                    }
                ?></span>
            <?php endif; ?>
        </div>
    </div>

    <!-- 医師会 -->
    <div class="detail-section" id="to-Medass">
        <h4>医師会</h4>
        <?php if($is_editable): ?>
            <input class="uk-input size-input-Medass" list="datalist_ass" type="text" name="med_ass" placeholder="例) 岡山市" value="<?php echo html_escape($var['med_ass']); ?>">
            <datalist id="datalist_ass">
                <?php foreach($datalist_ass as $var1): ?>
                    <option value="<?php echo html_escape($var1['med_ass']); ?>">
                <?php endforeach; ?>
            </datalist>
        <?php else: ?>
            <span><?php echo !empty($var['med_ass']) ? html_escape($var['med_ass']) : 'データなし'; ?></span>
        <?php endif; ?>
    </div>

    <!-- 所在地 -->
    <div class="detail-section" id="to-area">
        <h4>所在地 <?php if($is_editable): ?><label class="uk-label uk-label-required">必須</label><?php endif; ?></h4>
        
        <div class="uk-margin">
            <label>郵便番号 <?php if($is_editable): ?><i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><?php endif; ?></label>
            <div class="uk-form-controls">
                <i class="fas fa-tenge"></i>
                <?php if($is_editable): ?>
                    <input class="uk-input size-input-zip pattern" type="text" name="zipcode" data-pattern="zip" maxlength="7" placeholder="例)1234567" value="<?php echo ($var['zipcode'] !== '0') ? html_escape($var['zipcode']) : ''; ?>">
                <?php else: ?>
                    <span><?php echo !empty($var['zipcode']) && $var['zipcode'] !== '0' ? html_escape($var['zipcode']) : 'データなし'; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="uk-margin">
            <label>都道府県 <?php if($is_editable): ?><i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><?php endif; ?></label>
            <div class="uk-form-controls">
                <?php if($is_editable): ?>
                    <select name="pre" class="uk-select size-input-pre" id="selbox" onchange="change();">
                        <option value="岡山県" <?php echo ($var['pre'] === '岡山県') ? 'selected' : ''; ?>>岡山県</option>
                        <option value="広島県" <?php echo ($var['pre'] === '広島県') ? 'selected' : ''; ?>>広島県</option>
                    </select>
                <?php else: ?>
                    <span><?php echo !empty($var['pre']) ? html_escape($var['pre']) : 'データなし'; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="uk-margin">
            <label>地域 <?php if($is_editable): ?><i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><?php endif; ?></label>
            <div class="uk-form-controls">
                <?php if($is_editable): ?>
                    <select class="uk-select size-select-area" name="area1" <?php if(strpos($var['are_cd'], "33") !== 0) { echo 'style="display:none"'; } ?> id="area1" onchange="change2();">
                        <option value="" selected>選択してください</option>
                        <?php foreach($are_cds as $key1=>$var1):
                            if(strpos($var1['sec_cd'], "33") === 0): ?>
                                <option value="<?php echo html_escape($var1['area2']); ?>" <?php echo ($var['area'] === $var1['area2']) ? 'selected' : ''; ?>><?php echo html_escape($var1['area2']); ?></option>
                            <?php endif;
                        endforeach; ?>
                    </select>
                    <select class="uk-select size-select-area" name="area2" <?php if(strpos($var['are_cd'], "34") !== 0) { echo 'style="display:none"'; } ?> id="area2" onchange="change2();">
                        <option value="" selected>選択してください</option>
                        <?php foreach($are_cds as $key1=>$var1):
                            if(strpos($var1['sec_cd'], "34") === 0): ?>
                                <option value="<?php echo html_escape($var1['area2']); ?>" <?php echo ($var['area'] === $var1['area2']) ? 'selected' : ''; ?>><?php echo html_escape($var1['area2']); ?></option>
                            <?php endif;
                        endforeach; ?>
                    </select>
                <?php else: ?>
                    <span><?php echo !empty($var['area']) ? html_escape($var['area']) : 'データなし'; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="uk-margin">
            <label>地区コード <?php if($is_editable): ?><i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><?php endif; ?></label>
            <div class="uk-form-controls">
                <?php if($is_editable): ?>
                    <select id="are_cd1" class="uk-select size-select-area" name="are_cd1" <?php if(strpos($var['are_cd'], "33") !== 0) { echo 'style="display:none"'; } ?> onchange="change3();">
                        <option value="" selected>選択してください</option>
                        <?php foreach($are_cds as $key1=>$var1):
                            if(strpos($var1['sec_cd'], "33") === 0): ?>
                                <option value="<?php echo html_escape($var1['sec_cd']); ?>" <?php echo ($var['are_cd'] === (string)$var1['sec_cd']) ? 'selected' : ''; ?>><?php echo html_escape($var1['sec_cd']); ?>（<?php echo html_escape($var1['area2']); ?>）</option>
                            <?php endif;
                        endforeach; ?>
                    </select>
                    <select id="are_cd2" class="uk-select size-select-area" name="are_cd2" <?php if(strpos($var['are_cd'], "34") !== 0) { echo 'style="display:none"'; } ?> onchange="change3();">
                        <option value="" selected>選択してください</option>
                        <?php foreach($are_cds as $key1=>$var1):
                            if(strpos($var1['sec_cd'], "34") === 0): ?>
                                <option value="<?php echo html_escape($var1['sec_cd']); ?>" <?php echo ($var['are_cd'] === (string)$var1['sec_cd']) ? 'selected' : ''; ?>><?php echo html_escape($var1['area2']); ?>：<?php echo html_escape($var1['sec_cd']); ?></option>
                            <?php endif;
                        endforeach; ?>
                    </select>
                <?php else: ?>
                    <span><?php echo !empty($var['are_cd']) ? html_escape($var['are_cd']) : 'データなし'; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="uk-margin">
            <label>市</label>
            <div class="uk-form-controls">
                <?php if($is_editable): ?>
                    <input id="city" class="uk-input size-input-city" type="text" placeholder="例) 岡山市" name="city" value="<?php echo html_escape($var['city']); ?>">
                <?php else: ?>
                    <span><?php echo !empty($var['city']) ? html_escape($var['city']) : 'データなし'; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="uk-margin">
            <label>区</label>
            <div class="uk-form-controls">
                <?php if($is_editable): ?>
                    <input id="zone" class="uk-input size-input-zone" type="text" placeholder="例) 北区" name="zone" value="<?php echo html_escape($var['zone']); ?>">
                <?php else: ?>
                    <span><?php echo !empty($var['zone']) ? html_escape($var['zone']) : 'データなし'; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="uk-margin">
            <label>町</label>
            <div class="uk-form-controls">
                <?php if($is_editable): ?>
                    <input id="town" class="uk-input size-input-town" type="text" name="town" value="<?php echo html_escape($var['town']); ?>">
                <?php else: ?>
                    <span><?php echo !empty($var['town']) ? html_escape($var['town']) : 'データなし'; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="uk-margin">
            <label>番地・建物名</label>
            <div class="uk-form-controls">
                <?php if($is_editable): ?>
                    <input id="str_num" class="uk-input size-input-strNum" type="text" name="str_num" value="<?php echo html_escape($var['str_num']); ?>">
                <?php else: ?>
                    <span><?php echo !empty($var['str_num']) ? html_escape($var['str_num']) : 'データなし'; ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- 連絡先 -->
    <div class="detail-section" id="to-address">
        <h4>連絡先</h4>
        
        <div class="uk-margin">
            <label>電話番号</label>
            <div class="uk-form-controls">
                <i class="fas fa-phone"></i>
                <?php if($is_editable): ?>
                    <input class="uk-input size-input-Tel pattern" type="text" name="tel" data-pattern="tel" placeholder="例)123-456-7890" value="<?php echo html_escape($var['tel']); ?>">
                <?php else: ?>
                    <span><?php echo !empty($var['tel']) ? html_escape($var['tel']) : 'データなし'; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="uk-margin">
            <label>FAX</label>
            <div class="uk-form-controls">
                <i class="fas fa-fax"></i>
                <?php if($is_editable): ?>
                    <input class="uk-input size-input-Fax pattern" type="text" name="fax" data-pattern="fax" placeholder="例)123-456-7890" value="<?php echo html_escape($var['fax']); ?>">
                <?php else: ?>
                    <span><?php echo !empty($var['fax']) ? html_escape($var['fax']) : 'データなし'; ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="uk-margin">
            <label>MAIL</label>
            <div class="uk-form-controls">
                <i class="fas fa-envelope"></i>
                <?php if($is_editable): ?>
                    <input class="uk-input size-input-Email pattern" type="text" name="mail" data-pattern="mail" placeholder="例)abc123@gmail.com" value="<?php echo html_escape($var['email']); ?>">
                <?php else: ?>
                    <span><?php echo !empty($var['email']) ? html_escape($var['email']) : 'データなし'; ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- 備考 -->
    <div class="detail-section" id="to-note1">
        <h4>備考 <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
        <?php if($is_editable): ?>
            <textarea class="uk-textarea size-textarea-Notes" rows="7" name="note" maxlength="1000"><?php echo html_escape($var['note']); ?></textarea>
        <?php else: ?>
            <span><?php echo !empty($var['note']) ? nl2br(html_escape($var['note'])) : 'データなし'; ?></span>
        <?php endif; ?>
    </div>
<?php
endforeach;
?>
