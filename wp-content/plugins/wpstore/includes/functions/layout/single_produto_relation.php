<?php
$ajaxFiltro = true;
 $tipoSkinShop = get_option('tipoSkinShop');  
 
 $txtProdutosRelacionados= get_option('txtProdutosRelacionadosWPSHOP');   
  if( $txtProdutosRelacionados==""){
     $txtProdutosRelacionados= "Produtos Relacionados"; 
  }
  
  
if($tipoSkinShop=="DARK"){
  include("single_produto_relation_dark.php");   
}else{
 include("single_produto_relation_light.php");    
}

?>