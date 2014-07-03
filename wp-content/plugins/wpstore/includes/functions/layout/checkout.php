<?php $moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
    if($moedaCorrente==""){
      $moedaCorrente = "R$" ; 
    }
    
    
      $idPagina = get_idPaginaCheckout();  

      if(is_page($idPagina)) {  

           $htmlVar .='<input type="hidden" id="checkout" value="TRUE" />'; 

      }; 

      $plugin_directory = str_replace('functions/layout/','',plugin_dir_url( __FILE__ ));

 
$htmlVar .="<div class='pagamento'>

	<div class='title3'>
			Confirme o Pedido  
		
		<span>Total : ".$moedaCorrente."".custom_get_total_price_session_order()."</span>
	</div>
	
	
	<p><a href='".verifyURL(get_permalink( get_idPaginaCarrinho() ))."' >Clique aqui se deseja  editar seu pedido</a></p>
    
    ";
	
	
    $arrayCarrinho ='';   

 	    $blogid = intval(get_current_blog_id());  
      	 if($blogid>1){
      	       $arrayCarrinho = $_SESSION['carrinho'.$blogid];
      	 }else{
      	       $arrayCarrinho =  $_SESSION['carrinho'];  
         };

    
    
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
                                                             $precoAddFSoma =   str_replace(',','.',$precoAddF);
                                                             };
                                                             


                                     if($sinal=="-"){
                                     $precoSoma = $precoSoma -  $precoAddFSoma;  
                                     }elseif($sinal=="+"){
                                     $precoSoma = $precoSoma +  $precoAddFSoma;    
                                     };   

                                   $qtd = intval($item['qtdProduto']);


                                   $precoLinha =    getPriceFormat($qtd*$precoSoma) ;

                                   $subtotal += $qtd*$precoSoma;

                      
                           $textoUnidade = "unidades";
                           if($qtd==1){
                            $textoUnidade = "unidade";    
                           }   
                           
                           
                           
                           
                                 $categories = "<span style='font-size:10px'><strong>Categorias do produto:</strong></span>";


                                 foreach((get_the_category($postID)) as $category) { 
                                     $categories .= "<span style='font-size:10px'>".$category->cat_name.", </span>"; 
                                 }
                                 
	
                   $htmlVar .="	<div class='fotosC'>
	                            ".custom_get_image($postID,150,150,true,false)."
                                </div>
	
	                            <div class='unidC'>
		                        <span> <strong> $qtd $textoUnidade </strong>  </span>
		                        <br/>
		                       <span>  $tabelaVariacao </span><br/>
								<span> $precoAdd   </span>
								  <br/>
						         $categories 
								
		                        <a href='".get_permalink($postID)."'>detalhes</a>
	                            </div>
	                           	<div class='precoC'>".$moedaCorrente."".$preco." (".$moedaCorrente."".$precoLinha.") </div>
	                           	 <div class='clear'></div>
	                            <hr/>
	                            
	                            <p><a href='".verifyURL(get_permalink( get_idPaginaCarrinho() ))."' >Clique aqui se deseja  editar seu pedido</a></p>
                                
                                
                                ";
	              };

        };
          
