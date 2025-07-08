<!--櫻間-->

    <div class="uk-margin">
        <label class="uk-form-label" for="form-h-text">許可病床数：</label>
        <span><?php echo $bed;?>床</span>
    </div>
    <div class="uk-margin" uk-grid>
        <div><!--病棟種類-->
            <label class="uk-form-label" for="form-h-text">【 病棟種類 】</label>
            <ul>
                <?php if(!empty($bed_main)){ ?>
                    <li><?php echo'一般病棟' ;}?></li>
                <?php if(!empty($bed_tre)){ ?>
                    <li><?php echo'療養病棟' ;}?></li>
                <?php if(!empty($bed_reh)){ ?>
                    <li><?php  echo'回復リハビリテーション病棟' ;}?></li>
                <?php if(!empty($bed_care)){ ?>
                    <li><?php echo'地域包括ケア病棟' ;}?></li>
                <?php if(!empty($bed_tra)){ ?>
                    <li><?php echo'障害者病棟' ;}?></li>
                <?php if(!empty($bed_att)){ ?>
                    <li><?php echo'暖和ケア病棟' ;}?></li>
            </ul>
        </div>

        <div><!--リハビリスタッフ-->
            <label class="uk-form-label" for="form-h-text">【 リハビリスタッフ 】</label>
            <ul>
                <?php if(!empty($pt)){?>
                    <li><?php echo'理学療法士' ;}?></li>
                <?php if(!empty($ot)){ ?>
                    <li><?php echo'作業療法士' ;}?></li>
                <?php if(!empty($st)){ ?>
                    <li><?php echo'言語聴覚士' ;}?></li>
            </ul>
        </div>
    </div>


    
<br>

<fieldset class="uk-fieldset">
<legend class="uk-legend"><span uk-icon="triangle-right"></span> 診療時間</legend>
    <div class="uk-margin"><!--診療時間-->
        <span><?php echo ($con_hour);?></span>
    </div>


</fieldset>
<br>

