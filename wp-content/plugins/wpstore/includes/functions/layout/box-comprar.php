<?php  


      $moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
         if($moedaCorrente==""){
             $moedaCorrente = "R$" ; 
           };  
      
$urlImgM =  "".get_option('imagemTabelaWPSHOP');;  
$exibirTabela =  "".get_option('exibirTabelaWPSHOP');

$parcelaMinima=  get_parcelaMinima(); 
$totalParcela = get_totalParcela();         

$txtParcelamentoJuros = get_option('txtParcelamentoJurosWPSHOP');   
if($txtParcelamentoJuros==""){
   $txtParcelamentoJuros = "x sem juros* no cartão"; 
}


$txtEscolhaCorProduto= get_option('txtEscolhaCorProdutoWPSHOP');   
if($txtEscolhaCorProduto==""){
   $txtEscolhaCorProduto = "Cor do Produto :"; 
}
 
 
 
 $txtEscolhaTamanhoProduto= get_option('txtEscolhaTamanhoProdutoWPSHOP');   
 if( $txtEscolhaTamanhoProduto==""){
    $txtEscolhaTamanhoProduto= "Tamanho do Produto :"; 
 }
 
    
 $txtComprarBtProduto= get_option('txtComprarBtProdutoWPSHOP');   
 if( $txtComprarBtProduto==""){
    $txtComprarBtProduto= "Comprar"; 
 }          

 $txtAdicionarBtProduto= get_option('txtAdicionarBtProdutoWPSHOP');   
 if( $txtAdicionarBtProduto==""){
    $txtAdicionarBtProduto= "Adicionar ao Carrinho"; 
 }
 
 
 $txtprodutoIndisponivel= get_option('txtprodutoIndisponivelWPSHOP');   
  if( $txtprodutoIndisponivel==""){
     $txtprodutoIndisponivel= "Produto Indisponível."; 
  }     
  
  $txtprodutoAvisarChegar= get_option('txtprodutoAvisarChegarWPSHOP');   
   if( $txtprodutoAvisarChegar==""){
      $txtprodutoAvisarChegar= "Avisar quando chegar?"; 
   }     

    $txtprodutoEnviarFormContato= get_option('txtprodutoEnviarFormContatoWPSHOP');   
    if( $txtprodutoEnviarFormContato==""){
       $txtprodutoEnviarFormContato= "Enviar."; 
    } 
    
    $txtprodutoNomeFormContato= get_option('txtprodutoNomeFormContatoWPSHOP');   
    if( $txtprodutoNomeFormContato==""){
       $txtprodutoNomeFormContato= "Digite seu Nome"; 
    }
    
    
    $txtprodutoEMailFormContato= get_option('txtprodutoEmailFormContatoWPSHOP');   
    if( $txtprodutoEmailFormContato==""){
       $txtprodutoEmailFormContato= "Email para contato "; 
    }    
       
     $txtSelecioneParcela= get_option('txtSelecioneParcelaWPSHOP');   
    if( $txtSelecioneParcela==""){
       $txtSelecioneParcela= "Selecione a quantidade de Produtos "; 
    }
 
 
