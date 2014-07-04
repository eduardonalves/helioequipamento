<?php 
require("../../../../../wp-load.php");

if(!isset($_SESSION)){
session_start();
};

 $cupom = trim($_POST['cupom']); 
 
 $fivesdrafts = consultaDesconto($cupom);
 $count = 0 ;
      foreach ( $fivesdrafts as $fivesdraft ){
           $count +=1;
           $id = $fivesdraft->id;
           $numeroCupom = $fivesdraft->numeroCupom;
      	   $tipoDesconto = $fivesdraft->tipoDesconto;
      	   $valorDesconto = $fivesdraft->valorDesconto;
           $limite = intval($fivesdraft->limite) ;
           $qtdUsado =  intval($fivesdraft->qtdUsado);
           $total = $limite - $qtdUsado;
           
           if($total>0){
               $info = "$numeroCupom***$tipoDesconto***$valorDesconto";
               $_SESSION['cupomDesconto'] = $info;
           }
          
       };
       
       if($count==0){
           $_SESSION['cupomDescontoErro'] = 'Cupom não encontrado!';
       }
    
     //echo json_encode($fivesdrafts);
?> 