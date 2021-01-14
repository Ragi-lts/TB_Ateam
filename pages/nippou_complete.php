<!DOCTYPE html>
<html lang="ja">

<head>

  <?php
    session_start();
$title="日報整理";
include_once("../component/menu.php");


?>

</head>

<body class="container-fluid">

  <h4><?php echo $title?>
  </h4>
  <div class="mx-3">
    <p>記入した日報を登録しました。</p>
    <p>ここに記入した内容は，『グループへ送信』をタップすることで，日報として報告することができます。</p>
    <hr>

    <h5>送信内容</h5>
    <p>このまま送信できますが，書き換えることもできます。</p>
    <div class="form-group">
      <textarea id="sendForm" class="form-control" name="" rows="8"><?php
      print "【日報】\n";
      print "1. Mission {$_SESSION["mission_correct"]}から開始。";
      print "苦戦していた箇所は，{$_SESSION["now_stop"]}\n";
      print "2. {$_SESSION["sol_think"]}\n";
      if (strcmp($_SESSION["results"], "達成") != 0) {
          print "3. {$_SESSION["results"]}\n";
      } else {
          print "3. 結果，Mission{$_SESSION["mission_correct"]}を達成することができた。\n";
      }
      print "4. {$_SESSION["kadai"]}\n";
      print "課題解決のためには，{$_SESSION["kadai-sol"]}\n";
      
      print "5. 次回は，".date('j日H時i分', strtotime($_SESSION["next-start"]))."から作業開始予定です。";
      ?>
      </textarea>
    </div>
    <button class="btn btn-primary btn-block" type="button" id="send">グループに送信する</button>

  </div>

  <footer class="text-center">
    <hr>
    <a href="#!" role="button" class="btn
      btn-link" data-target="#asktop" data-toggle="modal">TOPページへ</a>
  </footer>

  <!-- ページ遷移 -->
  <div id="asktop" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="askpass-t" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="askpass-t">遷移</h5>
        </div>
        <div class="modal-body text-center">
          <p>ポータルのTOPページに移動しますか？
            （今まで書いた内容は破棄されます）
          </p>
        </div>
        <div class="modal-footer w-90">
          <a href="#" class="btn btn-primary btn-block col" role="button">OK</a>

          <button class="btn btn-danger btn-block col" data-dismiss="modal" aria-label="Close">
            <span>キャンセル</span>
          </button>
        </div>
      </div>
    </div>
  </div>







</body>
<?php include_once('nippou_style.php')
?>

<script>
document.getElementById('send').addEventListener('click', function() {
  liff.sendMessages([{
    'type': 'text',
    'text': $('#sendForm').val()
  }]).then(function() {
    window.alert('グループに日報を送信しました。\nアプリを終了します。');
    liff.closeWindow();
  }).catch(function(error) {
    window.alert('Error sending message: ' + error);
  });
});
</script>

</html>