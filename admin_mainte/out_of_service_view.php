<!-- // 20240618_大橋_メンテ中画面関係 -->
<style>
    div.modified1{
        margin:0 auto;
        margin-top: 70px; 
        border:1px solid grey;
        width: 1000px;
        background-color: rgb(247, 240, 172);
        text-align:left;
        font-size: 2rem;   
    }
    div.modified1>dl{
        margin:1rem;
    }
    .modified1 p{
        margin-top: 0;
        margin-bottom: 0.8rem;
    }

    p.message1{
        font-size:1.3rem;
        line-height: 1.8em;
    }
    p.message2{
        color:red;
        font-size:1.55rem;
        line-height: 1.8em;
    }

    .bottom-right {
        position: fixed;
        right: 0;
        bottom: 0;
    }
    
    div.message3{
        font-size:1.3rem;
        white-space: pre-line; /* 改行を反映 */
        margin-bottom: 1em;
        line-height: 1.8em;
        padding-top: 1em; /* 上部に1emのパディングを追加 */
    }

    i.fas {
        margin-right: 1em; /* アイコンとテキストの間に1emの空白を追加 */
    }

    span.uk-label2{
        background-color: #f0506e;
        color: #fff;
    
        display: inline-block;
        padding: 1px 15px;
        line-height: 2.9rem;
        font-size: 1.3rem;
        vertical-align: middle;
        white-space: nowrap;
        border-radius: 2px;
        text-transform: uppercase
    }

</style>


<?php if(!empty($data)){?>
<div class="modified1">
   <dl>
    <span class="uk-label2"><i class="fas fa-screwdriver-wrench"></i><?php echo $data[0]['title']?></span>
    
    <div class="message3"><?php echo $data[0]['comment']?></div>

        <p class="message2"><?php  echo '【作業日時】'. $data[0]['A']?>　<?php echo $data[0]['B'] .' 〜 '.  $data[0]['C'] .'（予定）'?></p>
    
        <div class="message3"><?php echo $data[0]['comment2']?></div>
            
        <p class="message1" ><?php echo 'ご協力よろしくお願いいたします。'?></p>
    </dl> 


</div>
<?php }?>
<br>



<div class="bottom-right">
<center>
<?php 
    if(isset($_SESSION['admin_pass_err'])){
    echo '<span style="color:red;">' . $_SESSION['admin_pass_err'] . '</span>';
    unset($_SESSION['admin_pass_err']);
}else{} ?>

<form action="./mainte_index_pass.php" method="post">
    <input type="hidden" id="user_id" name="user_id" value="">
    <input type="hidden" id="password" name="password" value="">
    <label for="admin_pass"  class="uk-button uk-button-default">パスワード:</label>
    <input type="password" id="admin_pass" name="admin_pass" autofocus>
    <input class="uk-button uk-button-default" type="submit" value="送信">
</form>

<!-- <a href="./mainte_index.php" class="uk-button uk-button-default">管理者テストログイン</a> -->


    <a href="./login/logout.php" class="uk-button uk-button-default">システム管理者テストログアウト</a>
</div>