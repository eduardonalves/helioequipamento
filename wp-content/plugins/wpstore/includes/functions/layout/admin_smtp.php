 <?php

$idPaginaCarrinho = 0;
$idPaginaCheckout = 0;



  if( $_POST['submit']=="Salvar" ){
  
          $smtpPort = trim($_POST['smtpPort']); 
          add_option('smtpPortWPSHOP',$smtpPort,'','yes'); 
          update_option('smtpPortWPSHOP',$smtpPort);
 
 
            $smtpSecure = trim($_POST['smtpSecure']); 
            add_option('smtpSecureWPSHOP',$smtpSecure ,'','yes'); 
            update_option('smtpSecureWPSHOP',$smtpSecure );
            
            
            $smtpHost = trim($_POST['smtpHost']); 
            add_option('smtpHostWPSHOP',$smtpHost ,'','yes'); 
            update_option('smtpHostWPSHOP',$smtpHost );
            
            $smtpUser = trim($_POST['smtpUser']); 
            add_option('smtpUserWPSHOP',$smtpUser ,'','yes'); 
            update_option('smtpUserWPSHOP',$smtpUser );
            
            $smtpPass= trim($_POST['smtpPass']); 
            add_option('smtpPassWPSHOP',$smtpPass ,'','yes'); 
            update_option('smtpPassWPSHOP',$smtpPass );


            $smtpFrom = trim($_POST['smtpFrom']); 
               add_option('smtpFromWPSHOP',$smtpFrom ,'','yes'); 
               update_option('smtpFromWPSHOP',$smtpFrom ); 
               
                    $smtpAtivo = trim($_POST['smtpAtivo']); 
                          add_option('smtpAtivoWPSHOP',$smtpAtivo ,'','yes'); 
                          update_option('smtpAtivoWPSHOP',$smtpAtivo);    
               
                                  $smtpDebug = trim($_POST['smtpDebug']); 
                                        add_option('smtpDebugWPSHOP',$smtpDebug ,'','yes'); 
                                        update_option('smtpDebugWPSHOP',$smtpDebug);   
                                        
                                        
                                        
        $emailSend =  trim($_POST['emailSend']);         
                                 
        $plugin_directory = str_replace('layout/','',plugin_dir_url( __FILE__ )); 
        	                                
        if($emailSend !="") {    
            
                  echo "<p>Enviando Email test to : ".$emailSend." </p>";    
                  echo "</br>";         
                   
                  $user_email= $emailSend;   
                  $nome = "Test Name";
                  $assuntoEmail =   " Email Test: ".get_bloginfo('name');
                  $mensagemEmail = " <h1>Hello,  </h1><p>This is a test! </p>";
                  
                  include("../wp-content/plugins/wpstore/includes/functions/email.php");      
                   
                  echo "</br></br></br>";         
        };
        
        
   };


$smtpPort = get_option('smtpPortWPSHOP');
$smtpSecure= get_option('smtpSecureWPSHOP');
$smtpHost= get_option('smtpHostWPSHOP');
$smtpUser= get_option('smtpUserWPSHOP');
$smtpPass= get_option('smtpPassWPSHOP');
$smtpFrom= get_option('smtpFromWPSHOP');  

