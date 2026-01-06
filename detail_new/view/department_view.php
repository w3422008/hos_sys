<?php
// detail_control.phpから$data, $user_type等が渡されている
foreach ($data as $key => $var):
?>
    <div class="detail-section" id="to-BedReha">
        <h4>許可病床数・病棟種類・リハビリスタッフ</h4>
        
        <label>許可病床数</label>
        <?php if($is_editable): ?>
            <input class="uk-input size-input-bed" name="bed" type="text" value="<?php echo ($var['bed'] !== '0') ? html_escape($var['bed']) : ''; ?>">床
        <?php else: ?>
            <span><?php echo ($var['bed'] !== '0') ? html_escape($var['bed']) . '床' : 'データなし'; ?></span>
        <?php endif; ?>
        
        <div uk-grid>
            <div>
                <label>【 病棟種類 】</label><br>
                <?php if($is_editable): ?>
                    <label><input class="uk-checkbox" type="checkbox" name="bed_main" <?php echo ($var['bed_main'] === '1') ? 'checked' : ''; ?>> 一般病棟</label><br>
                    <label><input class="uk-checkbox" type="checkbox" name="bed_tre" <?php echo ($var['bed_tre'] === '1') ? 'checked' : ''; ?>> 療養病棟</label><br>
                    <label><input class="uk-checkbox" type="checkbox" name="bed_reh" <?php echo ($var['bed_reh'] === '1') ? 'checked' : ''; ?>> 回復期リハビリテーション病棟</label><br>
                    <label><input class="uk-checkbox" type="checkbox" name="bed_care" <?php echo ($var['bed_care'] === '1') ? 'checked' : ''; ?>> 地域包括ケア病棟</label><br>
                    <label><input class="uk-checkbox" type="checkbox" name="bed_tra" <?php echo ($var['bed_tra'] === '1') ? 'checked' : ''; ?>> 障害者病棟</label><br>
                    <label><input class="uk-checkbox" type="checkbox" name="bed_att" <?php echo ($var['bed_att'] === '1') ? 'checked' : ''; ?>> 緩和ケア病棟</label>
                <?php else: ?>
                    <span>
                        <?php 
                        $bed_types = [];
                        if($var['bed_main'] === '1') $bed_types[] = '一般病棟';
                        if($var['bed_tre'] === '1') $bed_types[] = '療養病棟';
                        if($var['bed_reh'] === '1') $bed_types[] = '回復期リハビリテーション病棟';
                        if($var['bed_care'] === '1') $bed_types[] = '地域包括ケア病棟';
                        if($var['bed_tra'] === '1') $bed_types[] = '障害者病棟';
                        if($var['bed_att'] === '1') $bed_types[] = '緩和ケア病棟';
                        echo !empty($bed_types) ? implode('、', $bed_types) : 'データなし';
                        ?>
                    </span>
                <?php endif; ?>
            </div>
            
            <div>
                <label>【 リハビリスタッフ 】</label><br>
                <?php if($is_editable): ?>
                    <label><input class="uk-checkbox" type="checkbox" name="pt" <?php echo ($var['pt'] === '1') ? 'checked' : ''; ?>> 理学療法士</label><br>
                    <label><input class="uk-checkbox" type="checkbox" name="ot" <?php echo ($var['ot'] === '1') ? 'checked' : ''; ?>> 作業療法士</label><br>
                    <label><input class="uk-checkbox" type="checkbox" name="st" <?php echo ($var['st'] === '1') ? 'checked' : ''; ?>> 言語聴覚士</label>
                <?php else: ?>
                    <span>
                        <?php 
                        $staff_types = [];
                        if($var['pt'] === '1') $staff_types[] = '理学療法士';
                        if($var['ot'] === '1') $staff_types[] = '作業療法士';
                        if($var['st'] === '1') $staff_types[] = '言語聴覚士';
                        echo !empty($staff_types) ? implode('、', $staff_types) : 'データなし';
                        ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="detail-section" id="to-week">
        <h4>診療日・手術日、診療時間</h4>
        <?php if($is_editable): ?>
            <table class="uk-table-small tbl-border">
                <tr>
                    <th rowspan="2">
                        <label for="All">すべて</label><br>
                        <input type="checkbox" class="uk-checkbox" id="All">
                    </th>
                    <th colspan="2"><label for="Mon">月</label><br><input type="checkbox" class="uk-checkbox all" id="Mon" name="week[]"></th>
                    <th colspan="2"><label for="Tue">火</label><br><input type="checkbox" class="uk-checkbox all" id="Tue"></th>
                    <th colspan="2"><label for="Wed">水</label><br><input type="checkbox" class="uk-checkbox all" id="Wed"></th>
                    <th colspan="2"><label for="Thu">木</label><br><input type="checkbox" class="uk-checkbox all" id="Thu"></th>
                    <th colspan="2"><label for="Fri">金</label><br><input type="checkbox" class="uk-checkbox all" id="Fri"></th>
                    <th colspan="2"><label for="Sat">土</label><br><input type="checkbox" class="uk-checkbox all" id="Sat"></th>
                    <th colspan="2"><label for="Sun">日</label><br><input type="checkbox" class="uk-checkbox all" id="Sun"></th>
                    <th rowspan="2"><label for="holiday">祝日</label><br><input type="checkbox" class="uk-checkbox all" id="Hol"></th>
                </tr>
                <tr>
                    <td><label for="Mon_AM">AM</label></td><td><label for="Mon_PM">PM</label></td>
                    <td><label for="Tue_AM">AM</label></td><td><label for="Tue_PM">PM</label></td>
                    <td><label for="Wed_AM">AM</label></td><td><label for="Wed_PM">PM</label></td>
                    <td><label for="Thr_AM">AM</label></td><td><label for="Thr_PM">PM</label></td>
                    <td><label for="Fri_AM">AM</label></td><td><label for="Fri_PM">PM</label></td>
                    <td><label for="Sat_AM">AM</label></td><td><label for="Sat_PM">PM</label></td>
                    <td><label for="Sun_AM">AM</label></td><td><label for="Sun_PM">PM</label></td>
                </tr>
                <tr>
                    <th><label for="All1"><i class="fas fa-calendar-alt"></i> 診療日</label><br><input type="checkbox" class="uk-checkbox all" id="All1"></th>
                    <td><input type="hidden" name="mon_am"><input type="checkbox" name="mon_am" value="●" <?php echo ($var['mon_am'] === '●' || $var['mon_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis MONDAY"></td>
                    <td><input type="hidden" name="mon_pm"><input type="checkbox" name="mon_pm" value="●" <?php echo ($var['mon_pm'] === '●' || $var['mon_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis MONDAY"></td>
                    <td><input type="hidden" name="tue_am"><input type="checkbox" name="tue_am" value="●" <?php echo ($var['tue_am'] === '●' || $var['tue_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis TUESDAY"></td>
                    <td><input type="hidden" name="tue_pm"><input type="checkbox" name="tue_pm" value="●" <?php echo ($var['tue_pm'] === '●' || $var['tue_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis TUESDAY"></td>
                    <td><input type="hidden" name="wed_am"><input type="checkbox" name="wed_am" value="●" <?php echo ($var['wed_am'] === '●' || $var['wed_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis WEDNESDAY"></td>
                    <td><input type="hidden" name="wed_pm"><input type="checkbox" name="wed_pm" value="●" <?php echo ($var['wed_pm'] === '●' || $var['wed_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis WEDNESDAY"></td>
                    <td><input type="hidden" name="thr_am"><input type="checkbox" name="thr_am" value="●" <?php echo ($var['thr_am'] === '●' || $var['thr_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis THURSDAY"></td>
                    <td><input type="hidden" name="thr_pm"><input type="checkbox" name="thr_pm" value="●" <?php echo ($var['thr_pm'] === '●' || $var['thr_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis THURSDAY"></td>
                    <td><input type="hidden" name="fri_am"><input type="checkbox" name="fri_am" value="●" <?php echo ($var['fri_am'] === '●' || $var['fri_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis FRIDAY"></td>
                    <td><input type="hidden" name="fri_pm"><input type="checkbox" name="fri_pm" value="●" <?php echo ($var['fri_pm'] === '●' || $var['fri_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis FRIDAY"></td>
                    <td><input type="hidden" name="sat_am"><input type="checkbox" name="sat_am" value="●" <?php echo ($var['sat_am'] === '●' || $var['sat_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis SATURDAY"></td>
                    <td><input type="hidden" name="sat_pm"><input type="checkbox" name="sat_pm" value="●" <?php echo ($var['sat_pm'] === '●' || $var['sat_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis SATURDAY"></td>
                    <td><input type="hidden" name="sun_am"><input type="checkbox" name="sun_am" value="●" <?php echo ($var['sun_am'] === '●' || $var['sun_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis SUNDAY"></td>
                    <td><input type="hidden" name="sun_pm"><input type="checkbox" name="sun_pm" value="●" <?php echo ($var['sun_pm'] === '●' || $var['sun_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis SUNDAY"></td>
                    <td><input type="hidden" name="holiday"><input type="checkbox" name="holiday" value="●" <?php echo ($var['holiday'] === '●' || $var['holiday'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all diagnosis HOLIDAY"></td>
                </tr>
                <tr>
                    <th><label for="All2"><i class="fas fa-calendar-check"></i> 手術日</label><br><input type="checkbox" class="uk-checkbox all" id="All2"></th>
                    <td><input type="hidden" name="mon_am1"><input type="checkbox" name="mon_am1" value="★" <?php echo ($var['mon_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery MONDAY"></td>
                    <td><input type="hidden" name="mon_pm1"><input type="checkbox" name="mon_pm1" value="★" <?php echo ($var['mon_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery MONDAY"></td>
                    <td><input type="hidden" name="tue_am1"><input type="checkbox" name="tue_am1" value="★" <?php echo ($var['tue_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery TUESDAY"></td>
                    <td><input type="hidden" name="tue_pm1"><input type="checkbox" name="tue_pm1" value="★" <?php echo ($var['tue_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery TUESDAY"></td>
                    <td><input type="hidden" name="wed_am1"><input type="checkbox" name="wed_am1" value="★" <?php echo ($var['wed_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery WEDNESDAY"></td>
                    <td><input type="hidden" name="wed_pm1"><input type="checkbox" name="wed_pm1" value="★" <?php echo ($var['wed_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery WEDNESDAY"></td>
                    <td><input type="hidden" name="thr_am1"><input type="checkbox" name="thr_am1" value="★" <?php echo ($var['thr_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery THURSDAY"></td>
                    <td><input type="hidden" name="thr_pm1"><input type="checkbox" name="thr_pm1" value="★" <?php echo ($var['thr_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery THURSDAY"></td>
                    <td><input type="hidden" name="fri_am1"><input type="checkbox" name="fri_am1" value="★" <?php echo ($var['fri_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery FRIDAY"></td>
                    <td><input type="hidden" name="fri_pm1"><input type="checkbox" name="fri_pm1" value="★" <?php echo ($var['fri_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery FRIDAY"></td>
                    <td><input type="hidden" name="sat_am1"><input type="checkbox" name="sat_am1" value="★" <?php echo ($var['sat_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery SATURDAY"></td>
                    <td><input type="hidden" name="sat_pm1"><input type="checkbox" name="sat_pm1" value="★" <?php echo ($var['sat_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery SATURDAY"></td>
                    <td><input type="hidden" name="sun_am1"><input type="checkbox" name="sun_am1" value="★" <?php echo ($var['sun_am'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery SUNDAY"></td>
                    <td><input type="hidden" name="sun_pm1"><input type="checkbox" name="sun_pm1" value="★" <?php echo ($var['sun_pm'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery SUNDAY"></td>
                    <td><input type="hidden" name="holiday1"><input type="checkbox" name="holiday1" value="★" <?php echo ($var['holiday'] === '★') ? 'checked' : ''; ?> class="uk-checkbox all surgery HOLIDAY"></td>
                </tr>
                <tr height="100">
                    <th><span><i class="fas fa-clock"></i> 診療時間</span></th>
                    <td colspan="15"><textarea class="uk-textarea" name="con_hour" placeholder="例) 9:00~12:00"><?php echo html_escape($var['con_hour']); ?></textarea></td>
                </tr>
            </table>
        <?php else: ?>
            <div class="uk-alert">診療日・手術日・診療時間は管理者のみ編集可能です</div>
            <span><?php echo !empty($var['con_hour']) ? html_escape($var['con_hour']) : 'データなし'; ?></span>
        <?php endif; ?>
    </div>

    <div class="detail-section" id="to-Dept">
        <h4>診療科</h4>
        <?php if($is_editable): ?>
            <div uk-filter="target: .js-filter">
                <ul class="uk-subnav uk-subnav-pill">
                    <li class="uk-active" uk-filter-control><a href="#">All</a></li>
                    <li uk-filter-control="[data-color='内科系']"><a href="#">内科系</a></li>
                    <li uk-filter-control="[data-color='小児科系']"><a href="#">小児科系</a></li>
                    <li uk-filter-control="[data-color='外科系']"><a href="#">外科系</a></li>
                    <li uk-filter-control="[data-color='整形外科系']"><a href="#">整形外科系</a></li>
                    <li uk-filter-control="[data-color='眼科系']"><a href="#">眼科系</a></li>
                    <li uk-filter-control="[data-color='耳鼻咽喉科系']"><a href="#">耳鼻咽喉科系</a></li>
                    <li uk-filter-control="[data-color='皮膚科・泌尿器科系']"><a href="#">皮膚科・泌尿器科系</a></li>
                    <li uk-filter-control="[data-color='産婦人科系']"><a href="#">産婦人科系</a></li>
                    <li uk-filter-control="[data-color='精神科系']"><a href="#">精神科系</a></li>
                    <li uk-filter-control="[data-color='歯科系']"><a href="#">歯科系</a></li>
                    <li uk-filter-control="[data-color='その他']"><a href="#">その他</a></li>
                </ul>
                <ul class="js-filter uk-child-width-1-4@m uk-child-width-1-1@s" uk-grid>
                    <?php 
                    $dept_lists = [
                        '内科系' => $dept_data,
                        '小児科系' => $dept_data2,
                        '外科系' => $dept_data3,
                        '整形外科系' => $dept_data4,
                        '眼科系' => $dept_data5,
                        '耳鼻咽喉科系' => $dept_data6,
                        '皮膚科・泌尿器科系' => $dept_data7,
                        '産婦人科系' => $dept_data8,
                        '精神科系' => $dept_data9,
                        '歯科系' => $dept_data10,
                        'その他' => $dept_data11
                    ];
                    
                    foreach($dept_lists as $category => $list): ?>
                        <li data-color="<?php echo $category; ?>">
                            <span class="uk-h5">【<?php echo $category; ?>】</span>
                            <div class="uk-margin-small-left">
                                <?php foreach($list as $var1): ?>
                                    <input type="hidden" name="<?php echo $var1['dep_cd']; ?>">
                                    <div>
                                        <input type="checkbox" class="uk-checkbox" name="<?php echo $var1['dep_cd']; ?>" id="<?php echo $var1['dep_cd']; ?>" value="1" <?php echo ($var[$var1['dep_cd']] === '1') ? 'checked' : ''; ?>>
                                        <label for="<?php echo $var1['dep_cd']; ?>"><?php echo html_escape($var1['dep_name']); ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else: ?>
            <span>診療科は管理者のみ編集可能です</span>
        <?php endif; ?>
    </div>

    <div class="detail-section" id="to-note2">
        <h4>備考 <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
        <?php if($is_editable): ?>
            <textarea class="uk-textarea size-textarea-Notes" name="dep_note" rows="7" maxlength="1000"><?php echo html_escape($var['dep_note']); ?></textarea>
        <?php else: ?>
            <span><?php echo !empty($var['dep_note']) ? nl2br(html_escape($var['dep_note'])) : 'データなし'; ?></span>
        <?php endif; ?>
    </div>
<?php
endforeach;
?>
