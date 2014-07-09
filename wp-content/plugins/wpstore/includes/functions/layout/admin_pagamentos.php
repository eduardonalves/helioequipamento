<?php
          



 $plugin_directory = str_replace('functions/','functions/',plugin_dir_url( __FILE__ ));



$idPaginaCarrinho = 0;
$idPaginaCheckout = 0;

           if( $_POST['submit']=="Salvar" ){
               
               
               $emailPagseguro = trim($_POST['emailPagseguro']);
               $tokenPagseguro = trim($_POST['tokenPagseguro']);
               $emailRedecard = trim($_POST['emailRedecard']);
               $filicaoRedecard = trim($_POST['filicaoRedecard']);
               $filicaoRedecardGateway = trim($_POST['filicaoRedecardGateway']);
           
  
               add_option( 'emailPagseguro', $emailPagseguro, '', 'yes' ); 
               update_option( 'emailPagseguro',$emailPagseguro );
               add_option( 'tokenPagseguro', $tokenPagseguro, '', 'yes' ); 
               update_option( 'tokenPagseguro', $tokenPagseguro );
               add_option( 'emailRedecard', $emailRedecard , '', 'yes' ); 
               update_option( 'emailRedecard',  $emailRedecard );
               add_option( 'filicaoRedecard', $filicaoRedecard, '', 'yes' ); 
               update_option('filicaoRedecard', $filicaoRedecard);
               
               add_option( 'filicaoRedecardGateway', $filicaoRedecardGateway, '', 'yes' ); 
               update_option('filicaoRedecardGateway', $filicaoRedecardGateway);
             
             
             
             
                      $depositoNomeCnpj = trim($_POST['depositoNomeCnpj']); 
                      
                      $depositoBanco1 = trim($_POST['depositoBanco1']); 
                      $depositoAgencia1 = trim($_POST['depositoAgencia1']);
                      $depositoConta1 = trim($_POST['depositoConta1']); 
                      
                      $depositoBanco2 = trim($_POST['depositoBanco2']); 
                      $depositoAgencia2 = trim($_POST['depositoAgencia2']); 
                      $depositoConta2 = trim($_POST['depositoConta2']); 
                      
                      $depositoMaisInfos = trim($_POST['depositoMaisInfos']);
                      
                      $enderecoRetirada = trim($_POST['enderecoRetirada']);
                      
                      $chaveCielo = trim($_POST['chaveCielo']);
                      $filiacaoCielo = trim($_POST['filiacaoCielo']);
                      
                      
                      $tipoParcelamentoCielo = trim($_POST['tipoParcelamentoCielo']);
                      $capturarAutomaticamenteCielo  = trim($_POST['capturarAutomaticamenteCielo']);
                      $indicadorAutorizacaoCielo = trim($_POST['indicadorAutorizacaoCielo']);
                      
                      
                      
                 
                             
                             
                  add_option('depositoNomeCnpj',$depositoNomeCnpj,'','yes'); 
                  update_option('depositoNomeCnpj',$depositoNomeCnpj);
                  
                  add_option('depositoBanco1',$depositoBanco1,'','yes'); 
                  update_option('depositoBanco1',$depositoBanco1);
                  
                  add_option('depositoConta1',$depositoConta1,'','yes'); 
                  update_option('depositoConta1',$depositoConta1);
         
                  add_option('depositoAgencia1',$depositoAgencia1,'','yes'); 
                  update_option('depositoAgencia1',$depositoAgencia1);
                 
                 
                  add_option('depositoBanco2',$depositoBanco2,'','yes'); 
                  update_option('depositoBanco2',$depositoBanco2);

                  add_option('depositoConta2',$depositoConta2,'','yes'); 
                  update_option('depositoConta2',$depositoConta2);

                  add_option('depositoAgencia2',$depositoAgencia2,'','yes'); 
                  update_option('depositoAgencia2',$depositoAgencia2);     
                      
                  add_option('depositoMaisInfos',$depositoMaisInfos,'','yes'); 
                  update_option('depositoMaisInfos',$depositoMaisInfos);  
                  
                  add_option('enderecoRetirada',$enderecoRetirada,'','yes'); 
                  update_option('enderecoRetirada',$enderecoRetirada);
                  
                  add_option('filiacaoCielo',$filiacaoCielo,'','yes'); 
                  update_option('filiacaoCielo',$filiacaoCielo); 
                  
                   add_option('chaveCielo',$chaveCielo,'','yes'); 
                    update_option('chaveCielo',$chaveCielo);
                  
                  add_option('tipoParcelamentoCielo',$tipoParcelamentoCielo,'','yes'); 
                    update_option('tipoParcelamentoCielo',$tipoParcelamentoCielo);
                    
                    add_option('capturarAutomaticamenteCielo',$capturarAutomaticamenteCielo,'','yes'); 
                      update_option('capturarAutomaticamenteCielo',$capturarAutomaticamenteCielo);
                      
                      add_option('indicadorAutorizacaoCielo',$indicadorAutorizacaoCielo,'','yes'); 
                        update_option('indicadorAutorizacaoCielo',$indicadorAutorizacaoCielo);
          
   
   
                           $ativaPagseguro = trim($_POST['ativaPagseguro']);
                            $ativaCielo = trim($_POST['ativaCielo']);
                            $ativaDeposito = trim($_POST['ativaDeposito']);
                            $ativaRetirada = trim($_POST['ativaRetirada']);
                            
                            $ativaPaypal = trim($_POST['ativaPaypal']); 
                            $ativaGoogleCk = trim($_POST['ativaGoogleCk']);
                            $emailPaypal = trim($_POST['emailPaypal']);
                            $currentCodePaypal  = trim($_POST['currentCodePaypal']); 
                            
                             $ativaMoip = trim($_POST['ativaMoip']);
                             $emailMoip = trim($_POST['emailMoip']);  
                             
                             $meuPinMoip  = trim($_POST['meuPinMoip']);  

                             add_option('ativaPagseguro',$ativaPagseguro,'','yes'); 
                             update_option('ativaPagseguro',$ativaPagseguro);

                             add_option('ativaCielo',$ativaCielo,'','yes'); 
                             update_option('ativaCielo',$ativaCielo);

                             add_option('ativaDeposito',$ativaDeposito,'','yes'); 
                             update_option('ativaDeposito',$ativaDeposito);

                             add_option('ativaRetirada',$ativaRetirada,'','yes'); 
                             update_option('ativaRetirada',$ativaRetirada);  
                             
                                add_option('ativaMoip',$ativaMoip,'','yes'); 
                                  update_option('ativaMoip',$ativaMoip);
                                  
                                     add_option('ativaPaypal',$ativaPaypal,'','yes'); 
                                       update_option('ativaPaypal',$ativaPaypal); 
                                       
                                        add_option('emailPaypal',$emailPaypal,'','yes'); 
                                          update_option('emailPaypal',$emailPaypal);
                                          
                                           add_option('currentCodePaypal',$currentCodePaypal,'','yes'); 
                                             update_option('currentCodePaypal',$currentCodePaypal);  
                                             
                                             
                                             add_option('emailMoip',$emailMoip,'','yes'); 
                                             update_option('emailMoip',$emailMoip); 
                                               
                                               
                                             add_option('meuPinMoip',$meuPinMoip,'','yes'); 
                                             update_option('meuPinMoip',$meuPinMoip);
                             
                             
           };
 

