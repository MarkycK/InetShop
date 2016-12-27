<?php
	include "lib/config.php";
	include "lib/function.php";
	include "lib/catalog.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Catalog</title>
	<link rel="stylesheet" type="text/css" href="<?=PATH?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?=PATH?>css/bootstrap.css">
</head>
<body>
	<nav class="container indent">
		<a href="<?=PATH?>" class="home">Главаня</a>
	</nav>
	<div class="container">
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
				<div class="row indent_side">
					<?php print_arr($breadcrumbs);?>
				</div>
				<div class="product">
					<?php if(isset($get_one_product)): ?>
						<?php print_arr($get_one_product); ?>
					<?php else: echo "Такого товара нет"; ?>
					<?php endif; ?>
				</div>
			</div>
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