<fieldset class="uk-fieldset">
<legend class="uk-legend"><span uk-icon="triangle-right"></span> 診療日・手術日</legend>
<div class="uk-margin"><!--診療日・手術日-->
    <div class="uk-width-auto uk-overflow-auto">
    <table class="uk-table-small table-bordered">
        <tr>
            <th> </th>
            <th>月</th>
            <th>火</th>
            <th>水</th>
            <th>木</th>
            <th>金</th>
            <th>土</th>
            <th>日</th>
            <th>祝日</th>
        </tr>
        <tr>
            <th>AM</th>
            <td><?php if(($mon_am)==='●'){ echo '○';}elseif(($mon_am)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
            <td><?php if(($tue_am)==='●'){ echo '○';}elseif(($tue_am)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
            <td><?php if(($wed_am)==='●'){ echo '○';}elseif(($wed_am)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
            <td><?php if(($thr_am)==='●'){ echo '○';}elseif(($thr_am)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
            <td><?php if(($fri_am)==='●'){ echo '○';}elseif(($fri_am)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
            <td><?php if(($sat_am)==='●'){ echo '○';}elseif(($sat_am)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
            <td><?php if(($sun_am)==='●'){ echo '○';}elseif(($sun_am)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
            <td rowspan="2"><?php if(($holiday)==='●'){ echo '○';}elseif(($holiday)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
        </tr>

        <tr>
            <th>PM</th>
            <td><?php if(($mon_pm)==='●'){ echo '○';}elseif(($mon_pm)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
            <td><?php if(($tue_pm)==='●'){ echo '○';}elseif(($tue_pm)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
            <td><?php if(($wed_pm)==='●'){ echo '○';}elseif(($wed_pm)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
            <td><?php if(($thr_pm)==='●'){ echo '○';}elseif(($thr_pm)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
            <td><?php if(($fri_pm)==='●'){ echo '○';}elseif(($fri_pm)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
            <td><?php if(($sat_pm)==='●'){ echo '○';}elseif(($sat_pm)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
            <td><?php if(($sun_pm)==='●'){ echo '○';}elseif(($sun_pm)==='★'){  echo '★';} else{  echo'×' ;} ?></td>
        </tr>
    </table>
    </div>
</div>


    <br>


<fieldset class="uk-fieldset">
<legend class="uk-legend"><span uk-icon="triangle-right"></span> 診療科</legend>

<div class="uk-margin"><!--診療科-->
<ul class="uk-child-width-1-4@m uk-child-width-1-1@s " uk-grid>
    <li>
    <span class="uk-h5 <?php if(($int_med)==='1'){echo 'uk-text-danger';} ?>">【内科系】</span>
    <div class="uk-margin-small-left">
        <input type="hidden" name="int_int" >
        <?php if(($int_int)==='1'){echo'内科';?><br><?php }?>
        <input type="hidden" name="int_dig">
        <?php if(($int_dig)==='1'){echo'消化器内科' ;?><br><?php }?>

        <input type="hidden" name="int_uri">
        <?php if(($int_uri)==='1'){echo'糖尿病内科(代謝内科)' ;?><br><?php }?>

        <input type="hidden" name="int_tum">
        <?php if(($int_tum)==='1'){echo'臨床腫瘍科' ;?><br><?php }?>

        <input type="hidden" name="int_res">
        <?php if(!empty($int_res)){echo'呼吸器内科' ;?><br><?php }?>

        <input type="hidden" name="int_kid">
        <?php if(!empty($int_kid)){echo'腎臓内科' ;?><br><?php }?>

        <input type="hidden" name="int_blo">
        <?php if(!empty($int_blo)){echo'血液内科' ;?><br><?php }?>

        <input type="hidden" name="int_apo">
        <?php if(!empty($int_apo)){echo'脳卒中科' ;?><br><?php }?>

        <input type="hidden" name="int_cir">
        <?php if(!empty($int_cir)){echo'循環器内科' ;?><br><?php }?>

        <input type="hidden" name="int_ner">
        <?php if(!empty($int_ner)){echo'神経内科' ;?><br><?php }?>

        <input type="hidden" name="int_inf">
        <?php if(!empty($int_inf)){echo'感染症内科' ;?><br><?php }?>
        </div>

    </li>

    <li>
    <span class="uk-h5 <?php if(($ped_med)==='1'){echo 'uk-text-danger';} ?>">【小児科系】</span>
    <div class="uk-margin-small-left">
        <input type="hidden" name="ped_ped">
        <?php if(!empty($ped_ped)){echo'小児科' ;?><br><?php }?>
        <input type="hidden" name="ped_sur">
        <?php if(!empty($ped_sur)){echo'小児外科' ;?><br><?php }?>

        <input type="hidden" name="ped_neo">
        <?php if(!empty($ped_neo)){echo'新生児科' ;?><br><?php }?>
        </div>

    </li>

    <li>
    <span class="uk-h5 <?php if(($sur_med)==='1'){echo 'uk-text-danger';} ?>">【外科系】</span>
    <div class="uk-margin-small-left">
        <input type="hidden" name="sur_sur">
        <?php if(!empty($sur_sur)){echo'外科' ;?><br><?php }?>

        <input type="hidden" name="sur_lac">
        <?php if(!empty($sur_lac)){echo'乳腺外科' ;?><br><?php }?>

        <input type="hidden" name="sur_ner">
        <?php if(!empty($sur_ner)){echo'脳神経外科' ;?><br><?php }?>

        <input type="hidden" name="sur_nes">
        <?php if(!empty($sur_nes)){echo'呼吸器外科' ;?><br><?php }?>

        <input type="hidden" name="sur_dig">
        <?php if(!empty($sur_dig)){echo'消化器外科' ;?><br><?php }?>

        <input type="hidden" name="sur_car">
        <?php if(!empty($sur_car)){echo'循環器外科(心臓･血管外科)' ;?><br><?php }?>

        <input type="hidden" name="sur_ven">
        <?php if(($sur_ven)){echo'肛門外科' ;?><br><?php }?>
        </div>

    </li>

    <li>
    <span class="uk-h5 <?php if(($ort_med)==='1'){echo 'uk-text-danger';} ?>">【整形外科系】</span>
    <div class="uk-margin-small-left">
        <input type="hidden" name="ort_rhe">
        <?php if(!empty($ort_rhe)){echo'リウマチ科' ;?><br><?php }?>

        <input type="hidden" name="ort_cos">
        <?php if(!empty($ort_cos)){echo'美容外科' ;?><br><?php }?>

        <input type="hidden" name="ort_ort">
        <?php if(!empty($ort_ort)){echo'整形外科' ;?><br><?php }?>

        <input type="hidden" name="ort_reh">
        <?php if(!empty($ort_reh)){echo'リハビリテーション科' ;?><br><?php }?>

        <input type="hidden" name="ort_pla">
        <?php if(!empty($ort_pla)){echo'形成外科' ;?><br><?php }?>
        </div>

    </li>

    <li>
    <span class="uk-h5 <?php if(($oph_med)==='1'){echo 'uk-text-danger';} ?>">【眼科系】</span>
    <div class="uk-margin-small-left">
        <input type="hidden" name="oph_oph">
        <?php if(!empty($oph_oph)){echo'眼科' ;?><br><?php }?>
        </div>

    </li>
    <li>
    <span class="uk-h5 <?php if(($ent_med)==='1'){echo 'uk-text-danger';} ?>">【耳鼻咽喉科系】</span>
    <div class="uk-margin-small-left">
        <input type="hidden" name="ent_ent">
        <?php if(!empty($ent_ent)){echo'耳鼻いんこう科' ;?><br><?php }?>

        <input type="hidden" name="ent_to">
        <?php if(!empty($ent_to)){echo'気管食道科' ;?><br><?php }?>
        </div>

    </li>

    <li>
    <span class="uk-h5 <?php if(($so_med)==='1'){echo 'uk-text-danger';} ?>">【皮膚科・泌尿器系】</span>
    <div class="uk-margin-small-left">
        <input type="hidden" name="so_sky">
        <?php if(!empty($so_sky)){echo'皮膚科' ;?><br><?php }?>
        <input type="hidden" name="so_org">
        <?php if(!empty($so_org)){echo'泌尿器科' ;?><br><?php }?>
        </div>

    </li>

    <li>
    <span class="uk-h5 <?php if(($gyn_med)==='1'){echo 'uk-text-danger';} ?>">【産婦人科系】</span>
    <div class="uk-margin-small-left">
        <input type="hidden" name="gyn_gyn">
        <?php if(!empty($gyn_gyn)){echo'産婦人科' ;?><br><?php }?>

        <input type="hidden" name="gyn_obs">
        <?php if(!empty($gyn_obs)){echo'産科' ;?><br><?php }?>

        <input type="hidden" name="gyn_gyne">
        <?php if(!empty($gyn_gyne)){echo'婦人科' ;?><br><?php }?>
        </div>

    </li>

    <li>
    <span class="uk-h5 <?php if(($psy_med)==='1'){echo 'uk-text-danger';} ?>">【精神科系】</span>
    <div class="uk-margin-small-left">
        <input type="hidden" name="psy_psy">
        <?php if(!empty($psy_psy)){echo'精神科' ;?><br><?php }?>

        <input type="hidden" name="psy_psyc">
        <?php if(!empty($psy_psyc)){echo'心療内科' ;?><br><?php }?>
        </div>

    </li>

    <li>
    <span class="uk-h5 <?php if(($den_med)==='1'){echo 'uk-text-danger';} ?>">【歯科系】</span>
    <div class="uk-margin-small-left">
        <input type="hidden" name="den_den">
        <?php if(!empty($den_den)){echo'歯科' ;?><br><?php }?>

        <input type="hidden" name="den_cav">
        <?php if(!empty($den_cav)){echo'歯科口腔外科' ;?><br><?php }?>

        <input type="hidden" name="den_ref">
        <?php if(!empty($den_ref)){echo'矯正歯科' ;?><br><?php }?>

        <input type="hidden" name="den_ped">
        <?php if(!empty($den_ped)){echo'小児歯科' ;?><br><?php }?>
        </div>

    </li>

    <li>
    <span class="uk-h5 <?php if(($etc_med)==='1'){echo 'uk-text-danger';} ?>">【その他】</span>
    <div class="uk-margin-small-left">
        <input type="hidden" name="alle">
        <?php if(!empty($alle)){echo'アレルギー科' ;?><br><?php }?>
        <input type="hidden" name="pat">
        <?php if(!empty($pat)){echo'病理診断科' ;?><br><?php }?>
        <input type="hidden" name="rad">
        <?php if(!empty($rad)){echo'放射線科' ;?><br><?php }?>
        <input type="hidden" name="cli">
        <?php if(!empty($cli)){echo'臨床検査科' ;?><br><?php }?>
        <input type="hidden" name="ane">
        <?php if(!empty($ane)){echo'麻酔科' ;?><br><?php }?>
        <input type="hidden" name="eme">
        <?php if(!empty($eme)){echo'救急科' ;?><br><?php }?>
        <input type="hidden" name="checkup">
        <?php if(!empty($checkup)){echo'健康診断' ;?><br><?php }?>
        </div>
    </li>
</ul>
</div>


</fieldset>

<br>

<div class="detail-section" id="to-note6"><!-- 備考 -->
<h4>備考
    <label class="uk-form-label">（自由入力、1000文字以内）</label></h4>
    <div class="uk-form-controls">
        <textarea class="uk-textarea size-textarea-Notes"  rows="7" maxlength="1000" readonly><?php echo $dep_note; ?></textarea>
    </div>
</div>
<!--櫻間-->
