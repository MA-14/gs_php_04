<!-- リセットがうまく機能しない！！！ -->

<?php
include('header.php');

?>
  <div class="titlemessage">
    今日の巨人戦のスコアを予想しよう
  </div>
  <div class="form">
    <form action="insert.php" method ="post">
      名前　　：<input type="text" name="name" value=<?= $view ?>>
      <br>
      得点　　：<input type="number" name="getscore" min="0" max="100">
      <br>
      失点　　：<input type="number" name="lostscore" min="0" max="100">
      <br>
      コメント：<input name="comment" size=40>
      <br>
      <input class = "input-button" type="submit" value="投稿する">
    </form>
  </div>

<div class="bottom-button">
  <button class = "login-jamp" id = "login-jamp" onclick="location.href='login.php'">ログイン</button>
  <button class = "logout-jamp" id = "logout-jamp" onclick="location.href='logout.php'">ログアウト</button>
  <button class = "result-jamp" onclick="location.href='result.php'">みんなの予想</button>
</div>

<script>
  <?php if($_SESSION["name"] !== null): ?>
    document.getElementById("login-jamp").style.display ="none";
    document.getElementById("logout-jamp").style.display ="block";
  <?php else: ?>  
    document.getElementById("login-jamp").style.display ="block";
    document.getElementById("logout-jamp").style.display ="none";
  <?php endif ?>
  
  </script>

<?php 
include('footer.php');