$emailPagseguro = get_option('emailPagseguro');
$tokenPagseguro =  get_option('tokenPagseguro');
$emailRedecard =  get_option('emailRedecard');
$filicaoRedecard =  get_option('filicaoRedecard');
$filicaoRedecardGateway =  get_option('filicaoRedecardGateway');

$filiacaoCielo=  get_option('filiacaoCielo'); 
$chaveCielo=  get_option('chaveCielo');
$tipoParcelamentoCielo =  get_option('tipoParcelamentoCielo');
$capturarAutomaticamenteCielo =  get_option('capturarAutomaticamenteCielo');
$indicadorAutorizacaoCielo =  get_option('indicadorAutorizacaoCielo');

  
            $depositoNomeCnpj =get_option('depositoNomeCnpj'); 
            
            $depositoBanco1 = get_option('depositoBanco1'); 
            $depositoAgencia1 =get_option('depositoAgencia1');
            $depositoConta1 = get_option('depositoConta1');
            
            $depositoBanco2 = get_option('depositoBanco2');
            $depositoAgencia2 = get_option('depositoAgencia2'); 
            $depositoConta2 = get_option('depositoConta2');
            
            $depositoMaisInfos = get_option('depositoMaisInfos');
            
            
            $enderecoRetirada = get_option('enderecoRetirada');
            
     
            $ativaPagseguro = get_option('ativaPagseguro');
            $ativaCielo = get_option('ativaCielo');
            $ativaDeposito = get_option('ativaDeposito ');
            $ativaRetirada= get_option('ativaRetirada');      
           
           $ativaMoip= get_option('ativaMoip');
           $ativaPaypal= get_option('ativaPaypal'); 
           
        

