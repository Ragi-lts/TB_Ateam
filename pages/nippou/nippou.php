<!DOCTYPE html>
<html lang="ja">

<head>
  <?php
    session_start();
$title = "日報整理";
include_once('../../component/menu.php');

$start_date = date('Y-m-d\TH:i');

/* $_SESSION['Bib_KEY']    = (!empty($_SESSION['Bib_KEY']))    ?   $_SESSION['Bib_KEY']    :   [] ;
$_SESSION['Bib_SITE']   = (!empty($_SESSION['Bib_SITE']))   ?   $_SESSION['Bib_SITE']   :   [] ;
$_SESSION['NowMission'] = (!empty($_SESSION['NowMission'])) ?   $_SESSION['NowMission'] :   '' ;
 */
$parse = parse_url($_SERVER['HTTP_REFERER']);

if ($parse['path'] !='/pages/nippou_confirm.php') {
    $_SESSION =
[
  "mission_correct"   =>  '',
  'will_finish'       =>  '',
  'now_stop'          =>  '',
  'sol_think'         =>  '',
  'results'           =>  '',
  'kadai'             =>  '',
  'kadai-sol'         =>  '',
  'next-start'        =>  date('Y-m-d\TH:i'),
  'next-end'          =>  ''
];
} else {
    $_SESSION = [
  "mission_correct"   =>  (isset($_SESSION['mission_correct'])) ? '' :$_SESSION['mission_correct'],
  'will_finish'       =>  (isset($_SESSION['will_finish'])) ? '' :$_SESSION['will_finish'],
  'now_stop'          =>  (isset($_SESSION['now_stop'])) ? '' :$_SESSION['now_stop'],
  'sol_think'         =>  (isset($_SESSION['sol_think'])) ? '' :$_SESSION['sol_think'],
  'results'           =>  (isset($_SESSION['results'])) ? '' :$_SESSION['results'],
  'kadai'             =>  (isset($_SESSION['kadai'])) ? '' :$_SESSION['kadai'],
  'kadai-sol'         =>  (isset($_SESSION['kadai-sol'])) ? '' :$_SESSION['kadai-sol'],
  'next-start'        =>  (isset($_SESSION['next-start'])) ? date('Y-m-d\TH:i') :$_SESSION['next-start'],
  'next-end'          =>  (isset($_SESSION['next-end'])) ? '' :$_SESSION['next-end'],
];
}
/*  */
?>
</head>





<body class="container">

  <h4><?php echo $title?>
  </h4>

  <div id="seiri">
    <div class="mx-3">
      <p>どういった作業をしたのか，書けるところから書いてみましょう。
        <span class="btn-link">色が変わっているところ</span>は，展開したり，折りたたむことができます。
      </p>
    </div>


    <form action=<?php
            echo "pages/nippou_confirm.php"." ";
        ?> method="post" id="express_nippou">
      <hr>
      <ol>
        <li>
          <a class="btn btn-link text-nowrap" data-toggle="collapse" href="#start" role="button" aria-expanded="false"
            aria-controls="start">作業開始時の状況
          </a>
        </li>
        <div id="start" class="mb-4 collapse" style="line-height: 2;">
          <ul class="detail">
            <div class="form-group  has-feedback">
              <!-- Mission選択 -->
              <li>作業開始時のMission番号 <span class="badge badge-danger">必須</span> </li>
              <select id="mission-select" class="custom-select" name="mission_correct">
                <option value="-1" disabled selected>▽　選択してください</option>
                <?php
                                    $mission_all = [
                                        ["テキストファイルでWEB掲示板を作る",
                                            "3-1","3-2","3-3","3-4","3-5 （★）"],
                                        ["データベースを操作する",
                                            "4-1","4-2","4-3","4-4","4-5","4-6","4-7","4-8"],
                                        ["データベースで掲示板を作る",
                                            "5-1  （★）","5-2"],
                                        ["自力で１から作る",
                                            "6-1","6-2"]
                                        ];
                                        foreach ($mission_all as $item) {
                                            for ($i = 0; $i < count($item); $i++) {
                                                if ($item[$i] == $_SESSION['mission_correct']) {
                                                    echo "<option selected value=".explode(" ", $item[$i])[0]
                                            .">　Mission ".$item[$i]."</option>";
                                                } else {
                                                    if ($i == 0) {
                                                        echo "<option value=".$item[0]
                                                ." disabled>◆".$item[0]."</option>";
                                                    } else {
                                                        echo "<option value=".explode(" ", $item[$i])[0]
                                                .">　Mission ".$item[$i]."</option>";
                                                    }
                                                }
                                            }
                                        }
