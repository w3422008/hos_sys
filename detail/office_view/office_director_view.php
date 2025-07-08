
<?php
include("./control/director_control.php");   
//include("./header_detail.php"); 
$hos_cd = $_GET['cd'];
?> 

<?php foreach ($drct_data1 as $key => $var):?>
    <!--櫻間ここから-->
    <div class="detail-section" id="to-Chi"><!-- 理事長 -->
    <h4>理事長</h4>
        <table class="uk-table">
            <!-- **理事長 氏名//chi_name【データあり】 -->
                <tr>
                    <th>氏名</th>
                    <td><?php echo html_escape ($var['chi_name']);?></td>
                </tr>
            <!-- **理事長 専門科//chi_spe【データあり】 -->
                <tr>
                    <th>専門科</th>
                    <td><?php echo html_escape ($var['chi_spe']);?></td>
                </tr>
            <!-- **理事長 卒年//chi_year【データあり】 -->
                <tr>
                    <th>卒年</th>
                    <td><?php echo html_escape ($var['chi_year']);?></td>
                </tr>

            <!-- **理事長 出身校//chi_sch【データあり】 -->
                <tr>
                    <th>出身校</th>
                    <td><?php echo html_escape ($var['chi_sch']);?></td>
                </tr>

            <!-- **理事長 備考//chi_note【データあり】 -->
                <tr>
                    <th>備考</th>
                    <td><?php echo html_escape ($var['chi_note']);?></td>
                </tr>
        </table>
    </div>

    <div class="detail-section" id="to-Pre"><!-- 病院長 -->
    <h4>病院長</h4>
        <table class="uk-table">
            <!-- **病院長 氏名//pre_name【データあり】 -->
                <tr>
                    <th>氏名</th>
                    <td><?php echo html_escape ($var['pre_name']);?></td>
                </tr>

            <!-- **病院長 専門科//pre_spe【データあり】 -->
                <tr>
                    <th>専門科</th>
                    <td><?php echo html_escape ($var['pre_spe']);?></td>
                </tr>

            <!-- **病院長 卒年//pre_year【データあり】 -->
                <tr>
                    <th>卒年</th>
                    <td><?php echo html_escape ($var['pre_year']);?></td>
                </tr>

            <!-- **病院長 出身校//pre_sch【データあり】 -->
                <tr>
                    <th>出身校</th>
                    <td><?php echo html_escape ($var['pre_sch']);?></td>
                </tr>

            <!-- **病院長 備考//pre_note【データあり】 -->
                <tr>
                    <th>備考</th>
                    <td><?php echo html_escape ($var['pre_note']);?></td>
                </tr>
        </table>
    </div>
<?php endforeach;?>
 

<div class="detail-section" id="to-relative"><!-- 親族情報 -->
<h4>親族情報</h4>
    <table  class="uk-table table-bordered" >
        <tr>
            <th>氏名</th>
            <th>続柄</th>
            <th>学校名</th>
            <th>入学年</th>
            <th>卒業年</th>
            <th>備考</th>
        </tr>
        <?php 
            foreach($drct_data2 as $key=>$var): 
                //高橋20230113  年度が0000のとき
                if($var['ent_year']==='0000'){$var['ent_year']=null;}
                if($var['gra_year']==='0000'){$var['gra_year']=null;}
        ?>
        <tr>
            <td class="uk-form-controls"><!-- 氏名 -->
            <?php echo html_escape ($var['name']);?>
            </td>

            <td class="uk-form-controls"><!-- 続柄[プルダウン] -->
            <?php echo html_escape ($var['conn']);?>

            </td>
            <td class="uk-form-controls"><!-- 学校名[プルダウン] -->
            <?php echo html_escape ($var['sch_name']);?>

            </td>
            <td class="uk-form-controls"><!-- 入学年 -->
            <?php echo html_escape ($var['ent_year']);?>
            </td>
            <td class="uk-form-controls"><!-- 卒業年 -->
            <?php echo html_escape ($var['gra_year']);?>
            </td>
            <td class="uk-form-controls"><!-- 備考 -->
            <?php echo html_escape ($var['note']);?>
                
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="detail-section" id="to-note3"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
    <?php foreach($data as $var): ?>
        <?php if( $var['drct_note'] !== null ) { echo nl2br(html_escape ($var['drct_note'])); }else{ echo '<span class="uk-text-muted">' . '---' . '</span>'; } ?>
    <?php endforeach; ?>
    </div>
</div>
<!--櫻間ここまで-->

