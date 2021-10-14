<?php
include('header.php');

$pdo = db_conn();

  $stmt = $pdo->prepare("SELECT * FROM bb_predict");
  $status = $stmt->execute();

  $win_view="";
  $win_view_count=0;
  $lose_view="";
  $lose_view_count=0;
  $draw_view="";
  $draw_view_count=0;

  //勝敗コメントをSQLで検索
  if ($status==false) {
      //execute（SQL実行時にエラーがある場合）
      sql_error($stmt);
    }
    else{
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
      if($result["winlose"]=="win"){
        $win_view .= "<li>".h($result["getscore"])." vs ".h($result["lostscore"])." - ".h($result["comment"])." (".h($result["name"]).")"."</li>";
        $win_view_json =json_encode($win_view); 
        $win_view_count ++ ;
      }elseif($result["winlose"]=="lose"){
        $lose_view .= "<li>".h($result["getscore"])." vs ".h($result["lostscore"])." - " .h($result["comment"])." (".h($result["name"]).")"."</li>";
        $lose_view_json =json_encode($lose_view); 
        $lose_view_count++;
      }else{
        $draw_view .= "<li>";
        $draw_view .= h($result["getscore"])." vs ".h($result["lostscore"])." - ".h($result["comment"])." (".h($result["name"]).")"; 
        $draw_view .= "</li>";
        $draw_view_json =json_encode($draw_view); 
        $draw_view_count ++;
      }
    }
  }


  //得点数の予想をカウント
  $get_score_vote0 = 0;
  $get_score_vote1 = 0;
  $get_score_vote2 = 0;
  $get_score_vote3 = 0;
  $get_score_vote4 = 0;
  $get_score_vote5 = 0;
  $get_score_vote6 = 0;
  $get_score_vote7more = 0;

  $stmt = $pdo->prepare("SELECT getscore FROM bb_predict");
  $status = $stmt->execute();
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      
     if($result["getscore"]==0){
      $get_score_vote0 ++ ; 
     }elseif($result["getscore"]==1){
      $get_score_vote1 ++ ; 
     }elseif($result["getscore"]==2){
      $get_score_vote2 ++ ; 
     }elseif($result["getscore"]==3){
      $get_score_vote3 ++ ; 
     }elseif($result["getscore"]==4){
      $get_score_vote4 ++ ; 
     }elseif($result["getscore"]==5){
      $get_score_vote5 ++ ; 
     }elseif($result["getscore"]==6){
      $get_score_vote6 ++ ; 
     }else{
      $get_score_vote7more ++ ; 
     }
  }
 
  //得点数の予想をカウント
  $lost_score_vote0 = 0;
  $lost_score_vote1 = 0;
  $lost_score_vote2 = 0;
  $lost_score_vote3 = 0;
  $lost_score_vote4 = 0;
  $lost_score_vote5 = 0;
  $lost_score_vote6 = 0;
  $lost_score_vote7more = 0;

  $stmt = $pdo->prepare("SELECT lostscore FROM bb_predict");
  $status = $stmt->execute();
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      
     if($result["lostscore"]==0){
      $lost_score_vote0 ++ ; 
     }elseif($result["lostscore"]==1){
      $lost_score_vote1 ++ ; 
     }elseif($result["lostscore"]==2){
      $lost_score_vote2 ++ ; 
     }elseif($result["lostscore"]==3){
      $lost_score_vote3 ++ ; 
     }elseif($result["lostscore"]==4){
      $lost_score_vote4 ++ ; 
     }elseif($result["lostscore"]==5){
      $lost_score_vote5 ++ ; 
     }elseif($result["lostscore"]==6){
      $lost_score_vote6 ++ ; 
     }else{
      $lost_score_vote7more ++ ; 
     }
  }
?>

  <div class="titlemessage">みんなの予想はこの通り！</div>

<div class="result-box box1"> 
  <h2 class="result-box-title">勝敗・スコア分析</h2>
  <div class="allcharts">
    <div class="win_lose_rate chart_wrapper">
      <div class="chart-title">勝敗予想</div>
      <div id="vote_none1">・投稿はありません</div>
      <div class="result_figure figures" style="width:325px">
        <canvas id="mychart1" class="mychart1"></canvas>
      </div>
    </div>

    <div class="getScore_rate chart_wrapper">
      <div class="chart-title">得点数予想</div>
      <div id="vote_none2">・投稿はありません</div>
      <div class="getScore_figure figures" style="width:350px">
        <canvas id="mychart2" class="mychart2"></canvas>
      </div>
    </div>

    <div class="lostScore_rate chart_wrapper">
      <div class="chart-title">失点数予想</div>
      <div id="vote_none3">・投稿はありません</div>
      <div class="lostScore_figure figures" style="width:350px">
        <canvas id="mychart3" class="mychart3"></canvas>
      </div>
    </div>
  </div>
</div>

