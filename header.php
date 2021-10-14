<?php
session_start();
require_once('funcs.php');
$view = '';
if($_SESSION["name"] !== null){
  $view .= $_SESSION["name"];
}else{
  $view .= "ゲスト";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>巨人戦予想掲示板</title>
</head>
<body>
  <div class="title-wrapper">
    <h1 class="title">みんなの巨人戦予想</h1>
    <div class="title-message">こんにちは<?= $view ?>さん</div>
  </div>
