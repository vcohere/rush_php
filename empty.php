<?php
session_start();
if (!isset($_SESSION['login'])) {
  header('Location: index.php');
  exit;
}
$login = $_SESSION['login'];
session_destroy();
session_start();
$_SESSION['login'] = $login;
$_SESSION['nbbasket'] = 0;
header('Location: basket.php');
exit;
?>
