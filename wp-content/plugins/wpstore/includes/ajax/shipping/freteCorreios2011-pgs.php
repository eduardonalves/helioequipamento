<?
// DEFININDO OS VALORES
 $CEP_ORIGEM = $origemCep; // SP
 $CEP_DESTINO = $destinoCep; // CAMPINAS
 
 $PESO = "$peso";
 $VALOR = '40';

 // CHAMADA DO ARQUIVO QUE CONTEM A CLASSE PgsFrete()
 require_once('fretePgs.php');
 // INSTANCIANDO A CLASSE
 $frete = new PgsFrete;
 // ZERANDO VALORES
 $valorFrete = 0.0;
 // CALCULANDO O FRETE
 $valorFrete = $frete->gerar($CEP_ORIGEM, $PESO, $VALOR, $CEP_DESTINO);
  
  if(is_array($valorFrete)) {
        
        $valorSedex = $valorFrete["Sedex"];
        $valorPac = $valorFrete["PAC"];
      
   };
 

?>

