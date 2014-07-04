<?php  $tabelaVar .= "   <div class='meios'>"; ?>
  
	
<?php  $tabelaVar .= " 		<div class='calcularFrete'>"; ?>
		
		
<?php  $tabelaVar .= " 	    <p class='tituloFrete' ><strong>Frete:</strong> </p>"; ?>
        
        
              <?php $theID = $post->ID; $idPagina = get_idPaginaCheckout();   ?>
             <?php if(is_page($idPagina)){ ?>
            <?php  $tabelaVar .= " 	   <div style='display:none'> "; ?>
             <?php }; ?>
                      
                      
	                     <?php $cepV = get_session_cep();    ?>
	                     
	                     <?php  if( $_SESSION['alertaFrete'] == 'ALERTAR'){ ?>
	                     <?php  $tabelaVar .= " 	  <label for='cep'  class='red' > Informe seu cep: </label>   "; ?> 
	                     <?php }else{ ?>
	                    <?php  $tabelaVar .= " 	  <label for='cep'>Informe seu cep:</label>     " ?>
	                    <?php  }; ?>
	                    
		                 <?php  $tabelaVar .= " 	  <input type='text' id='cep' name='cep' value='$cepV' title='Digite seu Cep' class='cep'   "; ?>
		                 <?php if(is_page($idPagina)){    $tabelaVar .= " readonly='readonly'";    }; ?> <?php  $tabelaVar .= " />";
                        
                         $tabelaVar .= "<input type='button' class='btCalcularFrete button ' value='Consultar Frete' />";    
                         
                             
		 	           
		 	             $tabelaVar .= "<div class='clear'></div>
    		
    		                "; ?>
    		
                 	    <?php

                 	     $pesoTotal = get_weight_cart();

                 	    ?>



    		   <?php if(is_page($idPagina)){ ?>
    		    
    		     <?php  $tabelaVar .= " 
    		        
                  </div>
                  <h3>CEP DA ENTREGA : <span class='cepEntrega'><?php    echo $cepV;  ?></span> </h3>
                  
                          <input type='hidden' id='cep' name='cep' value='$cepV' title='Digite seu Cep' class='cep' ";  
                           if(is_page($idPagina)){   $tabelaVar .= "  readonly='readonly' "; };   
                           $tabelaVar .= "  />
                          "; ?>
                          
                              <?php
                                   $_SESSION['pesoCheckout'] =  $pesoTotal; 
                                   $_SESSION['cepCheckout'] =   $cepV;
                               ?>
                <?php }; ?>
            
     

<?php $tabelaVar .= "

            <p class='endereco'></p>
            
    		<p class='resultFrete'></p>

	 	<p> Não sabe o CEP ? <a href='http://www.buscacep.correios.com.br/servicos/dnec/index.do'  target='_blank' >Consulte Aqui.</a></p>

	
		<input type='hidden' id='cityEntrega' value='Digite sua Cidade' title='Digite sua Cidade' class='cityEntrega ' />
        

        <input type='hidden' id='idPrd'   class='idPrd ' value='$theID' />    


		<input type='hidden' class='peso' value='";
		
	     if( is_single() ) { 
	         
	         $tabelaVar .= get_weight_product($post->ID); }else{ $tabelaVar .= " $pesoTotal";  };  $tabelaVar .= "' />";

         /*
	     $tabelaVar .= "<p>Peso do Produto :  "; 
	    
	      if( is_single() ){  
	             $tabelaVar .= get_weight_product($post->ID);
	           }else{ 
	             $tabelaVar .= "$pesoTotal"; 
	             
          };   
          $tabelaVar .= "  Kg  </p>";
          */

         $idTermos = get_idPaginaTermos();
         $paginaTermos = get_permalink($idTermos);
         
          
          
         $txtEntrega   = get_option('txtEntregaWPSHOP');
         if($txtEntrega==""){
             $txtEntrega = "Entre 1 a 9 dias úteis após a confirmação de pagamento . Para promoção de FRETE GRÁTIS e produtos com mais de 30kg a entrega é feita por transportadora. Neste último caso é aplicada a tarifa SEDEX. ";
         }  
		    
	$tabelaVar .= "</div>
		
		
	 <p><strong>Entrega: </strong> $txtEntrega </p>";
                     
      if($idTermos != ''){
	  $tabelaVar .=  "<p><strong>Troca e Devolução : </strong> <a href='".$paginaTermos."'> Fique por dentro </a> </p>";
	  };      
		
	$tabelaVar .=  "</div><!-- .meios -->"; ?>
	
	<?php  //$htmlVar .= $tabelaVar; ?>
