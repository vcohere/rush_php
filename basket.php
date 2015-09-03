<?php
session_start();
include 'sql_log.php';

$result = mysqli_query($connection, 'SELECT * FROM articles');
$articles = array();
while ($datas = mysqli_fetch_assoc($result)) {
	foreach ($_SESSION['basket'] as $article) {
		if (in_array($datas['id'], $article, true)) {
			$datas['nb'] = $article['nb'];
			array_push($articles, $datas);
		}
	}
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
		<a href="/basket.php"><div class="basket">Cart<div class=art><?php echo $_SESSION['nbbasket']; ?></div></div></a>
		</div>
	</div>
	<div id="container">
		<h1> My Cart</h1>
	<?php
	$total = 0;
	foreach ($articles as $article) {
		$total = $article['nb'] * $article['price'] + $total;
		echo "<div class='item'><img src='". $article['image'] ."' />";
		echo $article['name'] . "<br />" . $article['descr'] . "<span class='quantity'> Qte: " . $article['nb'] . "</span><span class='price'>" . $article['price'] . "$</div>";
	}
	?>

	<?php
	echo "<div class='total'>" . "Total d'articles : " . $_SESSION['nbbasket'];
	echo "<br />Total: " . $total . "$";
	?>
	</div>

	<div class='buy'>
		<?php
		if (isset($_SESSION['login']))
			echo "<a href='command.php'>Purchase</a>";
		else
			echo "<a href='forms.php'>You must be logged in to buy.</a>";
		?>
	</div>

	<div class="buy"> <a href='empty.php'>Empty</a> </div>
</div>
</body>
</html>
