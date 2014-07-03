<?php

$idPaginaCarrinho = 0;
$idPaginaCheckout = 0;

  if( $_POST['submit']=="Salvar" ){
  
          $txtParcelamentoJuros= trim($_POST['txtParcelamentoJuros']); 
          add_option('txtParcelamentoJurosWPSHOP',$txtParcelamentoJuros,'','yes'); 
          update_option('txtParcelamentoJurosWPSHOP',$txtParcelamentoJuros); 
          
          
            $txtEscolhaCorProduto= trim($_POST['txtEscolhaCorProduto']); 
            add_option('txtEscolhaCorProdutoWPSHOP',$txtEscolhaCorProduto,'','yes'); 
            update_option('txtEscolhaCorProdutoWPSHOP',$txtEscolhaCorProduto);  
            
            
            $txtEscolhaTamanhoProduto= trim($_POST['txtEscolhaTamanhoProduto']); 
            add_option('txtEscolhaTamanhoProdutoWPSHOP',$txtEscolhaTamanhoProduto,'','yes'); 
            update_option('txtEscolhaTamanhoProdutoWPSHOP',$txtEscolhaTamanhoProduto);  
            
            $txtComprarBtProduto= trim($_POST['txtComprarBtProduto']); 
            add_option('txtComprarBtProdutoWPSHOP',$txtComprarBtProduto,'','yes'); 
            update_option('txtComprarBtProdutoWPSHOP',$txtComprarBtProduto);
            
           
               $txtAdicionarBtProduto= trim($_POST['txtAdicionarBtProduto']); 
                add_option('txtAdicionarBtProdutoWPSHOP',$txtAdicionarBtProduto,'','yes'); 
                update_option('txtAdicionarBtProdutoWPSHOP',$txtAdicionarBtProduto);
                 
    
                $txtprodutoIndisponivel = trim($_POST['txtprodutoIndisponivel']); 
                add_option('txtprodutoIndisponivelWPSHOP',$txtprodutoIndisponivel ,'','yes'); 
                update_option('txtprodutoIndisponivelWPSHOP',$txtprodutoIndisponivel );   
                
                
                         $txtprodutoAvisarChegar= trim($_POST['txtprodutoAvisarChegar']); 
                            add_option('txtprodutoAvisarChegarWPSHOP',$txtprodutoAvisarChegar ,'','yes'); 
                            update_option('txtprodutoAvisarChegarWPSHOP',$txtprodutoAvisarChegar );
                            
   $txtprodutoEnviarFormContato = trim($_POST['txtprodutoEnviarFormContato']); 
     add_option('txtprodutoEnviarFormContatoWPSHOP',$txtprodutoEnviarFormContato ,'','yes'); 
     update_option('txtprodutoEnviarFormContatoWPSHOP',$txtprodutoEnviarFormContato );   
                            
 
     $txtprodutoNomeFormContato = trim($_POST['txtprodutoNomeFormContato']); 
       add_option('txtprodutoNomeFormContatoWPSHOP',$txtprodutoNomeFormContato ,'','yes'); 
       update_option('txtprodutoNomeFormContatoWPSHOP',$txtprodutoNomeFormContato );
       
       $txtprodutoEmailFormContato = trim($_POST['txtprodutoEmailFormContato']); 
         add_option('txtprodutoEmailFormContatoWPSHOP',$txtprodutoEmailFormContato ,'','yes'); 
         update_option('txtprodutoEmailFormContatoWPSHOP',$txtprodutoEmailFormContato );
         
         
         $txtSelecioneParcela = trim($_POST['txtSelecioneParcela']); 
           add_option('txtSelecioneParcelaWPSHOP',$txtSelecioneParcela ,'','yes'); 
           update_option('txtSelecioneParcelaWPSHOP',$txtSelecioneParcela);    
           
           
               $txtProdutosRelacionados = trim($_POST['txtProdutosRelacionados']); 
                  add_option('txtProdutosRelacionadosWPSHOP',$txtProdutosRelacionados ,'','yes'); 
                  update_option('txtProdutosRelacionadosWPSHOP',$txtProdutosRelacionados);
                  
                       $txtEntrega = trim($_POST['txtEntrega']); 
                            add_option('txtEntregaWPSHOP',$txtEntrega ,'','yes'); 
                            update_option('txtEntregaWPSHOP',$txtEntrega);  
                             
  };

