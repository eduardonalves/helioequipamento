<?php
   

   add_action('admin_menu', 'criarMenuAdmin');

   function criarMenuAdmin() {
        
               add_menu_page(__('WP STORE','menu-wp-store'), __('WP STORE','menu-wp-store'), 'manage_options', 'wpstore', 'custom_criar_pagina_geral');
               
               
                     add_submenu_page( 
                             'wpstore', 
                             'Produtos',
                             'Adicionar Produto', 
                             '10', // $capability
                             'post-new.php?post_type=produtos' 
                      );
                      
               
               add_submenu_page( 
                   'wpstore', 
                   'Produtos',
                   'Listar Produtos', 
                   '10', // $capability
                   'edit.php?post_type=produtos' 
               );
               
         
            
   };
   


   //criar MENU PERSONALIZADO  -------------post types ( PEDIDOS )

    add_action('admin_menu', 'criarPedidos');
    

    function criarPedidos() {
         
          add_submenu_page('wpstore', __('Pedidos','menu-lista-pedidos'), __('PEDIDOS','menu-lista-pedidos'), 'manage_options',  'lista_pedidos', 'custom_criar_pagina_admin_pedidos');
     
          
    };
    
    

    function custom_criar_pagina_geral() {
        
           //echo "<h2>" . __( 'WP STORE', 'menu-criar-pedidos' ) . "</h2>";
      
            
          
            include('layout/panel/panel-header.php');
            
            include('layout/admin_page_general.php');    
            
            include('layout/panel/panel-footer.php');   
            
            
            echo "<br/><br/>";
           
    };
    
 

    function custom_criar_pagina_admin_pedidos() {
      
      
     
      
      
              include('layout/panel/panel-header.php');

              include('layout/admin_orders.php');    

              include('layout/panel/panel-footer.php');
              
           
   };

   // FINAL criar MENU PERSONALIZADO  -------------post types ( PEDIDOS )
   
   
   
   
   
   
   
   
   
   
   
   
   //criar MENU PERSONALIZADO  -------------post types ( CONTACTS )

       add_action('admin_menu', 'criarContatos');


       function criarContatos() {

             add_submenu_page('wpstore', __('Solicitações de Contato','menu-lista-contatos'), __('Contatos','menu-lista-contatos'), 'manage_options',  'lista_contatos', 'custom_criar_pagina_admin_contatos');


       };
 


       function custom_criar_pagina_admin_contatos() {
       
          
          
                  include('layout/panel/panel-header.php');

                    include('layout/admin_contatos.php');         

                    include('layout/panel/panel-footer.php');
                    
                    
       };

      // FINAL criar MENU PERSONALIZADO  -------------post types (  CONTACTS)
      
      
      
      
      
      
      
      
      
      //criar MENU PERSONALIZADO  -------------post types (PAYMENTS)

             add_action('admin_menu', 'criarPagePagamentos');


             function criarPagePagamentos() {

                   add_submenu_page('wpstore', __('Configurações de Pagamento','menu-lista-descontos'), __('Configurações de Pagamento','menu-lista-pagamentos'), 'manage_options',  'lista_pagamentos', 'custom_criar_pagina_admin_pagamentos');


             };

 

             function custom_criar_pagina_admin_pagamentos() {

                
                
                  include('layout/panel/panel-header.php');

                                  include('layout/admin_pagamentos.php');            

                    include('layout/panel/panel-footer.php');
                    
             };

      // FINAL criar MENU PERSONALIZADO  -------------post types (PAYMENTS)
      
      
      //criar MENU PERSONALIZADO  -------------post types ( SHIPPING )

               add_action('admin_menu', 'criarPageFrete');


               function criarPageFrete() {

                     add_submenu_page('wpstore', __('Configurações de Frete','menu-lista-frete'), __('Configurações de Frete','menu-lista-frete'), 'manage_options',  'lista_frete', 'custom_criar_pagina_admin_frete');


               };



               function custom_criar_pagina_admin_frete() {

                  
                                  include('layout/panel/panel-header.php');

                                  include('layout/admin_frete.php');                    

                                  include('layout/panel/panel-footer.php');
                                  
               };

        // FINAL criar MENU PERSONALIZADO  -------------post types ( SHIPPING )
        
        
        
        




           //criar MENU PERSONALIZADO  -------------post types ( DISCOUNTS )

                     add_action('admin_menu', 'criarPageDescontos');


                     function criarPageDescontos() {

                           add_submenu_page('wpstore', __('Cupom de Descontos','menu-lista-descontos'), __('Cupom de Descontos','menu-lista-descontos'), 'manage_options',  'lista_descontos', 'custom_criar_pagina_admin_descontos');


                     };



                     function custom_criar_pagina_admin_descontos() {
                   
                        
                        
                        include('layout/panel/panel-header.php');

                             include('layout/admin_descontos.php');                     

                           include('layout/panel/panel-footer.php');
                           
                           
                     };

              // FINAL criar MENU PERSONALIZADO  -------------post types ( DISCOUNTS)






                  //criar MENU PERSONALIZADO  -------------post types (DESIGN )

                               add_action('admin_menu', 'criarPageDesign');


                               function criarPageDesign() {

                                     add_submenu_page('wpstore', __('Opções de Design','menu-lista-design'), __('Opções de Design','menu-lista-design'), 'manage_options',  'lista_design', 'custom_criar_pagina_admin_design');


                               };



                               function custom_criar_pagina_admin_design() {
                     
                                  
                                      include('layout/panel/panel-header.php');

                                       include('layout/admin_design.php');  
                                       
                                       include('layout/panel/panel-footer.php');
                                         
                                         
                               };

                        // FINAL criar MENU PERSONALIZADO  -------------post types         (DESIGN )
                        
                        
                     
                        //criar MENU PERSONALIZADO  -------------post types (SMTP)

                                     add_action('admin_menu', 'criarPageSmtp');


                                     function criarPageSmtp() {

                                           add_submenu_page('wpstore', __('SMTP','menu-lista-smtp'), __('Opções de SMTP','menu-lista-smtp'), 'manage_options',  'lista_smtp', 'custom_criar_pagina_admin_smtp');


                                     };



                                     function custom_criar_pagina_admin_smtp() {
                                    
                                        
                                                 include('layout/panel/panel-header.php');

                                                  include('layout/admin_smtp.php');     

                                                   include('layout/panel/panel-footer.php');
                                                   
                                     };

                              // FINAL criar MENU PERSONALIZADO  -------------post types         (SECURITY AND SMTP)   
                              
                              
                              
                              
                              
                              
                              
                              

                              //criar MENU PERSONALIZADO  -------------post types (tAXS)

                                           add_action('admin_menu', 'criarPageImpostos');


                                           function criarPageImpostos() {

                                                 add_submenu_page('wpstore', __('Opções de Impostos e taxas','menu-lista-impostos'), __('Opções de Impostos','menu-lista-impostos'), 'manage_options',  'lista_impostos', 'custom_criar_pagina_admin_impostos');


                                           };



                                           function custom_criar_pagina_admin_impostos() {
                              
                                                 include('layout/panel/panel-header.php');

                                                 include('layout/admin_impostos.php');   
                                                 
                                                  include('layout/panel/panel-footer.php');
                                                     
                                                     
                                           };

                                    // FINAL criar MENU PERSONALIZADO  -------------post types         (DESIGN )


                                 


                                                           //criar MENU PERSONALIZADO  -------------post types (tAXS)

                                                                        add_action('admin_menu', 'criarPageTranslate');


                                                                        function criarPageTranslate() {
                                                                           add_submenu_page('wpstore', __('Opções de Texto e Tradução','menu-lista-translate'), __('Opções de texto e tradução','menu-lista-translate'), 'manage_options',  'lista_translate', 'custom_criar_pagina_admin_translate');
                                                                        };

                                                                        function custom_criar_pagina_admin_translate() {
                                                                  
                                                                                      include('layout/panel/panel-header.php');

                                                                                       include('layout/admin_translate.php');  
                                                                                      
                                                                                      include('layout/panel/panel-footer.php');
                                                                         };

                                                                 // FINAL criar MENU PERSONALIZADO  -------------post types         (DESIGN )




      
     
?>