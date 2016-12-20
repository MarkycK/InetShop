<?php
	$categories = get_cat();
	$categories_tree = map_tree($categories);
	$categories_menu = categories_to_string($categories_tree);
		$id = (int)$_GET['category'];
		//хлебные крошки
		 $breadcrumbs_array = breadcrumbs($categories, $id);
		 if($breadcrumbs_array){
			 	$breadcrumbs  = "<a href='".PATH."'>Главаня</a> / ";
				foreach ($breadcrumbs_array as $id => $title){
		 		  $breadcrumbs .="<a href='".PATH."?category={$id}'>{$title}</a> / ";
		        }
		        $breadcrumbs = rtrim($breadcrumbs, " / ");
		        $breadcrumbs = preg_replace("#(.+)?<a.+>(.+)</a>$#", "$1$2", $breadcrumbs);
			}else{
				    $breadcrumbs = "<a href='".PATH."'>Главаня</a> / Каталог";
			}
		 	//Id дочерних категорий.
		 	$ids = cats_id($categories, $id);
		 	$ids = !$ids ? $id : rtrim($ids, ", ");

		 	//----------- Pagination  ------------//
		 	// кол-ство товаров на страницу
		 	$perpage = 5;
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
?>