$txtParcelamentoJuros = get_option('txtParcelamentoJurosWPSHOP'); 
$txtEscolhaCorProduto = get_option('txtEscolhaCorProdutoWPSHOP');  
$txtEscolhaTamanhoProduto = get_option('txtEscolhaTamanhoProdutoWPSHOP');   

 $txtComprarBtProduto= get_option('txtComprarBtProdutoWPSHOP');   
 $txtAdicionarBtProduto= get_option('txtAdicionarBtProdutoWPSHOP'); 
   
 $txtprodutoIndisponivel= get_option('txtprodutoIndisponivelWPSHOP');   
 $txtprodutoAvisarChegar= get_option('txtprodutoAvisarChegarWPSHOP');   
 
 $txtprodutoEnviarFormContato= get_option('txtprodutoEnviarFormContatoWPSHOP');   
 $txtprodutoNomeFormContato= get_option('txtprodutoNomeFormContatoWPSHOP');   
 $txtprodutoEMailFormContato= get_option('txtprodutoEmailFormContatoWPSHOP');  
  
 $txtSelecioneParcela= get_option('txtSelecioneParcelaWPSHOP');   
 
 $txtProdutosRelacionados   = get_option('txtProdutosRelacionadosWPSHOP');   

 $txtEntrega   = get_option('txtEntregaWPSHOP');
