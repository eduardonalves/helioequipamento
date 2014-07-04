 
        
    <?php
  
  $htmlVar .="
  
    <div class='carregando'></div>
    <div class='msg msgRed'  ></div>
    
    <div class='clear'></div>
    
    
	<div class='divDir'>
	
	
	
   
   	 <p class='facebook_connect facebook_connect2 '></p>
   
	
	
			<h2>já sou cadastrado</h2>
	
    
    ";
    
    ?>
    
 
    
    <?php if($_GET['recs']=="true"){ //end if is page login ?>

<?php

  $htmlVar .="
   
      <div id='forgotPassFormConfirma' >

        <p>Recuperação de senha:    </p>

         <form id='formRSenha' class='senha' method='post'>


              <p class='clearfix'>
                 <label for='emailrS'>Confirme seu Email</label>
                 <input id='emailrS'  name='emailrS' type='text'  />
             </p>


          <p>
              <label for='pwpR'>Digite a nova Senha</label>
              <input id='pwpR'   name='pwpR'  type='password'   />
          </p>

           <p>
                <label for='pwpR2'>Confirmar nova Senha</label><br/>
                <input id='pwpR2'   name='pwpR2'  type='password'   />
            </p>

             <input type='hidden' id='lk'  class='iSubmit' value='".$_GET['lk']."' />  

            <input type='submit' id='btSenhaSendN'  class='iSubmit' value='Alterar Senha' />  


         </form>  


        <div class='opcoes'>
              <ul>
                 <li class='btLogin'>Voltar para Login</li>
              </ul>
        </div>


        </div>

"; ?>


     <?php }else{ ?>
    
    
      <?php   $htmlVar .="
      
     
      <div id='loginForm'>

      
          <form id='formLogin' class='clearfix login' method='post'>



           <p class='clearfix'>
               <label for='emp'>Seu  E-mail:</label>
               <input id='emp' name='emp' type='text' value='' class='required txt emailL' />
           </p>

           <p>
               <label for='pwp'>Informe sua senha:</label>
               <input id='pwp'   name='pwp'  type='password'  value='' title='' class='required  txt senhaL' />
           </p>
   

     "; ?>



      <?php  
      $idPagina = get_idPaginaCheckout();  

      if(is_page($idPagina)) {  

           $htmlVar .='<input type="hidden" id="checkout" value="TRUE" />'; 

       }; 

       ?>

 
 
 
 
 <?php 
 
 $htmlVar .="
 

         <input type='submit' id='btLoginSend'  class='login' value='Fazer Login' />  

      </form>  


     <div class='opcoes'>
           <ul>
              <li class='btForgotPass '>Esqueci a senha.</li>
           </ul>
     </div>


     </div>




     <div id='forgotPassForm' style='display:none'>

     <p>Esqueceu a senha?  </p>


     <form id='formSenha' class='senha' method='post'>
       <p class='clearfix'>
           <label for='emailr'></label>
           <input id='emailr'  name='emailr' type='text'  value='Informe seu email:' title='Informe seu email:'  class='txt emailL' />
       </p>

       <input type='submit' id='btSenhaSend' class='iSubmit recSenha' value='Recuperar Senha' />

     </form>

     <div class='opcoes'>
           <ul>
                 <li class='btLogin '>Fazer Login</li>

           </ul>
     </div>


     </div>";
     
     
     $htmlVar .= "</div>"; //div Dir
     
     
     
     $htmlVar .= "


	<div class='divEsq'>
	
	 <p class='facebook_connect'></p>
	
	  <h2>cria uma conta</h2>

      <div id='novoRegistroForm' >
 
          <form id='formCadastro' class='cadastro' method='post'>
 
            <p class='clearfix'>
           <label for='nome'>Seu nome:</label>
           <input id='nome' name='nome' value='' title='Digite seu nome'  type='text'  class='txt required nome' />
           </p>


           <p class='clearfix'>
           <label for='emailc'>Seu e-mail:</label>
           <input id='emailc' name='emailc'  value='Digite seu e-mail' title='Digite seu e-mail' type='text' class='required email' />
           </p>
           <p>
           <label for='passc'>Sua senha:</label>
           <input id='passc' name='passc' type='password' value='' title='Sua senha:' class='senha txt required' />
           </p>

           <p class='clearfix'>
             <label for='passc2' style='line-height:15px;margin-left:0px'>Confirmar Senha</label>
             
             <input id='passc2' name='passc2' type='password' value='' title='Sua senha:' class='confirmarSenha txt required ' />
           </p>
           
           
           <br/>
           
           	    	<p class='recebaNews'>  ";
           	    	
           	    	
           	
           	    	
           	    	 if (function_exists('registerNewsletterMail')) {  
           	    	     
           	    	
                   	    	 $htmlVar .= "  
     
						<input type='checkbox' class='receba' name='receba' id='receba' value='1' CHECKED/>
						<label for='receba'>Receba nossa newsletter e fique por dentro dos nossos lançamentos, dicas e matérias.</label>
						<br/><br/> ";
						
					     
					   }; 
						
					 $htmlVar .=    "   <input type='radio' class='termos' id='termos' CHECKED />
						<label for='termos'>Estou ciente de que ao me cadastrar , concordo  com os termos de uso  e políticas do site.</label>
					</p>
           
                   
          <input type='submit' id='btCadastroSend' class='cadastrar' value='Cadastrar' title='Cadastrar' />

     </form>
  
     </div>  



     <div class='carregando'></div>
     <div class='msg msgRed'  ></div>




    "; ?>
    

    <?php }; ?>
    
    
    
     
    <?php $htmlVar .= "</div>"; //div Esc ?>
 


    
    <?php     $loginPrint.=  $htmlVar;  ?>
