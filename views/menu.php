<?php
defined("CATALOG") or 
header("Location: 404.php"); /* Redirect browser */
?>
<ul class="main_menu indent_side" >
		<?php foreach ($pages as $link => $item_page): ?>
			<?php if($link == 'index'): ?>
				<li><a href="<?php echo PATH; ?>"><?php echo $item_page;?>
				</a></li>
			<?php else:?>
			<li><a href="<?php echo PATH.'page/'.$link; ?>"><?php echo $item_page;?>
				
			</a></li>
			<?php endif;?>
		<?php endforeach; ?>
</ul>