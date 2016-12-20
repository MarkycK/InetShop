<?php
define("DBHOST", "localhost");
define("DBUSER", "lesson");
define("DBPASS", "12345678");
define("DB", "magazine");
define("PATH", "http://myhosting.com/CatalogTovarov/");
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die ("Нет соиденения с БД");
mysqli_set_charset($connection, "utf8") or die("не установлена кодеровка соиденения");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Catalog</title>
</head>
<body>
	
</body>
</html>