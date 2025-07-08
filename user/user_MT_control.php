<?php
//櫻間

if(isset($_SESSION)==null){
session_start();
}
require_once('../functions.php');

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

//櫻間

$user_adm = $_SESSION['member']['adm_user'];



//高橋20221121
/* 
    データ取得
*/
//データベース接続
$dbh = get_db_connect();


//変数の初期値
$onf = '';

/* $idがあれば ユーザーID検索 */
if(isset($_GET['user_id'])):
    $id = $_GET['user_id']; 
    $data= user_select($dbh,$id); //検索結果の取得 

else:
    

    if(isset($_GET['onf'])){
        if($_GET['onf']==='Active'){ $onf='0'; }
        elseif($_GET['onf']==='InActive'){ $onf='1'; }
        elseif($_GET['onf']==='ALL'){ $onf=''; }
    }
    
    if($onf === '0'){
        //利用中ユーザ onf=0
        $data = get_result1($dbh);
    }elseif($onf === '1'){
        //停止中ユーザ onf=1
        $data = get_result2($dbh);
    }else{
        //全ユーザ
        $data = get_result3($dbh);
    }

endif;



/*
    ユーザ数カウント
*/
$active_user = count( get_result1($dbh) );
$hide_user = count( get_result2($dbh) );
$total_user = count( get_result3($dbh) );


//高橋20221120、20221211追記
/* 
    Pagination
*/
if(!empty($data)):

    // 現在のページ番号
    if(!isset($_GET['page'])){ // $_GET['page'] はURLに渡された現在のページ数
        $page = 1; // 設定されてない場合は1ページ目にする

    /* 高橋20221211 表示件数変更実装：大井先生のを参考に！*/
    }elseif(isset($_POST['display'])){  //値に応じて表示する数を変える
        $page = 1;

    }else{
        $page = $_GET['page'];
    } 
  
    // トータルデータ件数
    $books_num = count($data);

    // 1ページに表示させるデータ件数
    /* 高橋20221211 表示件数変更実装：大井先生のを参考に！*/
    if(isset($_POST['display'])){
        $disp_cnt = $_POST['display'];
        $_SESSION['disp_cnt'] = $disp_cnt;

        //値に応じて表示する数を変える✅必要に応じてカスタマイズ
        if($disp_cnt === '5'){
            define('MAX','5');
        }elseif($disp_cnt === '10'){
            define('MAX','10');
        }elseif($disp_cnt === '15'){
            define('MAX','15');
        }elseif($disp_cnt === '20'){
            define('MAX','20');
        }elseif($disp_cnt === '50'){
            define('MAX','50');
        }elseif($disp_cnt === '全件'){
            define('MAX', $books_num);
        } 

    }elseif(isset($_SESSION['disp_cnt'])){
        $disp_cnt = $_SESSION['disp_cnt'];
        
        //値に応じて表示する数を変える✅必要に応じてカスタマイズ
        if($disp_cnt === '5'){
            define('MAX','5');
        }elseif($disp_cnt === '10'){
            define('MAX','10');
        }elseif($disp_cnt === '15'){
            define('MAX','15');
        }elseif($disp_cnt === '20'){
            define('MAX','20');
        }elseif($disp_cnt === '50'){
            define('MAX','50');
        }elseif($disp_cnt === '全件'){
            define('MAX', $books_num);
        } 

    }else{
        $disp_cnt = '';
        define('MAX','5'); // 1ページの記事の表示数 初期値5に設定✅
    }

    // 配列の何番目から取得すればよいか
    $start_no = ($page - 1) * MAX; 

    // 1ページに表示させるデータ ★foreach($data)⇒foreach($disp_data)に変更
    $disp_data = array_slice($data, $start_no, MAX, true); // array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
    

    // トータルページ数 ＝トータルデータ数／1ページに表示させる件数
    $totalPage = ceil($books_num / MAX); //※ceilは小数点を切り捨てる関数


    // ページ番号リンクの表示範囲
    $pageRange = 2;
    /* 例）
        << <前へ 1 2 3 ... 5 6 7(←現在のページ) 8 9 ... 21 次へ> >>

        7が現在のページ
        5 6 8 9　：7±「2」のページ番号が表示されてる
        このときの「2」がpageRangeにあたる
    */
    
    // ページリンク
    $prev = max($page - 1, 1); //戻る
    $next = min($page + 1, $totalPage); //次へ
  
    $page_start = max($page - $pageRange, 2); // ページ番号始点
    $page_end = min($page + $pageRange, $totalPage - 1); // ページ番号終点
  

    // ページ番号格納
    $nums = []; // ページ番号格納用
    for ($i = $page_start; $i <= $page_end; $i++) {
      $nums[] = $i;
    }

endif;
/* Paginationここまで */







//櫻間
if(isset($_SESSION)){
    unset($_SESSION['user']);
}

include_once('user_MT_view.php');
?>
