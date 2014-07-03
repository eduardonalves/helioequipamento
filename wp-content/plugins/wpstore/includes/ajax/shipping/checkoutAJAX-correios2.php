<?php

$moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
if($moedaCorrente==""){
  $moedaCorrente = "R$" ; 
}

function frete_correios($cep_destino='24340160', $peso='0.300', $retorno = 'array'){
   // TRATA OS CEP'S
   $cep_destino = eregi_replace("([^0-9])",'',$cep_destino);      

   $cep_origem =  get_option('cepOrigemCorreios'); // CEP DE QUEM ESTÁ ENVIANDO (LOJA - SE VC QUISER PODE PUXAR DO BANCO DE DADOS)
 
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
 
   // OUTROS OBRIGATORIOS (MESMO VAZIO)
   $parms->nCdFormato = 1;
   $parms->sCdMaoPropria = 'N';
   $parms->nVlValorDeclarado = 0;
   $parms->sCdAvisoRecebimento = 'N';
 
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


$destinoCep = trim(get_user_meta($idUser,'userCep2',true));
  

if($destinoCep==""){
    $destinoCep = trim(get_user_meta($idUser,'userCep',true)); 
    $destinoCep = str_replace(' ','',$destinoCep);
}    

if($userCep2==""){$userCep2="";}; 


$peso = $_SESSION['pesoCheckout'];

$frete = frete_correios($destinoCep,$peso);             

$cidade =   $_REQUEST['cityUser'];        
$tipoPagto = $_POST['varSelectV'];
      

 
global $current_user;
get_currentuserinfo();

$idUser = $current_user->ID; 

$destinoCep = trim(get_user_meta($idUser,'userCep2',true));if($userCep2==""){$userCep2="";};

if($destinoCep ==""){
$destinoCep  = = trim(get_user_meta($idUser,'userCep',true));if($userCep==""){$userCep="";};                              
};   

$userCidade2 = $_POST['cidadeV'];

if($userCidade2 ==""){
$userCidade2 = trim(get_user_meta($idUser,'userCidade2',true)); 
};

if($userCidade2 ==""){
$userCidade2 = trim(get_user_meta($idUser,'userCidade',true)); 
};

 
$freteGratis = false;



$cidadesFreteGratis = get_option('cidadesFreteGratis');
//$arrayCidades = array('Niterói','Niteroi','São Gonçalo','Sao Gonçalo','Rio Bonito','Maricá','Marica','Itaborai','Itaboraí');

$arrayCidades = array();
$arrayEstados = array();

$arrayEstadosCidades = explode(',',$cidadesFreteGratis);
foreach($arrayEstadosCidades as $item=>$value){
    $arrayValue = explode('**',$value);
    $arrayEstados = trim($arrayValue[0]);
    $arrayCidades = trim($arrayValue[1]); 
     


    $cidadeUser = str_replace(' ','',$arrayValue[1] ); 
    $cidadPromocao = str_replace(' ','',$userCidade2 );

    if(  modificaAcento(strtolower($cidadeUser)) == modificaAcento(strtolower($cidadPromocao)) ){   
    $freteGratis = true; 
    };
  

}






if(trim($userCidade2 ) ==""){
	$freteGratis = false;
}

  

if($freteGratis == false){ 
    
   $peso = $_SESSION['pesoCheckout'];
 
   $valorPac = "".$frete['pac']['valor']."";   

   $valorSedex = "".$frete['sedex']['valor']."";    
   

 
   if(floatval($valorSedex)<1 || floatval($valorPac)<1){
        require_once('freteCorreios2011-pgs.php');

     }

    
    
   $valorFreteEnviado = $_POST['radioFrete'];
   
   $comentario = $_POST['commentOrderV'];
   
   $tipoFrete = "";
 
   if($valorFreteEnviado== $valorSedex){
       $tipoFreteR = "SEDEX";
       $tipoFrete = "$destinoCep ($peso kg):  SEDEX ($moedaCorrente$SEDEX)"; 
       $salvar = true;   
       $msg = '1-Cadastrado com Sucesso!';
   }elseif($valorFreteEnviado==$valorPac){
       $tipoFreteR = "PAC"; $tipoFrete = "PAC  ($moedaCorrente$PAC)";  
       $salvar = true;    
       $msg = '2-Cadastrado com Sucesso!';
   }else{
       
       $idPage = get_idPaginaPagamento();
       $page  = get_permalink($idPage);
     
       $msg = "0-Erro no Frete!V2 $destinoCep ($peso kg):    
       $valorFreteEnviado - $SEDEX - $PAC".'****'.$page;  
       echo "$msg";
   };

}else{ 
  
    $salvar = true;
     $msg = '4-Cadastrado com Sucesso!';
     $tipoFrete = "Frete Grátis para sua região";
	    
}; 




?>