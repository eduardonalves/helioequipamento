<?php

              require("../../../../../wp-load.php");

              global $current_user;

              get_currentuserinfo(); 
      
              $idPost = $_POST['postIDP'];
              $tipoVariacao= $_POST['operacaoTipoP'];
              $nomeItem = $_POST['nomeItemP'];
              $qtdProduto  = intval($_POST['qtdProd']);
              $precoOperacao  = $_POST['symbolItemP'];
              $precoAlternativo  = $_POST['precoItemP'];
              $imgAlternativa = $_POST['imagemItemP'];
               
              $msgError = "";
              $idUser = $current_user->ID;
              $update = false;
              
              $msg = "";
              
              $action = $_POST['action'];
              $itemID = intval($_POST['itemID']);
                 
                  
              $user_email =  $current_user->user_email ;
              
              if(intval($current_user->ID)<=0){
                   $msgError =  "Permissão Administrativa negada";
              }
              
  

                if ( current_user_can('edit_post', $idPost) ) {
          
                }else{
         
                  $msgError =  "Permissão Administrativa temporariamente indisponível";
         
                }
                
                
                if($action=="remove" && $msgError=="" ){
          
                  global $wpdb; 
                  
                  $tabela = $wpdb->prefix."";
                  $tabela .=  "wpstore_stock";
                 
                  $sql = "DELETE FROM `$tabela` WHERE `id` = '$itemID' ";
                 
                 $resultQuery = $wpdb->query($sql);
                  
                  $msgError =  "Removido com Sucesso.";
                                           
                }
              
              
              
              
     
              
             
                if(trim( $nomeItem ) == "" && $msgError==""  ){

                   $msgError =  "NONAME";
                };

             
             
             
              if($msgError=="" ){
 
              $returnMSG = add_variation_stock($idPost ,$tipoVariacao,$nomeItem,$qtdProduto,$precoAlternativo,$imgAlternativa ,$precoOperacao);
                 
              echo $returnMSG;
             
             };

			 
		 
	
	?>