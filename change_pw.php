<?php
session_start();

if (empty($_POST['new_pwd'])) {
  header('Location: profile.php?e=2');
  exit;
}
else if (empty($_POST['confirm'])) {
  header('Location: profile.php?e=2');
  exit;
}
else if (!isset($_SESSION['login'])) {
  header('Location: index.php');
  exit;
}
else if ($_POST['submit'] != 'Change') {
  header('Location: profile.php');
  exit;
}
else if ($_POST['new_pwd'] != $_POST['confirm']) {
  header('Location: profile.php?e=1');
  exit;
}
else if (strlen($_POST['new_pwd']) < 8 || strlen($_POST['new_pwd']) > 40) {
  header('Location: profile.php?e=2');
  exit;
}
$passwd = hash("whirlpool", $_POST['new_pwd']);
$oldone = hash("whirlpool", $_POST['old_pwd']);

include 'sql_log.php';

$req_pre = mysqli_prepare($connection, 'SELECT pass FROM users WHERE login = ?');
mysqli_stmt_bind_param($req_pre, "s", $_SESSION['login']);
mysqli_stmt_execute($req_pre);
mysqli_stmt_bind_result($req_pre, $oldpass);
if (mysqli_stmt_fetch($req_pre)) {
  mysqli_close($connection);
  if ($oldpass != $oldone) {
    header('Location: profile.php?e=3');
    exit;
  }
  else {
    include 'sql_log.php';
    $req = mysqli_prepare($connection, 'UPDATE users SET pass = ? WHERE login = ?');
    mysqli_stmt_bind_param($req, "ss", $passwd, $_SESSION['login']);
    mysqli_stmt_execute($req);
    header('Location: profile.php?e=4');
    exit;
  }
}
else {
  header('Location: profile.php');
  exit;
}
?>
