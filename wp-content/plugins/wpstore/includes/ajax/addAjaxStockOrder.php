<?php

              require("../../../../../wp-load.php");

              $arrItem= explode('***',$_POST['arrItem']);
              
              $arrOrder= explode('***',$_POST['arrOrder']);
              
          
              $msgError = "";
              $msg = "";

              global $current_user;
              get_currentuserinfo(); 
              $idUser = $current_user->ID;
              $update = false;
           
     
              $user_email =  $current_user->user_email ;
              
              if(intval($current_user->ID)<=0){
                   $msgError =  "Permissão Administrativa negada";
              }
              
  

               if (current_user_can( 'manage_options' ) ) {
                    
               }else{
                  $msgError =  "Permissão Administrativa temporariamente indisponível";
               }
   
             
              if($msgError=="" ){
 
              for($z=0;$z<count($arrItem);$z++){
                  if($z>0){
                       
                        $order = intval($arrItem[$z]);
                        $item = intval($arrOrder[$z]);

                        add_orderby_stock( $item ,  $order );
                     };
              };
              
             
             }else{
                 echo $msgError;
             };

			 
		 
	
	?>