?>
              </select>
            </div>

            <!-- 完成形は？ -->
            <li>Mission <span class="now-mission"><?php echo $_SESSION['mission_correct'];?></span>の完成形はどういうもの？
              <span class="badge badge-secondary">確認</span>
            </li>
            （ミッション概要は<a id="mission_ref" href="">こちら</a>）
            <?php
                    ?>
            <div class="form-group">
              <textarea id="will_finish" class="form-control" name="will_finish"
                rows="3"><?php echo $_SESSION['will_finish'];?></textarea>
            </div>

            <!-- 詰まっているところ -->
            <li>Mission <span class="now-mission"></span>を実装していくにあたって，詰まっているところは？
              <span class="badge badge-danger">必須</span>
            </li>
            <div class="form-group">
              <textarea id="my-textarea" class="form-control" name="now_stop"
                rows="3"><?php echo $_SESSION['now_stop'];?></textarea>
            </div>



          </ul>


          <script>
          const root = $('#mission_ref').attr('href');
          $(function() {
            $('#mission_ref').on('click', function() {
              if ($(this).attr('href') == root) {
                $(this).removeAttr('href');
                alert("Missionが選択されていません。")
                return false;

              } else {
                window.location.href = $(this).attr('href');
              }
            })
            //セレクトボックスが切り替わったら発動
            $('#mission-select').change(function() {
              //選択したvalue値を変数に格納
              var val = $(this).val();
              if (val != "default") { //選択したvalue値をp要素に出力
                $('.now-mission').text(val);
                let section = val.split('-')[0];
                $('#mission_ref').attr('href',
                  "https://home.tech-base.net/info/forportal/Mission/body.php?mission=" +
                  section + "&file=mission_" + val + ".html");
              } else {
                $('.now-mission').text('');
                $('#mission_ref').attr('href', '');
              };

            });
          });
          </script>

        </div>
        <div id="solution" class="mb-3">
          <!--２． 解決するためには？ -->
          <li><a class="btn text-nowrap" href="javascript:void(0);"> 解決するために，考えたことや調べたこと
              <span class="badge badge-danger">必須</span> </a>
          </li>
          <ul>
            <div class="form-group">
              <textarea id="my-textarea" class="form-control" name="sol_think"
                rows="3"><?php echo $_SESSION['sol_think'];?></textarea>
            </div>

        </div>
        <div id="result" class="mb-3">
          <!--３． 実践結果 -->
          <li><a class="btn text-nowrap" href="javascript:void(0);">実践した結果，どうなった？ <span
                class="badge badge-danger">必須</span>
            </a>
          </li> （完成していれば，<strong>達成</strong>
          と記入してください。）
          <ul>
            <div class="form-group">
              <textarea id="results" class="form-control" name="results"
                rows="3"><?php echo $_SESSION['results'];?></textarea>
            </div>
            <div class="d-flex justify-content-between">
              <li class="col">達成度 <span class="badge badge-success">任意</span> </li>
              <div class="col input-group mb-3 ">
                <input class="form-control" type="number" name="achievement" min=0 max="100" maxlength="3"
                  style="text-align: right;">
                <div class="input-group-append">
                  <span class="input-group-text">%</span>
                </div>
              </div>
            </div>
          </ul>

        </div>

        <div id="problem" class="mb-3">
          <!--４． 次回課題 -->
          <li>
            <a class="btn btn-link text-nowrap" data-toggle="collapse" href="#kadai" role="button" aria-expanded="false"
              aria-controls="kadai">今回の作業について
            </a>
          </li>
          <ul id="kadai" class="collapse">
            <li class="detail">今回の作業で浮かび上がった課題は？ <span class="badge badge-danger">必須</span> </li>
            <div class="form-group">
              <textarea id="kadai" class="form-control" name="kadai"
                rows="3"><?php echo $_SESSION['kadai'];?></textarea>
            </div>
            <div>
              <li class="detail"> <strong>現時点で</strong>どのようにすれば，うまくいくと考えている？ <span class="badge badge-danger">必須</span>
              </li>
              <div class="form-group">
                <textarea id="kadai-sol" class="form-control" name="kadai-sol"
                  rows="3"><?php echo $_SESSION['kadai-sol'];?></textarea>
              </div>
            </div>

          </ul>
        </div>
        <hr>
        <div id="next-sagyou" class="mb-3">
          <li>
            <a class="btn btn-link text-nowrap" data-toggle="collapse" href="#nextDo" role="button"
              aria-expanded="false" aria-controls="nextDo">次回の作業予定　<span class="badge badge-danger">必須</span>
            </a>
          </li>
          <ul class="collapse" id="nextDo">
            <div class="d-flex justify-content-between mb-3">
              <li class="detail col-5 align-self-center">
                開始時間
              </li>
              <input id="next-start" class="form-control date col-7" type="datetime-local" name="next-start"
                value=<?php echo $_SESSION['next-start']; ?>>
            </div>

          </ul>

        </div>

      </ol>
      <button class="btn btn-info btn-block" type="submit">確認する</button>
    </form>


  </div>
  </div>
  <?php include_once('nippou_style.php')
?>

</body>



</html>