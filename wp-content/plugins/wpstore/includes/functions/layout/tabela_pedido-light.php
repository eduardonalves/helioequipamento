 <?php
 $moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
 if($moedaCorrente==""){
   $moedaCorrente = "R$" ; 
 }
 ?>
    
    
 <?php
 
 $orderPrint .="
 

 <section class='cart'>



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

             <tbody> "; ?>
            
            <?php 
            
            //print_r($arrayCarrinho);
            
            $subtotal = 0;
            $pesoTotal = 0;
            
        
        
           
                 $tabela = $wpdb->prefix."";
                $tabela .=  "wpstore_orders_products";

                $fivesdrafts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM  `$tabela` WHERE `id_usuario`='$idUser' AND `id_pedido`='$idPedido' ORDER BY `id`  ASC  " ,1,'') );

                // Adicionando PRODUTOS

                foreach ( $fivesdrafts as $item=>$fivesdraft ){
                      	 	 	 	 	
                     
                                 $id_produto = $fivesdraft->id_produto;
                                 $preco = $fivesdraft->preco;
                                 $variacao = $fivesdraft->variacao;
                                 $qtdProd = $fivesdraft->qtdProd;
                                 $precoAlt = $fivesdraft->precoAlt;
                                 $precoAltSymb = $fivesdraft->precoAltSymb;
                                 $sinal = $precoAltSymb;
                 
                
                $postID = intval( $id_produto);
                
                if($postID>0){
                    
                   
                    if($variacao==""){
                        $variacao="-";
                    }
                    
               
                   $precoSoma = $preco;
                   
                            if(strlen($precoSoma)>6){
                             $precoSoma= str_replace('.','',$precoSoma );
                            };
                              $precoSoma = str_replace(',','.',$precoSoma);   
                              
                       $precoAlt = floatval(str_replace(',','.',$precoAlt));  
                       
                                   if(strlen($precoAlt)>=6){
                                    $precoAlt =  str_replace('.','',$precoAlt);
                                    $precoAlt =  str_replace(',','.',$precoAlt); 
                                    }else{
                                    $precoAlt =  str_replace(',','.',$precoAlt);
                                    };
                                    
                                     
                                      
                     if($sinal=="-"){
                     $precoSoma = $precoSoma -  $precoAlt;  
                     }elseif($sinal=="+"){
                     $precoSoma = $precoSoma +  $precoAlt;    
                     };   
          
                   $qtd = intval($qtdProd);
                   
                   
                   $precoLinha =    getPriceFormat($qtd*$precoSoma) ;
                   
                   $subtotal += $qtd*$precoSoma;
                   $extra ="";
                    if(floatval($precoAlt)!=0){
                   $extra = "($sinal $moedaCorrente$precoAlt)";
                   };
                ?>
                
                
                <?php   
                
                
                
                
                
                $categories = "<span style='font-size:10px'><strong>Categorias do produto:</strong></span>";


                foreach((get_the_category($postID)) as $category) { 
                    $categories .= "<span style='font-size:10px'>".$category->cat_name.", </span>"; 
                }




                $orderPrint .="

                
                
       
         <tr>
         	<td width='1' class='ta-center hide-phone'><a href='".get_permalink($postID)."'>".custom_get_image($postID,50,50,true,false)."</a></td>
             <td><a href='".get_permalink($postID)."'>".get_the_title($postID)."</a> ($categories ) </td>
             <td class='hide-phone'>".$variacao."  </td>
             <td>
             $qtdProd 
             </td>
             <td class='ta-right'>$moedaCorrente $preco <br/> $extra </td>
             <td class='ta-right'>$moedaCorrente $precoLinha  </td>
     	</tr>
      
            	"; ?>
            	
            	<?php }; ?>
            	
           <?php }; ?>
           
           
           
           
           
 
                   <?php

                   $orderPrint .="

           
        
        <tfoot>
               <tr>
               	<td colspan='6'>
                   	<div class='float-right'>

                    <h3> $moedaCorrente<span class='subtotalCart'>".getPriceFormat($subtotal)."</span> 	</h3>

                        ";
                        
                        ?>
                        
                        
                        <?php if($numeroCupom !=""){ ?>
                            
                            <?php


                      
                              
                              $orderPrint .="

                            
                            
                             <b>Cupom Desconto :</b>$numeroCupom;<br>
                               <b>Valor do Desconto :</b> $moedaCorrente$desconto<br>
                               <b>Valor Final (sem Frete) :</b> $moedaCorrente$totalPagto <br><br>
                               
                               "; ?>
                               
                               <?php }; ?>
                               
                               
                                       <?php

                                         $orderPrint .="

                               
                               
                               </div>
                               <div class='float-right ta-right'>
                           
                           	  	 <h4> 	Sub-Total :  </h4>
                           	  	 
                           	  	 ";
                           	  	 
                           	  	 ?>
                           	  	 
                           	  	 
                           	    <?php if($numeroCupom !=""){ ?>	 
                           	  	   
                           	  	   
                           	  	   <?php  $orderPrint .=" <h4> 	Desconto :  </h4>"; ?>
                             
                             
                              <?php }; ?>
                                             
                             <?php   $orderPrint .="
                             <br>
                           </div>
                       </td>
                   </tr>
               </tfoot>
               
            </tbody>
        </table>
     
</section><!-- .cart -->

 	<div class='clear'></div>"; 


?>


