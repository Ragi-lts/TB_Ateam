<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
<?php include_once('prepare.php');

?>



<link rel="shortcut icon" href="icon/favicon.ico" type="image/x-icon">

<title><?php echo $title?>
</title>

<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href="#">
    <img src="icon/favicon.ico" width="30" height="30" alt="">
  </a>
  <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav"
    aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>
  </button>
  <div id="my-nav" class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">TOP<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#!" data-target="#askpass" data-toggle="modal">チーム資料</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#/iken">意見箱<span class="sr-only">(current)</span></a>

        <!-- <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Item 2</a>
            </li>  -->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/nippou/nippou.php">日報整理 <span class="badge badge-danger">PC</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/bibiography/index.php">参考サイト集</a>
      </li>

      <!-- 内部情報(Version,Updated dateなど) -->
      <li class="nav-item ml-auto" data-toggle="tooltip" data-placement="bottom"
        title=<?php  echo "Updated:".date('Y/m/d', $update); ?>>
        <span class="nav-link  disabled " href="#" aria-disabled="true">Version:
          <?php echo $_ENV['VERSION']?>
        </span>
      </li>

    </ul>
  </div>
</nav>



<!-- ページ遷移 -->
<div id="askpass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="askpass-t" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="askpass-t">外部サイトへの遷移</h5>
      </div>
      <div class="modal-body text-center">
        <p>チーム資料フォルダに移動しますか？
          (外部サイトに移動します)</p>
      </div>
      <div class="modal-footer w-90">
        <a href="https://drive.google.com/drive/folders/1a2ukYaUSSjP1k3WxaDP7VSRFqH7UjdMd"
          class="btn btn-primary btn-block col" role="button">OK</a>

        <button class="btn btn-danger btn-block col" data-dismiss="modal" aria-label="Close">
          <span>キャンセル</span>
        </button>
      </div>
    </div>
  </div>
</div>





<style>
body {
  padding: 70px 0;

  font-family: 'Noto Sans ', 'Kosugi Maru', sans-serif;
}

.navbar-light .navbar-toggler {
  border-color: rgba(0, 0, 0, 0);
}

.tooltip-inner {
  max-width: 100%;
}
</style>
<script>
$('[data-toggle="tooltip"]').tooltip();
</script>