$htmlVar .="<section class='checkout'>

	<div class='block'>
    	<div class='block-head title'>Etapa 1: Confirme Seus Dados</div>
        <div class='block-content'>
 
            <!-- Your dialog markup -->
            <div class='my-dialog'>";  
            
            
             if ( is_user_logged_in() ) {

                      include('meus-dados.php');
                      
                      $htmlVar .= " <br/>
                          	        <p class='msg'></p>
                          	        <br/> ";
                          	        
                          	        
                   
                        
             }else{
                 
                      include('loginRegistro.php');  
             
             };
             
             
            
              $blockHead = "";
              if ( is_user_logged_in() ) {  $blockHead = "block-head";  }else{   $blockHead = "block-headl";  }; 
              $blockHead = "block-headl";
        
        
         $htmlVar .="  </div>



            <div class='clear'></div>
        </div>
    </div>
 
    <div class='block'>
    	<div class='$blockHead title2'>Etapa 2: Escolha o tipo de Entrega</div>
        <div class='block-content'>
            <div class='content form-inline'>
            
   
             <p>Por favor selecione o tipo de entrega de sua preferência para realizar esta compra.</p>";
             
           
           
           include('box-frete.php');   
           
           
           
            $htmlVar .="  
            
            
            
                <div class='clear'></div>

                <p> <span class='btSeguir2 button'>Continuar</span></p>
                <span class='msg2'></span>
                
                
                <div class='clear'></div>"; 

            
            
            include('box-desconto.php'); 


           $htmlVar .="  <div class='clear'></div>"; 
            
            
            /*
                <div class="field"><label>Se desejar, adicione abaixo qualquer comentário sobre seu pedido:</label>
                <textarea style="width: 98%;" rows="8" id='addComentOrder'></textarea></div>
              */ 
              
          $htmlVar .="  

            	                         	 
            	
            	<br/>
             
            </div>
            <div class='clear'></div>
            
            <p> <span class='btSeguir2 button'>Continuar</span></p>
            <span class='msg2'></span>
            
        </div>
    </div>";  
    
       $enderecoRetirada = get_option('enderecoRetirada');
       
       $htmlVar .="   
    <div class='block'>
    	<div class='$blockHead title3'>Etapa 3: Selecione a  forma Pagamento </div>
        <div class='block-content'>
            <div class='content form-inline'>
                <p>Por favor selecione o   método de pagamento de sua preferência para realizar esta compra.</p>";
                
                      global $current_user;
                      get_currentuserinfo();
                      
                      
                      $plugin_directory = str_replace('functions/','functions/',plugin_dir_url( __FILE__ ));
 
 
                        $ativaPagseguro = get_option('ativaPagseguro');
                        $ativaCielo = get_option('ativaCielo');
                        $ativaDeposito = get_option('ativaDeposito ');
                        $ativaRetirada= get_option('ativaRetirada'); 
                        
                        
                        $ativaMoip= get_option('ativaMoip');
                        $ativaPaypal= get_option('ativaPaypal');
                        
                        
                        
             if($ativaCielo=="ativaCielo"){         
                //if( $current_user->ID==1 || $current_user->ID==4849 ){
               $htmlVar .=" <hr/><br/><div class='field'><input type='radio' class='tipoPagto' name='tipoPagto' value='Cielo' checked='checked'>  <img src='".$plugin_directory."images/cielo.png' > &nbsp; CIELO  <img src='".$plugin_directory."images/mastercard.png' width='40'> <img src='".$plugin_directory."images/visa.png' width='40'> <img src='".$plugin_directory."images/diners.png' width='40'>   <img src='".$plugin_directory."images/elo.png' width='40'> <img src='".$plugin_directory."images/discovery.png' width='40'> 
               <br/><span style='font-size:10px'> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;Função Crédito </span>  </div>";
               //}; 
            }; 
             
             /*
              $htmlVar .="<hr/><br/> <div class='field'><input type='radio' class='tipoPagto' name='tipoPagto' value='Redecard' checked='checked'><img src='".$plugin_directory."images/redecard.png' >  &nbsp; Redecard  <img src='".$plugin_directory."images/mastercard.png' width='40'> <img src='".$plugin_directory."images/visa.png' width='40'>  <img src='".$plugin_directory."images/diners.png' width='40'> 
              <br/><span style='font-size:10px'>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;Função Crédito</span> 
               </div>";
               */
             
            if($ativaPagseguro=="ativaPagseguro"){    
		  	$htmlVar .="<br/><hr/><div class='field'><input type='radio' class='tipoPagto'  name='tipoPagto' value='Pagseguro'> <img src='".$plugin_directory."images/pagseguro.png' > &nbsp; Pagseguro <img src='".$plugin_directory."images/pagseguro2.png' > 
				   <br/><span style='font-size:10px'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;Função Crédito , Débito e Boleto</span> 
				   </div>";
				   
			}; 
			
			
				if($ativaMoip=="ativaMoip"){    
    		  	$htmlVar .="<br/><hr/><div class='field'><input type='radio' class='tipoPagto'  name='tipoPagto' value='Moip'> <img src='".$plugin_directory."images/moip.png' > &nbsp; Moip 
    				   </div>";

    			};
    			
			
			
		     	if($ativaPaypal=="ativaPaypal"){    
        		  	$htmlVar .="<br/><hr/><div class='field'><input type='radio' class='tipoPagto'  name='tipoPagto' value='Paypal'> <img src='".$plugin_directory."images/paypal.png' > &nbsp; Paypal
        				   </div>";

        			};
			
			
			
		
			
			
			
			
			if($ativaDeposito=="ativaDeposito"){    	   
		    $htmlVar .="<br/><hr/>	<div class='field'><input type='radio' class='tipoPagto'  name='tipoPagto' value='Depósito'> <img src='".$plugin_directory."images/deposito.png' > &nbsp; Deposito em conta Corrente    <img src='".$plugin_directory."images/bb.png' width='40'>  <img src='".$plugin_directory."images/itau.png' width='40'>  </div>
		     ";
		     
		     	};
			
			
		    if($ativaDeposito=="ativaDeposito"){  	   
				   $htmlVar .="
		
			<br/><hr/>	<div class='field'><input type='radio' class='tipoPagto'  name='tipoPagto' value='Retirar na Loja'> <img src='".$plugin_directory."images/retirada.png' > &nbsp;   	Retirada na Loja . 
			<span style='font-size:10px'>( <strong style='color:red'>ATENÇÃO </strong>: Retiradas somente no RJ,  em nossa Loja no endereço : 
				 $enderecoRetirada . )</span></div>";
				};
				 
				 
			 $htmlVar .=	 "
                
              
                 <p> <span class='btSeguir3 button'>Concluir </span></p>
  
                 
                 <span class='msg2'></span>
              
            
            
                 
            </div>
            <div class='clear'></div>
        </div>
    </div>
   
</section>"; 

 $htmlVar .="</div>"; //div pagamento 
 
   
 $googleConversaoCheckout=  get_option('googleConversaoCheckout'); 
  $googleConversaoCheckout= str_replace('\"','"',$googleConversaoCheckout);
      
 $htmlVar .=$googleConversaoCheckout;
 
 ?>