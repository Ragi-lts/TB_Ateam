<!DOCTYPE html>
<html lang="ja">

<head>
  <?php
    $title = "Aチーム専用ポータルサイト";
    include_once('component/menu.php');
    include_once('component/method/line.php');
    $_SESSION["CLIENT_VERSION"] = isset($_SESSION["CLIENT_VERSION"]) ?  $_SESSION["CLIENT_VERSION"] : $_ENV["VERSION"];
    ?>
  <title><?php echo $title?>
  </title>
</head>

<body class="container-fluid">


  <div class="">
    <h4 style="text-align: center;">
      <?php echo $title?>
    </h4>
    <hr>
    <div class="container-fluid" id="update_history">
      <div class="d-flex justify-content-between">
        <h5>更新履歴</h5>
        <div><?php echo "　（最終更新日：".date('Y/m/d', $update)."）";  ?>
        </div>
      </div>
      <li>『チームの進捗状況』を廃止し，ミーティングに気軽に参加できるようにしました．</li>
      <li> <strong>意見箱</strong> で，送信したときに空白のページに移動する不具合を修正しました．</li>

    </div>
    <hr>
  </div>
  <div>
    <div name="today" class="text-center">

    </div>
    <div class="text-center">
      <div class="card border-dark">
        <div class="card-header ">
          実装予定の機能
        </div>
        <ul class="list-group ">
          <li class="list-group-item ">各地の天気表示</li>
        </ul>
      </div>
      <div class="card my-3 border-info">
        <div class="card-header">
          チームミーティングに参加する
        </div>
        <div class="card-body">
          <p>参加方法を選択してください。</p>
          <div class="d-flex justify-content-center">
            <a class=" btn btn-primary w-50 mx-2" role="button" href=<?php echo $_ENV['ZOOMURL_APP']; ?>>アプリで参加</a>
            <a class=" btn btn-warning w-50 mx-2" role="button" href=<?php echo $_ENV['ZOOMURL_BR'] ;?>>ブラウザで参加</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <hr>
  <!--   <div id="nippou">
            <h2>日報作成</h2>


            <hr>
        </div> -->
  <div id="iken" class="container-fluid">
    <h5>意見箱</h5>

    <form action="" method="post" class="m-4" name="suggest" id="sug">
      <div class="form-group">
        <p>こういう機能が欲しいとかあれば，ぜひ！</p>
        <textarea id="suggestion" class="form-control" placeholder="送信された内容は，リーダとサブリーダ間で共有されます。" name="suggestion"
          rows="3"></textarea>
      </div>
      <span id="sug_res"></span>
      <div class="d-flex justify-content-between">
        <button class="btn btn-secondary w-50 mx-2" type="reset">リセット</button>
        <button class="btn btn-primary w-50 mx-2" type="submit" id="sug_post">送信</button>
      </div>
      <div class="response"><?php echo $receive_message; ?>
    </form>
  </div>






</body>


</html>