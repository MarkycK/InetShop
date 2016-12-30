<?php
defined("CATALOG") or 
header("Location: 404.php"); /* Redirect browser */
?>
<li>
	<a href="<?=PATH?>category/<?=$category['alias']?>"><?=$category['title']?></a>
	<?php if($category['childs']): ?>
	<ul style="display:none; list-style:none">
		<?php echo categories_to_string($category['childs']); ?>
	</ul>
	<?php endif; ?>
</li>