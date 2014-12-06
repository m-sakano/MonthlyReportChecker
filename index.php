<?php

require_once('config.php');
require_once('functions.php');

session_start();

if (!isset($_SESSION['me'])) {
    header('Location: '.SITE_URL.'login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo BRAND; ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico">
</head>
<body>

<div id="header" class="container" style="background:white;">
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo SITE_URL; ?>"><?php echo BRAND; ?></a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo h($_SESSION['me']['google_email']); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="logout.php">ログアウト</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-3" style="background:white;">Side1</div>
		<div class="col-sm-6" style="background:white;">
			<h1>月末申請書のオンラインチェック</h1>
			<form action="upload.php" method="post" enctype="multipart/form-data">
				<div class ="form-group">
					<label class="control-label" for="file">ファイル</label>
					<input type="file" id="file" class="form-control" placeholder="file" name="upfile" />
				</div>
				<div class="form-group">
					<input type="submit" value="アップロードしてチェック" class="btn btn-primary" />
				</div>
			</form>
			<h1>チェックメッセージ</h1>
			<?php showMessages(); ?>
		</div>
		<div class="col-sm-3" style="background:white;">
			<script src="http://bijo-linux.com/bp/js/bijo-off-0.9.js"></script>
		</div>
	</div>
</div>

<div id="footer" class="container" style="background:#C7243A;">footer</div>

<!-- jQuery & bootstrap plugins-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
