      <?php
      $moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
      if($moedaCorrente==""){
        $moedaCorrente = "R$" ; 
      }
      ?>
      
        <div class='containerOpcoes'>
        
    
        
        <div class="abas">
        	<ul class="botoes">
            	<li id="maisdet" class="ativo">Mais Detalhes</li>
                <li id="compati">Formas de Pagamento</li>
                <li id="garantia">Garantia e Assistência</li>
            </ul>
            <div class="clear"></div>
            
            
            <div class="maisdet ">
            	<h3><strong>Mais informações do produto </strong> <?php the_title(); ?> </h3>
            	 
				
				<?php the_content(); ?> 
            	 <?php //$textoDetalhes= get_post_meta($post->ID,'textoDetalhes',true); if($textoDetalhes =="" || $textoDetalhes=="#"){ $textoDetalhes = "---"; }; echo $textoDetalhes; ?>
                
                
            </div>
            
            
            <div class="compati inativo">
            
             
     
             <?php $parcelaMinima = get_parcelaMinima(); 
                   $totalParcelas = get_totalParcela(); 
                   
                          global $post;
                          $preco = custom_get_price($post->ID);
                          $specialPrice = custom_get_specialprice($post->ID);
                          if($specialPrice > 0){
                            $preco =   $specialPrice; 
                          };
						  
						  $txtParcelamentoJuros = get_option('txtParcelamentoJurosWPSHOP');  
             
             ?>

                     <h3><?php echo $moedaCorrente; ?> <?php echo $preco ; ?> *Parcele em até <?php echo $totalParcelas; ?> <?php echo $txtParcelamentoJuros; ?> </h3>


				<p>Parcela Mínima de <?php echo $moedaCorrente; ?><?php echo $parcelaMinima; ?> por pedido.  </p>
                
             
				<table id="tabelaParcelamento">

				
					<tr>
						<th>Número de Parcelas</th>
						<th>Valor da Parcela</th>
					 
					</tr>

					
					
					<?php for($z=1;$z<=$totalParcelas;$z++){ ?>
				
                    <?php 
                    
                    $qtd = $z; 
                    
                    
                    $precoSoma = $preco;
                             if(strlen($precoSoma)>6){
                              $precoSoma= str_replace('.','',$precoSoma );
                               }
                               $precoSoma = str_replace(',','.',$precoSoma);   
                    
                    
                    $parcela = $precoSoma/$qtd; 
                    
                   $parcela = number_format( $parcela,2 ,  ',', '.');
                    
                    
                    if( $parcela>$parcelaMinima ){
                        
                        ?>
                  	<tr>
  						<td><?php echo $qtd; ?></td>
  						<td><?php echo $moedaCorrente; ?><?php echo $parcela; ?></td>
  				 
  					</tr>  
                    <?php }; ?>
                    
                      <?php }; ?>
        
                    
				</table>  
      
			    <p><a href="#boxComprar" class='button'>Comprar Produto</a></p>

            	 
            </div>
            
            
            <div class="garantia inativo">
            
            
            	<h3><strong>Garantia e Assistência:</strong> <?php the_title(); ?></h3>
                
                
                <?php  $textoGarantia = get_post_meta($post->ID,'textoGarantia',true); if($textoGarantia =="" || $textoGarantia=="#"){ $textoGarantia = "Garantia padrão do fabricante"; }; echo $textoGarantia; ?>
              
                
             </div>
             
             
            
        </div>
        
		
		
            
            
			
        </div>