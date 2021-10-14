<?php
require_once('funcs.php');
include('header.php');
?>

    <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
    <form name="form1" action="login_act.php" method="post">
        ID:<input type="text" name="lid" />
        PW:<input type="password" name="lpw" />
        <input type="submit" value="LOGIN" />
    </form>
    <div class="bottom-button">
      <button class = "vote-jamp" onclick="location.href='index.php'">予想する</button>
      <button class = "vote-jamp" onclick="location.href='result.php'">みんなの予想</button>
    </div>


</body>

</html>