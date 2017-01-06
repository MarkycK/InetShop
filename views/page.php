<?php
defined("CATALOG") or 
header("Location: 404.php"); /* Redirect browser */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Catalog</title>
	<link rel="stylesheet" type="text/css" href="<?=PATH?>views/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?=PATH?>views/css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="wrapper">
			<div class="sidebar col-md-3">
				<nav>
					<?php 
						include "sidebar.php";
					?>
				</nav>
			</div>
			<div class="content col-md-9">
				<div class="row ">
					<?php include 'menu.php';?>
				</div>
				<div class="row indent_side">
					<?php print_arr($breadcrumbs);?>
				</div>
				<div class="row indent_side">
					<?php echo $page['text']; ?>
				</div>
			</div>
		</div>
	</div>
	</body>

<script type="text/javascript" src="<?=PATH?>views/Js/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="<?=PATH?>views/Js/bootstrap.js"></script>
<script type="text/javascript" src="<?=PATH?>views/Js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?=PATH?>views/Js/jquery.accordion.js"></script>
<script type="text/javascript" src="<?=PATH?>views/Js/script.js"></script>
</body>
</html>