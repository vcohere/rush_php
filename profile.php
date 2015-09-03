<?php
session_start();
if (!isset($_SESSION['login']))
  header('Location: index.php');
include 'sql_log.php';

$items = array();

$req_pre = mysqli_prepare($connection, 'SELECT items FROM commands WHERE user = ?');
mysqli_stmt_bind_param($req_pre, "s", $_SESSION['login']);
mysqli_stmt_execute($req_pre);
mysqli_stmt_bind_result($req_pre, $item);
while (mysqli_stmt_fetch($req_pre)) {
  if (isset($item))
    array_push($items, unserialize($item));
}
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/form.css">
  <title>My Epic Webshop of The Death</title>
</head>
<body>
  <div id="nav">
    <div class="con"><a href="/index.php">< Go back</a></div>
    <a href="/basket.php"><div class="basket">Cart<div class=art><?php echo $_SESSION['nbbasket']; ?></div></div></a>
</div>

<h1> <?php echo ucfirst($_SESSION['login']); ?>'s Profile </h1>

<div id="content">
<h2> Orders </h2>
<?php
foreach ($items as $command) {
  ?>
  <div class="command"> <?php
  $total = 0;
  foreach ($command as $item) {
    include 'sql_log.php';
    $req_pre = mysqli_prepare($connection, 'SELECT * FROM articles WHERE id = ?');
    mysqli_stmt_bind_param($req_pre, "i", $item['id']);
    mysqli_stmt_execute($req_pre);
    mysqli_stmt_bind_result($req_pre, $data['id'], $data['name'], $data['descr'], $data['img'], $data['categorie'], $data['price']);
    if (mysqli_stmt_fetch($req_pre)) {
      echo "<b>" . $data['name'] . "</b> - (Qte :" . $item['nb'] . ")";
      echo "<div class='prix'> Montant :" . $data['price'] * $item['nb'] . "$</div>------------------ <br/> ";
      $total +=  $data['price'] * $item['nb'];
    }
  }
  if ($total != NULL)
    echo "<div class='totol'> Total commande :" . $total . "$ </div>"; ?>
</div>
<?php
}
?>
<div class="erreur">
<?php
  switch ($_GET['e']) {
    case 1:
      echo 'The new password and the confirmation are differents.';
      break;
    case 2:
      echo 'The password length must be between 8 and 40 chars.';
      break;
    case 3:
      echo 'Wrong password.';
      break;
    case 4:
      echo "Success !";
      break;
  }
?>
</div>
<div class="pass">
<h2> Change Password </h2>
<form method="post" action="change_pw.php">
    Your password: <input type="password" name="old_pwd" /><br />
    New password: <input type="password" name="new_pwd" /><br />
    Retype the new one: <input type="password" name="confirm" /><br />
    <input type="submit" name="submit" value="Change" />
</form>
</div>
</div>
</body>
</html>
