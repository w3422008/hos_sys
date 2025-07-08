<style>
    div.modified1{
        margin:0 auto;
        border:1px solid grey;
        width:850px;
        background-color: rgb(247, 240, 172);
        text-align:left;
        font-size: 0.9rem;
        
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
    }
    p.message2{
        color:red;
        font-size:1.0rem;
    }
</style>


<?php if(!empty($data)){?>
<div class="modified1">
    <dl>
        <p><span class="uk-label uk-label-danger">医療機関システムに関するお知らせ</span></p>
            <dt><?php echo $data[0]['A'] ?></dt>
                <p class="message1" ><?php echo $data[0]['title']?></p>
                <p class="message2"><?php  echo '【作業日時】'. $data[0]['B']?>　<?php echo $data[0]['C'] .' 〜 '.  $data[0]['D'] .'（予定）'?></p>
            
                <div style="white-space: pre-line; margin-bottom: 1em;"><?php echo $data[0]['comment']?></div>
                <p></p>
                <p><?php echo 'ご協力よろしくお願いいたします。'?></p>
    </dl> 
</div>
<?php }?>
<br>