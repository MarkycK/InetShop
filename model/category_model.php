<?php
/*Получение ID дочерних категорий*/

function cats_id($array, $id){
	if(!$id) return false;
	$data = null;
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

/* получение чпу категорий*/
function get_category($category_alias){
	global $connection;
	$product_alias = mysqli_real_escape_string($connection, $category_alias);
	$query = "SELECT * FROM categories WHERE alias = '$category_alias'";
	$res = mysqli_query($connection, $query);
	return mysqli_fetch_assoc($res);
}
?>