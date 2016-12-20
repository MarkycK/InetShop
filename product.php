<?php
	include "config.php";
	include "function.php";
	include "catalog.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Catalog</title>
	<link rel="stylesheet" type="text/css" href="<?=PATH?>css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?=PATH?>css/style.css">
</head>
<body>
	<a href="<?=PATH?>" class="home">Главаня</a>
	<div class="wrapper">
		<div class="sidebar col-md-3">
			<nav>
			<ul id="accordion" class="menu">
				<?php 
				echo $categories_menu
				?>
			</ul>
			</nav>
		</div>
		<div class="content col-md-9">
			<div class="row">
			<?php print_arr($breadcrumbs);?>
			</div>
			<?=$_GET['product']?>
		</div>
	</div>
	</body>

<script type="text/javascript" src="<?=PATH?>Js/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="<?=PATH?>Js/bootstrap.js"></script>
<script type="text/javascript" src="<?=PATH?>Js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?=PATH?>Js/jquery.accordion.js"></script>
<script type="text/javascript" src="<?=PATH?>Js/script.js"></script>
</body>
</html>