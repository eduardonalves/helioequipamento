<?php
global $current_user;
get_currentuserinfo();
$idUser = $current_user->ID;


if($idUser<=0){
    
    $idLogin = get_idPaginaLogin();
    $pageLogin = get_permalink($idLogin);
    
   // wp_redirect($pageLogin.'');
    echo "<script>window.location='".$pageLogin."'</script>";
};



$moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
if($moedaCorrente==""){
  $moedaCorrente = "R$" ; 
}
?>
    
    
<?php $ordersPrint.="<section class='order-list'>"; ?>


<?php $ordersPrint.="<ul class='pedidos'>"; ?>
	
	
	<?php 

    
    if($_SESSION['msgRedecardOK']=='true'){
           
       echo "<br/><h3 style='color:green'>Seu pedido foi registrado e uma nova janela foi aberta para que você salve o comprovante de sua compra. </h3> <br/>";

       $_SESSION['numpedido']= "";
       $_SESSION['msgRedecardOK'] = "";
       }else{
           
             if($_SESSION['msgRedecard'] !=""){
                 echo $_SESSION['msgRedecard'];
                 $_SESSION['msgRedecard'] = "";
             };
           
       };
 
    ?>
	
	
	
	<?php

    global $wpdb;
    $tabela = $wpdb->prefix."";
    $tabela .=  "wpstore_orders";
    
    $totalpedidos = 0;
    
    $fivesdrafts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM  `$tabela` WHERE  `id_usuario`='$idUser' ORDER BY `id`  DESC " ,1,'') );
    
    $tipo_pagto = "";
    
    foreach ( $fivesdrafts as $fivesdraft ){
        
        $totalpedidos +=1;
        
        $idPedido = $fivesdraft->id_pedido;
    	$valor_total = $fivesdraft->valor_total;
    	$frete = $fivesdraft->frete;
        $tipo_pagto = $fivesdraft->tipo_pagto;
        $status_pagto = $fivesdraft->status_pagto;
        $comentario_cliente = $fivesdraft->comentario_cliente ;
        $comentario_admin = $fivesdraft->comentario_admin;
   
        //   echo "ID Pedido : ".$idPedido ."<br/><br/>";
        ///	echo "Valor : ".$valor_total."<br/><br/>";
        //	echo "Frete : ".$frete."<br/><br/>";
        //	echo "Tipo de pagamento : ".$tipo_pagto."<br/><br/>";
        //	echo "STATUS : ".$status_pagto."<br/><br/>";
        
    	$fretev = 0;
    	$totalPagto = getPriceFormat(custom_get_sum( $valor_total,$fretev));
    	
    	//echo "Observações1 : ".$comentario_cliente."<br/><br/>";
        //echo "Observações2 : ".$comentario_admin."<br/><br/>";
   //     echo "<hr/>";
        
        $dataArray = explode('.',$idPedido);
        
        $get_total_Products = custom_get_total_products_in_order($idPedido); 
        
        
        
        if($status_pagto=="PENDENTE"){
			$cor = "#ff5f76";
			}elseif($status_pagto=="VERIFICANDO"){
			$cor = "#A2C6DE";
			}elseif($status_pagto=="APROVADO"){
			$cor = "green";
			}else{
		   	$cor = "red"; 
			};

        
        
                                $cupom=  explode('***',$comentario_admin);
                                
                                $numeroCupom = $cupom[0];
             
                               $desconto = 0.00;
                               $vt = $totalPagto; 
                               $vt = str_replace('.','',$vt);
                               $vt = str_replace(',','.',$vt);
                               $vt = floatval($vt);


                                if($cupom[1]=="Valor"){ 
                                   $msg =  $cupom[1]." $moedaCorrente".$cupom[2];
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
             
              
              
              
                                $obs = ""; 

                                   if( intval($totalPagto)<0){
                                      $positivoTotal = str_replace('-','',$totalPagto);
                                        $obs = "<br/><span style='font-size:0.8em;color:red'>Seu cupom é maior que o total de suas compras . Em breve você receberá um  novo cupom no valor de $positivoTotal. </span><br/><br/>";
                                     $comentarioAdmin .= $obs;
                                      $totalPagto= "0.00";
                                   };
              
              
              
                
                 	  if($frete==""){$frete = "0.00"; }

       
     ?>
     
     
     <?php $ordersPrint.="
     
    	<li style='background:#ccc;padding:10px'>
    	
    	
            <div>
                <strong>ID do pedido:</strong>$idPedido</br>
                <strong>Data:</strong> ".$dataArray[4]."/".$dataArray[3]."/". $dataArray[2]."</br>
                   <strong>Tipo de Pagamento:</strong>  $tipo_pagto; </br>  
                <strong>Quantidade de Produtos:</strong>  $get_total_Products "; ?>
                <?php if(trim($numeroCupom)!=""){  
                   $ordersPrint.="<td class='ta-left va-top'>CUPOM :  $numeroCupom </td>  ";
                }; ?>
               
               
               <?php
               
                $ordersPrint.="
                   
            </div>
            
            
            <div>
                 <strong>Status:</strong><span style='color:$cor'> $status_pagto </span></br>
                <strong>SubTotal:</strong> $moedaCorrente $valor_total </br>           
                <strong>Frete:</strong>   ($tipoFrete) $moedaCorrente".$frete." </br>  
                <td class='ta-left va-top'>Desconto : $moedaCorrente ".getPriceFormat($desconto)."</br>  
                <strong>Total:</strong> $moedaCorrente".getPriceFormat($totalPagto)."</br>  
                
                $obs
                
                 </td>     
            </div>
            
            
            <div>
                <a href='".get_bloginfo('url')."/pedido/?order=$idPedido'>Ver Detalhes</a><br>";
                
            if($status_pagto=="PENDENTE" && intval($totalPagto) >0){
            $ordersPrint.="<a href='".get_bloginfo('url')."/pedido/?order=$idPedido#pagamento'>Realizar pagamento</a>";
             }; 
             
          $ordersPrint.=" </div></li>"; ?>
        
        <?php } ?>
        
  <?php $ordersPrint.="</ul></section>";  if($totalpedidos==0){ $ordersPrint.="<p>Não há pedidos registrados</p>"; };

?>