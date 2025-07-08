<?php
$date = 0 ;
$w_date = "";
    foreach($check1 as $key => $var):
        
        if($date==0){
            if($date==0 && $var['MMDD'] !== $w_date)
                echo $var['MMDD']."<br>";
        $date2 = $var['MMDD'];
        }        
            
            if($var['MMDD'] !== $date){    
                echo $var['MMDD']."<br>";
                $w_date = $var['MMDD'];
                echo "・".$var['comment']."<br>";
                $date = 0;
                
            }elseif(empty(!$var['comment'])){
                echo "・".$var['comment']."<br>";
                $w_date = "";
                $date = $var['MMDD'];
                
            }

    endforeach;

?>
<br>
＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿<br>
<?php
$date2 = 0 ;
$w_date2 = "";
    foreach($check2 as $key => $var):
        
        if($date2==0){
            if($date2==0 && $var['MMDD'] !== $w_date2)
                echo $var['MMDD']."<br>";
        $date2 = $var['MMDD'];
        }        
            
            if($var['MMDD'] !== $date2){    
                echo $var['MMDD']."<br>";
                $w_date2 = $var['MMDD'];
                echo "・".$var['comment']."<br>";
                $date2 = 0;
                
            }elseif(empty(!$var['comment'])){
                echo "・".$var['comment']."<br>";
                $w_date2 = "";
                $date2 = $var['MMDD'];
                
            }

    endforeach;

?>


<br>
＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿<br>
<?php
$date3 = 0 ;
$w_date3 = "";
    foreach($check3 as $key => $var):
        
        if($date3==0){
            if($date3==0 && $var['MMDD'] !== $w_date3)
                echo $var['MMDD']."<br>";
        $date3 = $var['MMDD'];
        }        
            
            if($var['MMDD'] !== $date3){    
                echo $var['MMDD']."<br>";
                $w_date3 = $var['MMDD'];
                echo "・".$var['comment']."<br>";
                $date3 = 0;
                
            }elseif(empty(!$var['comment'])){
                echo "・".$var['comment']."<br>";
                $w_date3 = "";
                $date3 = $var['MMDD'];
                
            }

    endforeach;

?>