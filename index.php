<?php
session_start();
if (!isset($_SESSION['basket']))
	$_SESSION['basket'] = array();
if (!isset($_SESSION['nbbasket']))
	$_SESSION['nbbasket'] = 0;
include 'sql_log.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Epic Webshop of The Death</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<div id="nav">
		<div class="con">
			<?php	if (!($_SESSION['login'])):  ?>
		<a href="/forms.php" title="connexion">Login & Register</a>
	<?php else: ?>
		<a href="/disconnect.php">Logout</a> - <a href="/profile.php">Profile</a>
		<?php
		if ($_SESSION['login'] == "admin")
			echo " - <a href='admin.php'>Administration</a>";
		?>
	<?php endif ?>
</div>
		<a href="/basket.php"><div class="basket">Cart<div class=art><?php echo $_SESSION['nbbasket']; ?></div></div></a>
</div>
	<div id="header">
		<h1>My Epic Webshop </h1> <h1 class="title">of The Death</h1>
	</div>
	<div id="content">
		<?php
		$categories = array();
		$result = mysqli_query($connection, 'SELECT * FROM articles');
		while ($datas = mysqli_fetch_assoc($result)) {
			$item_cat = explode(";", $datas['categorie']);
			if (!isset($_GET['tri']) || in_array($_GET['tri'], $item_cat, true)) {
		?>
			<div class="article">
			<img src="<?php echo $datas['image']; ?>" />
			<span class="desc">
			<?php
			echo "<a href='add_basket.php?item=" . $datas['id'] . "'>";
			?>
				<h3><?php echo $datas['name']; ?> </h3> </a>
				<?php echo $datas['descr']; ?> </span>
				<?php echo "<div class='pricebubble'>" . $datas['price'] . "$</div>" ?>
				<span class="addcart"><a href="add_basket.php?item=<?php echo $datas['id']; ?>">Add to Cart</a></span>
				</div>

		<?php
		}
			$cats = explode(";", $datas['categorie']);
			foreach ($cats as $cat) {
				if (!in_array($cat, $categories, true)) {
					array_push($categories, $cat);
				}
			}
		}
		?>
	</div>
	<div id="content">
		<div class='hashtag'><a href='index.php'>#all</a></div>
		<?php
		foreach ($categories as $categorie) {
			echo "<div class='hashtag'><a href='index.php?tri=" . $categorie . "'>#" . $categorie . "</a></div>";
		}
		?>
	</div>
</body>
</html>
