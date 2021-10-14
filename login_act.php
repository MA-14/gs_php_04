<?php

session_start();

$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

require_once("funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM bb_user WHERE lid = :lid AND lpw = :lpw; ');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         

//5. 該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ){
    $_SESSION["chk_ssid"]  = session_id();
    $_SESSION["kanri_flag"] = $val['kanri_flag'];
    $_SESSION["name"]      = $val['name'];
    header('Location: select.php');
}else{
    header('Location: login.php');
}

exit();
