<?
// DEFININDO OS VALORES
 $CEP_ORIGEM = '11060-000'; // SP
 $PESO = '0.07';
 $VALOR = '1999,99';
 $CEP_DESTINO = '13015-904'; // CAMPINAS
 $tipoEntrega = "SD";

 // CHAMADA DO ARQUIVO QUE CONTEM A CLASSE PgsFrete()
 require_once('fretePgs.php');
 // INSTANCIANDO A CLASSE
 $frete = new PgsFrete;
 // ZERANDO VALORES
 $valorFrete = 0.0;
 // CALCULANDO O FRETE
 $valorFrete = $frete->gerar($CEP_ORIGEM, $PESO, $VALOR, $CEP_DESTINO);
 // CONDIÇÃO
 if($tipoEntrega == "SD" || $tipoEntrega == "EN") {
    if(is_array($valorFrete)) {
       if($tipoEntrega == "SD") {
          echo "Sedex: R$ " . $valorFrete["Sedex"];
       } else {
	    echo "Encomenda econômica (PAC): R$ " . $valorFrete["PAC"];
       }
    }
 }else{
       $valorFrete = "0.00";
	 echo "FRETE GRATIS: ".$valorFrete;
 }

?>

