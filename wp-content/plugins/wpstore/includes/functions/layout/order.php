<?php

global $current_user;
get_currentuserinfo();
$idUser = $current_user->ID;


if($idUser<=0){
    
    $idLogin = get_idPaginaLogin();
    $pageLogin = get_permalink($idLogin);

   // wp_redirect($pageLogin .'');
    echo "<script>window.location='".$pageLogin ."'</script>";
};



$moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
if($moedaCorrente==""){
  $moedaCorrente = "R$" ; 
};
 
		    
		    $order = trim($orderNum);
		    if($order =="" ){
			$order = $_GET['order'];
        	};
        	
        	
        	if($order =="" ){
			$order = $_GET['orderCIELO'];
        	};
        	
        	$arrOrder = explode('.',$order);
        	
        	$idUser = 	intval($arrOrder[0]);
        	
        	
        	
         
            
            if ( is_admin() ) {
            $arrayOrderN = explode(".",$order);
            $idUser = $arrayOrderN[0];     
            };
            
            $userEndereco = trim(get_user_meta($idUser,'userEndereco',true));if($userEndereco==""){$userEndereco="";};
            $userEnderecoNumero = trim(get_user_meta($idUser,'userEnderecoNumero',true));if($userEnderecoNumero==""){$userEnderecoNumero="";};
            $userComplemento = trim(get_user_meta($idUser,'userComplemento',true));if($userComplemento==""){$userComplemento="";};
            $userCidade = trim(get_user_meta($idUser,'userCidade',true));if($userCidade==""){$userCidade="";};
            $userBairro = trim(get_user_meta($idUser,'userBairro',true));if($userBairro==""){$userBairro="";};
            $userEstado = trim(get_user_meta($idUser,'userEstado',true));if($userEstado==""){$userEstado="";};
            $userCep = trim(get_user_meta($idUser,'userCep',true));if($userCep==""){$userCep="";};
            $userDDD = trim(get_user_meta($idUser,'userDDD',true));if($userDDD==""){$userDDD="";};
            $userTelefone = trim(get_user_meta($idUser,'userTelefone',true));if($userTelefone==""){$userTelefone="";};

            $userDDD2 =  trim(get_user_meta($idUser,'userDDDCel',true));if($userDDDCel==""){$userDDDCel="";};
            $userTelefone2 =  trim(get_user_meta($idUser,'userTelefoneCel',true));if($userTelefoneCel==""){$userTelefoneCel="";};

	        $plugin_directory = str_replace('layout/','payment/',plugin_dir_url( __FILE__ ));
	        
	      
            global $wpdb;
            $tabela = $wpdb->prefix."";
            $tabela .=  "wpstore_orders";

            $fivesdrafts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM  `$tabela` WHERE  `id_usuario`='$idUser' ORDER BY `id`  DESC LIMIT 0,1",1,'' ) );

            if($_GET['order'] !=""){
                $order = $_GET['order'];
                $fivesdrafts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM  `$tabela` WHERE  `id_pedido`='$order'  AND `id_usuario`='$idUser' ORDER BY `id`  DESC LIMIT 0,1" ,1,'') );
            };
            
              if($_GET['orderCIELO'] !=""){
                    $order = $_GET['orderCIELO'];
                    $fivesdrafts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM  `$tabela` WHERE  `id_pedido`='$order'  AND `id_usuario`='$idUser' ORDER BY `id`  DESC LIMIT 0,1" ,1,'') );
                };

            $tipo_pagto = ""; 
            $status_pagto = "";
 
 
             $comentario_admin ="";
             
             $valor_total = 0.00;
             
             $frete  = "";

            foreach ( $fivesdrafts as $fivesdraft ){

                $idPedido = $fivesdraft->id_pedido;
            	$valor_total = $fivesdraft->valor_total;    
                        
            	$frete = $fivesdraft->frete;
                $tipo_pagto = $fivesdraft->tipo_pagto;
                $status_pagto = $fivesdraft->status_pagto;
                $comentario_cliente = $fivesdraft->comentario_cliente ;
                $comentario_admin = $fivesdraft->comentario_admin;

                //echo "ID Pedido : ".$idPedido ."<br/><br/>";
            	//echo "Valor : R$".$valor_total."<br/><br/>";
            	//echo "Frete : ".$frete."<br/><br/>";
            	//echo "Tipo de pagamento : ".$tipo_pagto."<br/><br/>";
            	//echo "STATUS : ".$status_pagto."<br/><br/>";

            	$totalPagto = custom_get_sum($valor_total,floatVal($frete));   
            	
 
            	//echo "Observações1 : ".$comentario_cliente."<br/><br/>";
                //echo "Observações2 : ".$comentario_admin."<br/><br/>";
                
                $dataArray = explode('.',$idPedido);

                $get_total_Products = custom_get_total_products_in_order($idPedido);

               
            };
 
        
        if($status_pagto=="PENDENTE"){
			$cor = "#ff5f76";
			}elseif($status_pagto=="APROVADO"){
			$cor = "green";
			}else{
		   	$cor = "red"; 
			};
      

                $cupom=  getCupomInfos($comentario_admin);  
                
                $numeroCupom = $cupom[0];
         
                $desconto = 0.00;
                   $vt =$valor_total;
                   $vt = str_replace('.','',$vt);
                   $vt = str_replace(',','.',$vt);
                   $vt = floatval($vt);


                    if($cupom[1]=="Valor"){ 
                       $msg =  $cupom[1]."  $moedaCorrente  ".$cupom[2];
                       $desconto = floatval(str_replace(',','.',$cupom[2]));
                     }elseif($cupom[1]=="Percentual"){ 
                       $msg = $cupom[1]." " .$cupom[2]."%" ;  
                       $desconto = ( $vt*floatval(str_replace(',','.',$cupom[2])) ) / 100 ;
                     };
                    
                    
                     $precoAdddArray = explode('(R$',$frete);
            	     $tipoFrete = $precoAdddArray[0];
            	     
            	 
                     $freteV= str_replace(')','',$precoAdddArray[1]);
                     $freteV =  floatVal(str_replace(',','.',$freteV));
 
                   //	$vtf = $vt-$desconto ;
              
                   	$vtf = $vt ;   
              	
                    $totalPagto = getPriceFormat(custom_get_sum( $vtf,$freteV));
                    
           
                    
                    
                    
                    
                    
 
                $orderPrint .="
		
			<section class='content'>
             
                    ";  
                    
                          
                              /*
                               $orderPrint .="

                			<section class='content'>

                            	<h2>Detalhes do pedido : </h2>
                                <p>
                                	<b>ID do pedido:</b> $order <br>
                                	<b>STATUS do pedido:</b> <span style='color: $cor '> $status_pagto </span><br>
                                    <b>Data:</b> ".$dataArray[4] ."/ ".$dataArray[3]." / ".$dataArray[2]."  <br>
                                    <b>Método de pagamento:</b>  $tipo_pagto <br>
                                    <b>Método de entrega:</b>  $frete <br>
                                     <b>Subtotal:</b> R$$valor_total <br>
                                    <b>Total:</b> R$$totalPagto <br><br>
                                    ";
                    
                               */
                    
                    
                      	 $orderPrint .= "    

                      

                                     <div class='pagamento'>
									 
									 <table id='detalhesPedido' class='table'>
										<tr>
											<thead>
												<th>ID do pedido:</th>
												<th>Metodo de Pagamento:</th>
												<th>Status do pedido:</th>
												<th>Data:</th>
												<th>Sub-total:</th>
												<th>Frete:</th>
												<th>Total:</th>
											</thead>
										</tr>
										
										<tr>
											<td>$order</td>
											<td>$tipo_pagto</td>
											<td>$status_pagto</td>
											<td>".$dataArray[4] ."/ ".$dataArray[3]." / ".$dataArray[2]."</td>
											<td>R$$valor_total</td>
											<td>($tipoFrete) $moedaCorrente".$frete."</td>
											<td>R$$totalPagto</td>
										</tr>
									</table>
											
                                

                                	</div>


                                     ";
                                     
                                     
                    
                    if( $numeroCupom  !=""){  
                        
                        



                       	     $obs = "";
                       	     
                       	     	$vtf2 = $vt-$desconto ;
                              if( intval($vtf2 )<0){
                                 $positivoTotal = str_replace('-','',$vtf2 );
                                  $obs = " <span style='font-size:0.8em;color:red'>Seu cupom é maior que o total de suas compras . Em breve você receberá um  novo cupom no valor de $positivoTotal. </span><br/><br/>";
                                     $comentario .= $obs;
                                 $comentario .= $obs;
                                 $vtf = "0.00";
                              }


                        
                          $orderPrint .="<b>Cupom Desconto :</b>  $numeroCupom <br>
                    <b>Valor do Desconto :</b>  $moedaCorrente   $desconto <br><br>$obs";   }; 
                    
                    
                  
    
                	 $orderPrint .= "    
                	 	<h2>Endereço </h2>
                	 
                  	        
                             <div class='pagamento'>
							
								<div class='detalhesPedido'>
                                
								<div class='clearfix enderecoPagto' >
									<dl>
										<dt>Endereço:</dt>
										<dd>$userEndereco</dd>
									</dl>
								</div>
								
								
								<div class='clearfix endNumPagto'>
									<dl>
										<dt>Número:</dt>
										<dd>$userEnderecoNumero</dd>
									</dl>
								</div>
								
								<div class='clearfix complementoPagto'>
									<dl>
										<dt>Complemento:</dt>
										<dd>$userComplemento</dd>
									</dl>
								</div>
								
								
								<div class='clearfix bairroPagto'>
									<dl>
										<dt>Bairro:</dt>
										<dd>$userBairro</dd>
									</dl>
								</div>
								
								<div class='clearfix estadoPagto'>
									<dl>
										<dt>Estado:</dt>
										<dd>$userEstado</dd>
									</dl>
								</div>
								
								<div class='clearfix cidadePagto'>
									<dl>
										<dt>Cidade:</dt>
										<dd>$userCidade</dd>
									</dl>
								</div>
								
								<div class='clearfix cepPagto'>
									<dl>
										<dt>CEP:</dt>
										<dd>$userCep</dd>
									</dl>
								</div>
								
								<div class='clearfix dddPagto telefonePagto'>
									<dl>
										<dt>DDD - Telefone:</dt>
										<dd>$userDDD - $userTelefone</dd>
									</dl>
								</div>
								
								
								
										<div class='clearfix dddPagto telefonePagto'>
        									<dl>
        										<dt>DDD - Celular:</dt>
        										<dd>$userDDD2 - $userTelefone2</dd>
        									</dl>
        								</div>
        								
        								
        								
								
								<div class='clear'></div>
								
								
                      

                        	</div>

                        	</div>
							
							<hr/> <br/>
                       
                             ";
                
                
                     $tabela = $wpdb->prefix."";
                    $tabela .=  "wpstore_orders_address";

                    $fivesdrafts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM  `$tabela` WHERE `id_usuario`='$idUser' AND `id_pedido`='$idPedido' ORDER BY `id`  ASC  ",1,'' ) );

                    // Adicionando PRODUTOS

                    foreach ( $fivesdrafts as $item=>$fivesdraft ){
 
                     $userEndereco = $fivesdraft->endereco;
                     $userEnderecoNumero = $fivesdraft->numero;
                     $userComplemento = $fivesdraft->complemento;
                     $userCidade = $fivesdraft->cidade;
                     $userBairro = $fivesdraft->bairro;
                     $userEstado = $fivesdraft->estado;
                     $userCep = $fivesdraft->cep;

                 }; 


                /*
                    $orderPrint .="
                    <div class='fluid50'>
                	<h2>Endereço para entrega</h2>
                   $userEndereco $userEnderecoNumero <br>
                   $userComplemento <br>
                    $userBairro $userCidade   $userEstado <br>
                    $userCep <br>
                  </div>";
                
                */
                
                
                
                
                
                
                
                
                            	 $orderPrint .= "    
                                 <h2>Endereço alternativo para entrega</h2>
                            	 

								 

                                         <div class='pagamento'>
										 
										 
											<div class='detalhesPedido'>
                                
							                				<div class='clearfix enderecoPagto' >
                            									<dl>
                            										<dt>Endereço:</dt>
                            										<dd>$userEndereco</dd>
                            									</dl>
                            								</div>


                            								<div class='clearfix endNumPagto'>
                            									<dl>
                            										<dt>Número:</dt>
                            										<dd>$userEnderecoNumero</dd>
                            									</dl>
                            								</div>

                            								<div class='clearfix complementoPagto'>
                            									<dl>
                            										<dt>Complemento:</dt>
                            										<dd>$userComplemento</dd>
                            									</dl>
                            								</div>


                            								<div class='clearfix bairroPagto'>
                            									<dl>
                            										<dt>Bairro:</dt>
                            										<dd>$userBairro</dd>
                            									</dl>
                            								</div>

                            								<div class='clearfix estadoPagto'>
                            									<dl>
                            										<dt>Estado:</dt>
                            										<dd>$userEstado</dd>
                            									</dl>
                            								</div>

                            								<div class='clearfix cidadePagto'>
                            									<dl>
                            										<dt>Cidade:</dt>
                            										<dd>$userCidade</dd>
                            									</dl>
                            								</div>

                            								<div class='clearfix cepPagto'>
                            									<dl>
                            										<dt>CEP:</dt>
                            										<dd>$userCep</dd>
                            									</dl>
                            								</div>

                            	 
                                    								
                                    								
                            								<div class='clear'></div>
								
                      

                        	</div>
							
           
           
				
							
                                 

                                    	<div class='clear'  style='clear:both'></div>

                                    	</div>

                                    	<hr/> <br/>


                                         ";


                
                
                
                
                
                $orderPrint .= " 
                
               
                
                
                <h2>Produtos</h2>
                
                "; 
                
                
                include('tabela_pedido.php'); 

                        $orderPrint .="

<hr/> <br/>
                            <h2>Histórico do pedido</h2>
                           	<table class='table carrinho' style='width: 100%;'>
                            	
                                <thead>
                                    <tr>
                                        <th   width='20%'>Date</th>
                                        <th  >Status</th>
                                        <th  >Comentário</th>
                                        <th    style='background:transparent;border:0px'></th>
                                    </tr>
                                </thead>
                                <tbody>



                                                    <tr>
                                                        <td class='ta-left va-top'>".$dataArray[4]."/".$dataArray[3]."/".$dataArray[2]."</td>
                                                        <td class='ta-left va-top'>PENDENTE</td>
                                                        <td class='ta-left va-top'>Aguardando confirmação de pagamento.</td>
                                                        <td class='ta-left va-top'></td>
                                                    </tr>


                     ";
                     
             
                          
                            $tabela = $wpdb->prefix."";
                            $tabela .=  "wpstore_orders_comments";

                            $fivesdrafts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM  `$tabela` WHERE `id_pedido`='$idPedido' ORDER BY `id`  ASC  " ,1,'') );

                            // Adicionando PRODUTOS
                            
                             $infoCieloXML = "";

                            foreach ( $fivesdrafts as $item=>$fivesdraft ){
 		                     
 		                     $comentario = $fivesdraft->comentario_cliente;
 		                     $comentario2 = $fivesdraft->comentario_admin;
 		                     $comentario3 = $fivesdraft->comentario_pagt;
                             $userCidade = $fivesdraft->cidade;
                             $status_pagto = $fivesdraft->status_pagto ;
                             $data = $fivesdraft->data;
                             
                             
                             $infoCieloXML =  $fivesdraft->comentario_pagt;

                           
             
                           $orderPrint .="
         
                                     <tr>
                                              <td class='ta-left va-top'>$data</td>
                                              <td class='ta-left va-top'>$status_pagto</td>
                                              <td class='ta-left va-top'>$comentario</td>";
                                       
                                       
                                
                              if($pagto !="off" ){   
                                               
                              $orderPrint .="<td class='ta-left va-top'>";
                            
                              if ( current_user_can('manage_options') ){
                                  
                                  if ( trim($comentario3) !="" ){
                                      $orderPrint .="<textarea name='xmlRetorno' cols='20' rows='5' readonly='readonly'>$comentario3</textarea><br/><br/>";
                                  };
                                   if ( trim($comentario2) !=""){
                                       $orderPrint .="<textarea name='xmlRetorno' cols='20' rows='5' readonly='readonly'>$comentario2</textarea>";
                                   };
                              
                               };
                                          
                              $orderPrint .="</td>";
                              $orderPrint .="</tr>";
                              
                              };
                                
                                
                         };  
                                   
                                   
       
                                    
         $orderPrint .="  </tbody>  </table>  ";   ?>
         
         
         
      
 
                             <?php
                             
                            if ( current_user_can('manage_options') ){
                                
                     
                           if($tipo_pagto=="Cielo" && $pagto !="off" ){
                         
                                $orderPrint .="<div style='background:#ddd;padding:10px;margin:10px'>
                             
                              <h3>Cielo : Opções de Administração </h3>";
                              
                                  
                                           $dirname = dirname(__FILE__);
                                                 $dirname = str_replace('layout','',$dirname);
                                     
                                     
                                     if($_GET['operacao']=="cons"){
                                                include_once($dirname.'/payment/Cielo/pages/operacao.php');    
                                     }
                           
                                     if(trim($comentario3)!=""){
                                     include_once($dirname.'/payment/Cielo/pages/pedidos.php'); 
                                     }else{
                                       $orderPrint .="<p>Ainda não há dados para este pedido.</p>";  
                                     };
                         
                              
                                   $orderPrint .="    </div><br/><hr/><br/>";
                             }; ?>
                              
                          
                              
                              <?php  }; ?>
                              
                              
                              
                              
             
                        <?php $arrayOrderN = explode(".",$order);
                         
                         $idUser2 = $arrayOrderN[0];
                         
                      
                      
                      
                      //  if ( $idUser2 == $current_user->ID && trim($status_pagto)=="PENDENTE" ) {
               
                     
                        $orderPrintB .=       $orderPrint ; 
               
            
            
                 if($status_pagto=="PENDENTE"){
                     
                 $orderPrint .= "
   
                <div id='pagamento'>
                
                  
                <h4>Opções De pagamento </h4> ";  
                
                
				         //PLUGIN SHOP FUNCTION --------------------------------------
				         
				    
				         $orderPrint .=   get_payment_checkout(false,$verifica);  
			   
				         
				   
                      $orderPrint .=   "</div>
                    <br/>
                    <br/> ";  
                    
                };
                    
                 //    }; // super admin restriction  
                     
                     
          $orderPrint .=   "    </section>"; 
                     
         $orderPrintB .=      "    </section>"; 
?>