
<?php
include("./control/department_control.php");    
//include("./header_detail.php"); 
?>
<?php
$hos_cd = $_GET['cd'];
foreach ($data as $key =>$var):
?>
    <div class="detail-section" id="to-BedReha">
    <h4>許可病床数・病棟種類・リハビリスタッフ</h4>
        <label>許可病床数</label><!-- 許可病床数 -->
        <input class="uk-input size-input-bed" name="bed" type="text" value="<?php if($var['bed'] !== '0'){ echo html_escape ($var['bed']);}?>">床 <?php //高橋20230331追加 病床数0 ?>
        
        <div uk-grid>
            <div><!--病棟種類-->
            <label>【 病棟種類 】</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="bed_main"  <?php if(($var['bed_main'])==='1'){ echo'checked' ;}?>> 一般病棟</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="bed_tre" <?php if(($var['bed_tre'])==='1'){ echo'checked' ;}?>> 療養病棟</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="bed_reh" <?php if(($var['bed_reh'])==='1'){ echo'checked' ;}?>> 回復期リハビリテーション病棟</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="bed_care" <?php if(($var['bed_care'])==='1'){ echo'checked' ;}?>> 地域包括ケア病棟</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="bed_tra" <?php if(($var['bed_tra'])==='1'){ echo'checked' ;}?>> 障害者病棟</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="bed_att" <?php if(($var['bed_att'])==='1'){ echo'checked' ;}?>> 緩和ケア病棟</label>
            </div>
            <div><!-- リハビリスタッフ -->
            <label>【 リハビリスタッフ 】</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="pt" <?php if(($var['pt'])==='1'){ echo'checked' ;}?>> 理学療法士</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="ot" <?php if(($var['ot'])==='1'){ echo'checked' ;}?>> 作業療法士</label><br>
                <label><input class="uk-checkbox" type="checkbox" name="st" <?php if(($var['st'])==='1'){ echo'checked' ;}?>> 言語聴覚士</label>
            </div>
        </div>
    </div>
    <div class="detail-section" id="to-week"><!-- 診療日・手術日・診療時間 -->
    <h4>診療日・手術日、診療時間</h4>

        <!-- 高橋0106 テーブルレイアウト変更 -->
        <table class="uk-table-small tbl-border">
            <tr>
                <th  rowspan="2"><!--*checkboxALL(すべて)-->
                    <label for="All">すべて</label><br>
                    <input type="checkbox" class="uk-checkbox" id="All">
                </th>

                <th colspan="2"><!--*checkboxALL(Mon)-->
                    <label for="Mon">月</label><br>
                    <input type="checkbox" class="uk-checkbox all" id="Mon" name="week[]">
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
                <th rowspan="2">
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
                <tr><!-- 午前 -->
                    <th>
                        <label for="All1"><i class="fas fa-calendar-alt"></i> 診療日</label><br>
                        <input type="checkbox" class="uk-checkbox all" id="All1">
                    </th>

                    <td><!-- 月AM -->
                    <input type="hidden" name="mon_am">   
                        <input type="checkbox" name="mon_am" value="●"<?php if(($var['mon_am'])==='●' || $var['mon_am']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis MONDAY" >
                    </td>
                    <td><!-- 月PM -->
                    <input type="hidden" name="mon_pm">
                        <input type="checkbox" name="mon_pm" value="●"<?php if(($var['mon_pm'])==='●' || $var['mon_pm']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis MONDAY" >
                    </td>

                    <td><!-- 火AM -->
                    <input type="hidden" name="tue_am">
                        <input type="checkbox" name="tue_am" value="●"<?php if(($var['tue_am'])==='●' || $var['tue_am']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis TUESDAY" >
                    </td>
                    <td><!-- 火PM -->
                    <input type="hidden" name="tue_pm">
                        <input type="checkbox" name="tue_pm" value="●"<?php if(($var['tue_pm'])==='●' || $var['tue_pm']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis TUESDAY" >
                    </td>

                    <td><!-- 水AM -->
                    <input type="hidden" name="wed_am">
                        <input type="checkbox" name="wed_am" value="●"<?php if(($var['wed_am'])==='●' || $var['wed_am']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis WEDNESDAY" >
                    </td>
                    <td><!-- 水PM -->
                    <input type="hidden" name="wed_pm">
                        <input type="checkbox" name="wed_pm" value="●"<?php if(($var['wed_pm'])==='●' || $var['wed_pm']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis WEDNESDAY" >
                    </td>

                    <td><!-- 木AM -->
                    <input type="hidden" name="thr_am">
                        <input type="checkbox" name="thr_am" value="●"<?php if(($var['thr_am'])==='●' || $var['thr_am']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis THURSDAY" >
                    </td>
                    <td><!-- 木PM -->
                    <input type="hidden" name="thr_pm">
                        <input type="checkbox" name="thr_pm" value="●"<?php if(($var['thr_pm'])==='●' || $var['thr_pm']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis THURSDAY" >
                    </td>

                    <td><!-- 金AM -->
                    <input type="hidden" name="fri_am">
                        <input type="checkbox" name="fri_am" value="●"<?php if(($var['fri_am'])==='●' || $var['fri_am']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis FRIDAY" >
                    </td>
                    <td><!-- 金PM -->
                    <input type="hidden" name="fri_pm">
                        <input type="checkbox" name="fri_pm" value="●"<?php if(($var['fri_pm'])==='●' || $var['fri_pm']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis FRIDAY" >
                    </td>

                    <td><!-- 土AM -->
                    <input type="hidden" name="sat_am">
                        <input type="checkbox" name="sat_am" value="●"<?php if(($var['sat_am'])==='●' || $var['sat_am']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis SATURDAY" >
                    </td>
                    <td><!-- 土PM -->
                    <input type="hidden" name="sat_pm">
                        <input type="checkbox" name="sat_pm" value="●"<?php if(($var['sat_pm'])==='●' || $var['sat_pm']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis SATURDAY" >
                    </td>

                    <td><!-- 日AM -->
                    <input type="hidden" name="sun_am">
                        <input type="checkbox" name="sun_am" value="●"<?php if(($var['sun_am'])==='●' || $var['sun_am']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis SUNDAY" >
                    </td>
                    <td><!-- 日PM -->
                    <input type="hidden" name="sun_pm">
                        <input type="checkbox" name="sun_pm" value="●"<?php if(($var['sun_pm'])==='●' || $var['sun_pm']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis SUNDAY" >
                    </td>

                    <td><!-- 祝日 -->
                    <input type="hidden" name="holiday">
                        <input type="checkbox" name="holiday" value="●"<?php if(($var['holiday'])==='●' || $var['holiday']==='★'){ echo'checked' ;}?> class="uk-checkbox all diagnosis HOLIDAY" >
                    </td>
                </tr>

            <!--
                手術日
            -->
                <tr>
                    <th>
                        <label for="All2"><i class="fas fa-calendar-check"></i> 手術日</label>
                        <br>
                        <input type="checkbox" class="uk-checkbox all" id="All2">
                    </th>

                    <td><!-- 月AM -->
                    <input type="hidden" name="mon_am1">   
                        <input type="checkbox" name="mon_am1" value="★"<?php if(($var['mon_am'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery MONDAY" >
                    </td>            
                    <td><!-- 月PM -->
                    <input type="hidden" name="mon_pm1">
                        <input type="checkbox" name="mon_pm1" value="★"<?php if(($var['mon_pm'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery MONDAY" >
                    </td>

                    <td><!-- 火AM -->
                    <input type="hidden" name="tue_am1">
                        <input type="checkbox" name="tue_am1" value="★"<?php if(($var['tue_am'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery TUESDAY" >
                    </td>
                    <td><!-- 火PM -->
                    <input type="hidden" name="tue_pm1">
                        <input type="checkbox" name="tue_pm1" value="★"<?php if(($var['tue_pm'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery TUESDAY" >
                    </td>

                    <td><!-- 水AM -->
                    <input type="hidden" name="wed_am1">
                        <input type="checkbox" name="wed_am1" value="★"<?php if(($var['wed_am'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery WEDNESDAY" >
                    </td>
                    <td><!-- 水PM -->
                    <input type="hidden" name="wed_pm1">
                        <input type="checkbox" name="wed_pm1" value="★"<?php if(($var['wed_pm'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery WEDNESDAY" >
                    </td>

                    <td><!-- 木AM -->
                    <input type="hidden" name="thr_am1">
                        <input type="checkbox" name="thr_am1" value="★"<?php if(($var['thr_am'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery THURSDAY" >
                    </td>
                    <td><!-- 木PM -->
                    <input type="hidden" name="thr_pm1">
                        <input type="checkbox" name="thr_pm1" value="★"<?php if(($var['thr_pm'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery THURSDAY" >
                    </td>

                    <td><!-- 金AM -->
                    <input type="hidden" name="fri_am1">
                        <input type="checkbox" name="fri_am1" value="★"<?php if(($var['fri_am'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery FRIDAY" >
                    </td>
                    <td><!-- 金PM -->
                    <input type="hidden" name="fri_pm1">
                        <input type="checkbox" name="fri_pm1" value="★"<?php if(($var['fri_pm'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery FRIDAY" >
                    </td>

                    <td><!-- 土AM -->
                    <input type="hidden" name="sat_am1">
                        <input type="checkbox" name="sat_am1" value="★"<?php if(($var['sat_am'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery SATURDAY" >
                    </td>
                    <td><!-- 土PM -->
                    <input type="hidden" name="sat_pm1">
                        <input type="checkbox" name="sat_pm1" value="★"<?php if(($var['sat_pm'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery SATURDAY" >
                    </td>

                    <td><!-- 日AM -->
                    <input type="hidden" name="sun_am1">
                        <input type="checkbox" name="sun_am1" value="★"<?php if(($var['sun_am'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery SUNDAY" >
                    </td>
                    <td><!-- 日PM -->
                    <input type="hidden" name="sun_pm1">
                        <input type="checkbox" name="sun_pm1" value="★"<?php if(($var['sun_pm'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery SUNDAY" >
                    </td>

                    <td><!-- 祝日 -->
                    <input type="hidden" name="holiday1">
                        <input type="checkbox" name="holiday1" value="★"<?php if(($var['holiday'])==='★'){ echo'checked' ;}?> class="uk-checkbox all surgery HOLIDAY" >
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
                        <textarea class="uk-textarea" name="con_hour" placeholder="例) 9:00~12:00" ><?php echo html_escape ($var['con_hour']);?></textarea>
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
            <div><!--ckbxALL-->
                <!--input type="checkbox" id=""><label for="">全選択</label-->
            </div>
            <ul class="js-filter uk-child-width-1-4@m uk-child-width-1-1@s " uk-grid>
                <li data-color="内科系"><span class="uk-h5">【内科系】</span>
                    <div class="uk-margin-small-left">
                        <?php foreach($dept_data as $var1){ ?>
                        <input type="hidden" name="<?php echo $var1['dep_cd'];?>">
                        <div>
                            <input type="checkbox" class="uk-checkbox" name="<?php echo $var1['dep_cd'];?>" id="<?php echo $var1['dep_cd'];?>" value="1" 
                            <?php if(($var[$var1['dep_cd']])==='1'){ echo'checked' ;}?>>
                            <label for="<?php echo $var1['dep_cd'];?>"><?php echo $var1['dep_name'];?></label>
                        </div>
                        <?php   } ?>
                    </div>
                </li>
                <li data-color="小児科系">
                    <span class="uk-h5">【小児科系】</span>
                    <div class="uk-margin-small-left">
                        <?php foreach($dept_data2 as $var1){ ?>
                        <input type="hidden" name="<?php echo $var1['dep_cd'];?>">
                            <input type="checkbox" class="uk-checkbox" name="<?php echo $var1['dep_cd'];?>" id="<?php echo $var1['dep_cd'];?>" value="1" 
                            <?php if(($var[$var1['dep_cd']])==='1'){ echo'checked' ;}?>>
                            <label for="<?php echo $var1['dep_cd'];?>"><?php echo $var1['dep_name'];?></label>
                        <br>
                        <?php   } ?>
                    </div>
                </li>
                <li data-color="外科系">
                    <span class="uk-h5">【外科系】</span>
                    <div class="uk-margin-small-left">
                        <?php foreach($dept_data3 as $var1){ ?>
                        <input type="hidden" name="<?php echo $var1['dep_cd'];?>">
                            <input type="checkbox" class="uk-checkbox" name="<?php echo $var1['dep_cd'];?>" id="<?php echo $var1['dep_cd'];?>" value="1" 
                            <?php if(($var[$var1['dep_cd']])==='1'){ echo'checked' ;}?>>
                            <label for="<?php echo $var1['dep_cd'];?>"><?php echo $var1['dep_name'];?></label>
                        <br>
                        <?php   } ?>
                    </div>
                </li>
                <li data-color="整形外科系">
                    <span class="uk-h5">【整形外科系】</span>
                    <div class="uk-margin-small-left">
                        <?php foreach($dept_data4 as $var1){ ?>
                        <input type="hidden" name="<?php echo $var1['dep_cd'];?>">
                            <input type="checkbox" class="uk-checkbox" name="<?php echo $var1['dep_cd'];?>" id="<?php echo $var1['dep_cd'];?>" value="1" 
                            <?php if(($var[$var1['dep_cd']])==='1'){ echo'checked' ;}?>>
                            <label for="<?php echo $var1['dep_cd'];?>"><?php echo $var1['dep_name'];?></label>
                        <br>
                        <?php   } ?>
                    </div>
                </li>
                <li data-color="眼科系">
                    <span class="uk-h5">【眼科系】</span>
                    <div class="uk-margin-small-left">
                        <?php foreach($dept_data5 as $var1){ ?>
                        <input type="hidden" name="<?php echo $var1['dep_cd'];?>">
                            <input type="checkbox" class="uk-checkbox" name="<?php echo $var1['dep_cd'];?>" id="<?php echo $var1['dep_cd'];?>" value="1" 
                            <?php if(($var[$var1['dep_cd']])==='1'){ echo'checked' ;}?>>
                            <label for="<?php echo $var1['dep_cd'];?>"><?php echo $var1['dep_name'];?></label>
                        <br>
                        <?php   } ?>
                    </div>
                </li>
                <li data-color="耳鼻咽喉科系">
                    <span class="uk-h5">【耳鼻咽喉科系】</span>
                    <div class="uk-margin-small-left">
                        <?php foreach($dept_data6 as $var1){ ?>
                        <input type="hidden" name="<?php echo $var1['dep_cd'];?>">
                            <input type="checkbox" class="uk-checkbox" name="<?php echo $var1['dep_cd'];?>" id="<?php echo $var1['dep_cd'];?>" value="1" 
                            <?php if(($var[$var1['dep_cd']])==='1'){ echo'checked' ;}?>>
                            <label for="<?php echo $var1['dep_cd'];?>"><?php echo $var1['dep_name'];?></label>
                        <br>
                        <?php   } ?>
                    </div>
                </li>
                <li data-color="皮膚科・泌尿器科系">
                    <span class="uk-h5">【皮膚科・泌尿器系】</span>
                    <div class="uk-margin-small-left">
                        <?php foreach($dept_data7 as $var1){ ?>
                        <input type="hidden" name="<?php echo $var1['dep_cd'];?>">
                            <input type="checkbox" class="uk-checkbox" name="<?php echo $var1['dep_cd'];?>" id="<?php echo $var1['dep_cd'];?>" value="1" 
                            <?php if(($var[$var1['dep_cd']])==='1'){ echo'checked' ;}?>>
                            <label for="<?php echo $var1['dep_cd'];?>"><?php echo $var1['dep_name'];?></label>
                        <br>
                        <?php   } ?>
                    </div>
                </li>
                <li data-color="産婦人科系">
                    <span class="uk-h5">【産婦人科系】</span>
                    <div class="uk-margin-small-left">
                        <?php foreach($dept_data8 as $var1){ ?>
                        <input type="hidden" name="<?php echo $var1['dep_cd'];?>">
                            <input type="checkbox" class="uk-checkbox" name="<?php echo $var1['dep_cd'];?>" id="<?php echo $var1['dep_cd'];?>" value="1" 
                            <?php if(($var[$var1['dep_cd']])==='1'){ echo'checked' ;}?>>
                            <label for="<?php echo $var1['dep_cd'];?>"><?php echo $var1['dep_name'];?></label>
                        <br>
                        <?php   } ?>
                    </div>
                </li>
                <li data-color="精神科系">
                    <span class="uk-h5">【精神科系】</span>
                    <div class="uk-margin-small-left">
                        <?php foreach($dept_data9 as $var1){ ?>
                        <input type="hidden" name="<?php echo $var1['dep_cd'];?>">
                            <input type="checkbox" class="uk-checkbox" name="<?php echo $var1['dep_cd'];?>" id="<?php echo $var1['dep_cd'];?>" value="1" 
                            <?php if(($var[$var1['dep_cd']])==='1'){ echo'checked' ;}?>>
                            <label for="<?php echo $var1['dep_cd'];?>"><?php echo $var1['dep_name'];?></label>
                        <br>
                        <?php   } ?>
                    </div>
                </li>
                <li data-color="歯科系">
                    <span class="uk-h5">【歯科系】</span>
                    <div class="uk-margin-small-left">
                        <?php foreach($dept_data10 as $var1){ ?>
                        <input type="hidden" name="<?php echo $var1['dep_cd'];?>">
                            <input type="checkbox" class="uk-checkbox" name="<?php echo $var1['dep_cd'];?>" id="<?php echo $var1['dep_cd'];?>" value="1" 
                            <?php if(($var[$var1['dep_cd']])==='1'){ echo'checked' ;}?>>
                            <label for="<?php echo $var1['dep_cd'];?>"><?php echo $var1['dep_name'];?></label>
                        <br>
                        <?php   } ?>
                    </div>
                </li>
                <li data-color="その他">
                    <span class="uk-h5">【その他】</span>
                    <div class="uk-margin-small-left">
                        <?php foreach($dept_data11 as $var1){ ?>
                        <input type="hidden" name="<?php echo $var1['dep_cd'];?>">
                            <input type="checkbox" class="uk-checkbox" name="<?php echo $var1['dep_cd'];?>" id="<?php echo $var1['dep_cd'];?>" value="1" 
                            <?php if(($var[$var1['dep_cd']])==='1'){ echo'checked' ;}?>>
                            <label for="<?php echo $var1['dep_cd'];?>"><?php echo $var1['dep_name'];?></label>
                        <br>
                        <?php   } ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="detail-section" id="to-note2"><!-- 備考 -->
    <h4>備考
        <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
        <textarea class="uk-textarea size-textarea-Notes" name="dep_note" rows="7" maxlength="1000"><?php  echo html_escape ($var['dep_note']); ?></textarea>
    </div>
<?php
endforeach;
?>
