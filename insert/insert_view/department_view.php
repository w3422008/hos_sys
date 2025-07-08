
<?php
include("./control/department_control.php");    
?>

    <div class="detail-section" id="to-BedReha">
    <h4>許可病床数・病棟種類・リハビリスタッフ</h4>
        <label>許可病床数</label><!-- 許可病床数 -->
        <input class="uk-input size-input-bed" name="bed" type="text" value="<?php if(isset($bed)){echo $bed; }?>">床
        
        <div class="uk-margin" uk-grid>
            <div><!--病棟種類-->
            <label>【 病棟種類 】</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="bed_main" <?php if(isset($bed_main)&&$bed_main=='1'){echo 'checked';}?> > 一般病棟</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="bed_tre" <?php if(isset($bed_tre)&&$bed_tre=='1'){echo 'checked';}?>> 療養病棟</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="bed_reh"  <?php if(isset($bed_reh)&&$bed_reh=='1'){echo 'checked';}?>> 回復期リハビリテーション病棟</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="bed_care"  <?php if(isset($bed_care)&&$bed_care=='1'){echo 'checked';}?>> 地域包括ケア病棟</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="bed_tra"  <?php if(isset($bed_tra)&&$bed_tra=='1'){echo 'checked';}?>> 障害者病棟</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="bed_att" <?php if(isset($bed_att)&&$bed_att=='1'){echo 'checked';}?> > 緩和ケア病棟</label>
            </div>
            <div><!-- リハビリスタッフ -->
            <label>【 リハビリスタッフ 】</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="pt" <?php if(isset($pt)&&$pt=='1'){echo 'checked';}?> > 理学療法士</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="ot"  <?php if(isset($ot)&&$ot=='1'){echo 'checked';}?>> 作業療法士</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="st"  <?php if(isset($st)&&$st=='1'){echo 'checked';}?>> 言語聴覚士</label>
            </div>
        </div>
    </div>
    <div class="detail-section" id="to-week"><!-- 診療日・手術日・診療時間 -->
    <h4>診療日・手術日、診療時間</h4>
        <!-- 高橋20230105 テーブルレイアウト変更 -->
        <table class="uk-table-small tbl-border">
            <tr>
                <th rowspan="2"><!--*checkboxALL(すべて)-->
                    <label for="All">すべて</label><br>
                    <input type="checkbox" class="uk-checkbox" id="All">
                </th>

                <th colspan="2"><!--*checkboxALL(Mon)-->
                    <label for="Mon">月</label><br>
                    <input type="checkbox" class="uk-checkbox all" id="Mon">
                </th>

                <th colspan="2"><!--*checkboxALL(Tue)-->
                    <label for="Tue">火</label><br>
                    <input type="checkbox" class="uk-checkbox all" id="Tue">
                </th>

                <th colspan="2"><!--*checkboxALL(Wed)-->
                    <label for="Wed">水</label><br>
                    <input type="checkbox" class="uk-checkbox all" id="Wed">
                </th>
                <th colspan="2"><!--*checkboxALL(Thu)-->
                    <label for="Thu">木</label><br>
                    <input type="checkbox" class="uk-checkbox all" id="Thu">
                </th>
                <th colspan="2"><!--*checkboxALL(Fri)-->
                    <label for="Fri">金</label><br>
                    <input type="checkbox" class="uk-checkbox all" id="Fri">
                </th>
                <th colspan="2"><!--*checkboxALL(Sat)-->
                    <label for="Sat">土</label><br>
                    <input type="checkbox" class="uk-checkbox all" id="Sat">
                </th>
                <th colspan="2"><!--*checkboxALL(Sun)-->
                    <label for="Sun">日</label><br>
                    <input type="checkbox" class="uk-checkbox all" id="Sun">
                </th>
                <th colspan="2" rowspan="2">
                    <label for="holiday">祝日</label><br>
                    <input type="checkbox" class="uk-checkbox all" id="Hol">
                </th>
            </tr>
            <tr>
                <td><!--*ckbxALL(月AM)-->
                    <label for="Mon_AM">AM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Mon_AM"-->
                </td>
                <td><!--*ckbxALL(月PM)-->
                    <label for="Mon_PM">PM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Mon_PM"-->
                </td>

                <td><!--*ckbxALL(火AM)-->
                    <label for="Tue_AM">AM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Tue_AM"-->
                </td>
                <td><!--*ckbxALL(火PM)-->
                    <label for="Tue_PM">PM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Tue_PM"-->
                </td>

                <td><!--*ckbxALL(水AM)-->
                    <label for="Wed_AM">AM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Wed_AM"-->
                </td>
                <td><!--*ckbxALL(水PM)-->
                    <label for="Wed_PM">PM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Wed_PM"-->
                </td>

                <td><!--*ckbxALL(木AM)-->
                    <label for="Thr_AM">AM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Thr_AM"-->
                </td>
                <td><!--*ckbxALL(木PM)-->
                    <label for="Thr_PM">PM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Thr_PM"-->
                </td>

                <td><!--*ckbxALL(金AM)-->
                    <label for="Fri_AM">AM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Fri_AM"-->
                </td>
                <td><!--*ckbxALL(金PM)-->
                    <label for="Fri_PM">PM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Fri_PM"-->
                </td>

                <td><!--*ckbxALL(土AM)-->
                    <label for="Sat_AM">AM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Sat_AM"-->
                </td>
                <td><!--*ckbxALL(土PM)-->
                    <label for="Sat_PM">PM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Sat_PM"-->
                </td>

                <td><!--*ckbxALL(日AM)-->
                    <label for="Sun_AM">AM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Sun_AM"-->
                </td>
                <td><!--*ckbxALL(日PM)-->
                    <label for="Sun_PM">PM</label><!--br>
                    <input type="checkbox" class="uk-checkbox all" id="Sun_PM"-->
                </td>

            </tr>

            <!--
                診療日
            -->

            <tr>
                <th>
                    <label for="All1"><i class="fas fa-calendar-alt"></i> 診療日</label><br>
                    <input type="checkbox" class="uk-checkbox all" id="All1">
                </th>

                <!-- 月 -->
                <td>
                <input type="hidden" name="mon_am">   
                    <input type="checkbox" name="mon_am" value="●" class="uk-checkbox all diagnosis MONDAY" <?php if((isset($mon_am)&&$mon_am=="●")||(isset($mon_a)&&$mon_a=="●")){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="mon_pm">
                    <input type="checkbox" name="mon_pm" value="●" class="uk-checkbox all diagnosis MONDAY" <?php if((isset($mon_pm)&&$mon_pm=="●")||(isset($mon_p)&&$mon_p=="●")){ echo'checked' ;}?>>
                </td>

                <!-- 火 -->
                <td>
                <input type="hidden" name="tue_am">
                    <input type="checkbox" name="tue_am" value="●" class="uk-checkbox all diagnosis TUESDAY" <?php if((isset($tue_am)&&$tue_am=="●")||(isset($tue_a)&&$tue_a=="●")){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="tue_pm">
                    <input type="checkbox" name="tue_pm" value="●" class="uk-checkbox all diagnosis TUESDAY"<?php if((isset($tue_pm)&&$tue_pm=="●")||(isset($tue_p)&&$tue_p=="●")){ echo'checked' ;}?> >
                </td>

                <!-- 水 -->
                <td>
                <input type="hidden" name="wed_am">
                    <input type="checkbox" name="wed_am" value="●" class="uk-checkbox all diagnosis WEDNESDAY" <?php if((isset($wed_am)&&$wed_am=="●")||(isset($wed_a)&&$wed_a=="●")){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="wed_pm">
                    <input type="checkbox" name="wed_pm" value="●" class="uk-checkbox all diagnosis WEDNESDAY" <?php if((isset($wed_pm)&&$wed_pm=="●")||(isset($wed_p)&&$wed_p=="●")){ echo'checked' ;}?>>
                </td>

                <!-- 木 -->
                <td>
                <input type="hidden" name="thr_am">
                    <input type="checkbox" name="thr_am" value="●" class="uk-checkbox all diagnosis THURSDAY" <?php if((isset($thr_am)&&$thr_am=="●")||(isset($thr_a)&&$thr_a=="●")){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="thr_pm">
                    <input type="checkbox" name="thr_pm" value="●" class="uk-checkbox all diagnosis THURSDAY" <?php if((isset($thr_pm)&&$thr_pm=="●")||(isset($thr_p)&&$thr_p=="●")){ echo'checked' ;}?>>
                </td>

                <!-- 金 -->
                <td>
                <input type="hidden" name="fri_am">
                    <input type="checkbox" name="fri_am" value="●" class="uk-checkbox all diagnosis FRIDAY" <?php if((isset($fri_am)&&$fri_am=="●")||(isset($fri_a)&&$fri_a=="●")){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="fri_pm">
                    <input type="checkbox" name="fri_pm" value="●" class="uk-checkbox all diagnosis FRIDAY" <?php if((isset($fri_pm)&&$fri_pm=="●")||(isset($fri_p)&&$fri_p=="●")){ echo'checked' ;}?>>
                </td>

                <!-- 土 -->
                <td>
                <input type="hidden" name="sat_am">
                    <input type="checkbox" name="sat_am" value="●" class="uk-checkbox all diagnosis SATURDAY" <?php if((isset($sat_am)&&$sat_am=="●")||(isset($sat_a)&&$sat_a=="●")){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="sat_pm">
                    <input type="checkbox" name="sat_pm" value="●" class="uk-checkbox all diagnosis SATURDAY" <?php if((isset($sat_pm)&&$sat_pm=="●")||(isset($sat_p)&&$sat_p=="●")){ echo'checked' ;}?>>
                </td>

                <!-- 日 -->
                <td>
                <input type="hidden" name="sun_am">
                    <input type="checkbox" name="sun_am" value="●" class="uk-checkbox all diagnosis SUNDAY" <?php if((isset($sun_am)&&$sun_am=="●")||(isset($sun_a)&&$sun_a=="●")){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="sun_pm">
                    <input type="checkbox" name="sun_pm" value="●" class="uk-checkbox all diagnosis SUNDAY" <?php if((isset($sun_pm)&&$sun_pm=="●")||(isset($sun_p)&&$sun_p=="●")){ echo'checked' ;}?>>
                </td>

                <!-- 祝日 -->
                <td>
                <input type="hidden" name="holiday">
                    <input type="checkbox" name="holiday" value="●"class="uk-checkbox all diagnosis HOLIDAY" <?php if((isset($holiday)&&$holiday=="●")||(isset($holida)&&$holida=="●")){ echo'checked' ;}?>>
                </td>
            </tr>


            <!--
                手術日
            -->
            <tr>
                <th>
                    <label for="All2">
                    <i class="fas fa-calendar-check"></i> 手術日
                    </label>
                    <br>
                    <input type="checkbox" class="uk-checkbox all" id="All2">
                </th>

                <!-- 月 -->
                <td>
                <input type="hidden" name="mon_am1">   
                    <input type="checkbox" name="mon_am1" value="★" class="uk-checkbox all surgery MONDAY" <?php if(isset($mon_am)&&$mon_am=="★"){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="mon_pm1">
                    <input type="checkbox" name="mon_pm1" value="★" class="uk-checkbox all surgery MONDAY" <?php if(isset($mon_pm)&&$mon_pm=="★"){ echo'checked' ;}?>>
                </td>

                <!-- 火 -->
                <td>
                <input type="hidden" name="tue_am1">
                    <input type="checkbox" name="tue_am1" value="★" class="uk-checkbox all surgery TUESDAY" <?php if(isset($tue_am)&&$tue_am=="★"){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="tue_pm1">
                    <input type="checkbox" name="tue_pm1" value="★" class="uk-checkbox all surgery TUESDAY"<?php if(isset($tue_pm)&&$tue_pm=="★"){ echo'checked' ;}?> >
                </td>

                <!-- 水 -->
                <td>
                <input type="hidden" name="wed_am1">
                    <input type="checkbox" name="wed_am1" value="★" class="uk-checkbox all surgery WEDNESDAY" <?php if(isset($wed_am)&&$wed_am=="★"){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="wed_pm1">
                    <input type="checkbox" name="wed_pm1" value="★" class="uk-checkbox all surgery WEDNESDAY" <?php if(isset($wed_pm)&&$wed_pm=="★"){ echo'checked' ;}?>>
                </td>

                <!-- 木 -->
                <td>
                <input type="hidden" name="thr_am1">
                    <input type="checkbox" name="thr_am1" value="★" class="uk-checkbox all surgery THURSDAY" <?php if(isset($thr_am)&&$thr_am=="★"){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="thr_pm1">
                    <input type="checkbox" name="thr_pm1" value="★" class="uk-checkbox all surgery THURSDAY" <?php if(isset($thr_pm)&&$thr_pm=="★"){ echo'checked' ;}?>>
                </td>

                <!-- 金 -->
                <td>
                <input type="hidden" name="fri_am1">
                    <input type="checkbox" name="fri_am1" value="★" class="uk-checkbox all surgery FRIDAY" <?php if(isset($fri_am)&&$fri_am=="★"){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="fri_pm1">
                    <input type="checkbox" name="fri_pm1" value="★" class="uk-checkbox all surgery FRIDAY" <?php if(isset($fri_pm)&&$fri_pm=="★"){ echo'checked' ;}?>>
                </td>

                <!-- 土 -->
                <td>
                <input type="hidden" name="sat_am1">
                    <input type="checkbox" name="sat_am1" value="★" class="uk-checkbox all surgery SATURDAY" <?php if(isset($sat_am)&&$sat_am=="★"){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="sat_pm1">
                    <input type="checkbox" name="sat_pm1" value="★" class="uk-checkbox all surgery SATURDAY" <?php if(isset($sat_pm)&&$sat_pm=="★"){ echo'checked' ;}?>>
                </td>

                <!-- 日 -->
                <td>
                <input type="hidden" name="sun_am1">
                    <input type="checkbox" name="sun_am1" value="★" class="uk-checkbox all surgery SUNDAY" <?php if(isset($sun_am)&&$sun_am=="★"){ echo'checked' ;}?>>
                </td>
                <td>
                <input type="hidden" name="sun_pm1">
                    <input type="checkbox" name="sun_pm1" value="★" class="uk-checkbox all surgery SUNDAY" <?php if(isset($sun_pm)&&$sun_pm=="★"){ echo'checked' ;}?>>
                </td>

                <!-- 祝日 -->
                <td>
                <input type="hidden" name="holiday1">
                    <input type="checkbox" name="holiday1" value="★"class="uk-checkbox all surgery HOLIDAY" <?php if(isset($holiday)&&$holiday=="★"){ echo'checked' ;}?>>
                </td>
            </tr>

            <!-- 
                診療時間
            -->
            <tr height="100">
                <th>
                    <span><i class="fas fa-clock"></i> 診療時間</span>
                </th>
                <td colspan="15">
                    <textarea class="uk-textarea" name="con_hour" placeholder="例) 9:00~12:00" ><?php if(isset($con_hour)){echo $con_hour; }?></textarea>
                </td>
            </tr>

        </table>
    </div>

    <div class="detail-section" id="to-Dept"><!-- 診療科 -->
    <h4>診療科</h4>
        <!--*Filter_dept-->
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
            <!--div>✅今後実装予定
                <input type="checkbox" id=""><label for="">全選択</label>
            </div-->
            <ul class="js-filter uk-child-width-1-4@m uk-child-width-1-1@s " uk-grid>
                <li data-color="内科系"><span class="uk-h5">【内科系】</span>
                    <div class="uk-margin-small-left">
                        <input type="hidden" name="int_int"><label>
                        <input type="checkbox" class="uk-checkbox" name="int_int" value="1" <?php if(isset($int_int)&&$int_int=='1'){ echo'checked' ;}?>>内科</label><br>

                        <input type="hidden" name="int_res"><label>
                        <input type="checkbox" class="uk-checkbox" name="int_res" value="1" <?php if(isset($int_res)&&$int_res=='1'){ echo'checked';}?>>呼吸器内科</label><br>

                        <input type="hidden" name="int_cir"><label>
                        <input type="checkbox" class="uk-checkbox" name="int_cir" value="1" <?php if(isset($int_cir)&&$int_cir=='1'){ echo'checked' ;}?>>循環器内科</label><br>

                        <input type="hidden" name="int_dig"><label>
                        <input type="checkbox" class="uk-checkbox" name="int_dig" value="1" <?php if(isset($int_dig)&&$int_dig=='1'){ echo'checked' ;}?>>消化器内科</label><br>

                        <input type="hidden" name="int_kid"><label>
                        <input type="checkbox" class="uk-checkbox" name="int_kid" value="1" <?php if(isset($int_kid)&&$int_kid=='1'){ echo'checked' ;}?>>腎臓内科</label><br>

                        <input type="hidden" name="int_ner"><label>
                        <input type="checkbox" class="uk-checkbox" name="int_ner" value="1" <?php if(isset($int_ner)&&$int_ner=='1'){ echo'checked' ;}?>>神経内科</label><br>

                        <input type="hidden" name="int_uri"><label>
                        <input type="checkbox" class="uk-checkbox" name="int_uri" value="1" <?php if(isset($int_uri)&&$int_uri=='1'){ echo'checked' ;}?>>糖尿病内科(代謝内科)</label><br>

                        <input type="hidden" name="int_blo"><label>
                        <input type="checkbox" class="uk-checkbox" name="int_blo" value="1" <?php if(isset($int_blo)&&$int_blo=='1'){ echo'checked' ;}?>>血液内科</label><br>

                        <input type="hidden" name="int_inf"><label>
                        <input type="checkbox" class="uk-checkbox" name="int_inf" value="1" <?php if(isset($int_inf)&&$int_inf=='1'){ echo'checked' ;}?>>感染症内科</label><br>

                        <input type="hidden" name="int_tum"><label>
                        <input type="checkbox" class="uk-checkbox" name="int_tum" value="1" <?php if(isset($int_tum)&&$int_tum=='1'){ echo'checked' ;}?>>臨床腫瘍科</label><br>

                        <input type="hidden" name="int_apo"><label>
                        <input type="checkbox" class="uk-checkbox" name="int_apo" value="1" <?php if(isset($int_apo)&&$int_apo=='1'){ echo'checked' ;}?>>脳卒中科</label><br>
                    </div>
                </li>
                <li data-color="小児科系">
                    <span class="uk-h5">【小児科系】</span>
                    <div class="uk-margin-small-left">
                        <input type="hidden" name="ped_ped"><label>
                        <input type="checkbox" class="uk-checkbox" name="ped_ped" value="1"<?php if(isset($ped_ped)&&$ped_ped=='1'){ echo'checked' ;}?>>小児科</label><br>
                        
                        <input type="hidden" name="ped_sur"><label>
                        <input type="checkbox" class="uk-checkbox" name="ped_sur" value="1"<?php if(isset($ped_sur)&&$ped_sur=='1'){ echo'checked' ;}?>>小児外科</label><br>
                        
                        <input type="hidden" name="ped_neo"><label>
                        <input type="checkbox" class="uk-checkbox" name="ped_neo" value="1"<?php if(isset($ped_neo)&&$ped_neo=='1'){ echo'checked' ;}?>>新生児科</label><br>
                    </div>
                </li>
                <li data-color="外科系">
                    <span class="uk-h5">【外科系】</span>
                    <div class="uk-margin-small-left">
                        <input type="hidden" name="sur_sur"><label>
                        <input type="checkbox" class="uk-checkbox" name="sur_sur" value="1"<?php if(isset($sur_sur)&&$sur_sur=='1'){
                            echo'checked' ;}?>>外科</label><br>
                        
                        <input type="hidden" name="sur_nes"><label>
                        <input type="checkbox" class="uk-checkbox" name="sur_nes" value="1"<?php if(isset($sur_nes)&&$sur_nes=='1'){
                            echo'checked' ;}?>>呼吸器外科</label><br>

                        <input type="hidden" name="sur_car"><label>
                        <input type="checkbox" class="uk-checkbox" name="sur_car" value="1"<?php if(isset($sur_car)&&$sur_car=='1'){
                            echo'checked' ;}?>>循環器外科(心臓･血管外科)<br>

                        <input type="hidden" name="sur_lac"><label>
                        <input type="checkbox" class="uk-checkbox" name="sur_lac" value="1"<?php if(isset($sur_lac)&&$sur_lac=='1'){
                            echo'checked' ;}?>>乳腺外科</label><br>
                        
                        <input type="hidden" name="sur_dig"><label>
                        <input type="checkbox" class="uk-checkbox" name="sur_dig" value="1"<?php if(isset($sur_dig)&&$sur_dig=='1'){
                            echo'checked' ;}?>>消化器外科</label><br>              
                        
                        <input type="hidden" name="sur_ven"><label>
                        <input type="checkbox" class="uk-checkbox" name="sur_ven" value="1"<?php if(isset($sur_ven)&&$sur_ven=='1'){
                            echo'checked' ;}?>>肛門外科</label><br>

                        <input type="hidden" name="sur_ner"><label>
                        <input type="checkbox" class="uk-checkbox" name="sur_ner" value="1"<?php if(isset($sur_ner)&&$sur_ner=='1'){
                            echo'checked' ;}?>>脳神経外科</label><br>
                    </div>
                </li>
                <li data-color="整形外科系">
                    <span class="uk-h5">【整形外科系】</span>
                    <div class="uk-margin-small-left">
                        <input type="hidden" name="ort_rhe"><label>
                        <input type="checkbox" class="uk-checkbox" name="ort_rhe" value="1"<?php if(isset($ort_rhe)&&$ort_rhe=='1'){
                            echo'checked' ;}?>>リウマチ科</label><br>

                        <input type="hidden" name="ort_ort"><label>
                        <input type="checkbox" class="uk-checkbox" name="ort_ort" value="1"<?php if(isset($ort_ort)&&$ort_ort=='1'){
                            echo'checked' ;}?>>整形外科</label><br>
                            
                        <input type="hidden" name="ort_pla"><label>
                        <input type="checkbox" class="uk-checkbox" name="ort_pla" value="1"<?php if(isset($ort_pla)&&$ort_pla=='1'){
                            echo'checked' ;}?>>形成外科</label><br>

                        <input type="hidden" name="ort_cos"><label>
                        <input type="checkbox" class="uk-checkbox" name="ort_cos" value="1"<?php if(isset($ort_cos)&&$ort_cos=='1'){
                            echo'checked' ;}?>>美容外科</label><br>
                        
                        <input type="hidden" name="ort_reh"><label>
                        <input type="checkbox" class="uk-checkbox" name="ort_reh" value="1"<?php if(isset($ort_reh)&&$ort_reh=='1'){
                            echo'checked' ;}?>>リハビリテーション科</label><br>
                    </div>
                </li>
                <li data-color="眼科系">
                    <span class="uk-h5">【眼科系】</span>
                    <div class="uk-margin-small-left">
                        <input type="hidden" name="oph_oph"><label>
                        <input type="checkbox" class="uk-checkbox" name="oph_oph" value="1"<?php if(isset($oph_oph)&&$oph_oph=='1'){
                            echo'checked' ;}?>>眼科</label><br>
                    </div>
                </li>
                <li data-color="耳鼻咽喉科系">
                    <span class="uk-h5">【耳鼻咽喉科系】</span>
                    <div class="uk-margin-small-left">
                        <input type="hidden" name="ent_ent"><label>
                        <input type="checkbox" class="uk-checkbox" name="ent_ent" value="1"<?php if(isset($ent_ent)&&$ent_ent=='1'){
                            echo'checked' ;}?>>耳鼻いんこう科</label><br>

                        <input type="hidden" name="ent_to"><label>
                        <input type="checkbox" class="uk-checkbox" name="ent_to" value="1"<?php if(isset($ent_to)&&$ent_to=='1'){
                            echo'checked' ;}?>>気管食道科</label><br>
                    </div>
                </li>
                <li data-color="皮膚科・泌尿器科系">
                    <span class="uk-h5">【皮膚科・泌尿器系】</span>
                    <div class="uk-margin-small-left">
                        <input type="hidden" name="so_sky"><label>
                        <input type="checkbox" class="uk-checkbox" name="so_sky" value="1"<?php if(isset($so_sky)&&$so_sky=='1'){
                            echo'checked' ;}?>>皮膚科</label><br>

                        <input type="hidden" name="so_org"><label>
                        <input type="checkbox" class="uk-checkbox" name="so_org" value="1"<?php if(isset($so_org)&&$so_org=='1'){
                            echo'checked' ;}?>>泌尿器科</label><br>
                    </div> 
                </li>
                <li data-color="産婦人科系">
                    <span class="uk-h5">【産婦人科系】</span>
                    <div class="uk-margin-small-left">
                        <input type="hidden" name="gyn_gyn"><label>
                        <input type="checkbox" class="uk-checkbox" name="gyn_gyn" value="1"<?php if(isset($gyn_gyn)&&$gyn_gyn=='1'){
                            echo'checked' ;}?>>産婦人科</label><br>
                        
                        <input type="hidden" name="gyn_obs"><label>
                        <input type="checkbox" class="uk-checkbox" name="gyn_obs" value="1"<?php if(isset($gyn_obs)&&$gyn_obs=='1'){
                            echo'checked' ;}?>>産科</label><br>
                        
                        <input type="hidden" name="gyn_gyne"><label>
                        <input type="checkbox" class="uk-checkbox" name="gyn_gyne" value="1"<?php if(isset($gyn_gyne)&&$gyn_gyne=='1'){
                            echo'checked' ;}?>>婦人科</label><br>
                    </div> 
                </li>
                <li data-color="精神科系">
                    <span class="uk-h5">【精神科系】</span>
                    <div class="uk-margin-small-left">
                        <input type="hidden" name="psy_psy"><label>
                        <input type="checkbox" class="uk-checkbox" name="psy_psy" value="1"<?php if(isset($psy_psy)&&$psy_psy=='1'){
                            echo'checked' ;}?>>精神科</label><br>
                    
                        <input type="hidden" name="psy_psyc"><label>
                        <input type="checkbox" class="uk-checkbox" name="psy_psyc" value="1"<?php if(isset($psy_psyc)&&$psy_psyc=='1'){
                            echo'checked' ;}?>>心療内科</label><br>
                    </div>
                </li>
                <li data-color="歯科系">
                    <span class="uk-h5">【歯科系】</span>
                    <div class="uk-margin-small-left">
                        <input type="hidden" name="den_den"><label>
                        <input type="checkbox" class="uk-checkbox" name="den_den" value="1"<?php if(isset($den_den)&&$den_den=='1'){
                            echo'checked' ;}?>>歯科</label><br>
                        
                        <input type="hidden" name="den_ref"><label>
                        <input type="checkbox" class="uk-checkbox" name="den_ref" value="1"<?php if(isset($den_ref)&&$den_ref=='1'){
                            echo'checked' ;}?>>矯正歯科</label><br>
                        
                        <input type="hidden" name="den_ped"><label>
                        <input type="checkbox" class="uk-checkbox" name="den_ped" value="1"<?php if(isset($den_ped)&&$den_ped=='1'){
                            echo'checked' ;}?>>小児歯科</label><br>

                        <input type="hidden" name="den_cav"><label>
                        <input type="checkbox" class="uk-checkbox" name="den_cav" value="1"<?php if(isset($den_cav)&&$den_cav=='1'){
                            echo'checked' ;}?>>歯科口腔外科</label><br>
                    </div>
                </li>
                <li data-color="その他">
                    <span class="uk-h5">【その他】</span>
                    <div class="uk-margin-small-left">
                        <input type="hidden" name="alle"><label>
                        <input type="checkbox" class="uk-checkbox" name="alle" value="1"<?php if(isset($alle)&&$alle=='1'){
                            echo'checked' ;}?>>アレルギー科</label><br>

                        <input type="hidden" name="rad"><label>
                        <input type="checkbox" class="uk-checkbox" name="rad" value="1"<?php if(isset($rad)&&$rad=='1'){
                            echo'checked' ;}?>>放射線科</label><br>

                        <input type="hidden" name="ane"><label>
                        <input type="checkbox" class="uk-checkbox" name="ane" value="1"<?php if(isset($ane)&&$ane=='1'){
                            echo'checked' ;}?>>麻酔科</label><br>

                        <input type="hidden" name="pat"><label>
                        <input type="checkbox" class="uk-checkbox" name="pat" value="1"<?php if(isset($pat)&&$pat=='1'){
                            echo'checked' ;}?>>病理診断科</label><br>
                        
                        <input type="hidden" name="cli"><label>
                        <input type="checkbox" class="uk-checkbox" name="cli" value="1"<?php if(isset($cli)&&$cli=='1'){
                            echo'checked' ;}?>>臨床検査科</label><br>

                        <input type="hidden" name="eme"><label>
                        <input type="checkbox" class="uk-checkbox" name="eme" value="1"<?php if(isset($eme)&&$eme=='1'){
                            echo'checked' ;}?>>救急科</label><br>
                        
                        <input type="hidden" name="checkup"><label>
                        <input type="checkbox" class="uk-checkbox" name="checkup" value="1"<?php if(isset($checkup)&&$checkup=='1'){
                            echo'checked' ;}?>>健康診断</label><br>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="detail-section" id="to-note2"><!-- 備考 -->
    <h4>備考
        <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
        <textarea class="uk-textarea size-textarea-Notes" name="dep_note" rows="7" maxlength="1000"><?php if(isset($dep_note)){echo $dep_note;} ?></textarea>
    </div>

