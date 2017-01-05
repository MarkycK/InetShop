<?php
/* Распечятка массива*/
function print_arr($array){
	echo "<pre class='breadcrumbs'>".print_r($array, true)."</pre>";
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
	$string = null;
	foreach ($data as $item){
		$string .= categories_to_template($item);
	}
	return $string;
}
/*  Шаблон вивода категорий*/
function categories_to_template($category){
	ob_start();
	include "/views/category_template.php";
	return ob_get_clean();
}

/* Постраницная навигация*/
function pagination($page, $count_pages, $modrew = true){
	// << < 3 4 5 6 7 > >> 
	$back = null; // ссілка назад
	$forward = null; //- ссилка вперед
	$startpage = null; //- cсилка на перв стран
	 $endpage = null; //- ссилка на посл стран
	$page2left = null; //- вторая страница слева
	$page1left = null; //- первая страница слева
	$page2right = null; //- вторая страница справа
	$page1right = null; // - первая страница справа

	$uri = "?";
	 if(!$modrew){
	// если есть парам в запросе
		if($_SERVER['QUERY_STRING']){
			foreach ($_GET as $key => $value) {
				if($key != 'page') {
					$uri .="{$key}=$value&amp;";
				}
				// echo $uri;
			}
		}
	}else{
		$url = $_SERVER['REQUEST_URI'];
		$url = explode("?", $url);
		if(isset($url[1]) && $url[1] != ''){
			$params =explode("&", $url[1]);
			foreach ($params as $param) {
				if(!preg_match("#page=#", $param)){
					$uri .="{$param}&amp;";
				}
			}
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
function breadcrumbs($array, $id){
	if(!$id) return false;

	$count = count($array);
	$breadcrumbs_array = array();
	for($i = 0; $i < $count; $i++){
		if(isset($array[$id])){
			$breadcrumbs_array[$array[$id]['id']] = $array[$id]['title'];
			$id = $array[$id]['parent'];
		}else break;
	}
	return array_reverse($breadcrumbs_array, true);
}
?>