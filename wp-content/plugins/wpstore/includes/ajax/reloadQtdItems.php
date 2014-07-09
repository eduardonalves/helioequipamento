<?php

require("../../../../../wp-load.php");

$qtdStock =  custom_get_qtd_items_Cart();

$item = "ítens";

if($qtdStock==1){
   $item = "ítem"; 
};
   
echo "$qtdStock"; 

echo $item;  

?>
  
