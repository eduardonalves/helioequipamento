<?php 
require("../../../../../wp-load.php");
 

 
	$email= $_REQUEST['emp'];
	$senha1 = $_REQUEST['pwp'];
	$senha2 = $_REQUEST['pw2p'];
	$nome = $_REQUEST['nome'];
	
	$checkout = $_REQUEST['checkout'];
    $receba  = $_REQUEST['receba'];      
    
    
	$user_login = sanitize_user( $email);
	$user_email = apply_filters( 'user_registration_email', $email );
	
	$msgReg ='' ;
	
	
	$plugin_directory = str_replace('ajax/','',plugin_dir_url( __FILE__ ));
    


	// Check the username
	if ( $user_login == '' )
		$msgReg .='ERROR: Por favor, escolha um nome de usuário.<br/>' ;
	elseif ( !validate_username( $user_login ) ) {
		$msgReg .='<strong>ERROR</strong>: Este nome é invalido.  Escolha um nome válido.<br/>';
		$user_login = '';
	} elseif ( username_exists( $user_login ) )
		$msgReg .='<strong>ERROR</strong>: Este nome  de usuário já esta registrado em nosso sistema. Por favor, escolha outro nome de usuário.<br/>';

	// Check the e-mail address
	if ($user_email == '') {
		$msgReg .='<strong>ERROR</strong>: Por favor  informe seu email de contato.<br/>';
	
	} elseif ( email_exists( $user_email ) )
		$msgReg .='<strong>ERROR</strong>: Este email já está registrado . Por favor ,   escolha outro.<br/><br/>';


	if ( $msgReg =="" ){
	    
	    $user_id = wp_create_user($email, $senha1,$email);
	    
	     add_user_meta($user_id,'first_name',$nome,true) OR update_user_meta($user_id, 'first_name',$nome);   
	     add_user_meta($user_id,'display_name',$nome,true) OR  update_user_meta($user_id,'display_name', $nome);

     
		
		 //LOGIN----------------------
            $creds = array();
         	$creds['user_login'] = $email; 
         	$creds['user_password'] = $senha1;

         	//echo $_REQUEST['rememberme'];

         	if($_REQUEST['rememberme'] == "forever "){

         	$creds['remember'] = true;

         	}

         	$user = wp_signon( $creds, false );
           //END LOGIN----------------------
           
                  
           
               if($receba !=""){

                    //UPDATE NEWSLETTER FORM --------------
                     if (function_exists('registerNewsletterMail')) {
                          registerNewsletterMail($nome,$user_email, "1***",'nao');   
                     };

                }
                
           	
		
		if ( is_wp_error($user) ){
		     echo $msgReg;
		}else{
		    
		              //echo $user->ID;
	        
	              // ENVIO DE EMAIL ----------------------------------------------------------
	              
	              
	                  $user_email =  $user_email;
	        
    				   $header = "<div style='width:100%;padding:5px;background:#15829D;margin-bottom:20px'><a href='".get_bloginfo('url')."'><img src='".$plugin_directory."images/topo-email.png' /></a></div>";

                       $footer = "<div style='width:100%;padding:5px;background:#0A2A35;margin-top:20px'><a href='".get_bloginfo('url')."'><img src='".$plugin_directory."images/footer-email.png'/></a></div>";

                       $idLogin = get_idPaginaLogin();
                       $pageLogin = get_permalink($idLogin);
                       
                       
                       $mensagemEmail = "
                          <h1>Olá $nome,  </h1> 
                          <p>Seja Bem vindo ao <strong> ".get_bloginfo('name')." </strong> ! Obrigado por acessar e se inscrever em nosso site.</p>
                          <p>Para acessar sua conta  siga <a href='".$pageLogin."' >".$pageLogin."</a> . </p> 
                          <p><strong>Dados para acesso:</strong></p>
                          <p>usuario : $email <br/>  senha : $senha1<br/>  </p> ";
                          
                          
                          $mensagemEmail2 = "
                                <h1>Olá Administrador ,  </h1> 
                                <p>Novo usuário cadastrado no <strong>".get_bloginfo('name')."</strong>.</p>
                                 <p>usuario : $email <br/>  Nome : $nome <br/>  </p>
                                <p>Para administrar faça o login em  <a href='".$pageLogin."' >".$pageLogin."</a> . </p> 
                                ";
                                
                      
                        $assuntoEmail = "Registro de Usuário : Bem Vindo ao ".get_bloginfo('name')."";
                        $assuntoEmail2 = "Registro de Usuário : Nova conta criada no ".get_bloginfo('name')."";
 
                        if(intval($user->ID)>0){
                
                                  $idPaginaPerfil = get_idPaginaPerfil();
                                  if($checkout =="TRUE"){
                                   $idPaginaPerfil = get_idPaginaCheckout();    
                                  }
                                  
                                  $urlRedirect = get_permalink($idPaginaPerfil);
                                  echo $user->ID."****".$urlRedirect;
                                  
                                  
                               include('email.php');
                        };
                        
                        
                // FINAL ENVIO DE EMAIL ----------------------------------------------------------
                        
                        
	
		}



	}else{
	    
	        echo $msgReg;
	        
	}
	
	
	
	?>