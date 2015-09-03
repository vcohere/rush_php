<?php
session_start();

if (strlen($_POST['login']) < 3 || strlen($_POST['login']) > 18) {
	$error = 1;
}

$login = $_POST['login'];
$pass = hash("whirlpool", $_POST['passwd']);

include 'sql_log.php';

$req_pre = mysqli_prepare($connection, 'SELECT pass FROM users WHERE login = ?');
mysqli_stmt_bind_param($req_pre, "s", mysql_real_escape_string($login));
mysqli_stmt_execute($req_pre);
mysqli_stmt_bind_result($req_pre, $result);
if (mysqli_stmt_fetch($req_pre)) {
	if ($pass == $result) {
		$_SESSION['login'] = $login;
		$error = 3;
	}
	else {
		$error = 2;
	}
}
else {
	$error = 1;
}
header('Location: forms.php?l=' . $error)
?>
