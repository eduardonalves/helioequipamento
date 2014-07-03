<?php
$ajaxFiltro = true;
 $tipoSkinShop = get_option('tipoSkinShop');
if($tipoSkinShop=="DARK"){
  include("tabela_pedido-dark.php");   
}else{
 include("tabela_pedido-light.php");    
}

?>