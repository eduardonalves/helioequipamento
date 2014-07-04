<?php

//FILTER TO THE CONTENT ------------------------------------------------------------
 
 
 
 function addCartTable($content) {
    
        global $post;
 

        $find = false;
        $tabela = "";

          //------------------------------------------------
 
               $pos = strpos($content,'[get_cart_Table]');
                if($pos == true) {
                $find = true;
                }
                
             
                 
               if($find==true){  $tabela = get_cart_Table(false);
               $content = str_replace('[get_cart_Table]',$tabela,$content); return $content;
               };
        
               $idPaginaCarrinho  =  get_option('idPaginaCarrinhoWPSHOP'); 
               if($post->ID==$idPaginaCarrinho && $idPaginaCarrinho !=""){  $tabela = get_cart_Table(false);
               $content = $content.$tabela;   return $content;
               }
       
        
        
          //------------------------------------------------
        
         $find = false;
        
        
             $pos = strpos($content,'[custom_get_checkout]');
             if($pos == true) {
             $find = true;
             }
                       
           
           
             if($find==true){  $tabela = custom_get_checkout(false);
             $content = str_replace('[custom_get_checkout]',$tabela,$content); return $content;
             }
          
              $idPaginaCheckout  =  get_option('idPaginaCheckoutWPSHOP'); 
              if($post->ID==$idPaginaCheckout&& $idPaginaCarrinho !=""){  $tabela = custom_get_checkout(false);
              $content = $content.$tabela;    return $content;
              }
 
         //------------------------------------------------
       
        $find = false;
       
        
           $pos = strpos($content,'[get_payment_checkout]');
             if($pos == true) {
             $find = true;
             }
             
           
                     
            if($find==true){ $tabela = get_payment_checkout(false);
                $content = str_replace('[get_payment_checkout]',$tabela,$content); return $content;
            }
            
            $idPaginaPagto =   get_option('idPaginaPagtoWPSHOP');  
            if($post->ID==$idPaginaPagto&& $idPaginaCarrinho !=""){ $tabela = get_payment_checkout(false);
              $content = $content.$tabela;   return $content;
            }
         
         
         
         //------------------------------------------------
          $find = false;
         
           $pos = strpos($content,'[custom_get_orders_user]');
           
           if($pos == true) {
           $find = true;
           }
            
         
         
            if($find==true){
                   $tabela = custom_get_orders_user(false);
                   $content = str_replace('[custom_get_orders_user]',$tabela,$content); return $content;
            }
        
            $idPaginaPedidos =   get_option('idPaginaPedidosWPSHOP');  
            if($post->ID==$idPaginaPedidos&& $idPaginaCarrinho !=""){
                   $tabela = custom_get_orders_user(false);
              $content = $content.$tabela;  return $content;
            }
    
    
                 //------------------------------------------------
                  $find = false;

                   $pos = strpos($content,'[custom_get_order_user]');

                   if($pos == true) {
                   $find = true;
                   }

                    

                    if($find==true){
                        $tabela = custom_get_order_user(false);
                    $content = str_replace('[custom_get_order_user]',$tabela,$content); return $content;
                    }

                    $idPaginaPedido   =  get_option('idPaginaPedidoWPSHOP');
                    if($post->ID==$idPaginaPedido&& $idPaginaCarrinho !=""){
                        $tabela = custom_get_order_user(false);
                         $content = $content.$tabela;  return $content;
                    }
    
    
    
                           //------------------------------------------------
                              $find = false;

                               $pos = strpos($content,'[get_edit_form_perfil]');

                               if($pos == true) {
                               $find = true;
                               }

                                

                                if($find==true){
                                $tabela = get_edit_form_perfil(false);
                                $content = str_replace('[get_edit_form_perfil]',$tabela,$content); return $content;
                                }

                               $idPaginaPerfil   =  get_option('idPaginaPerfilWPSHOP');
                                if($post->ID==$idPaginaPerfil&& $idPaginaCarrinho !=""){
                                    $tabela = get_edit_form_perfil(false);
                               $content = $content.$tabela;  return $content;
                                }
                                
                          
                           //------------------------------------------------
                                 $find = false;

                                 $pos = strpos($content,'[get_Login_form]');

                                 if($pos == true) {
                                 $find = true;
                                 }

                                 $tabela = get_Login_form(false);

                                 if($find==true){
                                      $content = str_replace('[get_Login_form]',$tabela,$content); return $content;
                                 }

                                 $idPaginaLogin  =  get_option('idPaginaLoginWPSHOP');
                                 
                                 if($post->ID==$idPaginaLogin&& $idPaginaCarrinho !=""){
                          
                                     $content = $content.$tabela;  return $content;
                                 }
                          
                          
                                
              return $content;                  
  
 };
 
 
 
 add_filter('the_content', 'addCartTable');
  add_filter('get_the_content', 'addCartTable');
 
 
 //add_filter('the_content',"showFormNewsletter", $priority, $accepted_args );
 
 //FINAL FILTER TO THE CONTENT ------------------------------------------------------------






?>