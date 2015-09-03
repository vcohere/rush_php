<?php
session_start();
if (!isset($_SESSION['login']) || !isset($_GET['item']))
	header('Location: index.php');
if (!isset($_SESSION['nbbasket']))
	$_SESSION['nbbasket'] = 1;
else
	$_SESSION['nbbasket']++;

foreach ($_SESSION['basket'] as $key => $value) {
	if ($value['id'] == $_GET['item']) {
		$_SESSION['basket'][$key]['nb'] = $value['nb'] + 1;
		header('Location: index.php');
		exit;
	}
}

$new = array('id' => $_GET['item'], 'nb' => 1);
array_push($_SESSION['basket'], $new);
header('Location: index.php');
?>
