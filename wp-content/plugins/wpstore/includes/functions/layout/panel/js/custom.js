$(document).ready(function(){
	$("#containerAbas div.conteudo:nth-child(1)").show();
	$(".abas li:first div.aba").addClass("selected");      
	$(".aba").click(function(){
		$(".aba").removeClass("selected");
		$(this).addClass("selected");
		var indice = $(this).parent().index();
		indice++;
		$("#containerAbas div.conteudo").hide();
		$("#containerAbas div:nth-child("+indice+")").fadeIn();
	});
	 
	$(".aba").hover(
		function(){$(this).addClass("ativa")},
		function(){$(this).removeClass("ativa")}
	);          

	
	$(".TabControl .conteudo .bloco .seta").click(function(){
		$(this).next().toggle();
	});
	
	
	$("table tr:odd").addClass("odd");
	
	
});