<?php
// detail_control.phpから$data, $user_type等が渡されている
?>
    <div class="detail-section" id="to-number">
        <h4>各診療部門の連絡先</h4>
        
        <?php if($is_editable): ?>
            <div class="uk-margin-small-bottom">
                <label class="uk-form-label">【絞り込み】</label>
                <div uk-filter="target: .js-filter-number">
                    <label><input type="radio" class="uk-radio" name="number_filter" uk-filter-control> すべて</label>
                    <label><input type="radio" class="uk-radio" name="number_filter" uk-filter-control="[data-type='zenken']"> 全圏</label>
                    <label><input type="radio" class="uk-radio" name="number_filter" uk-filter-control="[data-type='gairai']"> 外来</label>
                    <label><input type="radio" class="uk-radio" name="number_filter" uk-filter-control="[data-type='renkei']"> 連携</label>
                    <label><input type="radio" class="uk-radio" name="number_filter" uk-filter-control="[data-type='sonota']"> その他</label>
                </div>
            </div>
            
            <table class="uk-table uk-table-small tbl-border js-filter-number" id="number_table">
                <thead>
                    <tr>
                        <th>診療部門</th>
                        <th>部門区分</th>
                        <th>電話</th>
                        <th>FAX</th>
                        <th>備考</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody id="number_tbody">
                    <?php 
                    if(!empty($data)):
                        foreach($data as $var):
                    ?>
                        <tr data-type="<?php echo html_escape($var['type']); ?>">
                            <td><input type="text" name="number_dept[]" value="<?php echo html_escape($var['department']); ?>" maxlength="50" class="uk-input"></td>
                            <td>
                                <select name="number_type[]" class="uk-select">
                                    <option value="">選択</option>
                                    <option value="zenken" <?php echo ($var['type'] === 'zenken') ? 'selected' : ''; ?>>全圏</option>
                                    <option value="gairai" <?php echo ($var['type'] === 'gairai') ? 'selected' : ''; ?>>外来</option>
                                    <option value="renkei" <?php echo ($var['type'] === 'renkei') ? 'selected' : ''; ?>>連携</option>
                                    <option value="sonota" <?php echo ($var['type'] === 'sonota') ? 'selected' : ''; ?>>その他</option>
                                </select>
                            </td>
                            <td><input type="tel" name="number_tel[]" value="<?php echo html_escape($var['tel']); ?>" pattern="[0-9\-]+" maxlength="20" class="uk-input"></td>
                            <td><input type="tel" name="number_fax[]" value="<?php echo html_escape($var['fax']); ?>" pattern="[0-9\-]+" maxlength="20" class="uk-input"></td>
                            <td><input type="text" name="number_note[]" value="<?php echo html_escape($var['note']); ?>" maxlength="100" class="uk-input"></td>
                            <td><button type="button" class="uk-button uk-button-small uk-button-danger delete-row">削除</button></td>
                        </tr>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                </tbody>
            </table>
            
            <button type="button" class="uk-button uk-button-small uk-button-primary" id="add-number-row">行を追加</button>
            
            <script>
                // 行削除
                document.querySelectorAll('#number_table .delete-row').forEach(btn => {
                    btn.addEventListener('click', function() {
                        this.closest('tr').remove();
                    });
                });
                
                // 行追加
                document.getElementById('add-number-row')?.addEventListener('click', function() {
                    const tbody = document.getElementById('number_tbody');
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td><input type="text" name="number_dept[]" maxlength="50" class="uk-input"></td>
                        <td>
                            <select name="number_type[]" class="uk-select">
                                <option value="">選択</option>
                                <option value="zenken">全圏</option>
                                <option value="gairai">外来</option>
                                <option value="renkei">連携</option>
                                <option value="sonota">その他</option>
                            </select>
                        </td>
                        <td><input type="tel" name="number_tel[]" pattern="[0-9\\-]+" maxlength="20" class="uk-input"></td>
                        <td><input type="tel" name="number_fax[]" pattern="[0-9\\-]+" maxlength="20" class="uk-input"></td>
                        <td><input type="text" name="number_note[]" maxlength="100" class="uk-input"></td>
                        <td><button type="button" class="uk-button uk-button-small uk-button-danger delete-row">削除</button></td>
                    `;
                    tbody.appendChild(row);
                    row.querySelector('.delete-row').addEventListener('click', function() {
                        this.closest('tr').remove();
                    });
                });
            </script>
        <?php else: ?>
            <table class="uk-table uk-table-small tbl-border">
                <thead>
                    <tr>
                        <th>診療部門</th>
                        <th>部門区分</th>
                        <th>電話</th>
                        <th>FAX</th>
                        <th>備考</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(!empty($data)):
                        foreach($data as $var):
                    ?>
                        <tr>
                            <td><?php echo html_escape($var['department']); ?></td>
                            <td>
                                <?php 
                                $type_map = ['zenken' => '全圏', 'gairai' => '外来', 'renkei' => '連携', 'sonota' => 'その他'];
                                echo html_escape($type_map[$var['type']] ?? '');
                                ?>
                            </td>
                            <td><?php echo html_escape($var['tel']); ?></td>
                            <td><?php echo html_escape($var['fax']); ?></td>
                            <td><?php echo html_escape($var['note']); ?></td>
                        </tr>
                    <?php 
                        endforeach;
                    else:
                    ?>
                        <tr>
                            <td colspan="5">データなし</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
