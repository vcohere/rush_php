<?php
session_start();
if ($_SESSION['login'] != 'admin')
  header('Location: index.php');

include 'sql_log.php';

$sql = "DELETE FROM users WHERE id = " . mysql_real_escape_string($_GET['user']);
if (mysqli_query($connection, $sql)) {
  header('Location: admin.php');
}
else {
  header('Location: admin.php');
}
?>
