<?php  

 
       require("../../../../../wp-load.php");

         $creds = array();
       	 $creds['user_login'] = $_REQUEST['emp']; 
       	 $creds['user_password'] = $_REQUEST['pwp'];
       	 $checkout = $_REQUEST['checkout'];
       	 
       	 
       	 
       	    
      	    
      	            $idPaginaPerfil = get_idPaginaPerfil();
                    if($checkout =="TRUE"){
                     $idPaginaPerfil = get_idPaginaCheckout();    
                    }
                    $urlRedirect = get_permalink($idPaginaPerfil);
         
         

       	//echo $_REQUEST['rememberme'];

       	if($_REQUEST['rememberme'] == "forever "){

       	$creds['remember'] = true;

       	}
 
       	$user = wp_signon( $creds, false );

       	if ( is_wp_error($user) ){
       	$msg .= $user->get_error_message();	
       	$msg = str_replace("Perdeu","",$msg);
       	$msg = str_replace("sua","",$msg);
       	$msg = str_replace("senha","",$msg);
       	$msg = str_replace("?","",$msg);
       	$msg = str_replace("Esqueceu","",$msg);
       	
       	$msg = "Email ou senha incorreta!";
       	
       	}else{

        	$msg = $user->ID;

       	}


         if( intval($msg) > 0){
            echo $msg."****".$urlRedirect;
               
         }else{
             
              $user_login = $_REQUEST['emp'];
            
              $user = $wpdb->get_row("SELECT * FROM $wpdb->users WHERE user_login = \"$user_login\" or user_email = \"$user_login\"" );

              $idUser = $user->ID;   

              $user_info = get_userdata($idUser);
              $user_login = $user_info->user_login;
              
               
                 $creds = array();
             	 $creds['user_login'] = $user_login; 
             	 $creds['user_password'] = $_REQUEST['pwp'];

             	//echo $_REQUEST['rememberme'];

             	if($_REQUEST['rememberme'] == "forever "){

             	$creds['remember'] = true;

             	}

             	$user = wp_signon( $creds, false );

             	if ( is_wp_error($user) ){
             	$msg .= $user->get_error_message();	
             	$msg = str_replace("Perdeu","",$msg);
             	$msg = str_replace("sua","",$msg);
             	$msg = str_replace("senha","",$msg);
             	$msg = str_replace("?","",$msg);
             	$msg = str_replace("Esqueceu","",$msg);

             	$msg = "Email ou senha incorreta!";

             	}else{
             	 
              	$msg = $user->ID."****".$urlRedirect;
              	

             	}
             	
             	echo $msg;
              
             
         };


       	?>