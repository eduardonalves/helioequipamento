<?php 
	require "../includes/include.php";
?>
<html>
	<head>
		<title>Loja Exemplo : Cart�o na Loja</title>
	</head>
	<body>
	Redirecionando...
<?php 	
	
	$Pedido = new Pedido();
	
	// L� dados do $_POST
	$Pedido->formaPagamentoBandeira = $_POST["codigoBandeira"]; 
	if($_POST["formaPagamento"] != "A" && $_POST["formaPagamento"] != "1")
	{
		$Pedido->formaPagamentoProduto = $_POST["tipoParcelamento"];
		$Pedido->formaPagamentoParcelas = $_POST["formaPagamento"];
	} 
	else 
	{
		$Pedido->formaPagamentoProduto = $_POST["formaPagamento"];
		$Pedido->formaPagamentoParcelas = 1;
	}
	
	$Pedido->dadosEcNumero = LOJA;
	$Pedido->dadosEcChave = LOJA_CHAVE;
	
	$Pedido->capturar = $_POST["capturarAutomaticamente"];	
	$Pedido->autorizar = $_POST["indicadorAutorizacao"];
	
	
	$Pedido->dadosPortadorNumero = $_POST["cartaoNumero"];
	$Pedido->dadosPortadorVal = $_POST["cartaoValidade"];
	// Verifica se C�digo de Seguran�a foi informado e ajusta o indicador corretamente
	if ($_POST["cartaoCodigoSeguranca"] == null || $_POST["cartaoCodigoSeguranca"] == "")
	{
		$Pedido->dadosPortadorInd = "0";
	}
	else if ($Pedido->formaPagamentoBandeira == "mastercard")
	{
		$Pedido->dadosPortadorInd = "1";
	}
	else 
	{
		$Pedido->dadosPortadorInd = "1";
	}
	$Pedido->dadosPortadorCodSeg = $_POST["cartaoCodigoSeguranca"];
	
	$Pedido->dadosPedidoNumero = rand(1000000, 9999999); 
	$Pedido->dadosPedidoValor = $_POST["produto"];
	
	$Pedido->urlRetorno = ReturnURL();

	// ENVIA REQUISI��O SITE CIELO
	if($_POST["tentarAutenticar"] == "sim") // TRANSA��O
	{
		$objResposta = $Pedido->RequisicaoTransacao(true);
	}
	else // AUTORIZA��O DIRETA 
	{
		$objResposta = $Pedido->RequisicaoTid();
		
		$Pedido->tid = $objResposta->tid;
		$Pedido->pan = $objResposta->pan;
		$Pedido->status = $objResposta->status;
		
		$objResposta = $Pedido->RequisicaoAutorizacaoPortador();
	}
		
	$Pedido->tid = $objResposta->tid;
	$Pedido->pan = $objResposta->pan;
	$Pedido->status = $objResposta->status;
	
	$urlAutenticacao = "url-autenticacao";
	$Pedido->urlAutenticacao = $objResposta->$urlAutenticacao;
	
	// Serializa Pedido e guarda na SESSION
	$StrPedido = $Pedido->ToString();
	$_SESSION["pedidos"]->append($StrPedido);
	
	
	if($_POST["tentarAutenticar"] == "sim") // TRANSA��O
	{
		echo '<script type="text/javascript">
				window.location.href = "' . $Pedido->urlAutenticacao . '"
			 </script>';
	}
	else // AUTORIZA��O DIRETA 
	{
		echo '<script type="text/javascript">
				window.location.href = "retorno.php"
			 </script>';
	}
?>
	</body>
</html>