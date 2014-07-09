<?php
$ajaxFiltro = true;
 $tipoSkinShop = get_option('tipoSkinShop');
if($tipoSkinShop=="DARK"){
  include("listagem-dark.php");   
}else{
 include("listagem-light.php");    
}

?>