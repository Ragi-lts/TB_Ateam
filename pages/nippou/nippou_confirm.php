<!DOCTYPE html>
<html lang="ja">

<head>

  <?php
    session_start();
$title="日報確認";
include_once("../../component/menu.php");

$_SESSION = [
    "mission_correct"   =>  $_POST["mission_correct"],
    'will_finish'       =>  $_POST['will_finish'],
    'now_stop'          =>  $_POST['now_stop'],
    'sol_think'         =>  $_POST['sol_think'],
    'results'           =>  $_POST['results'],
    'kadai'             =>  $_POST['kadai'],
    'kadai-sol'         =>  $_POST['kadai-sol'],
    'next-start'        =>  $_POST['next-start'],
];

?>

</head>

<body class="container-fluid">

  <h4><?php echo $title?>
  </h4>
  <div class="mx-3">
    <p>記入した日報の確認です。</p>
  </div>
  <hr>
  <div id="confirm">
    <ol>
      <li class=" align-self-center">作業開始時の状況</li>
      <ul class="detail mb-3">
        <div class="row container-fluid">
          <li class="col align-self-center">
            Mission番号
          </li>

          <div class="col card bg-light border-dark ">
            <div class="card-body text-center" style="
                        font-size: large; 
                        letter-spacing: .5rem;">
              <?php echo $_SESSION["mission_correct"]?>
            </div>
          </div>
        </div>



        <li class="col align-self-center">
          Mission <?php echo $_SESSION["mission_correct"]?>の完成形
        </li>
        <div class="container mb-3">
          <div class="card bg-light border-dark">
            <div class="card-body">
              <?php echo nl2br($_SESSION['will_finish']);?>
            </div>
          </div>
        </div>

        <li class="col align-self-center">
          Mission <?php echo $_SESSION["mission_correct"]?>で詰まっている箇所
        </li>
        <div class="container">
          <div class="card bg-light border-dark mb-3">
            <div class="card-body">
              <?php echo nl2br($_POST['now_stop']); ?>
            </div>
          </div>
        </div>

      </ul>

      <li class=" align-self-center">
        解決するために，考えたことや調べたこと
      </li>
      <div class="container-fluid mb-3">
        <div class="card bg-light border-warning">
          <div class="card-body">
            <?php echo nl2br($_SESSION['sol_think']); ?>
          </div>
        </div>
      </div>

      <li class="align-self-center">
        実践した結果
      </li>
      <div class="container-fluid mb-3">

        <div class="card bg-light border-danger">
          <div class="card-body">
            <?php echo nl2br($_SESSION['results']); ?>
          </div>
        </div>
      </div>


      <li>今回の作業について</li>
      <ul class="detail my-3">
        <li class="col align-self-center">
          浮かび上がった課題
        </li>
        <div class="container mb-3">

          <div class="card bg-light border-info">
            <div class="card-body">
              <?php echo nl2br($_SESSION['kadai']);?>
            </div>
          </div>
        </div>

        <li class="col align-self-center">
          現時点での解決策
        </li>
        <div class="container mb-3">
          <div class="card bg-light border-info">
            <div class="card-body">
              <?php echo nl2br($_SESSION['kadai-sol']);?>
            </div>
          </div>
        </div>


      </ul>

    </ol>
    <hr>

    <ol start="5">
      <li>次回の予定</li>
      <ul>

        <div class="row container-fluid mb-3">
          <li class=" detail col align-self-center">
            開始日時
          </li>

          <div class="col card bg-light border-success ">
            <div class="card-body text-center">
              <?php echo date('m月j日 H:i', strtotime($_SESSION["next-start"])); ?>
            </div>
          </div>
        </div>



      </ul>
    </ol>


  </div>
  <hr>
  <div class="d-flex justify-content-between container-fluid">
    <a class="btn btn-danger col-4" role="button" href="pages/nippou.php">訂正する</a>
    <a class="btn btn-primary col-4" role="button" href="pages/nippou_complete.php">送信</a>
  </div>
</body>


<?php
include_once('nippou_style.php')
?>


</html>