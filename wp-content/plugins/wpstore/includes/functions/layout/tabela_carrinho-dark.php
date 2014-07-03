 <?php
 $moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
 if($moedaCorrente==""){
   $moedaCorrente = "R$" ; 
 }
 ?>

 <?php $tabelaVar .= "<section class='cart'>"; ?>


<?php 

  $arrayCarrinho ='';   

	    $blogid = intval(get_current_blog_id());  
    	 if($blogid>1){
    	       $arrayCarrinho = $_SESSION['carrinho'.$blogid];
    	 }else{
    	       $arrayCarrinho =  $_SESSION['carrinho'];  
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
    
    
    $idPagina  = get_idPaginaCarrinho();
   
    $urlRedirect = get_permalink($idPagina);
    
    
    if($act=='remove'){
             unset($arrayCarrinho[$idp]);
          
          
                     $blogid = intval(get_current_blog_id());  
          				if($blogid>1){$arrayCarrinho = $_SESSION['carrinho'.$blogid] = $arrayCarrinho;   }else{      $_SESSION['carrinho'] = $arrayCarrinho;    }
          
          
          
             	//wp_redirect(verifyURL(get_bloginfo('url')).'/carrinho/');
             		  echo "<script>window.location='".verifyURL($urlRedirect)."'</script>";
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
	<table class='table carrinho' style='width: 100%;'>
            <thead>
                <tr>
                	<th class='produto'>Produto</th>
                    <th class='detalhes'>Detalhes</th>
                    <th class='qtd'>Quantidade</th>
                    <th class='preco'>Preço</th>
                    <th class='total'>Total</th>
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
                     $precoSoma = $precoSoma -  $precoAddFSoma;  
                     }elseif($sinal=="+"){
                     $precoSoma = $precoSoma +  $precoAddFSoma;    
                     };   
          
                   $qtd = intval($item['qtdProduto']);
                   
                   
                   $precoLinha =    getPriceFormat($qtd*$precoSoma) ;
                   
                   $subtotal += $qtd*$precoSoma;
                   
               
                                $categories = "<span style='font-size:10px'><strong>Categorias do produto:</strong></span>";


                        foreach((get_the_category($postID)) as $category) { 
                            $categories .= "<span style='font-size:10px'>".$category->cat_name.", </span>"; 
                        }
             
                ?>
                
                
             <?php   
                $tabelaVar .= "  
                
                       
					         
                <tr>
              
                    <td> ".custom_get_image($postID,183,183,true,false)." </td>
                    
                    <td class='hide-phone'>
                     
                    		<ul class='descDetalhes'>
								<li><a href='".get_permalink($postID)."' >".get_the_title($postID)."</a></li>
								<li>$tabelaVariacao</li>
								<li>$precoAdd </li>  
								
							
    						         
							</ul>
							     
							
									<p> $categories</p>         
									
							<p class='editar'><a href='".get_permalink($postID)."'>mais detalhes</a></p>
							
                    
                    </td>
                   
                    <td>
                    
                    <input class='qtdProdInput' rel='$key' rev='$tabelaVariacao'   type='text' size='2' value='$qtd' 	readonly='readonly' />
                    
                    <ul class='setas maisMenos'>
                    <li class='setaUp' rel='$key' rev='$tabelaVariacao' ></li>
                    <li class='setaDown' rel='$key'  rev='$tabelaVariacao' ></li>
                    </ul>
             
                     <span class='removeProdCart remover' ><a href='".get_permalink( $idPaginaCarrinho)."?act=remove&idp=$key'>remover</a></span>
                    
                    
                    </td>
                    
                    <td class='ta-right'>$moedaCorrente$preco<br/>$precoAdd</td>
                    
                    <td class='ta-right'>$moedaCorrente$precoLinha</td>
                    
            	</tr>"; ?>
            	
            	<?php }; ?>
            	
           <?php }; ?>
           
           
           <?php      $tabelaVar .= " 
    
            </tbody>
        </table>
        
  
		
		<div class='clear'></div>"; ?>
		
		
		<?php

        if( $_SESSION['alertaFrete'] == 'ALERTAR'){
             $tabelaVar .= "<h3 class='red'>Calcule o frete : Informe o CEP para entrega. </h3>";
        };
        
        ?>
 
		 
                 
 
 
 
 
 
        		
  			   
 
         
                <?php 
                
                 $cupom = get_session_cupom(); 
                 
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
           
                      		        
      
               <?php    $total =  $subtotal - $desconto ;  ?>
               
  
  
  
                     <?php 
                      $obs = "";
                      if( $total<0){
                          $positivoTotal = str_replace('-','',$total);
                           $obs = "<br/><span style='font-size:0.6em;color:red'>Seu cupom é maior que o total de suas compras . Em breve você receberá um  novo cupom no valor de $positivoTotal. </span><br/><br/>";
                           $total= "0.00";
                      }

                      ?>
                      
                      
                      
                          
                          
                          <?php  $tabelaVar .= "   
                          		<div class='opcoesPgto'>
              						<form>"; ?>
              						

              				<?php//	$tabelaVar .= "	<input class='cep' type='text' value='Digite seu CEP:' title='Digite seu CEP:' />"; ?>
              				
              				
              				<?php $tabelaVar .= "<p class='cep btChangeO' rel='bvfrete' >Consulta Cep (FRETE) </p>"; ?>
              				
              				<?php $tabelaVar .= "<div class='ctChan  bvfrete' style='display:none'>"; ?>
              				
                                <?php  include('box-frete.php'); ?>

                                 <?php   $tabelaVar .= "</div>"; ?>
                                 
                              	<?php   $tabelaVar .= "<div class='clear'></div>"; ?>
                      
              			    <?php $tabelaVar .= "	<p class='cupom btChangeO' rel='bvCupom' >Cumpo de Desconto</p>"; ?>
              							
                       	   <?php $tabelaVar .= "<div class='ctChan bvCupom' style='display:none'>"; ?>
                        
                    		<?php include('box-desconto.php'); ?>
                    		
                    		 <?php   $tabelaVar .= "</div>"; ?><?php   $tabelaVar .= "</div>"; ?>
                          

                          	<?php  $tabelaVar .= "<div class='clear'></div>"; ?>
                          	




              				<?php//	$tabelaVar .= "<input class='cupom' type='text' value='Digite aqui seu Cupom-desconto:' title='Digite aqui seu Cupom-desconto:' /> "; ?>
              				
              				
              				
              			      <?php




                      						 $tipoImposto = get_option('tipoImposto');   
                      						  $impostos = " ";
                      						  $valorImposto = 0;
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


                                      				$valorImposto =   ( floatval(str_replace(',','.',$subtotal)) * $txImposto ) / 100;      
                                                    $total +=  $valorImposto;
                                                      
                                                     if($valorImposto>0){
                                      				        $impostos = "


                                      				     	 <p class='valorT' >Taxas</p>  
                                      							 <p class='preco'>Total impostos : $moedaCorrente <span class='vImpostoCart'>".getPriceFormat($valorImposto)."</span> </p>  
                                      							 <p class='preco' >  percentual : $txImposto% <br/>  $impostosIncidentes  </p>
                                          						 <div class='clear'></div>


                                          						 ";   

                                      						 };


                  						    };

                  				     ?>	


                           
              		
              							
              			<?php		$tabelaVar .= "<div class='clear'></div>
                                          
                                         <div style='width:100%' id='carrinhoFoot'>


                                        
                                        <div class='bk'>
                                        <p class='valorT' >Subtotal</p>
              							<div class='clear'></div>
                                        <p class='preco'>$moedaCorrente <span class='subtotalCart'>".getPriceFormat($subtotal)."</span> </p>
              							<div class='clear'></div> 
              					           
              					            $impostos
                  						     
              							</div> 
              							
              							
              							
              				   
                  							
              							
                                        <div class='bk'>
              							<p class='valorT'>Descontos</p>
              							<div class='clear'></div>
                                        <p class='preco'>$moedaCorrente <span   class='descontoCart red'>".getPriceFormat($desconto)."</span>
                                        <br/><span style='font-size:12px'> Cupom Desconto  :$cupom[0]   <br/>   $msg </p>
              							<div class='clear'></div>
              							</div>
              							
              							
                                       <div class='bk'>
              							<p class='valorT'>Valor Total</p>
              							<p class='preco totalCart'>$moedaCorrente ".getPriceFormat($total+$valorImposto)."  $obs </p>
              							<div class='clear'></div>
                                        <p class='voltar'><a href='".verifyURL(get_bloginfo('url'))."' >Mais uma olhada na loja</a></p>
              							<div class='clear'></div>
                                        <p class='concluirC'><a href='".verifyURL(get_bloginfo('url'))."/checkout/'>Concluir Compra</a></p>
              							<div class='clear'></div>
              						  </div>
              							
              						</form>
              					</div>
              					
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


		
<?php  $tabelaVar .= "<div class='clear'></div><br/><br/><br/>" ; ?>
 

