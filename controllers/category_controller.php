<?php
defined("CATALOG") or 
header("Location: 404.php"); /* Redirect browser */
include "main_controller.php";
include "model/{$view}_model.php";
			// ЧПУ категорий
		if(!isset($id)){
			$id = null;
		}
		if(isset($category_alias)){
					$get_category = get_category($category_alias);		
					 $id = $get_category['id'];
					}
		 	//Id дочерних категорий.
		 	$ids = cats_id($categories, $id);
		 	$ids = !$ids ? $id : rtrim($ids, ", ");
//----------- Pagination  ------------//
		 	// кол-ство товаров на страницу

		 	$perpage = ((isset($_COOKIE['per_page'])) && (int)$_COOKIE['per_page']) ? $_COOKIE['per_page'] : PERPAGE;
		 	//  общее колство товаров
		 	$count_goods = count_goods($ids);
		 	// необходимое кол-ство страниц
		 	$count_pages = ceil($count_goods / $perpage);
		 	// минимум 1 страница
		 	if(!$count_pages) $count_pages = 1;
			// получение текущей страницы
			if(isset($_GET['page'])){
				$page = (int)$_GET['page'];
				if($page < 1) $page = 1;
			}else{
				$page = 1;
			}
			// если запрошенная страница больше максимума
			if( $page > $count_pages) $page = $count_pages; 
			// начяльная позиция для запроса
			 $start_pos = ($page - 1)*$perpage;
			$pagination = pagination($page, $count_pages);
		 	//------------ /Pagination ----------- //
			$products = get_products($ids, $start_pos, $perpage);
include 'libs/breadcrumbs.php';
include "views/{$view}.php";

?>