<?php 
      
      //LOGIN FACEBOOK FUNCTIONS ----------------------------------------------------------------------
      include('custom_loginFacebook.php');    
      
      
      
      
      
      
      //função que remove acentos
      # @nome diegoSubistitui
      # @autor diegoSubistitui
      # @usar diegoSubistitui($variavel);
      function modificaAcento($sub){
          $acentos = array(
              'À','Á','Ã','Â', 'à','á','ã','â',
              'Ê', 'É',
              'Í', 'í', 
              'Ó','Õ','Ô', 'ó', 'õ', 'ô',
              'Ú','Ü',
              'Ç', 'ç',
              'é','ê', 
              'ú','ü',
              );
          $remove_acentos = array(
              'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
              'e', 'e',
              'i', 'i',
              'o', 'o','o', 'o', 'o','o',
              'u', 'u',
              'c', 'c',
              'e', 'e',
              'u', 'u',
              );
          return str_replace($acentos, $remove_acentos, urldecode($sub));
      }
      
      


 
function custom_get_category_id($blog_ID=1,$catName){
     global $wpdb;
     
     $query  = "SELECT * FROM `encontreingressos_".$blog_ID."_terms` WHERE `name` = '".$catName."' LIMIT 0 , 30";
  
    if(intval($blog_ID)==1){
     $query  = "SELECT * FROM `$wpdb->terms` WHERE `name` = '".$catName."' LIMIT 0 , 30";
    }
    
    
     $tvlt_posts = $wpdb->get_results($query, OBJECT);
     $id = 0;
     foreach($tvlt_posts as $postProd ){
       $id = $postProd->term_id;   
     };
     return  $id;
}

 
   //custom get all post meta of post --------------------------------------------------
   
   function custom_get_post_meta_all($post_id){include 'custom_functions.php';
   
       global $wpdb;
       $data   =   array();
       $wpdb->query("
           SELECT `meta_key`, `meta_value`
           FROM $wpdb->postmeta
           WHERE `post_id` = $post_id
       ");
       foreach($wpdb->last_result as $k => $v){
           $data[$v->meta_key] =   $v->meta_value;
       };
       return $data;
   }
 
   
    //custom IMAGE DISPLAY--------------------------------------------------
    

    function custom_get_image($postID,$width='260',$height='160' , $crop=0 , $print=true, $principal=false ,$class2=""){
       
 
        $imgPrint = "";
        include('layout/imagemListagem.php');
        if($print==false){
            return $imgPrint;
        }
        /* */

    };   
    
    
       function get_image_path($src) {
       global $blog_id;
       if(isset($blog_id) && $blog_id > 0) {
        $sub = get_bloginfo('url').'/wp-content'; 
        $src = str_replace($sub,'',$src);
       }
       return $src;
       }
    
    
    
    
    
    function ranger($url){
        $headers = array(
        "Range: bytes=0-32768"
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }






  /* */
 

  add_action('save_post','my_cf_check');
  function my_cf_check($post_id) {

      // verify this is not an auto save routine. 
      if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

      //authentication checks
      if (!current_user_can('edit_post', $post_id)) return;

      //obtain custom field meta for this post
       $custom_fields = get_post_custom($post_id);

      if(!$custom_fields) return;

      foreach($custom_fields as $key=>$custom_field):

          $values = array_filter($custom_field);

          //After removing 'empty' fields, is array empty?
          if(empty($values)):
              if($key!="embedVideo"){
              delete_post_meta($post_id,$key); //Remove post's custom field
              };
          endif;

      endforeach; 

      return;

  }

  /* */
          
 
 
 add_action(  'delete_post' ,'apagarCores'); 
 add_action('trash_post','apagarCores',1,1);     
 function   apagarCores($post_id){ 
     if(!did_action('trash_post')){ 
        global $wpdb; 
        $table_name = $wpdb->prefix."wpstore_stock"; 
        $sql = "DELETE FROM  `$table_name`  WHERE `idPost`='$post_id' "; 
        $wpdb->query($wpdb->prepare("$sql",'')); 
     }  
 };


  if ( ! function_exists( 'ucc_add_cpts_to_pre_get_posts' ) ) {
      function ucc_add_cpts_to_pre_get_posts( $query ) {
          if ( $query->is_main_query() && ! is_post_type_archive() && ! is_singular() && ! is_404() ) {
          $my_post_type = get_query_var( 'post_type' );
              if ( empty( $my_post_type ) ) {
                  $args = array(
                      'exclude_from_search' => false,
                      'public' => true,
                      '_builtin' => false
                  );
                  $output = 'names';
                  $operator = 'and';
                  $post_types = get_post_types( $args, $output, $operator );

                  // Or uncomment and edit to explicitly state which post types you want.
                  // $post_types = array( 'event', 'location' );
                  // Add 'link' and/or 'page' to array() if you want these included.
                  // array( 'post', 'link', 'page' ), etc.
                  $post_types = array_merge( $post_types, array( 'post' ) );
                  $query->set('post_type', $post_types );
              }
          }
      } 
  }

  add_action( 'pre_get_posts', 'ucc_add_cpts_to_pre_get_posts' );





  add_action('wp_head', 'add_metatag');
 
  function add_metatag() {
  
  $plugin_directory = str_replace('functions/','ajax/',plugin_dir_url( __FILE__ ));
  
  $idPage = get_idPaginaPagamento();
  $pgsUrl =  get_permalink($idPage);
 
  echo '<meta name="urlShop" content="'.$plugin_directory.'">';
  echo '<meta name="pgsUrl" content="'.$pgsUrl.'">';
  echo '<meta name="urlSite" content="'.get_bloginfo('url').'">';
  }





 function curPageURL() {
  $pageURL = 'http';
  if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
  $pageURL .= "://";
  if ($_SERVER["SERVER_PORT"] != "80") {
   $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  } else {
   $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  }

 $pageURL = explode("?", $pageURL);
 return $pageURL[0];

 }

 
 
 //inserindo style no header ---------------------------------
 
 
 $ajaxFiltro = true;
  $tipoSkinShop = get_option('tipoSkinShop');
 if($tipoSkinShop=="DARK"){
 wp_register_style( 'prefix-style', plugins_url('wpstore/includes/css/general-product-dark.css','WP STORE' ) );
 }else{
 wp_register_style( 'prefix-style', plugins_url('wpstore/includes/css/general-product-light.css','WP STORE' ) );    
 }
 wp_enqueue_style( 'prefix-style' );
 


   wp_register_style( 'date-pickercss', plugins_url('wpstore/includes/css/ui-lightness/jquery-ui-1.8.20.custom.css','WP STORE' ) ); 
   wp_enqueue_style( 'date-pickercss' );


  //FINAL inserindo style no header ---------------------------------   
  
 
   
  
  
  
  //inserindo JS no header ---------------------------------
  //wp_register_script( 'jui2', plugins_url('wpstore/includes/js/jquery-ui.js','WP STORE' ), array('jquery') );
  //wp_enqueue_script( 'jui2' );

 

   
  //inserindo JS no header ---------------------------------
  wp_register_script( 'validade', plugins_url('wpstore/includes/js/jquery-validade.js','WP STORE' ), array('jquery', 'jquery-ui-core' , 'jquery-ui-datepicker') );
  wp_enqueue_script( 'validade' );
   //FINAL inserindo JS no header ---------------------------------
    


  /*
  wp_register_script( 'jui', plugins_url('wpstore/includes/js/datepicker.js','WP STORE' ), array('jquery') );
  wp_enqueue_script( 'jui' );
  */


   //FINAL inserindo JS no header ---------------------------------

   
  //inserindo JS no header ---------------------------------
  wp_register_script( 'prefix-script', plugins_url('wpstore/includes/js/custom.js','WP STORE' ), array('thickbox') );
  wp_enqueue_script( 'prefix-script' );
   //FINAL inserindo JS no header ---------------------------------
   


   
	  
   //FINAL ATUALIZA DADOS DA ASSINATURA DO USUARIO-------------------------------

	 function my_plugin_page_filter_shop(){
	    
	    $registro = intval(get_option('registroWPSHOP'));
	  
	    if($registro<=0){ 
	    updatePagesShop();
	    };   
	 
     };
	     

 
              

	     
	 //ATUALIZA DADOS DA ASSINATURA DO USUARIO-------------------------------
   function updatePagesShop(){
             
     update_option('registroWPSHOP',1);
     
      global $current_user;

     get_currentuserinfo(); 
 
     $idUser = $current_user->ID;
     
    $page = get_page_by_title( 'Carrinho' );
    if(intval($page->ID)<=0){
      // Create post object
     $my_post = array(
     'post_title' => 'Carrinho',
     'post_content' => '[get_cart_Table]',
     'post_type' => 'page',
     'post_status' => 'publish',
     'post_author' => $idUser
     );
     $the_page_id = wp_insert_post( $my_post);
       
     add_option('idPaginaCarrinhoWPSHOP',$the_page_id,'','yes'); 
     update_option('idPaginaCarrinhoWPSHOP',$the_page_id);
                    
  };
  
  
  $page = get_page_by_title( 'Checkout' );
  if(intval($page->ID)<=0){ 	      
      	      
      // Create post object
      $my_post = array(
      'post_title' => 'Checkout',
      'post_content' => '[custom_get_checkout]',
      'post_type' => 'page',
      'post_status' => 'publish',
      'post_author' => $idUser
      );
      $the_page_id = wp_insert_post( $my_post);   
      
      add_option('idPaginaCheckoutWPSHOP',$the_page_id,'','yes'); 
       update_option('idPaginaCheckoutWPSHOP',$the_page_id);
                    	      
   };
   
   
   $page = get_page_by_title( 'Pagamento' );
   if(intval($page->ID)<=0){           	      
                    	      
       // Create post object
        $my_post = array(
        'post_title' => 'Pagamento',
         'post_content' => '[get_payment_checkout]',
         'post_type' => 'page',
         'post_status' => 'publish',
         'post_author' => $idUser 
         );
        
        $the_page_id = wp_insert_post($my_post);
         add_option('idPaginaPagtoWPSHOP',$the_page_id,'','yes'); 
         update_option('idPaginaPagtoWPSHOP',$the_page_id);                       	      
                              	      
  };
               
               
   $page = get_page_by_title( 'Pedidos' );
   if(intval($page->ID)<=0){
                   
                                   	      
           // Create post object
           $my_post = array(
           'post_title' => 'Pedidos',
           'post_content' => '[custom_get_orders_user]',
           'post_type' => 'page',
           'post_status' => 'publish',
           'post_author' => $idUser
           );
           $the_page_id =wp_insert_post( $my_post );   
           add_option('idPaginaPedidosWPSHOP',$the_page_id,'','yes'); 
           update_option('idPaginaPedidosWPSHOP',$the_page_id);
                                         	      
   };
                 
                 
   $page = get_page_by_title( 'Pedido' );
   if(intval($page->ID)<=0){                        	      
                                        	      
                                        	      
            // Create post object
             $my_post = array(
             'post_title' => 'Pedido',
             'post_content' => '[custom_get_order_user]',
             'post_type' => 'page',
             'post_status' => 'publish',
             'post_author' => $idUser
             );
            $the_page_id= wp_insert_post($my_post); 
            add_option('idPaginaPedidoWPSHOP',$the_page_id,'','yes'); 
            update_option('idPaginaPedidoWPSHOP',$the_page_id);
                                                          	      
    };
    
    
    $page = get_page_by_title( 'Meus Dados' );
    if(intval($page->ID)<=0){
     
     
              // Create post object
              $my_post = array(
                      'post_title' => 'Meus Dados',
               'post_content' => '[get_edit_form_perfil]',
               'post_type' => 'page',
               'post_status' => 'publish',
               'post_author' => $idUser);
              $the_page_id =  wp_insert_post($my_post);
              add_option('idPaginaPerfilWPSHOP',$the_page_id,'','yes'); 
              update_option('idPaginaPerfilWPSHOP',$the_page_id);
                                                                                          	      
     };
    
     $page = get_page_by_title( 'Login' );
     if(intval($page->ID)<=0){                                                          	      
                                                                                	      
                // Create post object
                 $my_post = array(
                 'post_title' => 'Login',
                 'post_content' => '[get_Login_form]',
                 'post_type' => 'page',
                 'post_status' => 'publish',
                 'post_author' => $idUser
                  );
                  $the_page_id = wp_insert_post($my_post);
                 add_option('idPaginaLoginWPSHOP',$the_page_id,'','yes'); 
                 update_option('idPaginaLoginWPSHOP',$the_page_id);                                                                        	      
                                                                            	      
                 };
                                                                  	                                                           	                    	      
      	};
	
	
      add_filter( 'the_post', 'my_plugin_page_filter_shop' );



      function confirmaTransacao(){
 
        //CONFIRMA PAYPAL IPN 
        if($_POST['cdp'] !=""){
        include( 'payment/Paypal/pages/IPN/ipn.php');    
        }
      
        //CONFIRMA MOIP RETORNO 
        $meuPinMoip = trim(get_option('meuPinMoip'));  
        if($_REQUEST['confirmaMoip'] == $meuPinMoip  && $_REQUEST['confirmaMoip'] !="" ){
        include( 'payment/Moip/pages/retorno.php');    
        }
        
      
      };


      add_filter( 'wp_head', 'confirmaTransacao' );


      add_filter( 'show_admin_bar', '__return_false' );


      add_filter( 'show_admin_bar', '__return_false' );
      
      
      
      
      
      //ADD CUSTOM COLLUM IN WP ADMIN USER
      
      
      add_filter('manage_users_columns', 'pippin_add_user_id_column');
      function pippin_add_user_id_column($columns) {
          $columns['user_id'] = '+Infos ';
          return $columns;
      }

      add_action('manage_users_custom_column',  'pippin_show_user_id_column_content', 10, 3);
      function pippin_show_user_id_column_content($value, $column_name, $user_id) {
          $user = get_userdata( $user_id );
      	if ( 'user_id' == $column_name ){
      	     $idPaginaDt = get_idPaginaPerfil();
      	     $linkP = get_permalink($idPaginaDt );
      		return "<a href='$linkP?idUser=$user_id' target='_BLANK'>+ Infos</a>";
  		}
      }
      
      
    
    
    
      function confirmaPagseguro(){
          
           if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){
             include( 'payment/Pagseguro/retornoPagseguro.php'); 
          };
      
      };


      add_filter( 'wp_head', 'confirmaPagseguro' );
                                
      
      
      
      
      function rssgoogleShop(){              
      if(isset($_GET['googlerss'])){
          include('layout/feed-google-shop.php');
      };          
      };
        add_action( 'after_setup_theme', 'rssgoogleShop' );   
        
         
?>