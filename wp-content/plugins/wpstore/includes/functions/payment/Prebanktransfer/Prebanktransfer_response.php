<?php
$moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
if($moedaCorrente==""){
  $moedaCorrente = "R$" ; 
}
?>
<?php  $txtPrint .= "<h2>Obrigado, Seu pedido foi registrado com sucesso.</h2>
	
	
	
				   <p><strong>Código de identificação do pedido  : $idPedido </strong> </p>
			
";

               
                   
                                  $cupom =   get_session_cupom();

                                  $desconto = 0.00;
                                  $msg = "";
                                  $numeroCupom  = $cupom[0];


                                               $vt = $valor_total;
                                               $vt = str_replace('.','',$vt);
                                               $vt = str_replace(',','.',$vt);
                                               $vt = floatval($vt);


                                  if($cupom[1]=="Valor"){ 
                                     $msg =  $cupom[1]." $moedaCorrente".$cupom[2];
                                   //  $desconto = floatval(str_replace(',','.',$cupom[2]));
                                  }elseif($cupom[1]=="Percentual"){
                                    $msg = $cupom[1]." " .$cupom[2]."%" ;  

                                   //  $desconto = ( $vt*floatval(str_replace(',','.',$cupom[2])) ) / 100 ;


                                  };
                                  
                                  
                  	if(floatval($desconto)>0){
                 	$txtPrint .= "Sub Total : $moedaCorrente".$valor_total."<br/><br/>";
                 	$txtPrint .= "Frete : ".$frete."<br/><br/>";
                   	$txtPrint .= "Desconto : $moedaCorrente".getPriceFormat($desconto)." ( Cupom Desconto  :$numeroCupom | $msg )<br/><br/>";

               	    };
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
                      <h3 style='width:92;background:#ddd;margin-left:5px;padding:20px;text-align:center;font-size:1.2em'  >Total a pagar: $moedaCorrente".getPriceFormat( $totalPagto)." </h3> $obs";  
                   ?>
                      
                      <?php
                      
                      $depositoNomeCnpj =get_option('depositoNomeCnpj'); 

                      $depositoBanco1 = get_option('depositoBanco1'); 
                      $depositoAgencia1 =get_option('depositoAgencia1');
                      $depositoConta1 = get_option('depositoConta1');

                      $depositoBanco2 = get_option('depositoBanco2');
                      $depositoAgencia2 = get_option('depositoAgencia2'); 
                      $depositoConta2 = get_option('depositoConta2');

                      $depositoMaisInfos = get_option('depositoMaisInfos');
                      
                      ?>    
 
 
 
 
                 <?php
                 
                 if(intval($totalPagto)>0){ ?>
					
				<?php	$txtPrint .= "	
						
					<p>Para confirmar sua compra é necessário realizar o depósito báncário no valor  total de  <u>$moedaCorrente  $totalPagto  </u> de acordo com as opções  abaixo :</p>
					<p><strong>    $depositoBanco1 - Agência:   $depositoAgencia1  | Conta : $depositoConta1</strong></p>
					<p> <strong>  $depositoBanco2 -  Agência:   $depositoAgencia2 | Conta : $depositoConta2 </strong></p>
					<p>  $depositoNomeCnpj </p>
					<br>
					<p> $depositoMaisInfos </p>
		 
				<p>	Anote e informe o código de identificação do pedido  no momento da comprovação. </p>
				
				<p><strong>Código de identificação do pedido  :  $idPedido  </strong> </p>
				
				
				
					<br>
					
					<p><span style='color:red'>IMPORTANTE: </span> O prazo de envio e entrega dos pedidos,  inicia somente  após  a confirmação do depósito .</p>
                    ";
                    
                }; // IF TOTAL PAGTO > 0
                
                
             $txtPrint .= " 	<p>Obrigado por  comprar conosco ".get_bloginfo('name')."</p>";
					
					?>