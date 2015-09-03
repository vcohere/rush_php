<?php
session_start();

if ($_SESSION['login'] != 'admin')
  header('Location: index.php');
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
    <div class="con"><a href="/admin.php">< Go back</a></div>
  </div>
  <?php
  include 'sql_log.php';
  $result = mysqli_query($connection, 'SELECT * FROM commands');
  while ($datas = mysqli_fetch_assoc($result)) {
    $items = unserialize($datas['items']);
    echo $datas['user'] . "<br />";
    foreach ($items as $item) {
      $req_pre = mysqli_prepare($connection, 'SELECT * FROM articles WHERE id = ?');
      mysqli_stmt_bind_param($req_pre, "i", $item['id']);
      mysqli_stmt_execute($req_pre);
      mysqli_stmt_bind_result($req_pre, $data['id'], $data['name'], $data['descr'], $data['img'], $data['categorie'], $data['price']);
      if (mysqli_stmt_fetch($req_pre)) {
        echo $data['name'] . " x" . $item['nb'] . "<br />";
      }
      mysqli_close($connection);
      include 'sql_log.php';
    }
  }
  mysqli_free_result($result);
  ?>
</body>
</html>
