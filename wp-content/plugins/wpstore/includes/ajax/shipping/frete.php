<?php

require("../../../../../../wp-load.php");

 
$tipoFrete = get_option('tipoFrete');

$correios = $_POST['correios'];

$cidade =   $_REQUEST['cityUser'];      


$destinoCep = trim($_REQUEST['CepDestinoR']);    

  

//Pegando cidade com base no CEP --------------------------------------------- 
     $caputurar = true;
     //include('buscaEndereco.php');
//Pegando cidade com base no CEP --------------------------------------------- 



 
$freteGratis = false;


$moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
if($moedaCorrente==""){
  $moedaCorrente = "R$" ; 
}


$cidadesFreteGratis = get_option('cidadesFreteGratis');
//$arrayCidades = array('Niterói','Niteroi','São Gonçalo','Sao Gonçalo','Rio Bonito','Maricá','Marica','Itaborai','Itaboraí');

$arrayCidades = array();
$arrayEstados = array();
   
$arrayEstadosCidades = explode(',',$cidadesFreteGratis);
foreach($arrayEstadosCidades as $item=>$value){
    $arrayValue = explode('**',$value);
    $arrayEstados[] = trim($arrayValue[0]);
    $arrayCidades[] = trim($arrayValue[1]); 
    
    $cidadeUser = str_replace(' ','',$arrayValue[1] ); 
    $cidadePromocao = str_replace(' ','',$cidade );
    
    if(  modificaAcento(strtolower($cidadeUser)) == modificaAcento(strtolower($cidadePromocao)) ){   
    $freteGratis = true; 
    };
    
}


if(trim($cidade) ==""){
	$freteGratis = false;
}       
 
  
  
$msgFreteGratis=""; 

$valorPedido = custom_get_total_price_session_order();

  


 if(strlen($valorPedido)>=6){
     $valorPedido =  str_replace('.','',$valorPedido);
     $valorPedido =  str_replace(',','.',$valorPedido);
     }else{
     $valorPedido =  str_replace(',','.',$valorPedido);
     }; 
     
     
     $idPrd   = $_POST['idPrd']; 
     $precoProduto =  custom_get_price($idPrd);
     
     if($precoProduto>0){
      $valorPedido =  $precoProduto;
     }
     
     $simbolo =  get_current_symbol(); 
     $precoPromocao = get_option('valorFreteGratis');

            if(strlen($precoPromocao)>=6){
             $precoPromocao =  str_replace('.','',$precoPromocao);
             $precoPromocao =  str_replace(',','.',$precoPromocao );
             }else{
             $precoPromocao =  str_replace(',','.',$precoPromocao);
             };   
             
 
 if($valorPedido > $precoPromocao &&  $precoPromocao > 0 ){
     $freteGratis = true; 
     $msgFreteGratis = "Frete Grátis para pedidos acima de  $simbolo".get_option('valorFreteGratis').". Aproveite!";   
 }

if($freteGratis == false){ 
 

    if($tipoFrete=='correios' && $correios=="2"){
    
       include('freteCorreios2011-2.php');
    
    }elseif($tipoFrete=='correios'){
    
        include('freteCorreios2011.php'); 
   
     }elseif($tipoFrete=='gratis' ){
    
        echo'<div id="retorno"><span style="color:green">PROMOÇÃO FRETE GRÁTIS . APROVEITE !  </div>';  
    
      }elseif($tipoFrete=='fixo' ){
            $valorFreteFixo  =get_option('valorFreteFixo');
            
            $FIXO = "<input type='radio' name='radioFrete'  class='radioFrete'    rel='Fixo'  id='Fixo' value='".$valorFreteFixo."' CHECKED />FRETE FIXO: $moedaCorrente <span  class='red' id='valorFreteFixo' >".$valorFreteFixo."</span>";    
            
            echo'<div id="retorno" style="font-size:16px" >'.$FIXO.' </div>';  
        
       }elseif($tipoFrete=='pesoBase' ){
    
           $valorFrete = 0;
           
           $peso =  intval( $_SESSION['pesoCheckout']);  
        
           if( $peso  >=0 && $peso  <1 ){
                $valorFrete = get_option('valorFretePeso1'); 
           }elseif($peso  >=1 && $peso  <5 ){
                 $valorFrete = get_option('valorFretePeso2');  
           }elseif($peso  >=5 && $peso  <10 ){
                 $valorFrete = get_option('valorFretePeso3');  
           }elseif($peso  >=10 && $peso  <20 ){
                 $valorFrete = get_option('valorFretePeso4');  
           }elseif($peso  >=20 && $peso  <30 ){
                 $valorFrete = get_option('valorFretePeso5');  
           }elseif($peso  >= 30  ){
                 $valorFrete = get_option('valorFretePeso6');  
           };
                          
           $PESOBASE = "<input type='radio' name='radioFrete'  class='radioFrete'    rel='pesoBase'  id='pesoBase' value='".$valorFrete."' CHECKED />FRETE Peso Base: $moedaCorrente <span  class='red' id='valorFretePesoBase' >".$valorFrete."</span>";    

           echo'<div id="retorno" style="font-size:16px" >'.$PESOBASE.' </div>';  

      }elseif($tipoFrete=='precoBase' ){

             $valorFrete = 0;
             $preco = intval(get_subtotal());
  
               if( $preco >=0 && $preco  <=100 ){
                    $valorFrete = get_option('valorFreteValor1'); 
               }elseif($preco >100 && $preco  <=200 ){
                     $valorFrete = get_option('valorFreteValor2');  
               }elseif($preco  >200 && $preco  <=300){
                     $valorFrete = get_option('valorFreteValor3');  
               }elseif($preco  >300 && $preco  <=400 ){
                     $valorFrete = get_option('valorFreteValor4');  
               }elseif($preco  >400 && $preco  <=500 ){
                     $valorFrete = get_option('valorFreteValor5');  
               }elseif($preco  >500  ){
                     $valorFrete = get_option('valorFreteValor6');  
               };



               $PRECOBASE= "<input type='radio' name='radioFrete'  class='radioFrete'    rel='precoBase'  id='precoBase' value='".$valorFrete."' CHECKED />FRETE Preço como Base: $moedaCorrente <span  class='red' id='valorFretePrecoBase' >".$valorFrete."</span>";    

               echo'<div id="retorno" style="font-size:16px" >'.$PRECOBASE.' </div>';

      }

}else{
     
   if($msgFreteGratis ==""){
    echo'<div id="retorno"><span style="color:green">FRETE GRÁTIS PARA SUA REGIÃO. APROVEITE !  </div>';          
   }else{ 
    echo'<div id="retorno"><span style="color:green">'.$msgFreteGratis.'</div>';   
   };
 
};

?>