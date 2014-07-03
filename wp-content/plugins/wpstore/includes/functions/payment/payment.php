<?php


if($_REQUEST['confirma']=='true'){
    
    $CURRENT_SOURCE_FOLDER = dirname(__FILE__);
    $CURRENT_SOURCE_FOLDER = str_replace('functions/payment','ajax/shipping',$CURRENT_SOURCE_FOLDER);
    $CURRENT_SOURCE_FOLDERB = str_replace('/shipping','',$CURRENT_SOURCE_FOLDER);
    include_once("$CURRENT_SOURCE_FOLDER/checkoutFinalizacao.php");
 
};


$moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
if($moedaCorrente==""){
  $moedaCorrente = "R$" ; 
}
?>
    
<?php

    global $current_user;
    get_currentuserinfo();
    $idUser = $current_user->ID;
    

    global $wpdb;
    $tabela = $wpdb->prefix."";
    $tabela .=  "wpstore_orders";
    
    $fivesdrafts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM  `$tabela` WHERE  `id_usuario`='$idUser' ORDER BY `id`  DESC LIMIT 0,1"  ,1,'') );
    
    if($_GET['order'] !=""){
        $order = $_GET['order'];
        $fivesdrafts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM  `$tabela` WHERE  `id_pedido`='$order'  AND `id_usuario`='$idUser' ORDER BY `id`  DESC LIMIT 0,1"  ,1,'') );
    };
    
    
    
    if($_GET['orderCIELO'] !=""){
        $order = $_GET['orderCIELO'];
        $fivesdrafts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM  `$tabela` WHERE  `id_pedido`='$order'  AND `id_usuario`='$idUser' ORDER BY `id`  DESC LIMIT 0,1" ,1,'' ) );
    };
    
    
    
    
    $tipo_pagto = "";
    $tipoFrete = "";
    
    $idPedido=0;
    
    foreach ( $fivesdrafts as $fivesdraft ){
        
        $idPedido = $fivesdraft->id_pedido;
    	$valor_total = $fivesdraft->valor_total;
    	$frete = $fivesdraft->frete;
        $tipo_pagto = $fivesdraft->tipo_pagto;
        $status_pagto = $fivesdraft->status_pagto;
        $comentario_cliente = $fivesdraft->comentario_cliente ;
        $comentario_admin = $fivesdraft->comentario_admin;
        
        if($status_pagto=="PENDENTE"){
			$cor = "#ff5f76";
			}elseif($status_pagto=="APROVADO"){
			$cor = "green";
			}else{
		   	$cor = "red"; 
			};
        
       
        
                       $cupom =     getCupomInfos($comentario_admin);
         
                       $desconto = 0.00;
                       $msg = "";
                       $numeroCupom  = $cupom[0];
                       
                       
                                    $vt = $valor_total;
                                    $vt = str_replace('.','',$vt);
                                    $vt = str_replace(',','.',$vt);
                                    $vt = floatval($vt);


                       if($cupom[1]=="Valor"){ 
                          $msg =  $cupom[1]."  $moedaCorrente".$cupom[2];
                          $desconto = floatval(str_replace(',','.',$cupom[2]));
                      }elseif($cupom[1]=="Percentual"){
                         $msg = $cupom[1]." " .$cupom[2]."%" ;  
             
                          $desconto = ( $vt*floatval(str_replace(',','.',$cupom[2])) ) / 100 ;


                       }; 
                   
                       
                   	     $precoAdddArray = explode('(R$',$frete);

                   	        $tipoFrete = $precoAdddArray[0];
                            $frete= str_replace(')','',$precoAdddArray[1]);
                            $frete =  str_replace(',','.',$frete);



                   	$vtf = $vt+floatVal($frete)-$desconto ;

                   	$totalPagto = $vtf;

 
  
        $txtPrint .= "  <div style='float:left;background:#ddd;margin-left:5px;padding:10px;margin-top:5px'><strong>ID Pedido : ".$idPedido ."</strong></div>";
    	$txtPrint .= "<div style='float:left;background:#ddd;margin-left:5px;padding:10px;margin-top:5px'>Sub Total :  $moedaCorrente".$valor_total."</div>";
        $txtPrint .= "<div style='float:left;background:#ddd;margin-left:5px;padding:10px;margin-top:5px'>Frete : ($tipoFrete) $moedaCorrente".$frete."</div>";
    	
    	$freteV = $frete;
    	
    	if(floatval($desconto)>0){
    	
    	$txtPrint .=  "<div style='float:left;background:#ddd;margin-left:5px;padding:10px;margin-top:5px'>Desconto :  $moedaCorrente".getPriceFormat($desconto)." ( Cupom Desconto  :$numeroCupom | $msg )</div>";
    	
	    }; 
	    
    	$txtPrint .=  "<div style='float:left;background:#ddd;margin-left:5px;padding:10px;margin-top:5px'>Tipo de pagamento : ".$tipo_pagto."</div>";
    	
    	$txtPrint .= "<div style='float:left;background:#ddd;margin-left:5px;padding:10px;margin-top:5px'>STATUS : <span style='color:$cor'>$status_pagto</span> </div><div class='clear'></div>";
    	
  
    	
    	//echo "Observações1 : ".$comentario_cliente."<br/><br/>";
        //echo "Observações2 : ".$comentario_admin."<br/><br/>";

        
    };
    
     
    if($tipo_pagto=="Redecard"){ // -----------------REDECARD ------------------------
        
        //include('Redecard/Redecard_response.php');
        
    }elseif($tipo_pagto=="Cielo"){ // -----------------REDECARD ------------------------

            include('Cielo/Cielo_response.php');

   }elseif($tipo_pagto=="Pagseguro"){ // -----------------PAGSEGURO ------------------------
        
        include('Pagseguro/Pagseguro_response.php');
        
    }elseif($tipo_pagto=="Paypal"){ // ----------------- RETIRADA NA LOJA ------------------------

         include('Paypal/Paypal_response.php');         
         
   }elseif($tipo_pagto=="Moip"){ // ----------------- RETIRADA NA LOJA ------------------------
          
          include('Moip/Moip_response.php');          
          
   }elseif($tipo_pagto=="Depósito"){ // ----------------- RETIRADA NA LOJA ------------------------

       include('Prebanktransfer/Prebanktransfer_response.php');

   }elseif($tipo_pagto=="Retirar na Loja"){ // ----------------- RETIRADA NA LOJA ------------------------

           include('Payondelevary/Payondelevary_response.php');
         //include('Prebanktransfer/Prebanktransfer_response.php');

   }
    
       $_SESSION['orderCC'] ="";   
       
       if($idUser<=0){
          echo  "<p>Você precisa estar logado para acessar seus dados.</p>";
       }
      
       
       
       $googleConversaoPagto =  get_option('googleConversaoPagto'); 
       $googleConversaoPagto = str_replace('\"','"',$googleConversaoPagto );
       echo   $googleConversaoPagto;
       
?>