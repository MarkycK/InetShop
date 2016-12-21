$(document).ready(function(){
	// $(".menu").dcAccordion();
	
	/*var a = $.ajax({
	  url: "http://myhosting.com/CatalogTovarov/lib/ajax.php",
	  async: true,
	  success: function (data){ 
        // var res = JSON.parse(data);
	        console.log(data);
	        $("#accordion").html(data);
		 }
	 });*/
	$("#accordion").dcAccordion();
	$("#perpage").change(function(){
		var perPage = this.value;// $(this).val();
		$.cookie('per_page', perPage, {expires: 1});
		window.location =location.href;//перезапрос страницы
	});
})