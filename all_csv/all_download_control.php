<?php
//櫻間20230801
require_once('../config.php');
require_once('../functions.php');


//ファイル名
$filename = 'hosplist.csv';


if (!$fp = fopen($filename, 'w')) {
    echo "Cannot open file ($filename)";
    exit;
}
$head = '医療機関コード,医療機関名,病院区分,開院区分,医師会,郵便番号,都道府県,地域,地区コード,市,区,町,番地・建物名,電話番号,FAX,MAIL,備考';

// head書き込み
fwrite($fp, mb_convert_encoding($head . "\n", "SJIS"));

try{
$dbh = get_db_connect();
$sql = "SELECT hos_cd, hos_name, hos_div, op_flg, med_ass, zipcode, pre, area, are_cd, city, zone, town, str_num, tel, fax, email, note  FROM main"; 
   $sql = $dbh->prepare($sql);
   $sql->execute();
   ob_clean(); 
    while($data = $sql->fetch()){
        // 出力用
        $output_text  = '"';
        $output_text .= $data['hos_cd'];
        $output_text .= '","' . $data['hos_name'];
        $output_text .= '","' . $data['hos_div'];
        $output_text .= '","' . $data['op_flg'];
        $output_text .= '","' . $data['med_ass'];
        $output_text .= '","' . $data['zipcode'];
        $output_text .= '","' . $data['pre'];
        $output_text .= '","' . $data['area'];
        $output_text .= '","' . $data['are_cd'];
        $output_text .= '","' . $data['city'];
        $output_text .= '","' . $data['zone'];
        $output_text .= '","' . $data['town'];
        $output_text .= '","' . $data['str_num'];
        $output_text .= '","' . $data['tel'];
        $output_text .= '","' . $data['fax'];
        $output_text .= '","' . $data['email'];
        $output_text .= '","' . $data['note'];
        $output_text .= '"';
        $output_text .= "\n";
        if (fwrite($fp, mb_convert_encoding($output_text, 'shift-jis', 'utf-8')) === FALSE) {
            break;
        }

    } 
    // close mysql
    $dbh = null;
 
} catch (PDOException $e) {
 
    print "[ERROR] {{$e->getMessage()}}\n";
    die();
    $dbh = null;
} catch (PDOException $e){
 
    print "[ERROR] {{$e->getMessage()}}\n";
    die();
 
}



fclose($fp);
 /* download_file関数実行 */
 download_file($filename);
 
 function download_file($path_file)
 {
     /* ファイルの存在確認 */
     if (!file_exists($path_file)) {
         die("Error: File(".$path_file.") does not exist");
     }
  
     /* オープンできるか確認 */
     if (!($fp = fopen($path_file, "r"))) {
         die("Error: Cannot open the file(".$path_file.")");
     }
     fclose($fp);
  
     /* ファイルサイズの確認 */
     if (($content_length = filesize($path_file)) == 0) {
         die("Error: File size is 0.(".$path_file.")");
     }
  
     /* ダウンロード用のHTTPヘッダー送信 */
     header("Cache-Control: private");
     header("Pragma: private");
     header('Content-Description: File Transfer');
     header("Content-Disposition: inline; filename=\"".basename($path_file)."\"");
     header("Content-Length: ".$content_length);
     header("Content-Type: application/octet-stream");
     header('Content-Transfer-Encoding: binary');
  
     /* ファイルを読んで出力 */
     if (!readfile($path_file)) {
         die("Cannot read the file(".$path_file.")");
     }
 }
 unlink('hosplist.csv');
//櫻間20230801
?>