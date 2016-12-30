<?php
// error_reporting(E_ALL);
	define("CATALOG", true);
	include 'model/config.php';
	include 'model/function.php';
	
	$routes = array(
			array('url' =>'#^$|^\?#',
				'view' => 'category'
				), 
			array('url' => '#^product/(?P<product_alias>[a-z0-9-]+)#i',
				  'view' => 'product'
				),
			array('url' => '#^category/(?P<category_alias>[a-z0-9-]+)#i',
				  'view' => 'category'
				)
			);
	$url = str_replace("/CatalogTovarov/",'',$_SERVER['REQUEST_URI']);
	foreach ($routes as $route) {
		if(preg_match($route['url'], $url, $match)){
			$view = $route['view'];
			break;
		}
	}
	if( empty($match)){
	   include 'views/404.php';
	   exit;
	}
	extract($match);
	// $category_alias - alias категории
	// $product_alias - alias продукта
	// $view - вид для подключения

	$categories = get_cat();
	$categories_tree = map_tree($categories);
	$categories_menu = categories_to_string($categories_tree);
	/*
	может быть либо ID продукта, либо ID категории .. если есть ID прод тогда ID категории возьмем из поля parent, иначе - возьмем сразу из параметра
	*/
	if(isset($product_alias)){
		// массив данных о продукте
		$get_one_product = get_one_product($product_alias);
		// получение ИД категории
		$id = $get_one_product['parent'];
	}else{
		 // $category_alias = $_GET['category'];
		$get_category = get_category($category_alias);
		$id = $get_category['id'];
	}
	
		//хлебные крошки
		 $breadcrumbs_array = breadcrumbs($categories, $id);
		 if($breadcrumbs_array){
			 	$breadcrumbs  = "<a href='".PATH."'>Главаня</a> / ";
				foreach ($breadcrumbs_array as $id => $title){
		 		  $breadcrumbs .="<a href='".PATH."category/{$id}'>{$title}</a> / ";
		        }
		        if(!isset($get_one_product)){
					$breadcrumbs = rtrim($breadcrumbs, " / ");
			        $breadcrumbs = preg_replace("#(.+)?<a.+>(.+)</a>$#", "$1$2", $breadcrumbs);
		        }else{
					$breadcrumbs .= $get_one_product['title'];
		        }
		       
			}else{
				    $breadcrumbs = "<a href='".PATH."'>Главаня</a> / Каталог";
			}
		 	//Id дочерних категорий.
		 	$ids = cats_id($categories, $id);
		 	$ids = !$ids ? $id : rtrim($ids, ", ");

		 	//----------- Pagination  ------------//
		 	// кол-ство товаров на страницу
		 	$perpage = (int)$_COOKIE['per_page'] ? $_COOKIE['per_page'] : PERPAGE;
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
			include "views/{$view}.php";
?>