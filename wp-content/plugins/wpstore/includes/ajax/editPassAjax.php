<?php

include("../../../../../wp-load.php");
       
	$email= $_REQUEST['emp'];
	$senha1 = $_REQUEST['pwp'];
	$senha2 = $_REQUEST['pw2p'];	
	$key = $_REQUEST['lk'];	

     global $wpdb;

    $info = $email;

    $msgLost = "";
    if ( empty( $info  ) && empty( $info  ) ){
    	$msgLost .='<strong>ERROR</strong>: Por favor, digite seu email ou nome de usuário.<br/>';
    };
    
    if ( $senha1 != $senha2 ){
    	$msgLost .='<strong>ERROR</strong>: As senhas devem ser iguais.<br/>';
    };

    if (strpos($info , '@')) {

    $user_data = get_user_by('email',trim($info));

    	if ( empty($user_data) ){
    		$msgLost .='<strong>ERROR</strong>: Este não é um email registrado.<br/>';
        }else{
    	$login = trim($info);
    	//$user_data = get_user_by('login', $login);
        };  

    }else{
    	$msgLost .='<strong>ERROR</strong>: Este não é um formato de email válido.<br/>';
    };
    
    
    $user = $wpdb->get_row("SELECT * FROM $wpdb->users WHERE user_login = \"$email\" or user_email = \"$email\"" );
    $loginN =  $user->user_login;
    
	$numReq = get_usermeta($user->ID, 'chave1');
	
	$numPost = $key;
	
    $mudou=false;
    
    $new_pass = wp_generate_password(12,false);
    
	if($numReq  == 	$numPost ){
	$mudou==true;
	$new_pass =  $senha1;
    wp_set_password($new_pass, $user->ID);
	update_usermeta($user->ID, 'default_password_nag', true); //Set up the Password change nag.
	
    }else{
    $msgLost .='<strong>ERROR</strong>: CHAVE INVÁLIDA! <br/>';  
    };
   
   
    if ( $msgLost =="" ){	
 
             if(intval($user->ID>0)){
                 
                 
                 $user_login = $info;
             	 
             	 $user_email = $info;


                     $header = "   <div style='width:100%;padding:5px;background:#15829D;margin-bottom:20px'><a href='".get_bloginfo('url')."'><img src='".get_bloginfo('template_url')."/images/likeblogs.png' /></a></div>";

                     $footer = "    <div style='width:100%;padding:5px;background:#0A2A35;margin-top:20px'><a href='".get_bloginfo('url')."'><img src='".get_bloginfo('template_url')."/images/rodape-logo.jpg' /></a></div>";


                   	$nome = trim(get_user_meta($user->ID,'first_name',true));

                   	if($nome==""){$nome = $user_login; };

                 	$assuntoEmail =   " Nova Senha Gerada : ".get_bloginfo('name');
                 	
                 	
                 	
                    $idLogin = get_idPaginaLogin();
                    $pageLogin = get_permalink($idLogin);


                     $mensagemEmail = " <h1>Olá ,  </h1> 
                           <p>Sua senha foi modificada com sucesso. </p>
                           <p>Para acessar sua conta  siga o link  <a href='".$pageLogin."' >".$pageLogin."</a> e digite seus dados de acesso . </p>
                           <p>usuario :$loginN </p>
                           <p>senha :$new_pass</p>";
               
               
              $idPaginaPerfil = get_idPaginaPerfil();
              $urlRedirect = get_permalink($idPaginaPerfil);
     
      
               //LOGIN----------------------
                $creds = array();
              	$creds['user_login'] = $loginN; 
              	$creds['user_password'] = $new_pass;

              	//echo $_REQUEST['rememberme'];

              	if($_REQUEST['rememberme'] == "forever "){

              	$creds['remember'] = true;

              	}
 
              	$user = wp_signon( $creds, false );
                //END LOGIN----------------------
                
                
                
                
                
                          echo $user->ID."****".$urlRedirect;

                          include('email.php');



             };
             
 
       
 
    }else{

      echo $msgLost;


    };
    
?>