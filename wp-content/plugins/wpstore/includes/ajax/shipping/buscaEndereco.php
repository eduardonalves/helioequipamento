<?php 



if( $caputurar ==true){ }else{
session_start();
};
 


include('phpQuery-onefile.php');


////////////////////////////////////////////////////////
 

function simple_curl($url,$post=array(),$get=array()){
	$url = explode('?',$url,2);
	if(count($url)===2){
		$temp_get = array();
		parse_str($url[1],$temp_get);
		$get = array_merge($get,$temp_get);
	}

	$ch = curl_init($url[0]."?".http_build_query($get));
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	return curl_exec ($ch);
}

//////////////////////////////////////////////////////////////

 
function busca_cep($cep){
$resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');
if(!$resultado){
$resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";
}
parse_str($resultado, $retorno);
return $retorno;
}
 
 //////////////////////////////////////////////////////////////
 

$cep = $_REQUEST['cep']; 

       
 
  if( $caputurar ==true){   
        $cep = $destinoCep;   
  };
  

if($cep !="Digite seu Cep"){
     $_SESSION['cepUser'] = $cep;
};

$html = simple_curl('http://m.correios.com.br/movel/buscaCepConfirma.do',array(
	'cepEntrada'=>$cep,
	'tipoCep'=>'',
	'cepTemp'=>'',
	'metodo'=>'buscarCep'));

phpQuery::newDocumentHTML($html, $charset = 'utf-8');

$dados = array(
	'logradouro'=> trim(pq('.caixacampobranco .resposta:contains("Logradouro: ") + .respostadestaque:eq(0)')->html()),
	'bairro'=> trim(pq('.caixacampobranco .resposta:contains("Bairro: ") + .respostadestaque:eq(0)')->html()),
	'cidade/uf'=> trim(pq('.caixacampobranco .resposta:contains("Localidade / UF: ") + .respostadestaque:eq(0)')->html()),
	'cep'=> trim(pq('.caixacampobranco .resposta:contains("CEP: ") + .respostadestaque:eq(0)')->html())
	);

$dados['cidade/uf'] = explode('/',$dados['cidade/uf']);
$dados['cidade'] = trim($dados['cidade/uf'][0]);
$dados['uf'] = trim($dados['cidade/uf'][1]);
unset($dados['cidade/uf']);
 
//Vamos buscar o CEP

if( trim( $dados['cidade'] ) =="" || trim( $dados['cidade'] ) =="null" ){
       
     //------------------------------------------------------------------
 
}else{

     if( $caputurar ==true){    
         
           $cidade =   $dados['cidade'];  
       
     }else{  
          die(json_encode($dados)); 
     };

};  
?>