
<?php
 
	//require '../includes/include.php';
	
	// Resgata último pedido feito da SESSION
	$ultimoPedido = $_SESSION["pedidos"]->count();

	//print_r($_SESSION["pedidos"]);
	
	//print_r($ultimoPedido);
 
	$ultimoPedido -= 1;
	
	$Pedido = new Pedido();
	
	$Pedido->FromString($_SESSION["pedidos"]->offsetGet($ultimoPedido));
	
	// Consulta situação da transação
	$objResposta = $Pedido->RequisicaoConsulta();
	
	// Atualiza status
	$Pedido->status = $objResposta->status;
	
	if($Pedido->status == '4' || $Pedido->status == '6')
		$finalizacao = true;
	else
		$finalizacao = false;
	
	// Atualiza Pedido da SESSION
	$StrPedido = $Pedido->ToString();
	$_SESSION["pedidos"]->offsetSet($ultimoPedido, $StrPedido);
	
	             $dataCi = date("D M d H:i:s T Y");
	             
	             $idPedido = $Pedido->dadosPedidoNumero;
		         $idPEDIDOI = $_GET['orderCIELO'];
		         $idPEDIDOF = trim(str_replace('.','',$idPEDIDOI));
		         
		         $status = $Pedido->getStatus();
		         
		         $tid = $Pedido->tid;
		         
                  $xmlCi = htmlentities($objResposta->asXML());
		         
		         if($idPEDIDOF==$Pedido->dadosPedidoNumero && $idPEDIDOF !=""){
		             
		             $idPedido = $idPEDIDOI;
		             $_SESSION['svCi'] = '1';
                     $_SESSION['fiCi'] = $finalizacao;
                     $_SESSION['tidCi'] =  htmlentities($tid);
                     $_SESSION['statusCi'] = $status;
                     $_SESSION['dataCi'] = $dataCi;
                     $_SESSION['xmlCi'] = $xmlCi;
                     $_SESSION['StrPedido'] = $StrPedido;
                     
                     
                     ?>
               
                     <div style="background:#A2C6DE;padding:10px;margin:10px">


                         		<h3> Pedido Concluído :  (<?php echo $dataCi; ?>)</h3>


                                 <p>Número pedido : <?php echo $idPedido; ?></p>
                  			     <p>Sucesso : <?php echo $finalizacao ? "sim" : "não"; ?></p>
                  				 <p>Transação:<?php echo $tid; ?></th>
                  				 <p>Status transação: <span style="color: red;"><?php echo $status; ?> </span></p>

                                 <p>Atualizando Pedido...</p>

                                        <?php /*
                                        
                                 		<h3>XML</h3>
                                 		<textarea name="xmlRetorno" cols="60" rows="25" readonly="readonly">
                                          <?php echo $xmlCi; ?>
                                 		</textarea>
                                 		
                                 		*/ ?>

                                  </div>
                                  
                  <?php  


                         $idPage = get_idPaginaPedido();
                          $page  = get_permalink($idPage);
                          
                          
                       echo "<script>window.location='".verifyURL($page)."/?order=".$_GET['orderCIELO']."'</script>";

                       };  
                       
                    ?>