?>
 
 
 
	<form action="<?php echo verifyURL(get_option( 'siteurl' )) ."/wp-admin/admin.php?page=lista_translate";?>"  method="post" >

       
  
  
  
  
  
  
  

    <div id="cabecalho">
    	<ul class="abas">
    		<li>
    			<div class="aba gradient">
    				<span>Tradução</span>
    			</div>
    		</li>  

    		 <?php /* 
    		<li>
    			<div class="aba gradient">
    				<span>Homepage</span>
    			</div>
    		</li>
    		<li>
    			<div class="aba gradient">
    				<span>Slide Home</span>
    			</div>
    		</li>
    		<li>
    			<div class="aba gradient">
    				<span>Sidebar</span>
    			</div>
    		</li>                   

    					*/ ?>      

    		<div class="clear"></div>
    	</ul>
    </div><!-- #cabecalho -->       





    <div id="containerAbas">  



    	<div class="conteudo">
    	
    	
    	
    	    
    	    
    	    
    	    
    	    <div class="bloco">  
    	    
    	    
    	        

        		<h3>1) PAGINA PRODUTOS  </h3>

        		<span class="seta" rel='paginaprodutos'></span>
        		<div class="texto" id='paginaprodutos'>

        		  
        		  
        		    <h4> x sem juros*   no  cartão</h4>

                      <label for="valorFreteValor6"> </label>
                         default : <strong> x sem juros*   no  cartão</strong>
                        <br/>
                        Substituir por : <input type="text" id="txtParcelamentoJuros" name="txtParcelamentoJuros" value="<?php echo $txtParcelamentoJuros; ?>"  style="width:40%"  />
                      <br/>
                      <span style="font-size:10px">x sem juros*   no  cartão</span>

                     <br/> <br/>  




                      <h4>Cor do Produto :</h4>

                       <label for="valorFreteValor6"> </label>
                          default :  <strong> Cor do Produto :</strong>
                         <br/>
                         Substituir por :  <input type="text" id="txtEscolhaCorProduto" name="txtEscolhaCorProduto" value="<?php echo $txtEscolhaCorProduto; ?>"  style="width:40%"  />
                       <br/>

                      <br/> <br/>





                       <h4>Tamanho do Produto : </h4>

                        <label for="valorFreteValor6"> </label>
                           default :  <strong>Tamanho do Produto :</strong>
                          <br/>
                          Substituir por :  <input type="text" id="txtEscolhaTamanhoProduto" name="txtEscolhaTamanhoProduto" value="<?php echo $txtEscolhaTamanhoProduto; ?>"  style="width:40%"  />
                        <br/>

                       <br/> <br/>






                       <h4>Comprar </h4>

                        <label for="valorFreteValor6"> </label>
                           default :  <strong>Comprar</strong>
                          <br/>
                          Substituir por :  <input type="text" id="txtComprarBtProduto" name="txtComprarBtProduto" value="<?php echo $txtComprarBtProduto; ?>"  style="width:40%"  />
                        <br/>

                       <br/> <br/>






                          <h4>Adicionar ao Carrinho</h4>

                        <label for="valorFreteValor6"> </label>
                           default :  <strong>Adicionar ao Carrinho</strong>
                          <br/>
                          Substituir por :  <input type="text" id="txtAdicionarBtProduto" name="txtAdicionarBtProduto" value="<?php echo $txtAdicionarBtProduto; ?>"  style="width:40%"  />
                        <br/>

                       <br/> <br/>




                          <h4>Produto Indisponível. </h4>

                        <label for="valorFreteValor6"> </label>
                           default :  <strong>Produto Indisponível.</strong>
                          <br/>
                          Substituir por :  <input type="text" id="txtprodutoIndisponivel" name="txtprodutoIndisponivel" value="<?php echo $txtprodutoIndisponivel ; ?>"  style="width:40%"  />
                        <br/>

                       <br/> <br/>  
                       
                       
                       

                          <h4>Avisar quando chegar?</h4>

                        <label for="valorFreteValor6"> </label>
                           default :  <strong>Avisar quando chegar?</strong>
                          <br/>
                          Substituir por :  <input type="text" id="txtprodutoAvisarChegar" name="txtprodutoAvisarChegar" value="<?php echo $txtprodutoAvisarChegar; ?>"  style="width:40%"  />
                        <br/>

                       <br/> <br/> 






                          <h4>Enviar</h4>

                        <label for="valorFreteValor6"> </label>
                           default :  <strong>Enviar</strong>
                          <br/>
                          Substituir por :  <input type="text" id="txtprodutoEnviarFormContato" name="txtprodutoEnviarFormContato" value="<?php echo $txtprodutoEnviarFormContato ; ?>"  style="width:40%"  />
                        <br/>

                       <br/> <br/>

                                 



                         <h4>Digite seu Nome</h4>

                        <label for="valorFreteValor6"> </label>
                           default :  <strong>Digite seu Nome</strong>
                          <br/>
                          Substituir por :  <input type="text" id="txtprodutoNomeFormContato" name="txtprodutoNomeFormContato" value="<?php echo $txtprodutoNomeFormContato ; ?>"  style="width:40%"  />
                        <br/>

                       <br/> <br/>

                              


                         <h4>Email para contato</h4>

                        <label for="valorFreteValor6"> </label>
                           default :  <strong>Email para contato</strong>
                          <br/>
                          Substituir por :  <input type="text" id="txtprodutoEmailFormContato" name="txtprodutoEmailFormContato" value="<?php echo $txtprodutoEmailFormContato ; ?>"  style="width:40%"  />
                        <br/>

                       <br/> <br/>



                          <h4>Selecione a quantidade de Produtos</h4>

                         <label for="valorFreteValor6"> </label>
                            default :  <strong>Selecione a quantidade de Produtos</strong>
                           <br/>
                           Substituir por :  <input type="text" id="txtSelecioneParcela" name="txtSelecioneParcela" value="<?php echo $txtSelecioneParcela ; ?>"  style="width:40%"  />
                         <br/>

                        <br/> <br/>     


                            <h4>Produtos Relacionados</h4>

                         <label for="valorFreteValor6"> </label>
                            default :  <strong>Produtos Relacionados</strong>
                           <br/>
                           Substituir por :  <input type="text" id="txtProdutosRelacionados" name="txtProdutosRelacionados" value="<?php echo $txtProdutosRelacionados  ; ?>"  style="width:40%"  />
                         <br/>

                        <br/> <br/>
                        
                        
                               <h4>Detalhe Entrega</h4>

                             <label for="valorFreteValor6"> </label>
                                default :  <strong>Entre 1 a 9 dias úteis após a confirmação de pagamento . Para promoção de FRETE GRÁTIS e produtos com mais de 30kg a entrega é feita por transportadora. Neste último caso é aplicada a tarifa SEDEX. </strong>
                               <br/>
                               Substituir por :  <input type="text" id="txtEntrega" name="txtEntrega" value="<?php echo $txtEntrega  ; ?>"  style="width:40%"  />
                             <br/>

                            <br/> <br/>
                               
                                 


            
        		</div>
        	</div><!-- .bloco -->
         	
         	
         	
         	
   
                        <input type="submit"  name="submit" value="Salvar"   />
 


 
 


          	<?php /*
          	<div class="conteudo">
          		Conteúdo da aba 2
          	</div>


          	<div class="conteudo">
          		Conteúdo da aba 3
          	</div>    


          	<div class="conteudo">
          		Conteúdo da aba 4
          	</div>     
          	*/ ?>




          </div><!-- .content -->






          </form>





          <script>

          jQuery('.seta').click(function(){
              rel = jQuery(this).attr('rel');
              jQuery('.texto').hide();
              jQuery('#'+rel).show();
          });    

          </script>