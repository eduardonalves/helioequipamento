<?php
 
 
 $moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
 if($moedaCorrente==""){
   $moedaCorrente = "R$" ; 
 }
 
function frete_correios($cep_destino='24340160', $peso='0.500', $retorno = 'array'){
    
   // TRATA OS CEP'S
   $cep_destino = eregi_replace("([^0-9])",'',$cep_destino);      

   $cep_origem =    get_option('cepOrigemCorreios'); // CEP DE QUEM ESTÁ ENVIANDO (LOJA - SE VC QUISER PODE PUXAR DO BANCO DE DADOS)
   //$cep_origem =    '24340000'; // CEP DE QUEM ESTÁ ENVIANDO (LOJA - SE VC QUISER PODE PUXAR DO BANCO DE DADOS)
 
   /*
    * TIPOS DE FRETE
    *
         41106 = PAC sem contrato
         40010 = SEDEX sem contrato
         40045 = SEDEX a Cobrar, sem contrato
         40215 = SEDEX 10, sem contrato
         40290 = SEDEX Hoje, sem contrato
         40096 = SEDEX com contrato
         40436 = SEDEX com contrato
         40444 = SEDEX com contrato
         81019 = e-SEDEX, com contrato
         41068 = PAC com contrato
    *
    *
    */
 
   // ESTE ARRAYS PARA O RETORNO (NO MEU CASO SÓ QUERO MOSTRAR ESTES)
   $rotulo = array('41106'=>'PAC','40010'=>'SEDEX','40215'=>'ESEDEX');
 
   //$webservice = 'http://shopping.correios.com.br/wbm/shopping/script/CalcPrecoPrazo.asmx?WSDL';// URL ANTIGA
   $webservice = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx?WSDL';
 
   // TORNA EM OBJETO AS VARIAVEIS
   $parms = new stdClass;
   $parms->nCdServico = '41106,40010,40215';// PAC, SEDEX E ESEDEX (TODOS COM CONTRATO) - se vc precisar de mais tipos adicione aqui
   $parms->nCdEmpresa = '';// <- LOGIN DO CADASTRO NO CORREIOS (OPCIONAL)
   $parms->sDsSenha = '';// <- SENHA DO CADASTRO NO CORREIOS (OPCIONAL)
   $parms->StrRetorno = 'xml';
 
   // DADOS DINAMICOS
   $parms->sCepDestino = $cep_destino;// CEP CLIENTE
   $parms->sCepOrigem = $cep_origem;// CEP DA LOJA (BD)
   $parms->nVlPeso = $peso;
 
   // VALORES MINIMOS DO PAC (SE VC PRECISAR ESPECIFICAR OUTROS FAÇA ISSO AQUI)
   $parms->nVlComprimento = '27';
   $parms->nVlDiametro = 2;
   $parms->nVlAltura = 9;
   $parms->nVlLargura = 18;
   

    $altura =  get_option('alturaEmbalagemCorreios');
    $largura= get_option('larguraEmbalagemCorreios');
    $comprimento = get_option('comprimentoEmbalagemCorreios');
       /**/ 

   if(intval($altura )>0){
     $parms->nVlAltura = $altura;
   }

   if(intval($largura)>0){
     $parms->nVlLargura = $largura;
    }

   if(intval( $comprimento)>0){
     $parms->nVlComprimento = $comprimento;
   }
   
   
   
 
   // OUTROS OBRIGATORIOS (MESMO VAZIO)
   $parms->nCdFormato = 1;
   $parms->sCdMaoPropria = 'S';
   $parms->nVlValorDeclarado = 0;
   $parms->sCdAvisoRecebimento = 'S';
 
   // Inicializa o cliente SOAP
   $soap = @new SoapClient($webservice, array(
           'trace' => true,
           'exceptions' => true,
           'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
           'connection_timeout' => 1000
   ));
 
   // Resgata o valor calculado
   $resposta = $soap->CalcPrecoPrazo($parms);
   $objeto = $resposta->CalcPrecoPrazoResult->Servicos->cServico;
 
   $array = array();
   foreach($objeto as $obj)
   {
      $tipo = isset($rotulo[$obj->Codigo]) ? strtolower($rotulo[$obj->Codigo]) : '';
      if($tipo!='')
      {
         $array[$tipo] = array('tipo'=>strtoupper($tipo),'valor'=>str_replace(',','.',$obj->Valor),'prazo'=>$obj->PrazoEntrega,'erro'=>$obj->Erro,'msg'=>$obj->MsgErro);
      }
   }
 
   // RETORNO
   if($retorno == 'objeto')
   {
      return $objeto;
   }
   elseif($retorno == 'json')
   {
      $json = json_encode($array);
      return $json;
   }
   else
   {
      return $array;
   }
}


            
$peso =  floatval(trim($_REQUEST['PesoR']));

$origemCep =   get_option('cepOrigemCorreios');
$peso =  floatval(trim($_REQUEST['PesoR']));
$destinoCep = $_REQUEST['CepDestinoR'];


if($peso>30){
$peso  = 30;	
}elseif($peso=""){
$peso  = 1;	   
}

$cidade =   $_REQUEST['cityUser'];      
$freteGratis = false;



 
if($freteGratis == false){ 
    
    $frete = frete_correios($_REQUEST['CepDestinoR'],$peso);           
   //$frete = frete_correios(); 
   // $frete = frete_correios('05716090','1');   
   
   $valorSedex = $frete['sedex']['valor'];
   $valorPac = $frete['pac']['valor'];
   
   if(floatval($valorSedex)<1 || floatval($valorPac)<1){
        require_once('freteCorreios2011-pgs.php');

     }
     
     
   $PAC = "<input type='radio' name='radioFrete'  class='radioFrete'    rel='".$frete['pac']['tipo']."'  id='".$frete['pac']['tipo']."' value='".$valorPac."' /> ".$frete['pac']['tipo']." : $moedaCorrente <span  class='red' id='valorFrete".$frete['pac']['tipo']."' >".$valorPac."</span>";   

   $SEDEX = " <input type='radio'  name='radioFrete' class='radioFrete'  checked='checked'  rel='".$frete['sedex']['tipo']."' id='".$frete['sedex']['tipo']."' value='".$valorSedex."' />SEDEX : $moedaCorrente <span  class='red'  id='valorFrete".$frete['sedex']['tipo']."' >".$valorSedex."</span>";     
 
   echo'<div id="retorno" style="font-size:16px">'.$SEDEX.'<div style="padding-top:5px">'.$PAC.'</div><br/></div>';
 
}else{ 
 
    echo'<div id="retorno"><span style="color:green">FRETE GRÁTIS PARA SUA REGIÃO. APROVEITE !  </div>';          
	
};



?>