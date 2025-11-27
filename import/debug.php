<?php
    require_once('../functions.php');
    $dbh = get_db_connect();

    if($_SERVER["REQUEST_METHOD"]==="POST"){
        echo 'POSTできました。<form action="debug.php" method="GET"><input type="hidden" name="debug" value="a"><button>OK</button></form>';
        $sql ='DELETE FROM intro WHERE hos_cd="9999999";';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $sql ='DELETE FROM invers_intro WHERE hos_cd="9999999"';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();


        $sql ='DELETE FROM contact WHERE hos_cd="9999999"';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();


        $sql ='DELETE FROM training WHERE hos_cd="9999999"';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

    }


    $sql ='SELECT * FROM intro';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $introCount = $stmt->rowCount();

    $sql ='SELECT * FROM invers_intro';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $invIntroCount = $stmt->rowCount();

    $sql ='SELECT * FROM contact';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $contactCount = $stmt->rowCount();

    $sql ='SELECT * FROM training';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $trainingCount = $stmt->rowCount();


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>debug</title>
    <style>
        .main,.submit-button{
            margin-left: 25%;
        }
        hr{
            margin: 0 300px 25px 300px;
        }
    </style>
</head>
<body>
    <div class="main">
        <h1>Debug Information</h1>
        <h2>data Count</h2>
        <p>intro：<?php echo $introCount; ?>　local：71681</p>
        <p>inv_intro：<?php echo $invIntroCount; ?>　local：61495</p>
        <p>contact：<?php echo $contactCount; ?>　local：5173</p>
        <p>training：<?php echo $trainingCount; ?>　local：2087</p>
    </div>


    <hr>

    <div class="submit-button">
        <form action="debug.php" method="POST">
        <input type="hidden" name="debug" value="a">
        <button>ダミーデータ削除</button>
        </form>
        <br><a href="file_select.php">インポート画面へ戻る</a>
    </div>
</body>
</html>