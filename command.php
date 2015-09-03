<?php
session_start();

if (!isset($_SESSION['login']) || !isset($_SESSION['basket'])) {
  header('Location: index.php');
  exit;
}
if ($_SESSION['nbbasket'] == 0) {
  header('Location: basket.php');
  exit;
}

include 'sql_log.php';

$req_two = mysqli_prepare($connection, 'INSERT INTO commands (user, items) VALUES (?, ?)');
mysqli_stmt_bind_param($req_two, "ss", $_SESSION['login'], serialize($_SESSION['basket']));
mysqli_stmt_execute($req_two);
unset($_SESSION['basket']);
$_SESSION['nbbasket'] = 0;
header('Location: profile.php');
?>
