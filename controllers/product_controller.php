<?php
defined("CATALOG") or 
header("Location: 404.php"); /* Redirect browser */
include "main_controller.php"; 
include "model/{$view}_model.php";

/*
	может быть либо ID продукта, либо ID категории .. если есть ID прод тогда ID категории возьмем из поля parent, иначе - возьмем сразу из параметра
	*/
	// массив данных о продукте
	$get_one_product = get_one_product($product_alias);
		// получение ИД категории
	$id = $get_one_product['parent'];
	// хлеюные крошки
	include 'libs/breadcrumbs.php';

include "views/{$view}.php";

?>