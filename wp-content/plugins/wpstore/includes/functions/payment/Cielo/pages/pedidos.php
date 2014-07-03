<?php 

	include_once($dirname.'/payment/Cielo/includes/include.php'); 
	
	// constantes
	$vmDadosPedido = "dados-pedido";
	$vmDataHora = "data-hora";
	$vmFormaPagamento = "forma-pagamento";
	$td = "				";
	$tr = "			";
	
 
 $orderPrint .="
		<table border='1'>
            	<tr>				
    				<th>Pedido</th>
    				<th>Data</th>
    				<th>Valor</th>
    				<th>Modalidade</th>
    				<th>Parcelas</th>
    				<th>TID</th>
    				<th>Status Transação</th>
    				<th>Valor a capturar</th>
    				<th>Ação</th>
    				<th></th>
    			</tr>";
			
 
 		    $objPedido = new Pedido();						
			$objPedido->FromString($infoCieloXML);
			
	 
			
				switch($objPedido->formaPagamentoProduto)
    			{
    				case "A":
    					$modalidade = "Débito";
    					break;
    				case "1":
    					$modalidade = "Crédito";
    					break;
    				case "2":
    					$modalidade = "Parcelado Loja";
    					break;
    				case "3":
    					$modalidade = "Parcelado Admin";
    					break;
    				default:
    					$modalidade = "n/a";
    					break;
    			}

                 $orderPrint .= $tr . '<form action="'.verifyURL(get_option( 'siteurl' )).'/pedido/?order='.$order.'&operacao=cons" target="tela_operacao" onsubmit="javascript:executar();" method="post">' . "\n";


                //echo $tr . '<form action="'.verifyURL(get_option( 'siteurl' )).'/wp-content/plugins/wpstore/includes/functions/payment/Cielo/pages/operacao.php" target="tela_operacao" onsubmit="javascript:executar();" method="post">' . "\n";


    		    $orderPrint .=  $tr . '<input type="hidden" name="numeroPedido" value="' . $objPedido->dadosPedidoNumero . '"/>' . "\n";
    			$orderPrint .=  $tr . '<input type="hidden" name="key" value="' . $objPedido->dadosPedidoNumero . '"/>' . "\n";
    			$orderPrint .=  $tr . "<tr>\n";
    			$orderPrint .=  $td . "<td>" . $objPedido->dadosPedidoNumero . "</td>\n";
    			$orderPrint .=  $td . "<td>" . $objPedido->dadosPedidoData . "</td>\n";
    			$orderPrint .=  $td . '<td align="right">' . $objPedido->dadosPedidoValor . "</td>\n";
    			$orderPrint .=  $td . "<td>" . $modalidade . "</td>\n";
    			$orderPrint .=  $td . "<td>" . $objPedido->formaPagamentoParcelas . "</td>\n";
    			$orderPrint .=  $td . "<td>" . $objPedido->tid . "</td>\n";
    			$orderPrint .=  $td . '<td style="color: red;">' . $objPedido->getStatus() . "</td>\n";
    		
    		
    			$orderPrint .=  $td . '<td align="right">'. "\n" . $td .
    				'	<select name="percentualCaptura">' . "\n" . $td .
    				'		<option value="100">100%</option>' . "\n" . $td .
    				'		<option value="90">90%</option>' . "\n" . $td .
    				'		<option value="30">30%</option>' . "\n" . $td .
    				'	</select>' . "\n" . $td .
    				"</td>\n";
    		
    		
    			$orderPrint .=  $td . '<td align="right">'. "\n" . $td .
    				'	<select name="acao">' . "\n" . $td .
    				'		<option value="autorizar">Autorizar</option>' . "\n" . $td .
    				'		<option value="capturar">Capturar</option>' . "\n" . $td .
    				'		<option value="cancelar">Cancelar</option>' . "\n" . $td .
    				'		<option value="consultar">Consultar</option>' . "\n" . $td .
    				'	</select>' . "\n" . $td .
    				"</td>\n";
    			
    			
    			$orderPrint .=  $td . '<td><input type="submit" value="Executar" /></td>' . "\n"; 
    			$orderPrint .=  $tr . "</tr>\n";
    			$orderPrint .=  $tr . "</form>\n\n";
 
 
 
 
 
         
			
 $orderPrint .= "
		</table>		
	    <script type='text/javascript'>
        			function executar() {
        				window.open('', 'tela_operacao', 'toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,resizable=0,screenX=0,screenY=0,left=0,top=0,width=725,height=725');				
        				return true;
        			}		
        </script>";
?>


    
	
