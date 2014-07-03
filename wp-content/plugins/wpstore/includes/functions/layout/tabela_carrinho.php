<?php
$ajaxFiltro = true;
 $tipoSkinShop = get_option('tipoSkinShop');
if($tipoSkinShop=="DARK"){
  include("tabela_carrinho-dark.php");   
}else{
 include("tabela_carrinho-light.php");    
}

?>