?>
       
   <input type="hidden" name='tabelaMedidas' id="tabelaMedida" value="<?php echo $urlImgM; ?>" />
	
 
	
	
	
	<div ><?php


     global $wpdb; 

     $tabela = $wpdb->prefix."";
     $tabela .=  "wpstore_stock";
 
     $sql = "SELECT * FROM `$tabela` WHERE   `idPost` = '$postID' AND  `tipoVariacao` = 'cor'  ORDER BY `showOrder` ASC   LIMIT 0 , 100";

     $fivesdraftsCor = $wpdb->get_results( $sql );
 
     $arrayColor = array();
     $arrayColorQtd = array();
     $arraySizes = array();
 
  if( intval($fivesdraftsCor) >0){     ?><span></span>
	   
	  
		<div  class="sexoSelect3">
		
		 <p> <?php echo $txtEscolhaCorProduto; ?> </p>
		 
		<ul class="cores" style="position:relative" >
		
		       <?php 
 
        
             foreach ( $fivesdraftsCor as $key0 =>$fivesdraftC )  {
                   
                   $color  = $fivesdraftC->variacaoProduto;
                   $corAlt  = $fivesdraftC->imgAlternativa;
                 
                   $qtdProduto =  intval($fivesdraftC->qtdProduto);
                   $qtdReservaUsuario = custom_get_stock_reservaUsuario($postID,$color);
                   $qtdProduto =  $qtdProduto - $qtdReservaUsuario;
                   
                   $arrayColor[] = $color;
                   $arrayColorQtd[] =$qtdProduto;
                   
                   
                   if($corAlt =="#F4F4F4" ){ $corAlt="";  }; 
              ?> 
              
              <li   class="selectVaricaoCor<?php if($key0==0){ ?> ativo  <?php }; ?>  " rel="<?php echo trim(str_replace(' ','',$color));  ; ?>"  rev="<?php if( $qtdProduto ==0 && $ilimitado ==false ){ ?>esgotado<?php }; ?>"
               <?php if($corAlt !=""){ ?>
               style="background:<?php echo $corAlt; ?>"
               <?php }; ?>
               > 
               
               <span><?php echo $color; ?> </span> <?php if( $qtdProduto ==0 && $ilimitado ==false ){ ?> <span class="esgotado"></span><?php }; ?></li>
		 
			<?php };  ?>
			
			
		</ul></div>
		
		<?php }; ?>
		
		<div class="clear"></div>
	
		<div class="carreg"></div>  <br/>

