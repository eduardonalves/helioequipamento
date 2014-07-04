<?php

 $moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
 if($moedaCorrente==""){
   $moedaCorrente = "R$" ; 
 }

 function calculaFrete($cod_servico, $cep_origem, $cep_destino, $peso, $altura='5', $largura='20', $comprimento='30', $valor_declarado='0.50')
 {
     #OFICINADANET###############################
     # Código dos Serviços dos Correios
     # 41106 PAC sem contrato
     # 40010 SEDEX sem contrato
     # 40045 SEDEX a Cobrar, sem contrato
     # 40215 SEDEX 10, sem contrato
     ############################################


     /**/
      $alturaS =  get_option('alturaEmbalagemCorreios');
      $larguraS= get_option('larguraEmbalagemCorreios');
      $comprimentoS = get_option('comprimentoEmbalagemCorreios');


     if(intval($alturaS)>0){
       $altura =  $alturaS;  
     }

     if(intval($larguraS)>0){
       $largura= $larguraS;  
     }

     if(intval($comprimentoS)>0){
      $comprimento =  $comprimentoS;  
     }




     $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cep_origem."&sCepDestino=".$cep_destino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=".$valor_declarado."&sCdAvisoRecebimento=s&nCdServico=".$cod_servico."&nVlDiametro=10&StrRetorno=xml";
     $xml = simplexml_load_file($correios);
     if($xml->cServico->Erro == '0')
         return $xml->cServico->Valor;
     else
         return false;
 };
/*
echo "<br><Br>Cálculo de FRETE PAC: ". 
calculaFrete('41106','24340000','24340160','4')."<br>";

echo "<br><Br>Cálculo de FRETE SEDEX: ". 
calculaFrete('40010','24340000','24340160','4')."<br>";

echo "<br><Br>Cálculo de FRETE SEDEX a cobrar: ". 
calculaFrete('40045','24340000','24340160','4')."<br>";

echo "<br><Br>Cálculo de FRETE SEDEX 10: ". 
calculaFrete('40215','24340000','24340160','4')."<br>";
*/

$origemCep =  get_option('cepOrigemCorreios');


global $current_user;
get_currentuserinfo();
$idUser = $current_user->ID;  

$destinoCep = trim(get_user_meta($idUser,'userCep2',true)); 
$destinoCep = str_replace(' ','',$destinoCep); 


if($destinoCep==""){
    $destinoCep = trim(get_user_meta($idUser,'userCep',true)); 
    $destinoCep = str_replace(' ','',$destinoCep);
}


$userCidade2 = $_POST['cidadeV'];
$tipoPagto = $_POST['varSelectV'];
 
 $valorFreteEnviado = $_POST['radioFrete'];
 $comentario = $_POST['commentOrderV'];

if($userCidade2 ==""){
$userCidade2 = trim(get_user_meta($idUser,'userCidade2',true)); 
}; 

if($userCidade2 ==""){
$userCidade2 = trim(get_user_meta($idUser,'userCidade',true)); 
};

$peso = $_SESSION['pesoCheckout']; 

if($peso>30){
$peso  = 30;	
}


 

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

 

if(trim($userCidade2) ==""){
	$freteGratis = false;
}

$salvar = false;

if($freteGratis == false){ 


       $valorSedex = 0.00;     
       $valorPac =  0.00;
       if(floatval($valorSedex)<1 || floatval($valorPac)<1){
            require_once('freteCorreios2011-pgs.php');
       }
   


   $tipoFrete = "";$tipoFreteR = "";
 
   
  if($valorFreteEnviado==$valorSedex){
     $tipoFreteR = "SEDEX";
     $tipoFrete = "SEDEX ($moedaCorrente$valorSedex)"; 
     $salvar = true;    
     $msg = '1-Cadastrado com Sucesso!';
  }elseif($valorFreteEnviado==$valorPac ){
     $tipoFreteR = "PAC";
     $tipoFrete = "PAC  ($moedaCorrente$valorPac)";  
     $salvar = true;    
     $msg = '2-Cadastrado com Sucesso!';
  }else{
     $msg = "0-Erro no Frete!V1:$valorFreteEnviado - $valorSedex - $valorPac ";  
     echo "$msg";
  };
 

}else{ 
    $salvar = true;
    $msg = '4-Cadastrado com Sucesso!';
    $tipoFrete = "Frete Grátis para sua região"; 
}; 




?>