<!--櫻間ここから-->
<div>

<?php
    include("./control/number_control.php");   
    //include("./header_detail.php"); 
    $hos_cd= $_GET['cd'];
?> 

<div class="detail-section" id="to-Fiejct">
<h4>部門連絡先</h4>
    <!--櫻間ここから-->
    <div class="uk-margin">
        <label class="uk-form-label">フィルタ機能</label>
        <div class="uk-form-controls">
            <div class="uk-margin uk-grid-small uk-child-width-auto" uk-grid>
                <label><input class="uk-radio" type="radio" name="maker" value="zenken" onclick="formSwitch()" checked> 全件</label>
                <label><input class="uk-radio" type="radio" name="maker" value="gairai" onclick="formSwitch()"> 外来</label>
                <label><input class="uk-radio" type="radio" name="maker" value="renkei" onclick="formSwitch()"> 連携</label>
                <label><input class="uk-radio" type="radio" name="maker" value="sonota" onclick="formSwitch()"> その他</label>
            </div>
        </div>
    </div>

    <div class="uk-margin">
        <div id="zenken">
            <table  class="uk-table uk-table-small table-bordered">
                <tr>
                    <th>区分</th>
                    <th>部門名</th>
                    <th>電話番号</th>
                    <th>FAX番号</th>
                    <th>備考</th>
                </tr>
                <?php foreach($num_data as $key => $var):?>
                <tr>
                    <td><?php echo ($var['fie_div']);?></td>
                    <td><?php echo html_escape ($var['fie_name']);?></td>
                    <td><?php echo html_escape ($var['tel']);?></td>
                    <td><?php echo html_escape ($var['fax']);?></td>
                    <td><?php echo html_escape ($var['note']);?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        
        <div id="gairai">
            <table  class="uk-table uk-table-small table-bordered">
                <tr>
                    <th>区分</th>
                    <th>部門名</th>
                    <th>電話番号</th>
                    <th>FAX番号</th>
                    <th>備考</th>
                </tr>
                <?php foreach($num_data1 as $key => $var):?>
                <tr>
                    <td><?php echo html_escape ($var['fie_div']);?></td>
                    <td><?php echo html_escape ($var['fie_name']);?></td>
                    <td><?php echo html_escape ($var['tel']);?></td>
                    <td><?php echo html_escape ($var['fax']);?></td>
                    <td><?php echo html_escape ($var['note']);?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div id="renkei">
            <table  class="uk-table uk-table-small table-bordered">
                <tr>
                    <th>区分</th>
                    <th>部門名</th>
                    <th>電話番号</th>
                    <th>FAX番号</th>
                    <th>備考</th>
                </tr>
                <?php foreach($num_data2 as $key => $var):?>
                <tr>
                    <td><?php echo html_escape ($var['fie_div']);?></td>
                    <td><?php echo html_escape ($var['fie_name']);?></td>
                    <td><?php echo html_escape ($var['tel']);?></td>
                    <td><?php echo html_escape ($var['fax']);?></td>
                    <td><?php echo html_escape ($var['note']);?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div id="sonota">
            <table class="uk-table uk-table-small table-bordered">
                <tr>
                    <th>区分</th>
                    <th>部門名</th>
                    <th>電話番号</th>
                    <th>FAX番号</th>
                    <th>備考</th>
                </tr>
                <?php foreach($num_data3 as $key => $var):?>
                <tr>
                    <td><?php echo html_escape ($var['fie_div']);?></td>
                    <td><?php echo html_escape ($var['fie_name']);?></td>
                    <td><?php echo html_escape ($var['tel']);?></td>
                    <td><?php echo html_escape ($var['fax']);?></td>
                    <td><?php echo html_escape ($var['note']);?></td>
                </tr>
                <?php endforeach; ?>
                
            </table>
        </div>
    </div>
</div>


<div class="detail-section" id="to-note4"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
    <?php if( $var['note'] !== '' ) { echo nl2br(html_escape ($var['note'])); }else{ echo '<span class="uk-text-muted">' . '---' . '</span>'; } ?>
    </div>
</div>


<script type="text/javascript" src="filter_user.js"></script>
</div>
<!--櫻間ここまで-->
