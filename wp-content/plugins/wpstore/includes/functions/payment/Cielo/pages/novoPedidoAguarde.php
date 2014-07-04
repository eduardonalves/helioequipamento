<?php //	require "../includes/include.php"; ?>
Redirecionando para Cielo...	<br/><br/>	
<?php

 
	$Pedido = new Pedido();
	
	// Lê dados do $_POST
	$Pedido->formaPagamentoBandeira = $_POST["codigoBandeira"]; 
	
	
	 $Pedido->dadosEcNumero = CIELO;
	$Pedido->dadosEcChave = CIELO_CHAVE;
	
	$Pedido->capturar = $_POST["capturarAutomaticamente"];	
	$Pedido->autorizar = $_POST["indicadorAutorizacao"];
	
	
	$tipoParcelamentoCielo =  get_option('tipoParcelamentoCielo');
    $capturarAutomaticamenteCielo =  get_option('capturarAutomaticamenteCielo');
    $indicadorAutorizacaoCielo =  get_option('indicadorAutorizacaoCielo');
    
 
	$Pedido->capturar = "$capturarAutomaticamenteCielo";	
	$Pedido->autorizar = "$indicadorAutorizacaoCielo";
 
	
	if($_POST["formaPagamento"] != "A" && $_POST["formaPagamento"] != "1"){
	    
		$Pedido->formaPagamentoProduto = $tipoParcelamentoCielo;
		$Pedido->formaPagamentoParcelas = $_POST["parcelas"];
		
	}else{
	    
		$Pedido->formaPagamentoProduto = $_POST["formaPagamento"];
		$Pedido->formaPagamentoParcelas = 1;
		
	}
	
	 

	//$Pedido->dadosPedidoNumero = rand(1000000, 9999999); 
	
	
	$idPedidoF  = str_replace('.','',$idPedido);
	$Pedido->dadosPedidoNumero =$idPedidoF;
	$Pedido->dadosPedidoDescricao =$idPedido;
	
	$Pedido->dadosPedidoValor = $_POST["produto"];
	$Pedido->dadosPedidoValor = $totalCompraCielo;
	//$Pedido->dadosPedidoValor = "10000";
	
	
	$Pedido->urlRetorno = ReturnURL();
	
//	echo $Pedido->urlRetorno."AAAA<br/><br/>";
	
	// ENVIA REQUISIÇÃO SITE CIELO
	$objResposta = $Pedido->RequisicaoTransacao(false);
	
   // echo $objResposta."BBBB<br/><br/>";
	
	$Pedido->tid = $objResposta->tid;
	$Pedido->pan = $objResposta->pan;
	$Pedido->status = $objResposta->status;
	
	$urlAutenticacao = "url-autenticacao";
	$Pedido->urlAutenticacao = $objResposta->$urlAutenticacao;
	
	//print_r($objResposta->$urlAutenticacao);
	//echo "aaa";

	// Serializa Pedido e guarda na SESSION
	$StrPedido = $Pedido->ToString();
	
//	print_r($StrPedido);
	
	$_SESSION["pedidos"]->append($StrPedido);
	
    //if($Pedido->urlAutenticacao !=""){ 
      
	echo '<script type="text/javascript">
	 window.location.href = "' . $Pedido->urlAutenticacao . '"
		 </script>';
//	 };
 

?>