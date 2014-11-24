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
    <title>ホーム画面</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div id="header" class="container" style="background:#C7243A;">header</div>

<div class="container">
	<div class="row">
		<div class="col-sm-3" style="background:white;">Side1</div>
		<div class="col-sm-6" style="background:white;">
			<h1>ホーム画面</h1>
			<p><?php echo h($_SESSION['me']['google_name']); ?>(<?php echo h($_SESSION['me']['google_email']); ?>)の
			googleアカウントでログインしています。</p>
			<p><a href="logout.php">[ログアウト]</a></p>
			<h2>チェックする月末申請書をアップロード</h2>
			<form action="upload.php" method="post" enctype="multipart/form-data">
				<div class ="form-group">
					<label class="control-label" for="file">ファイル</label>
					<input type="file" id="file" class="form-control" placeholder="file" name="upfile" />
				</div>
				<div class="form-group">
					<input type="submit" value="アップロード" class="btn btn-primary" />
				</div>
			</form>
			<h2>メッセージ</h2>
			<?php
                showMessages();
			?>
		</div>
		<div class="col-sm-3" style="background:white;">Side2</div>
	</div>
</div>

<div id="footer" class="container" style="background:#555555;">footer</div>

<!-- jQuery & bootstrap plugins-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
