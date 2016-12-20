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
			<div class="row ">
			<?php if($products):?>
					<nav class="text-center" aria-label="Page navigation ">
					  <ul class="pagination">
					     <?php if($count_pages > 1): ?>
					     <?php echo $pagination; ?>
						 <?php endif; ?>
					  </ul>
					</nav>
			</div><!--/pagination -->
			<div class="row">
				<div class="products">
					<?php foreach($products as $product): ?> 
					<a href="<?=PATH?>?product.php?product=<?=$product['id']?>"><?=$product['title']?></a><br>
					<?php endforeach; ?>
					<?php else:?>
						<p>Здесь товаров нет</p>
					<?php endif; ?>
				</div>
			</div>
			<div class="row ">
					<nav class="text-center" aria-label="Page navigation ">
					  <ul class="pagination">
					     <?php if($count_pages > 1): ?>
					     <?php echo $pagination; ?>
						 <?php endif; ?>
					  </ul>
					</nav>
			</div><!--/pagination -->
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