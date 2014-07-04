 <?php
 $moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
 if($moedaCorrente==""){
   $moedaCorrente = "R$" ; 
 }
 ?>
    
    
 <?php
 
 $orderPrint .="
 

 <section class='cart'>";
 
 
 
 

$orderPrint .= "
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
                     }
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
           
              
             
                $orderPrint .= " 
                <tr>
              
                    <td> ".custom_get_image($postID,183,183,true,false)." </td>
                    
                    <td class='hide-phone'>
                     
                    		<ul class='descDetalhes'>
								<li><a href='".get_permalink($postID)."' >".get_the_title($postID)."</a></li>
								<li>$orderPrintiacao $variacao</li>
								<li>$precoAdd </li>
							</ul>      
							
							<p> $categories</p>
							
							<p class='editar'><a href='".get_permalink($postID)."'>mais detalhes</a></p>
							
                    
                    </td>
                   
                    <td>
                    
                    <p>$qtd</p>
                    
 
                    
                    
                    </td>
                    
                    <td class='ta-right'>$moedaCorrente$preco<br/>$precoAdd</td>
                    
                    <td class='ta-right'>$moedaCorrente$precoLinha</td>
                    
            	</tr>"; ?>
            	
            	<?php }; ?>
            	
           <?php }; ?>
           
           
           <?php      $orderPrint .= " 
    
            </tbody>
        </table>
        
  
		
		<div class='clear'></div> 
        
         

</section><!-- .cart -->


		
		<div class='clear'></div>"; 


 