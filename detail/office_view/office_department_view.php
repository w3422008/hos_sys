<!--櫻間ここから-->
<?php
include("./control/department_control.php");    
//include("./header_detail.php"); 
?>



<div class="detail-section" id="to-BedReha">
    <h4>許可病床数・病棟種類・リハビリスタッフ</h4>
        <label>許可病床数</label><!-- 許可病床数 -->
        <span>
            <?php 
            if($var['bed'] !== ''){ //高橋20230331修正
                //高橋20230331追加 病床数0ここから
			    if($var['bed']==='0'){
                    $var['bed']='---';
                }else{
                    echo $var['bed']; 
                } 
                //高橋20230331追加 病床数0ここまで
            }else{ 
                echo'---'; } ?>床
        </span>

        
        <div uk-grid>
            <div><!--病棟種類-->
            <label>【 病棟種類 】</label>
            <ul>
                <?php if(($var['bed_main'])==='1'){ ?>
                    <li>一般病棟</li>
                <?php }?>
                <?php if(($var['bed_tre'])==='2'){ ?>
                    <li>療養病棟</li>
                <?php }?>
                <?php if(($var['bed_reh'])==='3'){ ?>
                    <li>回復リハビリテーション病棟</li>
                <?php }?>
                <?php if(($var['bed_care'])==='4'){ ?>
                    <li>地域包括ケア病棟</li>
                <?php }?>
                <?php if(($var['bed_tra'])==='5'){ ?>
                    <li>障害者病棟</li>
                <?php }?>
                <?php if(($var['bed_att'])==='6'){ ?>
                    <li>暖和ケア病棟</li>
                <?php }?>
            </ul>   
            </div>
            <div><!-- リハビリスタッフ -->
            <label>【 リハビリスタッフ 】</label>
            <ul>
                <?php if(($var['pt'])==='1'){ ?>
                    <li>理学療法士</li>
                <?php }?>

                <?php if(($var['ot'])==='1'){ ?>
                    <li>作業療法士</li>
                <?php }?>

                <?php if(($var['st'])==='1'){ ?>
                    <li>言語聴覚士</li>
                <?php }?>
            </ul>
            </div>
        </div>
    </div>
    <div class="detail-section" id="to-week"><!-- 診療日・手術日・診療時間 -->
    <h4>診療日・手術日、診療時間</h4>
        <!-- 高橋2023106 テーブルレイアウト変更 -->
        <table class="uk-table-small tbl-border">
            <tr>
                <th rowspan="3">
                    <label for="diagnosis"><i class="fas fa-calendar-alt"></i> 診療日・手術日</label><br>
                </th>

                <th></th>

                <th>
                    <label for="Mon">月</label>
                </th>

                <th>
                    <label for="Tue">火</label>
                </th>

                <th>
                    <label for="Wed">水</label>
                </th>
                <th>
                    <label for="Thu">木</label>
                </th>
                <th>
                    <label for="Fri">金</label>
                </th>
                <th>
                    <label for="Sat">土</label>
                </th>
                <th>
                    <label for="Sun">日</label>
                </th>
                <th>
                    <label for="holiday">祝日</label>
                </th>
            </tr>

            <!--
                診療日・手術日
            -->

            <?php
            //櫻間20230404

    if(($var['mon_am'] !== '●')&&($var['mon_pm'] !== '●')&&($var['tue_am'] !== '●')&&($var['tue_pm'] !== '●')&&($var['wed_am'] !== '●')&&($var['wed_pm'] !== '●')&&($var['thr_am'] !== '●')&&($var['thr_pm'] !== '●')&&($var['fri_am'] !== '●')&&($var['fri_pm'] !== '●')&&($var['sat_am'] !== '●')&&($var['sat_pm'] !== '●')&&($var['sun_am'] !== '●')&&($var['sun_am'] !== '●')&&($var['sun_pm'] !== '●')&&($var['holiday'] !== '●')&&($var['mon_am'] !== '★')&&($var['mon_pm'] !== '★')&&($var['tue_am'] !== '★')&&($var['tue_pm'] !== '★')&&($var['wed_am'] !== '★')&&($var['wed_pm'] !== '★')&&($var['thr_am'] !== '★')&&($var['thr_pm'] !== '★')&&($var['fri_am'] !== '★')&&($var['fri_pm'] !== '★')&&($var['sat_am'] !== '★')&&($var['sat_pm'] !== '★')&&($var['sun_am'] !== '★')&&($var['sun_am'] !== '★')&&($var['sun_pm'] !== '★')&&($var['holiday'] !== '★')){
                //$d[] = 'データなし'; //全部×のテーブルに
            ?>

                <tr><!-- 午前 -->
                    <th>
                        <label for="all_am">AM</label>
                    </th>
                    <td><!-- 月AM -->
                        -
                    </td>
                    <td><!-- 火AM -->
                        -
                    </td>
                    <td><!-- 水AM -->
                        -
                    </td>
                    <td><!-- 木AM -->
                        -
                    </td>
                    <td><!-- 金AM -->
                        -
                    </td>
                    <td><!-- 土AM -->
                        -
                    </td>
                    <td><!-- 日AM -->
                        -
                    </td>
                    <td rowspan="2"><!-- 祝日 -->
                        -
                    </td>
                </tr>
                <tr><!-- 午後 -->
                    <th>
                        <label for="all_pm">PM</label>
                    </th>
                    <td><!-- 月PM -->
                        -
                    </td>
                    <td><!-- 火PM -->
                        -
                    </td>
                    <td><!-- 水PM -->
                        -
                    </td>
                    <td><!-- 木PM -->
                        -
                    </td>
                    <td><!-- 金PM -->
                        -
                    </td>
                    <td><!-- 土PM -->
                        -
                    </td>
                    <td><!-- 日PM -->
                        -
                    </td>
                </tr>

            <?php }else{ ?>
                <tr>
                <!-- 午前 -->
                    <th>
                        <label for="all_am">AM</label>
                    </th>
                    <td><!-- 月AM -->

                        <?php if(($var['mon_am'])==='●'){ echo'○' ;}elseif($var['mon_am'] === '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                    <td><!-- 火AM -->
                        <?php if(($var['tue_am'])==='●'){ echo'○' ;}elseif($var['tue_am'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                    <td><!-- 水AM -->
                        <?php if(($var['wed_am'])==='●'){ echo'○' ;}elseif($var['wed_am'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                    <td><!-- 木AM -->
                        <?php if(($var['thr_am'])==='●'){ echo'○' ; }elseif($var['thr_am'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                    <td><!-- 金AM -->
                        <?php if(($var['fri_am'])==='●'){ echo'○' ;}elseif($var['fri_am'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                    <td><!-- 土AM -->
                        <?php if(($var['sat_am'])==='●'){ echo'○' ;}elseif($var['sat_am'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                    <td><!-- 日AM -->
                        <?php if(($var['sun_am'])==='●'){ echo'○' ;}elseif($var['sun_am'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                    <td rowspan="2"><!-- 祝日 -->
                        <?php if(($var['holiday'])==='●'){ echo'○' ;}elseif($var['holiday'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                </tr>
                <tr><!-- 午後 -->
                    <th>
                        <label for="all_pm">PM</label>
                    </th>
                    <td><!-- 月PM -->
                        <?php if(($var['mon_pm'])==='●'){ echo'○' ;}elseif($var['mon_pm'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                    <td><!-- 火PM -->
                        <?php if(($var['tue_pm'])==='●'){ echo'○' ;}elseif($var['tue_pm'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                    <td><!-- 水PM -->
                        <?php if(($var['wed_pm'])==='●'){ echo'○' ;}elseif($var['wed_pm'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                    <td><!-- 木PM -->
                        <?php if(($var['thr_pm'])==='●'){ echo'○' ;}elseif($var['thr_pm'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                    <td><!-- 金PM -->
                        <?php if(($var['fri_pm'])==='●'){ echo'○' ;}elseif($var['fri_pm'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                    <td><!-- 土PM -->
                        <?php if(($var['sat_pm'])==='●'){ echo'○' ;}elseif($var['sat_pm'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                    <td><!-- 日PM -->
                        <?php if(($var['sun_pm'])==='●'){ echo'○' ;}elseif($var['sun_pm'] == '★'){echo '★';}else{ echo'×' ; }?>
                    </td>
                </tr>
            <?php } 
                //櫻間
            ?>




            <!-- 
                診療時間
            -->
                <tr height="100">
                    <th>
                        <span><i class="fas fa-clock"></i> 診療時間</span>
                    </th>
                    <td colspan="15"><!-- 高橋20230331追加 診療時間 文字左上寄せ -->
                    <textarea class="uk-textarea" readonly><?php if($var['con_hour'] !== ''){ echo ($var['con_hour']); }else{ echo'データなし'; } ?></textarea>
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
            <ul class="js-filter uk-child-width-1-4@m uk-child-width-1-1@s " uk-grid>
                <li data-color="内科系"><span class="uk-h5">【内科系】</span>
                    <div class="uk-margin-small-left">
                    <ul>
                        <?php 
                        foreach($dept_data as $var1): 
                            if(($var[$var1['dep_cd']])==='1'){ ?>
                            <li><?php echo $var1['dep_name'];?></li>
                        <?php 
                            }
                        endforeach; 
                        ?>        
                    </ul>
                    </div>
                </li>
                <li data-color="小児科系">
                    <span class="uk-h5">【小児科系】</span>
                    <div class="uk-margin-small-left">
                    <ul>
                        <?php 
                        foreach($dept_data2 as $var1): 
                            if(($var[$var1['dep_cd']])==='1'){ ?>
                            <li><?php echo $var1['dep_name'];?></li>
                        <?php 
                            }
                        endforeach; 
                        ?>        
                    </ul>
                    </div>
                </li>
                <li data-color="外科系">
                    <span class="uk-h5">【外科系】</span>
                    <div class="uk-margin-small-left">
                    <ul>
                        <?php 
                        foreach($dept_data3 as $var1): 
                            if(($var[$var1['dep_cd']])==='1'){ ?>
                            <li><?php echo $var1['dep_name'];?></li>
                        <?php 
                            }
                        endforeach; 
                        ?>        
                    </ul>
                    </div>
                </li>
                <li data-color="整形外科系">
                    <span class="uk-h5">【整形外科系】</span>
                    <div class="uk-margin-small-left">
                    <ul>
                        <?php 
                        foreach($dept_data4 as $var1): 
                            if(($var[$var1['dep_cd']])==='1'){ ?>
                            <li><?php echo $var1['dep_name'];?></li>
                        <?php 
                            }
                        endforeach; 
                        ?>        
                    </ul>
                    </div>
                </li>
                <li data-color="眼科系">
                    <span class="uk-h5">【眼科系】</span>
                    <div class="uk-margin-small-left">
                    <ul>
                        <?php 
                        foreach($dept_data5 as $var1): 
                            if(($var[$var1['dep_cd']])==='1'){ ?>
                            <li><?php echo $var1['dep_name'];?></li>
                        <?php 
                            }
                        endforeach; 
                        ?>        
                    </ul>
                    </div>
                </li>
                <li data-color="耳鼻咽喉科系">
                    <span class="uk-h5">【耳鼻咽喉科系】</span>
                    <div class="uk-margin-small-left">
                    <ul>
                        <?php 
                        foreach($dept_data6 as $var1): 
                            if(($var[$var1['dep_cd']])==='1'){ ?>
                            <li><?php echo $var1['dep_name'];?></li>
                        <?php 
                            }
                        endforeach; 
                        ?>        
                    </ul>
                    </div>
                </li>
                <li data-color="皮膚科・泌尿器科系">
                    <span class="uk-h5">【皮膚科・泌尿器系】</span>
                    <div class="uk-margin-small-left">
                    <ul>
                        <?php 
                        foreach($dept_data7 as $var1): 
                            if(($var[$var1['dep_cd']])==='1'){ ?>
                            <li><?php echo $var1['dep_name'];?></li>
                        <?php 
                            }
                        endforeach; 
                        ?>        
                    </ul>
                    </div>
                </li>
                <li data-color="産婦人科系">
                    <span class="uk-h5">【産婦人科系】</span>
                    <div class="uk-margin-small-left">
                    <ul>
                        <?php 
                        foreach($dept_data8 as $var1): 
                            if(($var[$var1['dep_cd']])==='1'){ ?>
                            <li><?php echo $var1['dep_name'];?></li>
                        <?php 
                            }
                        endforeach; 
                        ?>        
                    </ul>
                    </div>
                </li>
                <li data-color="精神科系">
                    <span class="uk-h5">【精神科系】</span>
                    <div class="uk-margin-small-left">
                    <ul>
                        <?php 
                        foreach($dept_data9 as $var1): 
                            if(($var[$var1['dep_cd']])==='1'){ ?>
                            <li><?php echo $var1['dep_name'];?></li>
                        <?php 
                            }
                        endforeach; 
                        ?>        
                    </ul>
                    </div>
                </li>
                <li data-color="歯科系">
                    <span class="uk-h5">【歯科系】</span>
                    <div class="uk-margin-small-left">
                    <ul>
                        <?php 
                        foreach($dept_data10 as $var1): 
                            if(($var[$var1['dep_cd']])==='1'){ ?>
                            <li><?php echo $var1['dep_name'];?></li>
                        <?php 
                            }
                        endforeach; 
                        ?>        
                    </ul>
                    </div>
                </li>
                <li data-color="その他">
                    <span class="uk-h5">【その他】</span>
                    <div class="uk-margin-small-left">
                    <ul>
                        <?php 
                        foreach($dept_data11 as $var1): 
                            if(($var[$var1['dep_cd']])==='1'){ ?>
                            <li><?php echo $var1['dep_name'];?></li>
                        <?php 
                            }
                        endforeach; 
                        ?>        
                    </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>


    <div class="detail-section" id="to-note2"><!-- 備考 -->
    <h4>備考
        <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
        <div class="uk-form-controls">
        <?php if( $var['note'] !== '' ) { echo nl2br(html_escape ($var['note'])); }else{ echo '<span class="uk-text-muted">' . '---' . '</span>'; } ?>
        </div>
    </div>
