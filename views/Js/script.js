$(document).ready(function(){
	$("#accordion").dcAccordion();
	$("#perpage").change(function(){
		var perPage = this.value;// $(this).val();
		$.cookie('per_page', perPage, {expires: 1, path:'/CatalogTovarov/'});
		window.location =location.href;//перезапрос страницы
	});
})