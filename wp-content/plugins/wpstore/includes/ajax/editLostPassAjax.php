<?php

              require("../../../../../wp-load.php");
       
               global $wpdb;

              $info = $_REQUEST['emp'];

              $msgLost = "";
              if ( empty( $info  ) && empty( $info  ) ){
              	$msgLost .='<strong>ERROR</strong>: Por favor, digite seu email ou nome de usuário.<br/>';
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


              if ( $msgLost =="" ){	
 
              	$user_login = $info;
              	$user_email = $info;

              	$user = $wpdb->get_row("SELECT * FROM $wpdb->users WHERE user_login = \"$user_login\" or user_email = \"$user_login\"" );

                  $new_pass = wp_generate_password(12,false);

              	//$new_pass =  $senha1;

                  add_user_meta($user->ID, 'chave1',$new_pass,true) OR update_user_meta($user->ID, 'chave1',$new_pass);   


                  $header = "   <div style='width:100%;padding:5px;background:#15829D;margin-bottom:20px'><a href='".get_bloginfo('url')."'><img src='".get_bloginfo('template_url')."/images/likeblogs.png' /></a></div>";

                  $footer = "    <div style='width:100%;padding:5px;background:#0A2A35;margin-top:20px'><a href='".get_bloginfo('url')."'><img src='".get_bloginfo('template_url')."/images/rodape-logo.jpg' /></a></div>";


                	$nome = trim(get_user_meta($user->ID,'first_name',true));

                	if($nome==""){$nome = $user_login; };
                	
                	$idPaginaPerfil = get_idPaginaPerfil();
                	
                	
                    $idLogin = get_idPaginaLogin();
                    $pageLogin = get_permalink($idLogin);



              	$mensagemEmail = "  <h1>	Olá $nome, </h1>
              	<p>Verificamos em nosso sistema que foi feita uma solicitação de  uma nova senha para acesso em ".get_bloginfo('name')." . <br/>
                  </p>
                <p>	Caso você realmente deseje alterar sua senha acesse o link a seguir  :<strong><a href='".$pageLogin."?recs=true&lk=$new_pass'>".$pageLogin."?recs=true&lk=$new_pass</a></strong>
                  </p>
                 <p>	Para fazer o login acesse :  <a href='".$pageLogin."' >".$pageLogin."</a> </p>

                 <p>	Após o login , sugerimos que você altera a senha periódicamente na  pagina <strong><a href='".get_permalink($idPaginaPerfil)."'>Meus Dados</a> de forma a garantir a permanente segurança no acesso a sua conta.</strong> .</p>
              	";

              	$assuntoEmail =  "Solicitação de nova senha : ".get_bloginfo('name')."";
     

                   if(intval($user->ID>0)){
                       
                    echo $user->ID;

                    include('email.php');

                   };

                  }else{

                  echo $msgLost;


                 };




              	?>