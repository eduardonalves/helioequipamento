 <?php
 $moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
 if($moedaCorrente==""){
   $moedaCorrente = "R$" ; 
 }
 ?>

 <?php $tabelaVar .= "<section class='cart'>"; ?>


<?php 

   $arrayCarrinho = "";  
        $blogid = intval(get_current_blog_id());  
        	 if($blogid>1){
        	          $arrayCarrinho =  $_SESSION['carrinho'.$blogid] ;     
        	 }else{
        	          $arrayCarrinho = $_SESSION['carrinho'];      
           };
   
   $act = $_GET['act'];
   $idp = $_GET['idp'];
   $remove = $_GET['removeAll'];
 
    if($remove=="arisco"){
        $esvaziarCarrinho=true;
    }
    if($esvaziarCarrinho==true){
     
               $blogid = intval(get_current_blog_id());  
         	 if($blogid>1){
            	          $_SESSION['carrinho'.$blogid] = array();     
            	 }else{
            	          $_SESSION['carrinho'] = array();      
               };
 
        
               
    };
   
  
    if( $arrayCarrinho==""){
        $arrayCarrinho = array();
       
    }
    
    
    if($act=='remove'){
             unset($arrayCarrinho[$idp]);   
             
               $blogid = intval(get_current_blog_id());  
 				if($blogid>1){$arrayCarrinho = $_SESSION['carrinho'.$blogid] = $arrayCarrinho;   }else{      $_SESSION['carrinho'] = $arrayCarrinho;    };
             
        
             	//wp_redirect(verifyURL(get_bloginfo('url')).'/carrinho/');
             		  echo "<script>window.location='".verifyURL(get_bloginfo('url'))."/carrinho/'</script>";
    }
    
    

    $qtdStock =  custom_get_qtd_items_Cart();
     
    if($qtdStock>0){
  
?>

<?php

if( $_SESSION['alertaFrete'] == 'ALERTAR'){
    $tabelaVar .=  "<h2 class='red'>Calcule o frete : Informe o CEP para entrega. </h2>";
}
?>


<?php

$tabelaVar .= "
	<table class='table' style='width: 100%;'>
            <thead>
                <tr>
                	<td class='hide-phone'>Imagem</td>
                    <td class='ta-left'>Nome do Produto</td>
                    <td class='ta-left hide-phone'>Tamanho-Cor</td>
                    <td class='ta-left'>Quantidade</td>
                    <td class='ta-right'>Preço Unidade</td>
                    <td class='ta-right'>Total</td>
                </tr>
            </thead>
           
            <tbody>
            ";
?>


            
            <?php 
            
            //print_r($arrayCarrinho);
            
            $subtotal = 0;
            $pesoTotal = 0;
            
            
            $infoCupom =   get_session_cupom();
            
            $numeroCUpom = $infoCupom[0];
            $tipoDesconto = $infoCupom[1];
            $valorDesconto = $infoCupom[2];
            
            
            foreach($arrayCarrinho as $key=>$item){ 
                
                $postID = intval($item['idPost']);
                
                if($postID>0){
                    
                    $tabelaVariacao = $item['variacaoProduto'];
                    if($tabelaVariacao==""){
                        $tabelaVariacao="-";
                    }
                    
                    
                   
         
                   $preco =  custom_get_price( $postID );
                   $specialPrice =  custom_get_specialprice( $postID );
                   $pesoTotal += get_weight_product($postID );
                   
                   if($specialPrice >0){
                   $preco =  $specialPrice;   
                   }
                   
                   $precoSoma = $preco;            
                   
                            if(strlen($precoSoma)>6){
                             $precoSoma= str_replace('.','',$precoSoma );
                              }
                              $precoSoma = str_replace(',','.',$precoSoma);   
                              
                              
                                     $precoAdd = get_price_product_variation($postID,$tabelaVariacao);

                                     //$precoAdddArray = explode('(R$',$precoAdd);
                                     $precoAdddArray = explode('(',$precoAdd);
                                     $sinal = $precoAdddArray[0];
                                     $precoAddF= str_replace(')','',$precoAdddArray[1]);
                                                
                                      
                                                if(strlen($precoAddF)>=6){
                                                 $precoAddFSoma =  str_replace('.','',$precoAddF);
                                                 $precoAddFSoma =  str_replace(',','.',$precoAddFSoma );
                                                 }else{
                                                 $precoAddFSoma =  str_replace(',','.',$precoAddF);
                                                 }; 
                                                 
                                                    
                                      
                             
                                      
                     if($sinal=="-"){
                     $precoSoma = floatval($precoSoma) -   floatval($precoAddFSoma);  
                     }elseif($sinal=="+"){
                     $precoSoma =  floatval($precoSoma) +   floatval($precoAddFSoma);    
                     };   
                    
                   $qtd = intval($item['qtdProduto']);
                   
                   
                   $precoLinha =    getPriceFormat($qtd*$precoSoma) ;
                   
                   $subtotal += $qtd*$precoSoma;
                   
               
              
             
                ?>
                
                
             <?php   
                $tabelaVar .= " 
                <tr>
                	<td width='1' class='ta-center hide-phone'><a href='".get_permalink($postID)."'>".custom_get_image($postID,50,50,true,false)."</a></td>
                    <td><a href='".get_permalink($postID)."'>".get_the_title($postID)."</a> (<span class='removeProdCart' ><a href='".get_permalink( $idPaginaCarrinho)."?act=remove&idp=$key'>remover</a></span>)</td>
                    <td class='hide-phone'>$tabelaVariacao $precoAdd </td>
                    <td>
                    
                    <input class='qtdProdInput' rel='$key' rev='$tabelaVariacao'   type='text' size='2' value='$qtd' 	readonly='readonly' />
                    
                    <ul class='setas'>
                    <li class='setaUp' rel='$key' rev='$tabelaVariacao' ></li>
                    <li class='setaDown' rel='$key'  rev='$tabelaVariacao' ></li>
                    </ul>
                    
                    </td>
                    <td class='ta-right'>$moedaCorrente$preco<br/>$precoAdd</td>
                    <td class='ta-right'>$moedaCorrente$precoLinha</td>
            	</tr>"; ?>
            	
            	<?php }; ?>
            	
           <?php }; ?>       
           
           
           
           
           
           	<?php
 				
 			    
            
     						 
     						 $tipoImposto = get_option('tipoImposto');   
     						  $impostos = " ";
     						  
     						if($tipoImposto=="impostoCheckout"){   
     						    
     						            
     						       $impostoNome1 = get_option('impostoNome1');
                                   $impostoPercetual1 = floatval(get_option('impostoPercetual1'));

                                   $impostoNome2 = get_option('impostoNome2');
                                   $impostoPercetual2 = floatval(get_option('impostoPercetual2'));

                                   $impostoNome3 = get_option('impostoNome3');
                                   $impostoPercetual3 = floatval(get_option('impostoPercetual3'));

                                   $impostoNome4 = get_option('impostoNome4');
                                   $impostoPercetual4 = floatval(get_option('impostoPercetual4'));

                                   $txImposto =  $impostoPercetual+$impostoPercetual1+$impostoPercetual2+ $impostoPercetual3 +$impostoPercetual4;             
                                   
                     				$impostosIncidentes = "  $impostoNome1 ($impostoPercetual1%) + $impostoNome2 ($impostoPercetual2%)  + $impostoNome3 ($impostoPercetual3%)  + $impostoNome4 ($impostoPercetual4%)  ";       


                     				$valorImposto =   $subtotal * $txImposto / 100;      

                                    if($valorImposto>0){
                     				        $impostos = "

                                         <p class='preco'>Total impostos : $moedaCorrente <span class='vImpostoCart'>".getPriceFormat($valorImposto)."</span> </p>  
                     							 <p class='preco' >  percentual : $txImposto% <br/>  $impostosIncidentes  </p>
                         						 <div class='clear'></div>


                         						 ";   
                         						 
                     						 };
                         						 
                         						 
 						    };
 				
 				     ?>
 				     
 				     
 				     
 				     
           
           
           <?php      $tabelaVar .= " 
            <tfoot>
                   <tr>
                   	<td colspan='6'>
                       	<div class='float-right'>
                       	
                       	 <h3> 	$moedaCorrente<span class='subtotalCart'>".getPriceFormat($subtotal)."</span> </h3>
                        
                           
                           <br>

                           </div>
                           <div class='float-right ta-right'>
                           
                           	  	 <h4> 	Sub-Total :  </h4>
                             <br>    
                             
                                  $impostos  
                                  
                           </div>
                       </td>
                   </tr>
               </tfoot>
               
               
           
            </tbody>
        </table>
        
  
		
		<div class='clear'></div>"; ?>
		
		
		<?php

        if( $_SESSION['alertaFrete'] == 'ALERTAR'){
             $tabelaVar .= "<h3 class='red'>Calcule o frete : Informe o CEP para entrega. </h3>";
        };
        
        ?>
 
		 
            <?php  include('box-frete.php'); ?>


     		<?php   $tabelaVar .= "<div class='clear'></div>"; ?>
     			
      
     		<?php include('box-desconto.php'); ?>
     		
     		
           	<?php  $tabelaVar .= "<div class='clear'></div>"; ?>
 
         
                <?php 
                   $desconto = 0.00;
                   $msg = "";
                   if($cupom[1]=="Valor"){ 
                      $msg =  $cupom[1]." $moedaCorrente".$cupom[2];
                      $desconto = floatval(str_replace(',','.',$cupom[2]));
                    }elseif($cupom[1]=="Percentual"){
                      $msg = $cupom[1]." " .$cupom[2]."%" ;  
                      $desconto = ( $subtotal*floatval(str_replace(',','.',$cupom[2])) ) / 100 ;
                    }; 
                ?>
           
                
                
               		        
                
        <?php    $tabelaVar .= "    <h3> Sub Total : <span >$moedaCorrente ".getPriceFormat($subtotal)." </span> </h3>"; ?>
                
        <?php    $tabelaVar .= "    <h5> Descontos: $moedaCorrente <span   class='descontoCart red'>".getPriceFormat($desconto)."</span><span style='font-size:12px'> ( Cupom Desconto  :$cupom[0]   |   $msg   ) 
        </span></h5>"; ?>
               
               <?php    $total = $subtotal - $desconto;  ?>
               
               
                   <?php 
                   $obs = "";
                   if( $total<0){
                       $positivoTotal = str_replace('-','',$total);
                        $obs = "<br/><span style='font-size:0.6em;color:red'>Seu cupom é maior que o total de suas compras . Em breve você receberá um  novo cupom no valor de $positivoTotal. </span><br/><br/>";
                        $total= "0.00";
                   }

                   ?>
                   
                   
               
            <?php    $tabelaVar .= "     <h3> TOTAL: <span class='totalCart red'>$moedaCorrente ".getPriceFormat($total)." </span> $obs </h3>
         
		                <div class='buttons'>
                              
                              <div class='left' ><a href='".get_bloginfo('url')."/checkout/' class='button-alt btCalcularFrete  '>Seguir para Pagamento</a></div>
                              <div class='right' ><a href='".get_bloginfo('url')."' class='button'>Continuar comprando</a></div>
                              
                              <div class='clear'></div>
                          </div>
		
                          <br/> <br/>
                          ";
                          
                          ?>

		
		
		<?php }else{ ?>
		    
		    
		  <?php  $tabelaVar .= "  
		    
            <h2>Seu carrinho está vazio.</h2>

           <p> Para adicionar produtos ao carrinho, procure pelo produto que deseja em nosso site e clique no botão 'Comprar' na página do produto.
            </p>
            
            <br/>
            
            <h3> Por que meu carrinho está vazio?</h3>
            <ul>
            <li> 1. Os itens selecionados permaneceram em seu carrinho por mais tempo do que o permitido pelo sistema. Este período pode variar de acordo com cada item selecionado.</li>
            <li> 2. Você removeu os produtos do carrinho.</li>
            <li> 3. Sua compra já foi finalizada e Você utilizou as opções Voltar / Avançar da barra de ferramentas de seu navegador. </li>
            </ul>";
            
            ?>


		    
		<?php }; ?>
 

<?php  $tabelaVar .= "</section><!-- .cart -->"; ?>


		
<?php  $tabelaVar .= "<div class='clear'></div>" ; ?>
 

