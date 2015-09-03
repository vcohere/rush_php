<?php
session_start();
if ($_SESSION['login'] != 'admin')
	header('Location: index.php');

include 'sql_log.php';

if (strlen($_POST['name']) > 1 && strlen($_POST['desc']) > 1 && strlen($_POST['img']) > 1) {
	$req_pre = mysqli_prepare($connection, 'INSERT INTO articles (name, descr, image, categorie, price) VALUES (?, ?, ?, ?, ?)');
	mysqli_stmt_bind_param($req_pre, "ssssi", $_POST['name'], $_POST['desc'], $_POST['img'], $_POST['cate'], $_POST['price']);
	mysqli_stmt_execute($req_pre);
}

$result = mysqli_query($connection, 'SELECT * FROM users');
$users = array();
while ($datas = mysqli_fetch_assoc($result)) {
	array_push($users, $datas);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Epic Webshop of The Death</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/form.css">
</head>

<body>
	<div id="nav">
		<div class="con"><a href="/index.php">< Go back</a></div>
	</div>

	<h1> Administation </h1>
<div class="tableau">

<div class="tdpro">
	<h2> Products </h2>
		<?php
		$result = mysqli_query($connection, 'SELECT * FROM articles');
		while ($datas = mysqli_fetch_assoc($result)) {
		?>
	<b> <?php echo $datas['name']; ?> </b>	- <?php echo $datas['descr']; ?> </br>
	<?php
	}
	?>
</div>

<div class="td">
	<h2> Add Products </h2>
	<form method="post" action="admin.php">
		Name: <input type="text" name="name" /><br />
		Desc: <input type="text" name="desc" /><br />
		Image: <input type="text" name="img" placeholder="Internet URL or path" /><br />
		Categorie: <input type="text" name="cate" placeholder="Separate with ';'" /><br />
		Price: <input type="number" name="price" /><br />
		<input type="submit" name="submit" value="Add" />
	</form>
</div>

<div class="tdus">
	<h2>Users</h2>
	<?php
	foreach ($users as $user) {
		echo $user['login'] . "   <a href='del_user?user=" . $user['id'] . "'>X</a><br />";
	}
	?>
</div>

</div>


</body>
</html>
