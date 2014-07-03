<?php
$enderecoRetirada = get_option('enderecoRetirada');

$enderecoRetirada = get_option('enderecoRetirada');

?>


     <?php 
        $obs = "";
        if( intval( $totalPagto )<0){
           $positivoTotal = str_replace('-','', $totalPagto );
            $obs = "<br/><span style='font-size:0.8em;color:red'>Seu cupom é maior que o total de suas compras . Em breve você receberá um  novo cupom no valor de $positivoTotal. </span><br/><br/>";
          $totalPagto= "0.00";
        }
        
        ?>




<?php $txtPrint .= "<br/>
   <h3 style='width:92;background:#ddd;margin-left:5px;padding:20px;text-align:center;font-size:1.2em'  >Total a pagar: $moedaCorrente".getPriceFormat( $totalPagto)." </h3> $obs ";  
?>

<?php  $txtPrint .= "
 <br/>

<h4>Pedido Concluído</h4>
<p> Seu pedido foi concluído com sucesso e ficará reservado para  retirada em nossa loja nos próximos 5 dias. </p>
<p> Para retirar seu pedido visite  nossa loja , realize o pagamento e retire seu pedido. </p>
<p>Nosso Endereço : $enderecoRetirada </p> 
<p> Numero de seu pedido :  <strong> $idPedido </strong></p>

<br/>";

?>
 