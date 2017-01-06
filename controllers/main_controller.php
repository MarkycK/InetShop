<?php
defined("CATALOG") or 
header("Location: 404.php"); /* Redirect browser */
include 'config.php';
include 'model/main_model.php';
	$categories = get_cat();
	$categories_tree = map_tree($categories);
	$categories_menu = categories_to_string($categories_tree);
	// получение страниц меню
	$pages = get_pages();
?>