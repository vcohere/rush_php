<?php
include 'sql_log.php';

mysqli_query($connection, 'INSERT INTO articles (name, descr, image, categorie, price) VALUES ("Lighting Cube", "Such light so colors !", "/assets/img/cube1.jpg", "lighting;multicolor", 12)');
echo "First item created.<br />";
mysqli_query($connection, 'INSERT INTO articles (name, descr, image, categorie, price) VALUES ("Red Cube", "Little red cube so cute :3", "/assets/img/07-cube.jpg", "red;cute", 6)');
echo "Second item created.<br />";
mysqli_query($connection, 'INSERT INTO articles (name, descr, image, categorie, price) VALUES ("Blue and red Cube", "Swag.", "/assets/img/cube02.jpeg", "red;blue", 7)');
echo "Third item created. <br />";
?>