$smtpAtivo= get_option('smtpAtivoWPSHOP');    
$smtpDebug= get_option('smtpDebugWPSHOP');
?>
 
 
 
	<form action="<?php echo verifyURL(get_option( 'siteurl' )) ."/wp-admin/admin.php?page=lista_smtp";?>"  method="post" >


     
    
    
    
    <div id="cabecalho">
    	<ul class="abas">
    		<li>
    			<div class="aba gradient">
    				<span>Opções SMTP</span>
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
			
			<h3>1 ) Ativar Autênticação SMTP</h3>
			
			<span class="seta" rel='ativarSmtp'></span>
			<div class="texto" id='ativarSmtp'>
			
			
				<label for="smtpAtivo">Defina se deseja ativar a autênticação SMTP para enviar emails da loja. </label>
                <br/>  

                 <select id="smtpAtivo" name="smtpAtivo" >     
                  <option <?php if($smtpAtivo=='N'){ echo "SELECTED";};  ?> value='N' >Não</option>  
                  <option <?php if($smtpAtivo=='Y'){ echo "SELECTED";};  ?> value='Y' >Sim</option>
                 </select>  

                <br/>
                <span style="font-size:10px">Ao ativar o SMTP você torna o envio de seus emails autênticados.</span>
                
                 
				 <br/>  
			    <input type="submit"  name="submit" value="Salvar"   /> 
			    
		    
             </div>
             </div><!-- .bloco -->
            
            
            
            
            
      
                    
                    
                    
                    
                    <div class="bloco">      

            			<h3>2 )  Ativar SMTP DEBUG</h3>

            			<span class="seta" rel='debugSmtp'></span>
            			<div class="texto" id='debugSmtp'>


            		            <label for="valorFreteValor6">Defina se deseja ativar a aO DEBUG do SMTP.É bom para fazer testes. </label>
                                <br/>  

                                 <select id="smtpDebug" name="smtpDebug" >     
                                  <option <?php if($smtpDebug=='N'){ echo "SELECTED";};  ?> value='N' >Não</option>  
                                  <option <?php if($smtpDebug=='Y'){ echo "SELECTED";};  ?> value='Y' >Sim</option>
                                 </select>  

                                <br/>
                                <span style="font-size:10px">Ao ativar o Debug , o sistema informará o erro ocorrido no envio de emails.</span>
                          
              		     <input type="submit"  name="submit" value="Salvar"   />  

                         </div>
                         </div><!-- .bloco -->
                        
                        
                                
				  
	          
	   
                                       <div class="bloco">      

                                			<h3>3 )  Porta do Servidor</h3>

                                			<span class="seta" rel='ativaSmtpDb'></span>
                                			<div class="texto" id='ativaSmtpDb'>


                                		       
                                		             <label for="valorFreteValor6">Defina a porta do servidor</label>
                                                        <br/>
                                                         <input type="text" id="smtpPort" name="smtpPort" value="<?php echo $smtpPort; ?>"  style="width:40%"  />
                                                        <br/>
                                                        <span style="font-size:10px">Ex:465,587</span>
                                                       <input type="submit"  name="submit" value="Salvar"   />  

                                             </div>
                                             </div><!-- .bloco -->	   
	   
 
		    
          
            


                                              <div class="bloco">      

                                        			<h3>4 ) SMTP SECURE</h3>

                                        			<span class="seta" rel='secureSmtp'></span>
                                        			<div class="texto" id='secureSmtp'>



                                        		        <label for="valorFreteValor6">Defina o SMTPSECURE </label>
                                                         <br/>
                                                         <input type="text" id="smtpSecure" name="smtpSecure" value="<?php echo $smtpSecure; ?>"  style="width:40%"  />
                                                        <br/>
                                                        <span style="font-size:10px">Ex:ssl,tls</span>

                                                               <input type="submit"  name="submit" value="Salvar"   />  

                                                     </div>
                                                     </div><!-- .bloco -->
                                                    
                                                    
               
     
     
                                                    <div class="bloco">      

                                              			<h3>5 )SMTP HOST</h3>

                                              			<span class="seta" rel='hostSmtp'></span>
                                              			<div class="texto" id='hostSmtp'>


                                                            <label for="valorFreteValor6">Defina o SMTPHOST </label>
                                                             <br/>
                                                             <input type="text" id="smtpHost" name="smtpHost" value="<?php echo $smtpHost; ?>"  style="width:40%"  />
                                                            <br/>
                                                            <span style="font-size:10px">Ex:localhost,smtp.gmail.com</span>
                                                              <br/>
                                                            
                                                              <input type="submit"  name="submit" value="Salvar"   />   
                                                              <br/>
                                                           </div>
                                                           </div><!-- .bloco -->
                                                          
                                                          
                                                          
                                                          
             


                                                              <div class="bloco">      

                                                        			<h3>6 ) SMTP USER NAME</h3>

                                                        			<span class="seta" rel='userNSmtp'></span>
                                                        			<div class="texto" id='userNSmtp'>


                                                                              <label for="valorFreteValor6">Defina o email/usuario do SMTP </label>
                                                                               <br/>
                                                                               <input type="text" id="smtpUser" name="smtpUser" value="<?php echo $smtpUser; ?>"  style="width:40%"  />
                                                                              <br/>
                                                                              <span style="font-size:10px">Ex:seuemail@seudominio.com.br</span>
                                                                                                                                                          
                                                                                    <br/>
                                                                                    <input type="submit"  name="submit" value="Salvar"   />   
                                                                                    <br/>
                                                                    </div>
                                                                     </div><!-- .bloco -->
                                                                    
                                                                    
                    
                    
                    
                    
                                                                     <div class="bloco">      

                                                                			<h3>7 ) SMTP USER PASSWORD</h3>

                                                                			<span class="seta" rel='smtpPSmtp'></span>
                                                                			<div class="texto" id='smtpPSmtp'>


                                                                                             <label for="valorFreteValor6">Defina o email/usuario do SMTP </label>
                                                                                                 <br/>
                                                                                                 <input type="password" id="smtpPass" name="smtpPass" value="<?php echo $smtpPass; ?>"   style="width:40%" />
                                                                                                <br/>
                                                                                                <span style="font-size:10px">Ex:****</span>
                                                                                                                                                                                                 
                                                                                                       <br/>
                                                                                                        <input type="submit"  name="submit" value="Salvar"   />   
                                                                                                        <br/>
                                                                             </div>
                                                                             </div><!-- .bloco -->
                                                                            
                                                                    
                                                                     
             
             
                                                                             <div class="bloco">      

                                                                        			<h3>7 ) SEND EMAIL TEST</h3>

                                                                        			<span class="seta" rel='emailSend'></span>
                                                                        			<div class="texto" id='emailSend'>


                                                                                                     <label for="valorFreteValor6">Defina o email a receber o email  </label>
                                                                                                         <br/>
                                                                                                         <input type="text" id="emailSend" name="emailSend" value="<?php echo $emailSend; ?>"   style="width:40%" />
                                                                                                        <br/>
                                                                                                
                                                                                                        <br/>
                                                                                                        <input type="submit"  name="submit" value="Salvar"   />   
                                                                                                         <br/>
                                                                                     </div>
                                                                                     </div><!-- .bloco -->
                                                                                     
                                                                                     
                                                                                     

       


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






          </form>





           <script>

           jQuery('.seta').click(function(){
               rel = jQuery(this).attr('rel');
               jQuery('.texto').hide();
               jQuery('#'+rel).show();
           });    




           </script>
           
           
