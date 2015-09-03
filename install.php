<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "eleonore";
$dbname = "ecommerce";

$connection = mysqli_connect($servername, $username, $password);
if (!$connection) {
	echo "Plop";
	die("Connection failed: " . mysqli_connect_error());
}
$db = "CREATE DATABASE IF NOT EXISTS `" . $dbname . "` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
if (mysqli_query($connection, $db)) {
	echo "Database created.\n";
}
else {
	echo "Error creating db.\n";
}
mysqli_close($connection);

$connection = mysqli_connect($servername, $username, $password, $dbname);
if (!$connection) {
	die("Connection failed: " . mysqli_connect_error());
}

$users = "CREATE TABLE IF NOT EXISTS `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`login` varchar(20) NOT NULL,
	`pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$articles = "CREATE TABLE IF NOT EXISTS `articles` (
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` varchar(100) NOT NULL,
	`descr` text NOT NULL,
	`image` text NOT NULL,
	`categorie` text NOT NULL,
	`price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$commands = "CREATE TABLE IF NOT EXISTS `commands` (
	`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`user` varchar(20) NOT NULL,
	`items` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if (mysqli_query($connection, $users)) {
	echo "Table Users created. <font color='green'>Success.</font><br />";
}
else {
	echo "Table Users not created. <font color='red'>Failure.</font><br />";
}
if (mysqli_query($connection, $articles)) {
	echo "Table Articles created. <font color='green'>Success.</font><br />";
}
else {
	echo "Table Articles not created. <font color='red'>Failure.<br />";
}
if (mysqli_query($connection, $commands)) {
	echo "Table Commands created. <font color='green'>Success.</font><br />";
}
else {
	echo "Table Commands not created. <font color='red'>Failure.</font><br />";
}

$admin = "admin";
$adminpw = hash("whirlpool", $admin);

mysqli_close($connection);
include 'sql_log.php';

$req_pre = mysqli_prepare($connection, 'INSERT INTO users (login, pass) VALUES (?, ?)') or die(mysqli_error($connection));
mysqli_stmt_bind_param($req_pre, "ss", $admin, $adminpw);
mysqli_stmt_execute($req_pre);

mysqli_close($connection);
?>
