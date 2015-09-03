<?php
session_start();
if (isset($_SESSION['login']))
	header('Location: index.php');
if ($_GET['l'] == 3)
	header('Location: index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/form.css">
	<title>My Epic Webshop of The Death</title>
</head>
<body>
	<?php
	if ($_GET['l'] == 1)
		echo "User doesn't exist.\n";
	else if ($_GET['l'] == 2)
		echo "Wrong password.\n";
	?>

	<div id="nav">
		<div class="con"><a href="/index.php">< Go back</a></div>
		<a href="/basket.php"><div class="basket">Cart<div class=art><?php echo $_SESSION['nbbasket']; ?></div></div></a>
</div>

	<div class="connexion">
	<h2> Login </h2>
	<font color="red">
	<?php
	switch ($_GET['l']) {
		case 1:
			echo "User not found.";
			break;
		case 2:
			echo "Wrong password.";
			break;
	}
	?>
	</font>
	<form method="post" action="login.php">
		Username: <input type="text" name="login" /><br />
		Password: <input type="password" name="passwd" /><br />
		<input type="submit" name="submit" value="Login" />
	</form>
</div>
	<br />
	<div class="inscription">
	<h2> Suscribe ! </h2>
	<font color="red">
	<?php
	switch ($_GET['r']) {
		case 2:
			echo "Your passwords are differents.<br />";
			break;
		case 3:
			echo "Your password must be between 8 and 40 chars.<br />";
			break;
		case 4:
			echo "Your login must be between 3 and 18 chars.<br />";
			break;
		case 5:
			echo "This login is already in use.<br />";
			break;
		case 6:
			echo "Account created successfuly, you can now login.<br />";
			break;
		default:
			echo "<br />";
	}
	?>
	</font>
	<form method="post" action="register.php">
		Username: <input type="text" name="login" /><br />
		Password: <input type="password" name="passwd_one" /><br />
		Confirm:  <input type="password" name="passwd_two" /><br />
		<input type="submit" name="submit" value="Register" />
	</form>
</div>
</body>
</html>
