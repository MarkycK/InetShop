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
				<div class="perpage">
					<select name="perage" id="perpage">
						<?php 
						  foreach($option_perpage as $option): 
						  	?>
						  <option <?php if($perpage == $option) echo"Selected"; ?> value="<?=$option?>"><?=$option?> товаров на страницу</option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="">
				<?php if($products):?>
						<nav class="text-center" aria-label="Page navigation" >
						  <ul class="pagination ajax" style="list-style:none">
						     <?php if($count_pages > 1): ?>
						    <?php echo $pagination; ?> 

							 <?php endif; ?>
						  </ul>
						</nav>
				</div>
			</div><!--/pagination -->
			<div class="row indent_side">
				<div class="products indent_side">
					<?php foreach($products as $product): ?> 
					<a href="<?=PATH?>product/<?=$product['alias']?>"><?=$product['title']?></a><br>
					<?php endforeach; ?>
					<?php else:?>
						<p>Здесь товаров нет</p>
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
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

<script type="text/javascript" src="<?=PATH?>views/Js/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="<?=PATH?>views/Js/bootstrap.js"></script>
<script type='text/javascript' src='<?=PATH?>views/js/plugins/jquery.cookie.js'></script>
<script type='text/javascript' src='<?=PATH?>views/js/plugins/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='<?=PATH?>views/js/plugins/jquery.dcjqaccordion.2.7.js'></script>
<!-- <script type="text/javascript" src="<?=PATH?>views/Js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?=PATH?>views/Js/jquery.accordion.js"></script> -->
<script type="text/javascript" src="<?=PATH?>views/Js/script.js"></script>
</body>
</html>