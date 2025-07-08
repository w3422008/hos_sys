<?php
$date3 = 0 ;
$w_date3 = "";
    foreach($check3 as $key => $var):
        
        if($date3==0){
            if($date3==0 && $var['MMDD'] !== $w_date3)
                echo "<br>".$var['MMDD']."<br>";
        $date3 = $var['MMDD'];
        }        
            
            if($var['MMDD'] !== $date3){    
                echo "<br>".$var['MMDD']."<br>";
                $w_date3 = $var['MMDD'];
                echo "・".$var['comment']."　　";
                echo $var['req_fac'].')';
                echo $var['req_dep']."<br>";
                $date3 = 0;
                
            }elseif(empty(!$var['comment'])){
                echo "・".$var['comment']."　　";
                echo $var['req_fac'].')';
                echo $var['req_dep']."<br>";
                $w_date3 = "";
                $date3 = $var['MMDD'];
                
            }

    endforeach;

?>