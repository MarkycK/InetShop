<?php
defined("CATALOG") or 
header("Location: 404.php"); /* Redirect browser */
include "main_controller.php"; 
include "model/{$view}_model.php";
 $page = get_one_page($page_alias);
 $breadcrumbs = "<a href='".PATH."'>Главная</a> / {$page['title']}";
include "views/{$view}.php";

?>