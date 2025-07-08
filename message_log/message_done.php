<?php
$date = 0 ;
$w_date = "";
    foreach($check1 as $key => $var):
        
        if($date==0){
            if($date==0 && $var['MMDD'] !== $w_date)
                echo "<br>".$var['MMDD']."<br>";
        $date = $var['MMDD'];
        }        
            
            if($var['MMDD'] !== $date){    
                echo "<br>".$var['MMDD']."<br>";
                $w_date = $var['MMDD'];
                echo "・".$var['comment']."　　";
                echo $var['req_fac'].')';
                echo $var['req_dep']."<br>";
                $date = 0;
                
            }elseif(empty(!$var['comment'])){
                echo "・".$var['comment']."　　";
                echo $var['req_fac'].')';
                echo $var['req_dep']."<br>";
                $w_date = "";
                $date = $var['MMDD'];
                
            }

    endforeach;

?>
