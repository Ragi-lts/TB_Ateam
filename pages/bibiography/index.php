<!DOCTYPE html>
<html lang="ja">

<head>
  <?php
  $title = "参考サイト集";
  include_once('../../component/menu.php');
  ?>
</head>
<?php
$dbsn = '**DATABASE**';
$user = "**USER**";
$password = "**PASS**";

$pdo = new PDO($dbsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

/*
/* データベース新規作成 */
/*   $dropsql = "DROP TABLE Bibliography";
$stmt = $pdo->query($dropsql);
*/


/* $init_sql = "CREATE TABLE IF NOT EXISTS Bibliography"
."("
." id INT AUTO_INCREMENT PRIMARY KEY,"
."mission char(10),"
."tag TEXT,"
."url TEXT,"
."comment TEXT"
.");";
$stmt = $pdo->query($init_sql);
 */
?>

<body>
  <?php
  function Reg_comment($pdo = null, $mission = null, $tag = null, $url = null, $description = null)
  {
    if ($pdo == null) {
      echo ("Database is null");
      return null;
    }
    /* データの挿入． */
    $post_sql =   $pdo->prepare("INSERT INTO Bibliography (mission, tag, url, comment) VALUES (:mission, :tag, :url, :comment)");
    /* 変数割り当て */
    $post_sql->bindParam(':mission', $mission, PDO::PARAM_STR);
    $post_sql->bindParam(':tag', $tag, PDO::PARAM_STR);
    $post_sql->bindParam(':url', $url, PDO::PARAM_STR);
    $post_sql->bindParam(':comment', $description, PDO::PARAM_STR);
    /* 登録に成功すると，trueを返す． */
    if ($post_sql->execute()) {
      return true;
    } else {
      return false;
    }
  }

  function Load_DB(PDO $pdo = null)
  {
    if ($pdo != null) {
      $split_sql = "DELETE FROM Bibliography WHERE mission IS NULL";
      $stmt = $pdo->prepare($split_sql);
      $stmt->execute();

      $match_sql = "SELECT * FROM Bibliography";
      $stmt = $pdo->prepare($match_sql);
      if ($stmt->execute()) { /* もし成功したら */
        $results = $stmt->fetchAll();   /* SQL文で出力した結果を格納． */
        $amount =  count($results);   /* 1であれば抽出成功． */
        if ($amount == 0) {
          echo "<tr><td colspan='3'>登録データがありません。</td></tr>";
          return null;
        }
        $content = array();
        foreach ($results as $row) {    //* 抽出結果について，出力． */
          $mission = $row['mission'];
          $tag = $row['tag'];
          $comment = $row['comment'];
          $url = $row['url'];
          $tuple =
            "<tr>"
            . "<td>" . $mission . "</td>"
            . "<td> <a style='width:100%; height:100%; display:block;' href='" . $url . "'>" . $tag . "</td>"
            . "<td>" . $comment . "</td>"
            . "</tr>";
          array_push($content, $tuple);
        }
        return $content;
      } else {
        var_dump($pdo->errorInfo());
        return null;
      }
    }
  }



  ?>



  <div class="container-fluid ">
    <h4>参考サイト集</h4>
    <p class="mx-3">このページではMissionを進めるにあたって，参考になったサイトを登録・閲覧することができます。</p>
    <p class="text-center mx-3">データベース更新のため， 30秒ごとに再読み込みされます。</p>

    <hr>
    <div class="container-fluid">
      <h5>一覧</h5>
      <table class="table table-striped table-bordered">
        <thead>
          <tr class="text-center">
            <th>Mission</th>
            <th>タグ</th>
            <th>説明</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $content = Load_DB($pdo);
          if ($content != null) {
            foreach ($content as $item) {
              echo $item;
            }
          }
          ?>
        </tbody>

      </table>



    </div>
    <hr>
    <div class="container-fluid">
      <h5>登録する</h5>
      <form action="" method="post" id="postDB">
        <div class="form-group ">
          <label for="inputLabel">Mission番号</label>
          <select id="mission-select" class="custom-select text-center" name="mission_correct">
            <option value="-1" disabled selected>▽ 選択</option>
            <?php
            $mission_all = [
              [
                "Mission 3",
                "3-1", "3-2", "3-3", "3-4", "3-5 （★）"
              ],
              [
                "Mission 4",
                "4-1", "4-2", "4-3", "4-4", "4-5", "4-6", "4-7", "4-8"
              ],
              [
                "Mission 5",
                "5-1  （★）", "5-2"
              ],
              [
                "Mission 6",
                "6"
              ]
            ];
            foreach ($mission_all as $item) {
              for ($i = 0; $i < count($item); $i++) {
                if ($i == 0) {
                  echo "<option value=" . $item[0]
                    . " disabled>◆" . $item[0] . "</option>";
                } else {
                  echo "<option value=" . explode(" ", $item[$i])[0]
                    . ">" . $item[$i] . "</option>";
                }
              }
            }
            ?>
          </select>

        </div>
        <div class="form-group ">
          <label for="inputLabel">タグ</label>
          <input id="inputLabel" class="form-control" type="text" placeholder="わかりやすいタグ" name="inputLabel" required>
        </div>
        <div class="form-group ">
          <label for="inputURL">URL</label>
          <input id="inputURL" class="form-control" type="url" placeholder="httpから始まるURL" name="inputURL" required>
        </div>


        <div class="form-group">
          <label for="inputDescribe">説明文</label>
          <textarea id="inputDescribe" class="form-control" rows="3" name="inputDescribe" placeholder="どのような時に参照したかを書いてくれるとありがたいです！" required></textarea>
        </div>
        <button id="register" name="register" class="btn btn-primary btn-block" type="submit" data-toggle="modal" data-target="#confirm">登録</button>
      </form>

    </div>
  </div>

  <?php
  $is_Register = null;
  if (isset($_POST["register"])) {
    $is_Register = Reg_comment(
      $pdo,
      $_POST["mission_correct"],
      $_POST["inputLabel"],
      $_POST["inputURL"],
      $_POST["inputDescribe"]
    );
  } else {
    $_POST = array();
  }
  if ($is_Register == false) {
    exit;
  }
  ?>
  <script>
    setInterval(function() {
      location.reload();
    }, 30 * 1000);

    ///////////////////////////////////////
    $('#register').on('click', function() {
      location.reload();
    });
  </script>


</body>

</html>