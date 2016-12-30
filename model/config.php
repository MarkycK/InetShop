<?php
define("DBHOST", "localhost");
define("DBUSER", "lesson");
define("DBPASS", "12345678");
define("DB", "magazine");
define("PATH", "http://myhosting.com/CatalogTovarov/");
define('PERPAGE', 5);
$option_perpage = array(5, 10 , 15);

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die ("Нет соиденения с БД");
mysqli_set_charset($connection, "utf8") or die("не установлена кодеровка соиденения");
?>