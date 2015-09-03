<?php
$error = 0;
if ($_POST['passwd_one'] != $_POST['passwd_two']) {
	$error = 2;
}
else {
	$pass = hash("whirlpool", $_POST['passwd_one']);
}
if (strlen($_POST['passwd_one']) < 8 || strlen($_POST['passwd_one']) > 40) {
	$error = 3;
}
if (strlen($_POST['login']) < 3 || strlen($_POST['login']) > 18) {
	$error = 4;
}
else {
	$login = $_POST['login'];
}

if ($error != 0) {
	header('Location: forms.php?r=' . $error);
	exit;
}

include 'sql_log.php';
$req_pre = mysqli_prepare($connection, 'SELECT * FROM users WHERE login = ?');\
mysqli_stmt_bind_param($req_pre, "s", mysql_real_escape_string($login));
mysqli_stmt_execute($req_pre);
if (mysqli_stmt_fetch($req_pre)) {
	$error = 5;
}
else if ($error == 0) {
	mysqli_close($connection);
	include 'sql_log.php';
	$req_pre = mysqli_prepare($connection, 'INSERT INTO users (login, pass) VALUES (?, ?)');
	mysqli_stmt_bind_param($req_pre, "ss", mysql_real_escape_string($login), mysql_real_escape_string($pass));
	mysqli_stmt_execute($req_pre);
	$error = 6;
}

header('Location: forms.php?r=' . $error);
exit;
?>
