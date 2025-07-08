<?php
$date2 = 0 ;
$w_date2 = "";
    foreach($check2 as $key => $var):
        
        if($date2==0){
            if($date2==0 && $var['MMDD'] !== $w_date2)
                echo "<br>".$var['MMDD']."<br>";
        $date2 = $var['MMDD'];
        }        
            
            if($var['MMDD'] !== $date2){    
                echo "<br>".$var['MMDD']."<br>";
                $w_date2 = $var['MMDD'];
                echo "・".$var['comment']."　　";
                echo $var['req_fac'].')';
                echo $var['req_dep']."<br>";
                $date2 = 0;
                
            }elseif(empty(!$var['comment'])){
                echo "・".$var['comment']."　　";
                echo $var['req_fac'].")";
                echo $var['req_dep']."<br>";
                $w_date2 = "";
                $date2 = $var['MMDD'];
                
            }

    endforeach;

?>
