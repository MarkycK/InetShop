<?php
/* Распечятка массива*/
function print_arr($array){
	echo "<pre>".print_r($array, true)."</pre>";
}

/*Получения массива продуктов*/
function get_cat(){
	global $connection;
	$query = "SELECT * FROM categories";
	$res = mysqli_query($connection, $query);

	 $arr_cat = array();
	 while($row = mysqli_fetch_assoc($res)){
	 	$arr_cat[$row['id']] = $row;
	 }
	 return $arr_cat;
}
/*Построение дерева из массива каталога*/ 
function map_tree($dataset){
	$tree = array();
	foreach ($dataset as $id=>&$node) {
		if (!$node['parent']) { // root node
			$tree[$id] = &$node;
		} else { // sub node
			$dataset[$node['parent']]['childs'][$id] = &$node;
		}
	}
	return $tree;
}
/*Дерево в HTML*/
function categories_to_string($data){
	foreach ($data as $item){
		$string .= categories_to_template($item);
	}
	return $string;
}
/*  Шаблон вивода категорий*/
function categories_to_template($category){
	ob_start();
	include "category_template.php";
	return ob_get_clean();
}
function breadcrumbs($array, $id){
	if(!$id) return false;

	$count = count($array);
	$breadcrumbs_array = array();
	for($i = 0; $i < $count; $i++){
		if($array[$id]){
			$breadcrumbs_array[$array[$id]['id']] = $array[$id]['title'];
			$id = $array[$id]['parent'];
		}else break;
	}
	return array_reverse($breadcrumbs_array, true);
}
/*Получение ID дочерних категорий*/
function cats_id($array, $id){
	if(!$id) return false;
	foreach ($array as $item) {
		if($item['parent'] == $id){
			$data .= $item['id'] .", ";
			$data .= cats_id($array, $item['id']);
		}
	}
	return $data;
}
/*Получение товаров*/
function get_products($ids, $start_pos, $perpage){
	global $connection;
	if($ids){
		$query = "SELECT * FROM products WHERE parent IN($ids) ORDER BY title LIMIT $start_pos, $perpage";
	}else{
		$query = "SELECT * FROM products ORDER BY title LIMIT $start_pos, $perpage";
	}
	$res = mysqli_query($connection, $query);
	$products = array();
	while($row = mysqli_fetch_assoc($res)){
		$products[] = $row;
	}
	return $products;

}
/*получение отдельного товара*/
function get_one_product($product_id){
	global $connection;
	$query = "SELECT * FROM products WHERE id = $product_id LIMIT 1";
	$res = mysqli_query($connection, $query);
	return mysqli_fetch_assoc($res);
}
/*Кол-ство товаров*/
function count_goods($ids){
	global $connection;
	if(!$ids){
		$query = "SELECT COUNT(*) FROM products";
	}else{
		$query = "SELECT COUNT(*) FROM products WHERE parent IN($ids)";
	}
	$res = mysqli_query($connection, $query);
	$count_goods = mysqli_fetch_row($res);
	return $count_goods[0];
}
/* Постраницная навигация*/
function pagination($page, $count_pages){
	// << < 3 4 5 6 7 > >> 
	// $back - ссілка назад
	// $forward - ссилка вперед
	// $startpage - cсилка на перв стран
	//  $endpage - ссилка на посл стран
	// $page2left - вторая страница слева
	// $page1left - первая страница слева
	// $page2right - вторая страница справа
	// $page1right  - первая страница справа

	$uri = "?";
	// если есть парам в запросе
	if($_SERVER['QUERY_STRING']){
		foreach ($_GET as $key => $value) {
			if($key != 'page') {
				$uri .="{$key}=$value&amp;";
			}
			// echo $uri;
		}
	}
	if($page > 1){
		$back = "<a class='nav-link' href='{$uri}page=" .($page-1). "'>&lt; </a>";  
	}
	if($page < $count_pages){
		$forward = "<a class='nav-link' href='{$uri}page=" .($page+1). "'> &gt;</a>";  
	}
	if($page > 3){
		$startpage = "<a class='nav-link' href='{$uri}page=1'>&laquo; </a>";  
	}
	if($page < ($count_pages - 2)){
		$endpage = "<a class='nav-link' href='{$uri}page={$count_pages}'> &#187;</a>";  
	}
	if($page - 2 > 0 ){
		$page2left = "<a class='nav-link' href='{$uri}page=" .($page-2). "'>" .($page-2). " </a>";  
	}
	if($page - 1 > 0){
		$page1left = "<a class='nav-link' href='{$uri}page=" .($page-1). "'> " .($page-1). " </a>";  
	}
	if($page + 2 <= $count_pages){
		$page2right = "<a class='nav-link' href='{$uri}page=" .($page+2). "'>" .($page+2). " </a>";  
	}
	if($page + 1 <= $count_pages){
		$page1right = "<a class='nav-link' href='{$uri}page=" .($page+1). "'> " .($page+1). " </a>";  
	}
	return "<li>".$startpage."</li>"."<li>".$back."</li>"."<li>".$page2left."</li>"."<li>".$page1left."</li>"."<li><a class='active' style='background-color:#337ab7; color:#fff'>".$page."</a></li>"."<li>".$page1right."</li>"."<li>".$page2right."</li>"."<li>".$forward."</li>"."<li>".$endpage."</li>";
}


?>