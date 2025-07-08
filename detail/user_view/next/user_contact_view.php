
    <?php
include("./control/contact_control.php");   
//include("./header_detail.php"); 
?> 

   
    <p class="fs-4">【附属病院】</p>
    
   
    <p>フィルタ機能　　　　　　<input type=”text” size="10" name=”test1”>年度</p>
    <p>
    
    <table class="table table-bordered">
        <tr class="table-success">
            <th>日付</th>
            <th>区分</th>
            <th>内容</th>
            <th>連絡先対応者</th>
            <th>所属</th>
            <th>対応者</th>
        </tr>
        <tr>
            <td>　　　　</td>
            <td>　　　　</td>
            <td>　　　　　　　　　　　　　</td>
            <td>　　　　　　　　</td>
            <td>　　　　　　　　</td>
            <td>　　　　　　</td>
        </tr>
        <tr>
            <td>　　　　</td>
            <td>　　　　</td>
            <td>　　　　　　　　　　　　　</td>
            <td>　　　　　　　　</td>
            <td>　　　　　　　　</td>
            <td>　　　　　　</td>
        </tr>
    </table>
  
    </p>
   
    <p class="fs-4"> 【総合医療センター】</p>
<p>フィルタ機能　　　　　　<input type=”text” size="10" name=”test1”>年度</p>

    <p>
  
    <table class="table table-bordered">
        <tr class="table-success">
            <th>日付</th>
            <th>区分</th>
            <th>内容</th>
            <th>連絡先対応者</th>
            <th>所属</th>
            <th>対応者</th>
        </tr>
        <tr>
            <td>　　　　</td>
            <td>　　　　</td>
            <td>　　　　　　　　　　　　　</td>
            <td>　　　　　　　　</td>
            <td>　　　　　　　　</td>
            <td>　　　　　　</td>
        </tr>
    </table>
    </p>
    <!--櫻間-->
    <div class="uk-margin">
        <label class="uk-form-label" for="form-h-textarea">備考</label>
        <div class="uk-form-controls">
            <textarea class="uk-textarea uk-form-width-large" id="form-h-textarea" cols="30" rows="5" value="<?php echo html_escape ($var['note']);?>" readonly></textarea>
        </div>
    </div>