$emailPaypal = get_option('emailPaypal');        
$currentCodePaypal  = get_option('currentCodePaypal');       

$emailMoip = get_option('emailMoip');        
$currentCodePaypal  = get_option('currentCodePaypal');
 
$meuPinMoip = get_option('meuPinMoip');    

?>

 
    
	<form action="<?php echo verifyURL(get_option( 'siteurl' )) ."/wp-admin/admin.php?page=lista_pagamentos";?>"  method="post" >


    
 
 
 
 
 
 

    <div id="cabecalho">
    	<ul class="abas">
    		<li>
    			<div class="aba gradient">
    				<span>Configurações de Pagamento</span>
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

		<h3> 
		
        <input type="checkbox" name="ativaPagseguro" value="ativaPagseguro"  <?php  if($ativaPagseguro=='ativaPagseguro'){ echo "CHECKED"; }; ?> />  
        1 ) <img src='<?php echo $plugin_directory."images/pagseguro.png "; ?>' />  Pagseguro
        
        </h3>

	              <span class="seta" rel='Pagseguro'></span>
				   	 <div class="texto" id='Pagseguro'>
		   
		   
		   
		   
                         <p>Preencha seus dados do Pagseguro :</p>

                         <p>
                         <label for="emailPagseguro">Pagseguro Email</label>
                         <input type="text" id="emailPagseguro" name="emailPagseguro" value="<?php echo $emailPagseguro; ?>" />
                         </p>

                         <p>
                         <label for="emailPagseguro">Pagseguro TOKEN </label>
                         <input type="text" id="tokenPagseguro" name="tokenPagseguro" value="<?php echo $tokenPagseguro; ?>" />
                         </p>

                         <p>Lembre-se de ATIVAR a opção <strong>Integrações- >Notificações</strong> em sua conta no pagseguro e definir a url de retorno de seu site para :<?php echo get_bloginfo('url'); ?></p>


                 <input type="submit"  name="submit" value="Salvar"   />   

                   
		   </div><!-- .texto -->
			</div><!-- .bloco -->
			
			
			

 
 
 
 
 <div class="bloco"> 

 		<h3> <input type="checkbox" name="ativaCielo" value="ativaCielo"  <?php  if($ativaCielo=='ativaCielo'){ echo "CHECKED"; }; ?> /> 

        2 ) <img src='<?php echo $plugin_directory."images/cielo.png "; ?>' /> Cielo </h3>

 	              <span class="seta" rel='Cielo'></span>
 				   	 <div class="texto" id='Cielo'>
 		   
 		   
 		   
 		   
 		                 <p>Preencha seus dados de integração com a Cielo :</p>

                         <p>
                         <labe for="emailRedecard">Numero Filiação</label>
                         <input type="text" id="filiacaoCielo" name="filiacaoCielo" value="<?php echo $filiacaoCielo; ?>" />
                         </p>

                         <p>
                         <labe for="filicaoRedecard">Chave</label>
                         <input type="text" id="chaveCielo" name="chaveCielo" value="<?php echo $chaveCielo; ?>" />
                         </p>




                         <table>
                         						<tbody><tr>
                         							<td>
                         								Parcelamento
                         							</td>
                         							<td><?php //echo $tipoParcelamentoCielo; ?>
                         								<select name="tipoParcelamentoCielo">
                         									<option value="2" <? if($tipoParcelamentoCielo=='2'){ echo 'selected="selected" '; }; ?> >Loja</option>
                         									<option value="3"  <? if($tipoParcelamentoCielo=='3'){ echo 'selected="selected" '; }; ?> >Administradora</option>
                         								</select>
                         							</td>
                         						</tr>
                         						<tr>
                         							<td>Capturar Automaticamente?</td>
                         							<td><?php //echo $capturarAutomaticamenteCielo; ?>
                         								<select name="capturarAutomaticamenteCielo">
                         									<option value="true"  <? if($capturarAutomaticamenteCielo=='true'){ echo 'selected="selected" '; }; ?> >Sim</option>
                         									<option value="false"  <? if($capturarAutomaticamenteCielo=='false'){ echo 'selected="selected" '; }; ?> >Não</option>
                         								</select>
                         							</td>
                         						</tr>
                         						<tr>
                         							<td>Autorização Automática</td>
                         							<td><?php //echo $indicadorAutorizacaoCielo; ?>
                         								<select name="indicadorAutorizacaoCielo">
                         									<option value="3" <? if($indicadorAutorizacaoCielo=='3'){ echo 'selected="selected" '; }; ?> >Autorizar Direto</option>
                         									<option value="2" <? if($indicadorAutorizacaoCielo=='2'){ echo 'selected="selected" '; }; ?> >Autorizar transação autenticada e não-autenticada</option>
                         									<option value="0" <? if($indicadorAutorizacaoCielo=='0'){ echo 'selected="selected" '; }; ?> >Somente autenticar a transação</option>
                         									<option value="1" <? if($indicadorAutorizacaoCielo=='1'){ echo 'selected="selected" '; }; ?> >Autorizar transação somente se autenticada</option>
                         								</select>
                         							</td>
                         						</tr>
                         					</tbody></table>
                         					
                         					
                         					

                   <input type="submit"  name="submit" value="Salvar"   />   


 		   </div><!-- .texto -->
 			</div><!-- .bloco -->
 			
 			
 			
 
 
 
 
 
 
 <div class="bloco"> 

 		<h3> 
 		
 		
        <input type="checkbox" name="ativaMoip" value="ativaMoip"  <?php  if($ativaMoip =='ativaMoip'){ echo "CHECKED"; }; ?> /> 

        3 ) <img src='<?php echo $plugin_directory."images/moip.png "; ?>' /> Moip
        
        </h3>

 	              <span class="seta" rel='Moip'></span>
 				   	 <div class="texto" id='Moip'>



                         <p>Preencha seus dados de integração com o MOIP :</p>

                         <p>
                         <labe for="emailPaypal">Email Cadastro Moip</label>
                         <input type="text" id="emailMoip" name="emailMoip" value="<?php echo $emailMoip; ?>" />
                         </p>  


                         <p>
                         <labe for="emailPaypal">Crie uma chave de identificação para a URL de confirmação do Moip</label>
                         <input type="text" id="meuPinMoip" name="meuPinMoip" value="<?php echo $meuPinMoip; ?>" />
                         <br/><span> Você usará esta chave para certificar que suas mensagens de autenticação são do MOIP.</span>
                         <br/>  <?php if($meuPinMoip==""){$meuPinMoip = "suachave"; }; ?>
                         <span>Sua url de autenticação  no Moip : http://wpstore.com.br/loja1/?confirmaMoip=<strong><?php echo $meuPinMoip; ?></strong></span>
                         </p>


                  <input type="submit"  name="submit" value="Salvar"   />   

 		   </div><!-- .texto -->
 			</div><!-- .bloco -->
 
 
 
 