<div class="result-box"> 
  <h2 class="result-box-title">投票一覧</h2>
  <div class="vote_all">
      <div class="win_vote comment">
        <div class="vote_title"><span>勝ち予想</span>（<?= $win_view_count ?>件）</div>
        <ul class="win_vote_content vote-content">
          <?php if ($win_view !== ""): ?>
          <?= $win_view ?>
          <?php else: ?>
          <li>投稿はありません</li>
          <?php endif ?>
        </ul>
      </div>
      <div class="lose_vote comment">
        <div class="vote_title">負け予想（<?= $lose_view_count ?>件）</div>
        <ul class="lose_vote_content vote-content">
        <?php if ($lose_view !== ""): ?>
         <?= $lose_view ?>
          <?php else: ?>
          <li>投稿はありません</li>
          <?php endif ?>
        </ul>
      </div>
      <div class="draw_vote comment">
        <div class="vote_title">引き分け予想（<?= $draw_view_count ?>件）</div>
        <ul class="draw_vote_content vote-content">
          <?php if ($draw_view !== ""): ?>
          <?= $draw_view ?>
          <?php else: ?>
          <li>投稿はありません</li>
          <?php endif ?>
        </ul>
      </div>
  </div>
</div>

  <div class="bottom-button">
    <button class = "vote-jamp" onclick="location.href='index.php'">予想する</button>
    <button class = "select-jamp" id = "result-to-select" onclick="location.href='select.php'">編集</button>
    <button class = "login-jamp" id="result-to-login" onclick="location.href='login.php'">ログイン</button>
    <button class = "logout-jamp" id = "result-to-logout" onclick="location.href='logout.php'">ログアウト</button>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>

    <?php if($_SESSION["name"] !== null): ?>
      document.getElementById("result-to-login").style.display ="none";
      document.getElementById("result-to-logout").style.display ="block";
      document.getElementById("result-to-select").style.display ="block";
    <?php else: ?>  
      document.getElementById("result-to-login").style.display ="block";
      document.getElementById("result-to-logout").style.display ="none";
      document.getElementById("result-to-select").style.display ="none";
    <?php endif ?>

    <?php  if ($win_view !=="") :?>
    var win_view= JSON.parse('<?php echo $win_view_json ?>')
    <?php endif ?>
    <?php  if ($lose_view !=="") :?>
    var lose_view= JSON.parse('<?php echo $lose_view_json ?>')
    <?php endif ?>
    <?php  if ($draw_view !=="") :?>
    var draw_view= JSON.parse('<?php echo $draw_view_json ?>')
    <?php endif ?>

    // 予想がある時に図を表示
    <?php if($win_view !=="" || $lose_view !=="" || $draw_view !==""): ?>
      document.getElementById("vote_none1").style.display ="none";
      document.getElementById("vote_none2").style.display ="none";
      document.getElementById("vote_none3").style.display ="none";

      var ctx = document.getElementById('mychart1');
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['勝ち', '引き分け', '負け'],
          datasets: [{
            data: [<?= $win_view_count ?>, <?= $draw_view_count ?>, <?= $lose_view_count ?>],
            backgroundColor: ['#f88', '#484', '#48f'],
            weight: 100,
          }],
        },
        options:{
          plugins:{
            legend:{
              labels:{
                color:"white",
              }
            }
          }
        }
      });

      var ctx = document.getElementById('mychart2');
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['0点', '1点', '2点', '3点', '4点','5点','6点', '7点以上'],
          datasets: [{
            data: [<?php echo $get_score_vote0 ?>,<?php echo $get_score_vote1 ?>,<?php echo $get_score_vote2 ?>,<?php echo $get_score_vote3 ?>,<?php echo $get_score_vote4 ?>,<?php echo $get_score_vote5 ?>,<?php echo $get_score_vote6 ?>,<?php echo $get_score_vote7more ?>],
            backgroundColor: ['#e6b8c2','#f88','#e68a9e','#e65c7a','#e62e56','#ff0037','#cc002c','#990021'],
            weight: 100,
          }],
        },
        options:{
          plugins:{
            legend:{
              labels:{
                color:"white",
              }
            }
          }
        }
      });

      var ctx = document.getElementById('mychart3');
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['0点', '1点', '2点', '3点', '4点','5点','6点', '7点以上'],
          datasets: [{
            data: [<?php echo $lost_score_vote0 ?>,<?php echo $lost_score_vote1 ?>,<?php echo $lost_score_vote2 ?>,<?php echo $lost_score_vote3 ?>,<?php echo $lost_score_vote4 ?>,<?php echo $lost_score_vote5 ?>,<?php echo $lost_score_vote6 ?>,<?php echo $lost_score_vote7more ?>],
            backgroundColor: ['#abcbd9', '#82bdd9', '#57b0d9','#2ba2d9','#0095d9','#00aeff','#008bcc','#006999'],
            weight: 100,
          }],
        },
        options:{
          plugins:{
            legend:{
              labels:{
                color:"white",
                padding:10
              }
            }
          }
        }
      });

    //予想がない時は図を非表示
    <?php else: ?>  
      document.getElementById("vote_none1").style.display ="block";
      document.getElementById("vote_none2").style.display ="block";
      document.getElementById("vote_none3").style.display ="block";
    <?php endif ?>
  </script>




  <?php 
  include('footer.php');