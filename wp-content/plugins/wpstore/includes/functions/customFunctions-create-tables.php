<?php

//CREATE TABLES ----------------------------------------------------------------
   
   global $wpstore_version;
   $wpstore_version = "1.1.7";
   
   //verify update version 
   
   function shopPlugin_update_db_check() {
       global $wpstore_version;
       if (get_option('wpstore_version') != $wpstore_version) {
           update_option("wpstore_version", $wpstore_version);
           wpstore_createTable();
       }   
       wpstore_createTable();       
   }
         
   
   add_action('plugins_loaded', 'shopPlugin_update_db_check');
 
   function wpstore_createTable(){

        //create table ---------------------------------------------

          global $wpdb;
          global $jal_db_version;
          
          require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

            
   
          $table_nameA = $wpdb->prefix ."wpstore_orders"; 
           
          	$sqlA = "CREATE TABLE IF NOT EXISTS `$table_nameA` (
              `id` int(11) NOT NULL auto_increment,
              `id_pedido` varchar(155) NOT NULL,
              `id_usuario` varchar(155) NOT NULL,
              `valor_total` varchar(155) NOT NULL,
              `frete` varchar(155) NOT NULL,
              `tipo_pagto` varchar(55) NOT NULL,
              `status_pagto` varchar(500) NOT NULL,
              `comentario_cliente` varchar(1000) NOT NULL,
              `comentario_admin` varchar(1000) NOT NULL,
              `comentario_pagt` varchar(1000) NOT NULL,
              PRIMARY KEY  (`id`)
            ) AUTO_INCREMENT=1 ; ";
             
          dbDelta($sqlA);
                          
   
                 
          $table_nameB = $wpdb->prefix ."wpstore_orders_address"; 

 
                                   	 $sqlB = "CREATE TABLE IF NOT EXISTS `$table_nameB` (
                                      `id` int(11) NOT NULL auto_increment,
                                      `id_pedido` varchar(155) NOT NULL,
                                      `id_usuario` varchar(155) NOT NULL,
                                      `cep` varchar(15) NOT NULL,
                                      `cidade` varchar(155) NOT NULL,
                                      `bairro` varchar(155) NOT NULL,
                                      `estado` varchar(155) NOT NULL,
                                      `endereco` varchar(1000) NOT NULL,
                                      `numero` varchar(10) NOT NULL,
                                      `complemento` varchar(1000) NOT NULL,
                                      PRIMARY KEY  (`id`)
                                    ) AUTO_INCREMENT=1 ;";
                                   	
           
                  dbDelta($sqlB);
                  
                  
                       
                  
                 
                  $table_name = $wpdb->prefix ."wpstore_orders_products"; 

                   $sql3 = "CREATE TABLE IF NOT EXISTS `$table_name` (
                   	  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
                   	  `id_pedido` VARCHAR(155) DEFAULT '' NOT NULL,
                   	  `id_usuario` VARCHAR(155) DEFAULT '' NOT NULL,
                   	  `id_produto` VARCHAR(155) DEFAULT '' NOT NULL,
                   	  `preco` VARCHAR(155) DEFAULT '' NOT NULL,
                   	  `variacao` VARCHAR(55) DEFAULT '' NOT NULL,
                   	  `qtdProd` VARCHAR(55) DEFAULT '' NOT NULL,
                   	  `precoAlt` VARCHAR(55) DEFAULT '' NOT NULL,
                   	  `precoAltSymb` VARCHAR(55) DEFAULT '' NOT NULL,
                   	   PRIMARY KEY  (`id`)
                   	) AUTO_INCREMENT=1 ;";

                   dbDelta($sql3);
                   
                   
                   
                   
                   



                   $table_name = $wpdb->prefix  ."wpstore_orders_comments"; 

                     $sql4 = "CREATE TABLE IF NOT EXISTS `$table_name` (
                     	  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
                     	  `id_pedido` VARCHAR(155) DEFAULT '' NOT NULL,
                     	  `status_pagto` VARCHAR(1000) DEFAULT '' NOT NULL,
                     	  `comentario_cliente` VARCHAR(1000) DEFAULT '' NOT NULL, 
                     	  `comentario_admin` VARCHAR(1000) DEFAULT '' NOT NULL, 
                     	  `comentario_pagt` VARCHAR(1000) DEFAULT '' NOT NULL, 
                     	  `data` VARCHAR(10) DEFAULT '' NOT NULL,
                     	  PRIMARY KEY  (`id`)
                     	)  AUTO_INCREMENT=1 ;";

                     dbDelta($sql4);





                        
                     $table_name2 = $wpdb->prefix ."wpstore_stock";


                       $sql5 = "CREATE TABLE IF NOT EXISTS `$table_name2` (
                           	      `id` mediumint(9) NOT NULL AUTO_INCREMENT,
                            	  `idPost` VARCHAR(155) DEFAULT '' NOT NULL,
                            	  `tipoVariacao` VARCHAR(155) DEFAULT '' NOT NULL,
                            	 `variacaoProduto` VARCHAR(155) DEFAULT '' NOT NULL,
                            	 `qtdProduto` VARCHAR(155) DEFAULT '' NOT NULL,
                            	  `precoOperacao` VARCHAR(55) DEFAULT '' NOT NULL,
                            	  `showOrder` VARCHAR(1000) DEFAULT '' NOT NULL,
                            	  `precoAlternativo` VARCHAR(1000) DEFAULT '' NOT NULL,
                            	  `imgAlternativa` VARCHAR(10000) DEFAULT '' NOT NULL,
                            	  PRIMARY KEY  (`id`) 
                           	)  AUTO_INCREMENT=1 ;";

                          dbDelta($sql5);






                     $table_name = $wpdb->prefix  ."wpstore_contacts"; 

                          $sql6 = "CREATE TABLE IF NOT EXISTS `$table_name` (
                          	  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
                          	  `nomeAviso` VARCHAR(155) DEFAULT '' NOT NULL,
                          	  `emailAviso` VARCHAR(100) DEFAULT '' NOT NULL,
                          	  `postIDP` mediumint(9)  NOT NULL,
                          	  `variacaoCorP` VARCHAR(100) DEFAULT '' NOT NULL,
                          	  `variacaoTamanhoP` VARCHAR(100) DEFAULT '' NOT NULL,
                          	  	  PRIMARY KEY  (`id`) 
                             	)  AUTO_INCREMENT=1 ;";

                          dbDelta($sql6);
                          
                      

                          $table_name = $wpdb->prefix  ."wpstore_descontos"; 

                               $sql7 = "CREATE TABLE IF NOT EXISTS `$table_name` (
                               	  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
                               	  `numeroCupom` VARCHAR(155) DEFAULT '' NOT NULL,
                               	  `tipoDesconto` VARCHAR(100) DEFAULT '' NOT NULL,
                               	  `valorDesconto` VARCHAR(100) DEFAULT '' NOT NULL,
                               	  `limite` mediumint(9)  NOT NULL,
                               	  `qtdUsado` mediumint(9)  NOT NULL,
                                  	  PRIMARY KEY  (`id`) 
                                 	)  AUTO_INCREMENT=1 ;";

                               dbDelta($sql7);

        
   };
   
    

   
   //call to function
  register_activation_hook(__FILE__,'wpstore_createTable');
 
   
  
   // END CREATE TABLES -----------------------------------------------------------------
   
   ?>