<?php  if( intval($fivesdraftsCor) >0){      
    
		         global $wpdb; 
                   $tabela = $wpdb->prefix."";
                   $tabela .=  "wpstore_stock";
                   $sql = "SELECT * FROM `$tabela` WHERE  	`idPost` = '$postID' AND  `tipoVariacao` = 'tamanho'  ORDER BY `showOrder` ASC ";

                   $fivesdraftsTamanho = $wpdb->get_results( $sql);

                   //$arraySizes = array();


            if(count($fivesdraftsTamanho)>0){  ?>
		    
	
           <?php $urlImg =  plugin_dir_url( __FILE__ )."images/camisaMedida.png"; ?>

    		<span></span>
          	<div  class="tamanhoSelect2"  style='position:relative' >
          	<p>  <?php echo $txtEscolhaTamanhoProduto; ?> </p>
                
 
              <?php   if($exibirTabela=="sim"){     ?>
                         	
                         	 <img class='camisaMedida' src="<?php echo $urlImg; ?>" />
           
               <?php  }; ?>
 

        

		         <?php foreach($arrayColor as $key =>$cor){ ?>
		    
		             
		     		<ul class="tamanhos <?php echo trim(str_replace(' ','',$cor)); ?>" <?php if($key>0){ ?> style="position:relative;display:none;"  <?php }; ?>  >
		     
		    	     <?php 
        		  
                         $qtdVendida =0;
                         
                       foreach ( $fivesdraftsTamanho as $fivesdraftT )  {
                           
                           $arraySizes[] = $fivesdraftT->variacaoProduto;  
                           $tamanho  = $fivesdraftT->variacaoProduto;
                           $tamAlt  = $fivesdraftT->variacaoProduto;
                           
                         
                           
                           $corTamanho = trim( str_replace(' ','',$tamanho) )."-".trim( str_replace(' ','',$cor) );
 
 
                             if( intval($arrayColorQtd[$key]) > 0 ){ //se cor está com quantidade habilitada
                                 
                                 
                             // $qtdProduto =  intval($fivesdraftT->qtdProduto);
                             
                             $qtdProduto = custom_get_qtd_stock( $postID,trim(str_replace(' ','',$cor)),trim(str_replace(' ','',$tamanho)) );
                              
                              
                              $qtdReservaUsuario = custom_get_stock_reservaUsuario($postID,$tamanho);
                              
                              $qtdVendida = custom_get_qtd_vendida( $postID , trim(str_replace(' ','',$cor)) , trim(str_replace(' ','',$tamanho)) );
                              
                              $qtdProdutoF =  ($qtdProduto - $qtdReservaUsuario) - $qtdVendida;
                          
                                //echo  $corTamanho."****"."$qtdProduto - $qtdReservaUsuario - $qtdVendida =  $qtdProdutoF";
                              
                               $qtdProduto =$qtdProdutoF;
                               
                              };
                              
                              
                           if($qtdProduto>0){
                               $sql = "SELECT `qtdProduto` FROM `$tabela` WHERE  	`idPost` = '$postID' AND  `tipoVariacao` = 'tamanhoCor' AND `variacaoProduto` = '$corTamanho'  ORDER BY `showOrder` ASC   LIMIT 0 , 100";
                                 $qtdProduto =   $wpdb->get_var( $wpdb->prepare(  $sql ,1,'') );
                                 $qtdProduto =  intval( $qtdProduto );
                                 $qtdReservaUsuario = custom_get_stock_reservaUsuario($postID,$corTamanho);
                                 $qtdProduto = $qtdProduto - $qtdReservaUsuario - $qtdVendida;
                                 //echo "<script>alert('$qtdProduto'); </script>";
                                 //echo $qtdProduto; 
                                 
                                 $sql = "SELECT `precoOperacao` FROM `$tabela` WHERE  	`idPost` = '$postID' AND  `tipoVariacao` = 'tamanhoCor' AND `variacaoProduto` = '$corTamanho'  ORDER BY `showOrder` ASC   LIMIT 0 , 100";
                                 $precoOperacao =   $wpdb->get_var( $wpdb->prepare(  $sql ,1,'') );
                                 
                                 $sql = "SELECT `precoAlternativo` FROM `$tabela` WHERE  	`idPost` = '$postID' AND  `tipoVariacao` = 'tamanhoCor' AND `variacaoProduto` = '$corTamanho'  ORDER BY `showOrder` ASC   LIMIT 0 , 100";
                                  $precoAlternativo =   $wpdb->get_var( $wpdb->prepare(  $sql ,1,'') );  
                                  
                                  
                           }
                           
                      ?>

                     <li class="selectVaricaoTamanho" style="position:relative" rel="<?php echo  $tamanho  ; ?>" rev="<?php if( $qtdProduto ==0 && $ilimitado ==false ){ ?>esgotado<?php }; ?>"   ><?php echo  $tamanho  ; ?>    <?php if($precoAlternativo>0){ ?> <span style="font-size:0.7em">(<?php echo $precoOperacao; ?> <?php echo $moedaCorrente; ?><?php echo $precoAlternativo; ?>)</span> <?php }; ?>  <?php if($qtdProduto==0  && $ilimitado ==false ){ ?><span class="esgotado"></span> <?php }; ?></li>

                     <?php }; ?>
                     
                     </ul>
                     
                    <?php }; ?>
                    
                    
                    </div>
                   
                   
      <?php }; ?>       
        		
        		    
		    
		<?php }else{ // se não existe cor -------------------------------------  ?>
  
<div  class="tamanhoSelect2">


        
        

  		<ul class="tamanhos">
  		
		<?php 
		
		       global $wpdb; 
               $tabela = $wpdb->prefix."";
               $tabela .=  "wpstore_stock";
               $sql = "SELECT * FROM `$tabela` WHERE  	`idPost` = '$postID' AND  `tipoVariacao` = 'tamanho'  ORDER BY `showOrder` ASC   LIMIT 0 , 100";

               $fivesdraftsTamanho = $wpdb->get_results( $sql);
               
               $arraySizes = array();$cont = 0; ?>
                    
               
               
               <?php $urlImg =  plugin_dir_url( __FILE__ )."images/camisaMedida.png"; ?>         



                <?php
                
                    if(count($fivesdraftsTamanho )>0){ ?>    
                      
                   <p> <?php echo $txtEscolhaTamanhoProduto; ?></p>
                      
               <?php   if($exibirTabela=="sim"){     ?>
                               <img class='camisaMedida' src="<?php echo $urlImg; ?>" />
                 <?php  }; ?>
                    
                   <?php };  ?>
                   
                   
               
               <?php
               foreach ( $fivesdraftsTamanho as $fivesdraftT )  {
                   
                     $arraySizes[] = $fivesdraftT->variacaoProduto;  
        
                              $tamanho  = $fivesdraftT->variacaoProduto;
                              $tamAlt  = $fivesdraftT->variacaoProduto;
                              $qtdProduto =  intval($fivesdraftT->qtdProduto);
                              $qtdReservaUsuario = custom_get_stock_reservaUsuario($postID,$tamanho);
                              $qtdProduto =  $qtdProduto - $qtdReservaUsuario;   
                              
                              $precoOperacao =    $fivesdraftT->precoOperacao; 
                              $precoAlternativo =    $fivesdraftT->precoAlternativo;  
              ?>              
              
             
 
             <li class="selectVaricaoTamanho" rel="<?php echo  $tamanho  ; ?>" rev="<?php if( $qtdProduto ==0 && $ilimitado ==false ){ ?>esgotado<?php }; ?>"    ><?php echo  $tamanho  ; ?>   <?php if($precoAlternativo>0){ ?> <span style="font-size:0.7em">(<?php echo $precoOperacao; ?> <?php echo $moedaCorrente; ?><?php echo $precoAlternativo; ?>)</span> <?php }; ?>  <?php if($qtdProduto==0  && $ilimitado ==false ){ ?><span class="esgotado"></span> <?php }; ?></li>
          
             <?php $cont+=1; }; ?>
             
             </ul>
 	   </div>
    	<?php }; ?>
  

		<div class="clear"></div>
		<br/>
		
		<p class="indisp" style="background:#ddd;padding:10px" >Produto Indisponível.  <br/>
	    <span style="font-size:0.8em">Avisar quando chegar?</span>
           <br/>
           Digite seu Nome:<input type="text" id="nomeAviso2" value="" title="" /> <br/>
   		   Email para contato:<input type="text" id="emailAviso2" value="" title="" />
   		<br/>
   			<a href="#"  class="btAviso" >Enviar.</a>
		</p>
		
 
                <?php 
                
                $variacaoEscolhida = '';
                
                
                       
                          

                            $preco=custom_get_price($postID); 
                            $precoS = custom_get_specialprice($postID);
                            
                   
                if( intval($fivesdraftsCor) || intval($fivesdraftsTamanho) ){  ?>
                   
                 
                   
                   
                   
                   
                   
 	              	<div class="clear"></div>
 	         


                      <p class="preco"  ><?php if($precoS >0) { echo "<span style='font-size:0.8em'>De: </span>"; }; ?><?php echo $moedaCorrente; ?> <span <?php if($precoS >0) { echo "style='text-decoration:line-through;font-size:1.3em'"; }; ?> ><?php echo $preco; ?></span></p>




                                         <?php
                                        	//PLUGIN SHOP FUNCTION --------------------------------------

                                                 if($precoS>0){ ?>

                                     			 <p class="preco"   ><span style='font-size:0.8em'>Por:</span> <span style='color:red;font-size:1em'><?php echo $moedaCorrente; ?></span> <span  style='color:red;font-size:1.7em;' ><?php echo $precoS; ?></span></p>


                                           <?php }; ?>
                                           
                                           
                       
                       
                       
                       
                                                                                                            <?php $exibeQtdProd = get_option('exibeQtdProd');
                                                                                                                  if($exibeQtdProd  =="sim"){ ?>
                                                                                                               <p class='quantidade'> <label for='qtdProd'> <?php echo $txtSelecioneParcela; ?>:</label>  <input type='text' class='somenteNumeros'  name='qtdProd' id='qtdProd' value='1' style='width:30px' /> </p>
                                                                                                               <?php  }; ?>




                                                 <?php        if($totalParcela !="" && $txtParcelamentoJuros !="#"){ ?>
                                                  <p class="parc"><strong> <?php echo $totalParcela; ?> <?php echo $txtParcelamentoJuros; ?> </strong></p>
                                                  <?php }; ?>



                             
                             
                           


                                        <div class="clear"></div>
  

                     
                     <a class="addCarrinho btComprar" href="<?php the_permalink(); ?>"><?php echo $txtAdicionarBtProduto; ?></a>
                     <a class="comprar btComprar" href="<?php the_permalink(); ?>"><?php echo $txtComprarBtProduto; ?></a>
							
							
							
							
							
							
							
                    
               <?php }else{ $variacaoEscolhida = 'unico'; ?>

   		    
                       <?php   if( intval( get_post_meta($postID,'initstock',true) ) >0 || $ilimitado==true ){  ?>
                 
        	             
        	             
        	             
        	             
        	             
        	                   	<div class="clear"></div>



                                     <p class="preco"  ><?php if($precoS >0) { echo "<span style='font-size:0.8em'>De: </span>"; }; ?><?php echo $moedaCorrente; ?> <span <?php if($precoS >0) { echo "style='text-decoration:line-through;font-size:1.3em'"; }; ?> ><?php echo $preco; ?></span></p>


                                                                <?php
                                                              	//PLUGIN SHOP FUNCTION --------------------------------------

                                                                       if($precoS>0){ ?>

                                                           			 <p class="preco"  ><span style='font-size:0.8em'>Por:</span> <span style='color:red;font-size:1em'><?php echo $moedaCorrente; ?></span> <span  style='color:red;font-size:1.7em;' ><?php echo $precoS; ?></span></p>


                                                                 <?php }; ?>
                                                                 
                                                                 
                                                                 
                                                                 
                                                                 
                                                                                                   <?php $exibeQtdProd = get_option('exibeQtdProd');
                                                                                                         if($exibeQtdProd  =="sim"){ ?>
                                                                                                      <p class='quantidade'> <label for='qtdProd'> <?php echo $txtSelecioneParcela; ?>:</label>  <input type='text' class='somenteNumeros'  name='qtdProd' id='qtdProd' value='1' style='width:30px' /> </p>
                                                                                                      <?php  }; ?>
                                                                 
                                                                 
                                                                 

                                        <?php        if($totalParcela !="" && $txtParcelamentoJuros !="#"){ ?>
                                         <p class="parc"><strong> <?php echo $totalParcela; ?> <?php echo $txtParcelamentoJuros; ?> </strong></p>
                                         <?php }; ?>

                





                                                       <div class="clear"></div>

                                       <div id='boxComprar'></div>

                                    <a class="addCarrinho btComprar" href="<?php the_permalink(); ?>"><?php echo   $txtAdicionarBtProduto    ; ?> </a>   
                                    
                                    <a class="comprar btComprar" href="<?php the_permalink(); ?>"><?php echo  $txtComprarBtProduto    ; ?></a>


                             
  							
 
        	           <?php }else{ ?>
        	               <p class="indisp" style="display:block;background:#ddd;padding:10px" ><?php echo  $txtprodutoIndisponivel;      ?>  <br/>
        	               <span style="font-size:0.8em"> <?php echo  $txtprodutoAvisarChegar;      ?> </span>
        	               <br/>
        	               <?php echo $txtprodutoNomeFormContato ?>:<input type="text" id="nomeAviso" value="" title="" /> <br/>
                   		   <?php echo $txtprodutoEmailFormContato ?>:<input type="text" id="emailAviso" value="" title="" />
                   		<br/>
                   		 <a href="#" class="btAviso" >  <?php echo  $txtprodutoEnviarFormContato;      ?></a>
                   		</p>
        	           <?php }; ?><?php  }; ?><p class="msg"></p>
 
       		<input type="hidden" name="idP" id="idP" value="<?php echo $postID; ?>" />

		
		<br/>
   </div><!-- .variacoes -->