<div class="bloco"> 

		<h3> 4 ) 
		
		
        <input type="checkbox" name="ativaPaypal" value="ativaPaypal"  <?php  if($ativaPaypal =='ativaPaypal'){ echo "CHECKED"; }; ?> />
        
        <img src='<?php echo $plugin_directory."images/paypal.png "; ?>' /> Paypal </h3>

	              <span class="seta" rel='Paypal'></span>
				   	 <div class="texto" id='Paypal'>
		   	  
		   	  
		   	  
		   	  
		   	             <p>Preencha seus dados de integração com o paypal :</p>

                         <p>
                         <labe for="emailPaypal">Email Cadastro Paypal</label>
                         <input type="text" id="emailPaypal" name="emailPaypal" value="<?php echo $emailPaypal; ?>" />
                         </p>

                         <p> 

                         <labe for="chavePaypal">Current CODE</label>    

                         <select  id="currentCodePaypal" name="currentCodePaypal"> 
                         <option value="USD" <?php if($currentCodePaypal=="USD"){ echo "SELECTED"; }; ?> >USD - American Dollars</option>
                         <option value="BRL" <?php if($currentCodePaypal=="BRL"){ echo "SELECTED"; };  ?> >BRL - Real Brasileiro</option> 
                         </select>  

                         </p>


                    <input type="submit"  name="submit" value="Salvar"   />   
                   
		   </div><!-- .texto -->
			</div><!-- .bloco -->
			
			
 
 
 



 






         
   
       <div class="bloco"> 
          
				<h3> 5 ) 
				
				 <input type="checkbox" name="ativaDeposito" value="ativaDeposito"  <?php  if($ativaDeposito=='ativaDeposito'){ echo "CHECKED"; }; ?> /> 

                 <img src='<?php echo $plugin_directory."images/deposito.png "; ?>' /> Depósito bancário
                
                </h3>

			              <span class="seta" rel='Deposito'></span>
   						   	
   						  <div class="texto" id='Deposito'>
   						   	 
			              
			              
			              <p>Preencha seus dados bancários para depósito :</p>


                          <p>
                          <labe for="depositoNomeCnpj">Nome / CNPJ</label>
                          <input type="text" id="depositoNomeCnpj" name="depositoNomeCnpj" value="<?php echo $depositoNomeCnpj; ?>" />
                          </p>




                          <p>
                          <labe for="depositoBanco1">Opção Banco 1</label>
                          <input type="text" id="depositoBanco1" name="depositoBanco1" value="<?php echo $depositoBanco1; ?>" />
                          </p>

                          <p>
                          <labe for="depositoAgencia1">Opção Agência 1</label>
                          <input type="text" id="depositoAgencia1" name="depositoAgencia1" value="<?php echo $depositoAgencia1; ?>" />
                          </p>


                          <p>
                          <labe for="depositoConta1">Opção Conta 1</label>
                          <input type="text" id="depositoConta1" name="depositoConta1" value="<?php echo $depositoConta1; ?>" />
                          </p>



                          <p>
                          <labe for="depositoBanco2">Opção Banco 2</label>
                          <input type="text" id="depositoBanco2" name="depositoBanco2" value="<?php echo $depositoBanco2; ?>" />
                          </p>

                          <p>
                          <labe for="depositoAgencia2">Opção Agência 2</label>
                          <input type="text" id="depositoAgencia2" name="depositoAgencia2" value="<?php echo $depositoAgencia2; ?>" />
                          </p>


                          <p>
                          <labe for="depositoConta2">Opção Conta 2</label>
                          <input type="text" id="depositoConta2" name="depositoConta2" value="<?php echo $depositoConta2; ?>" />
                          </p>


                          <p>
                          <labe for="depositoMaisInfos">Mais Informações:</label><br/>
                          <textarea id="depositoMaisInfos" name="depositoMaisInfos"  style="width:50%" >
                          <?php echo $depositoMaisInfos; ?>
                          </textarea>
                          </p>
                          
                          

                       <input type="submit"  name="submit" value="Salvar"   />   

                             
				   </div><!-- .texto -->
					</div><!-- .bloco -->
   
   





                           <div class="bloco">




                 				<h3> 6 )<input type="checkbox" name="ativaRetirada" value="ativaRetirada"  <?php  if($ativaRetirada=='ativaRetirada'){ echo "CHECKED"; }; ?> />    
                 				 <img src='<?php echo $plugin_directory."images/retirada.png "; ?>' /> Retirar na Loja </h3>

                 			              <span class="seta" rel='retirada'></span>
                 						   	 <div class="texto" id='retirada'>
                 				   	    	 <p>Preencha abaixo os dados e mensagem para reserva com  pagamento e  retirada de produtos na loja  :</p>
                               	    	 <p>
                 				      	     <labe for="enderecoRetirada">Endereço e infos para retirada:</label><br/>
                 				      	 <textarea id="enderecoRetirada" name="enderecoRetirada"  style="width:50%" >
                 				      	 <?php echo $enderecoRetirada; ?>
                 				      	 </textarea>
                 				      	 </p>

                                     <input type="submit"  name="submit" value="Salvar"   />   


                 				   </div><!-- .texto -->
                 					</div><!-- .bloco -->












 <input type="submit"  name="submit" value="Salvar"   />


</form>





	</div>  
	
	
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

 


 <script>

 jQuery('.seta').click(function(){
     rel = jQuery(this).attr('rel');
     jQuery('.texto').hide();
     jQuery('#'+rel).show();
 });    
 
 
 

 </script>
 
 



 