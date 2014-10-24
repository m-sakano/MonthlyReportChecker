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
    <title>ホーム画面</title>
</head>
<body>
<h1>ホーム画面</h1>
<p><?php echo h($_SESSION['me']['google_name']); ?>(<?php echo h($_SESSION['me']['google_email']); ?>)の
googleアカウントでログインしています。</p>
<p><a href="logout.php">[ログアウト]</a></p>
<h2>チェックする月末申請書をアップロード</h2>
<form action="upload.php" method="post" enctype="multipart/form-data">
  ファイル：<br />
  <input type="file" name="upfile" size="30" /><br />
  <br />
  <input type="submit" value="アップロード" />
</form>
<h2>メッセージ</h2>
<?php
foreach($_SESSION['msg'] as $s) {
    echo "<p>" . $s . "</p>";
}
$_SESSION['msg'] = null;
?>
</body>
</html>
