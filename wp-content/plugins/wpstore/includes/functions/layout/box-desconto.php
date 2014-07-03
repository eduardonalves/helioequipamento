<?php
$moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
if($moedaCorrente==""){
  $moedaCorrente = "R$" ; 
}
?>

<?php   $tabelaVar .= "	<div class='meios'>"; ?>


<?php   $tabelaVar .= "		<div class='calcularDesconto'>"; ?>


<?php   $tabelaVar .= " <p class='tituloDesconto' ><strong>CUPOM:</strong>Resgate seu cupom de desconto.</p>"; ?>

     <?php  $cupom = get_session_cupom();    ?>
     
<?php   $tabelaVar .= "  	     <label for='cupom'>Digite o cupom de desconto :</label>
	 <input type='text' id='cupom' name='cupom' value='".$cupom[0]."' title='Digite o Cupom' class='cupom2' /> 
	     
     <input type='button' class='btCalcularDesconto button' value='Resgatar' />
    
     <div class='clear'></div>
      
      <p style='color:red'>".$_SESSION['cupomDescontoErro']."</p>
 
	        

  <p class='resultDesconto'> "; ?>
  
<?php  $_SESSION['cupomDescontoErro'] = ""; $tabelaVar .= " <span > CUPOM CÓDIGO : ".$cupom[0]."  - "; ?>
                    
                    <?php if($cupom[1]=="Valor"){ 
	                 $tabelaVar .= $cupom[1]." $moedaCorrente".$cupom[2];
	                 }elseif($cupom[1]=="Percentual"){
	                 $tabelaVar .= $cupom[1]." " .$cupom[2]."%" ;    
	                 }; 
	                 ?>
	                 
		<?php        $tabelaVar .= "  </span>
	        
	        </p>


</div><!-- .meios --> "; ?>

<?php  $htmlVar .= $tabelaVar; ?>