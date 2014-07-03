<?php

 
if(!isset($_SESSION)){
    session_start();
}


//custom IMAGE  MARCA--------------------------------------------------

function  custom_get_brand( $categoriaPrincipalName ){ 
        $categoriaPrincipalNameLower = strtolower($categoriaPrincipalName);

        if($categoriaPrincipalNameLower=="sony"){
        $urlBrandImage = get_bloginfo('template_url')."/images/$categoriaPrincipalNameLower.jpg";
        include('layout/imagemBrand.php');
        }else{
            echo $categoriaPrincipalName;
        }



};



 
 function getPriceFormat($preco){  
     
 
     if(strlen($preco)>6 &&  strpos($preco, ',') ===true ){
     $preco = str_replace('.','',$preco );
     }
     $preco = str_replace(',','.',$preco);   
 
     $preco = floatval($preco);

     $preco = number_format($preco,2 ,  ',', '.');
     return $preco;
     
 }
 
 

//custom PRICE  --------------------------------------------------

function  custom_get_price( $postID ){  
    
    $preco =get_post_meta($postID,'price','true');
    if(strlen($preco)>6){
    $preco = str_replace('.','',$preco );
    }
    $preco = str_replace(',','.',$preco);
    
    $preco = floatval($preco); 
    
    $preco = number_format($preco,2 ,  ',', '.');
    return $preco;
};




//custom SPECIAL PRICE  --------------------------------------------------

function  custom_get_specialprice( $postID ){ 
  
    
    $preco =get_post_meta($postID,'specialprice','true');
    if(strlen($preco)>6){
    $preco = str_replace('.','',$preco );
    }
    $preco = str_replace(',','.',$preco);
    
    $preco = floatval($preco);
    
    $preco = number_format($preco,2 ,  ',', '.');
        return $preco;
};





//custom SELECT FORM  FOR VARIATIONS OF THE PRODUCT ( SIZE AND COLOR ) --------------------------------------------------

function custom_get_select_stock_form($postID){
    
    $ilimitado = get_post_meta($postID,'is_check_outofstock',true);
   
    if(intval($ilimitado)==1 || $ilimitado=="" ){
         $ilimitado = true;
    }
 
     include('layout/box-comprar.php');
     
}; 

// FINAL FUNCTION custom_get_select_stock_form

 
 
 
 
 //FUNCAO PARA VERIFICAR QTD DE ESTOQUE --------------------------------------
 
 function custom_get_qtd_stock($postID,$cor,$tamanho,$controle=false){
     
 
     $qtdStock = 0;

     $qtdReservaUsuario = 0;

     if($tamanho=="" && $cor==""){
     $variacao='unico';
     };


     if($variacao=='unico'){

         $qtdProdInit = intval( get_post_meta($postID,'initstock',true) );

         $qtdReservaUsuario = custom_get_stock_reservaUsuario($postID,'');

         $qtdStock =  $qtdProdInit -  $qtdVendida - $qtdReservaUsuario;

     }else{
 
         $qtdStock =   verificarEstoque($postID,$cor,$tamanho);
 
         $qtdStock =  $qtdStock;
     };
     
     
     $qtdProdInit = get_post_meta($post->ID, 'is_check_outofstock', true);
     
      if( $qtdProdInit== '1' ||  $qtdProdInit== ''){
         if($controle==false){ $qtdStock =  100000000000000000000000000000; }; 
      }

     return $qtdStock;

 };
 
 //FUNCAO PARA VERIFICAR QTD DE ESTOQUE --------------------------------------
 

function custom_get_qtd_vendida($postID,$cor,$tamanho){
    
    global $wpdb; 
    $tabela = $wpdb->prefix."";
    $tabela .=  "wpstore_orders_products";
   
   $cor = str_replace(" ","",$cor);   
    
    $sql = "SELECT * FROM `$tabela` WHERE `id_produto` LIKE '$postID' AND `variacao` = '$tamanho-$cor'";    
    if($cor=="" && $tamanho !=""){
        $sql = "SELECT * FROM `$tabela` WHERE `id_produto` LIKE '$postID' AND `variacao` REGEXP '$tamanho' ";    
    }elseif($tamanho=="" && $cor !=""){
        
        $sql = "SELECT * FROM `$tabela` WHERE `id_produto` LIKE '$postID' AND `variacao` REGEXP '$cor$' ";    
    }
    $fivesdrafts = $wpdb->get_results( $wpdb->prepare(  $sql,1,'' ) );

     // Adicionando PRODUTOS
      $qtd  = 0;
     if($fivesdrafts ){
     foreach ( $fivesdrafts as $item=>$fivesdraft ){
           $qtd += intval($fivesdraft->qtdProd);
     };
     };
     return $qtd;
};


//FUNCAO PARA VERIFICAR QTD DE ESTOQUE--------------------------------------

function verificarEstoque($postID,$cor,$tamanho){

     global $wpdb;
     
     $tipoVariacao = 'tamanhoCor';
     
     $nome = trim( str_replace(' ','',$tamanho) )."-".trim( str_replace(' ','',$cor) );
     
     if($cor==""){
       $tipoVariacao = 'tamanho';  
       $nome = $tamanho;
     }elseif($tamanho==""){
       $tipoVariacao = 'cor';    
       $nome = $cor;
     };

     $tabela = $wpdb->prefix."";
     $tabela .=  "wpstore_stock";
       
     $sql = "SELECT `qtdProduto`
     FROM `$tabela`
     WHERE `idPost` = '$postID'
     AND `variacaoProduto` = '$nome'
     AND `tipoVariacao` = '$tipoVariacao'
     LIMIT 0 , 30";
 
     $resultQuery =  $wpdb-> get_row($sql);
     
     $resultQuery =  intval($resultQuery->qtdProduto);
     
     $qtdReservaUsuario = custom_get_stock_reservaUsuario($postID,$nome);
 
     $resultQuery = $resultQuery - $qtdReservaUsuario;

     return $resultQuery;
     
};



function verificarEstoqueTotal($postID,$cor,$tamanho){

     global $wpdb;
     
      $tabela = $wpdb->prefix."";
      $tabela .=  "wpstore_stock";


     
     $tipoVariacao = 'tamanhoCor';
     
     $nome = trim( str_replace(' ','',$tamanho) )."-".trim( str_replace(' ','',$cor) );

     
     $sql = "SELECT  * 
     FROM `$tabela`
     WHERE `idPost` = '$postID'
     AND `variacaoProduto` = '$nome'
     LIMIT 0 , 30";
     
  
     if($cor==""){
         
       $nome = $tamanho;
       
       
       $sql = "SELECT   *
       FROM `$tabela`
       WHERE `idPost` = '$postID'
       AND `variacaoProduto` REGEXP '$nome' 
       LIMIT 0 , 30";
       
       
     }elseif($tamanho==""){
         
       $nome = $cor;
       
       $sql = "SELECT   *
       FROM `$tabela`
       WHERE `idPost` = '$postID'
       AND `variacaoProduto` REGEXP '$nome$' 
       LIMIT 0 , 30";
       
       
     };
      
    
     $fivesdrafts = $wpdb->get_results( $wpdb->prepare(  $sql ,1,'') );

        // Adicionando PRODUTOS
         $qtd  = 0;
        if($fivesdrafts ){
        foreach ( $fivesdrafts as $item=>$fivesdraft ){
              $qtd += intval($fivesdraft->qtdProduto);
        };
        };
        return $qtd;
     
};







//FINAL FUNCAO PARA VERIFICAR QTD DE ESTOQUE --------------------------------------





function custom_get_stock_reservaUsuario($postID,$variacaoCor){
    
    if( $variacaoCor=="" || $variacaoCor=="-" ){ $variacaoCor=$postID; };
    
     $arrayCarrinho =  ''; 
    
     $blogid = intval(get_current_blog_id());  
  	 if($blogid>1){
  	       $arrayCarrinho = $_SESSION['carrinho'.$blogid];
  	 }else{
  	       $arrayCarrinho =  $_SESSION['carrinho'];  
     };

 	
     if(count($arrayCarrinho)>0){
     foreach($arrayCarrinho as $item){
          if( $item['prodString'] == trim($postID.$variacaoCor) ){
              $qtdItem =  $item['qtdProduto'];
              if($qtdItem==""){ $qtdItem=0; };
                  $reserva = intval($qtdItem);
                  return $reserva;
          } 
     };
     };
       return 0;  
}







//FUNCAO PARA IMPRIMIR TABELA DO CARRINHO DE COMPRAS--------------------------------------
function get_cart_Table($print=true){
    
 
   
      $tabelaVar = "";

     include('layout/tabela_carrinho.php');

      if($print ==true){
          echo  $tabelaVar;
      }else{
          return  $tabelaVar;
      };
   
   
   
    
}
//FINAL FUNCAO PARA IMPRIMIR TABELA DO CARRINHO DE COMPRAS--------------------------------------



function  custom_get_qtd_items_Cart(){

    $arrayCart = ''; 
    $blogid = intval(get_current_blog_id());  
 		if($blogid>1){$arrayCart = $_SESSION['carrinho'.$blogid];}else{  $arrayCart =  $_SESSION['carrinho'];   };

	
    if($arrayCart==""){
        $arrayCart = array();
    }
    $count = 0;
    foreach($arrayCart as $cartItem){
        $count += intval($cartItem['qtdProduto']);
    };
    return $count;
    
};




 
function custom_get_menu_shop_top(){
    
$qtdStock =  custom_get_qtd_items_Cart();
 
   include('layout/intro.php');
 

};



//recupera variacao de preco de um produto ---------------------------------------------\

function get_price_product_variation($postID,$variacao){
 
    
    
      global $wpdb; 
      $tabela = $wpdb->prefix."";
      $tabela .=  "wpstore_stock";
      
      $sql = "SELECT * FROM `$tabela` WHERE  `idPost` = '$postID' AND  (`variacaoProduto` = '$variacao' )  ORDER BY `variacaoProduto` ASC   LIMIT 0 , 1";

      $arrayResultado =$wpdb-> get_row($sql);
      
      
      $preco= "".$arrayResultado->precoAlternativo;
      $precofinal = $preco;
      
      if($preco=="undefined" || floatval($preco) <=0 ){
        $preco="";  
        $precofinal = $preco;
      }
      
      $operacao = "".$arrayResultado->precoOperacao;
      if($operacao=="undefined"){
          $operacao="";  
        }
        
      if(floatval($preco) >0){
      $precofinal = $operacao."($moedaCorrente$preco)";
      };
     
      return $precofinal;
      
    
};
 
//FINAL recupera variacao de preco de um produto ---------------------------------------------\


//funcao para pegar peso do produto -----------------------------------------

function get_weight_product($postID){
    $peso = floatval(str_replace(',','.',get_post_meta($postID,'weight',true)));
    
    if($peso==""){
        $peso= "0.00";
    }
     return $peso;
}
//final para pegar peso do produto -----------------------------------------



//function get galeria ----------------------------------



 function custom_product_galeria(){
     
      global $post;
     
      include('layout/galeria.php');
      
  };
  

  //FINAL function get galeria ----------------------------------




    
 
 
 function custom_product_single(){
     
     global $post;
    
     include('layout/single_produto.php');
     
 }
 
 
 
 function custom_product_abas(){
     
     global $post;
     include('layout/single_produto_abas.php');
 }
 
 
 
function 	custom_product_relation_single(){
 
     global $post;
    
     include('layout/single_produto_relation.php');
     
 };
 
 
 function custom_get_checkout($print=true){

     $qtdStock =  custom_get_qtd_items_Cart();
    
            $idPagina  = get_idPaginaCarrinho();
           
            $urlRedirect = get_permalink($idPagina);
            
    
     if($qtdStock==0){   
          //wp_redirect(verifyURL($urlRedirect));   
          echo "<script>window.location='".verifyURL($urlRedirect)."'</script>";
     };
    
     $valorFrete = get_valor_frete();
  
         $htmlVar = "";


          include('layout/checkout.php');
   

           if($print ==true){
               echo  $htmlVar ;
           }else{
               return $htmlVar ;
           };

 
      
 };
 
 
 function get_valor_frete(){
     $cep = get_session_cep();
     if($cep=="Digite seu Cep"){ 
         $valorFrete = ""; 
         return $valorFrete;
     };
     $valorFrete = 1;
     $_SESSION['alertaFrete'] = '';
     return $valorFrete;
 };
 
 
 function  get_session_cep($string="Digite seu Cep"){
     $cepV = "";
     $cepV = "".$_SESSION['cepUser'];
     if($cepV=="undefined"){
       $cepV= $string;  
     }else{
         $_SESSION['cepUser'] = $cepV;
     }
     
     $idUser = get_current_id_user();
     $userCep = trim(get_user_meta($idUser,'userCep',true));if($userCep==""){$userCep="";};
     $userCep2 = trim(get_user_meta($idUser,'userCep2',true));if($userCep2==""){$userCep2="";};
    
     if($userCep !=""){
          $cepV = $userCep;
     };
     if($userCep2 !==""){
          $cepV = $userCep2;
     };
     return $cepV;
     
 };
 
 
 function  get_weight_cart(){
      
      
      $arrayCarrinho ='';   

   	    $blogid = intval(get_current_blog_id());  
        	 if($blogid>1){
        	       $arrayCarrinho = $_SESSION['carrinho'.$blogid];
        	 }else{
        	       $arrayCarrinho =  $_SESSION['carrinho'];  
           };
      
   	
   	
       if($arrayCarrinho==""){ $arrayCarrinho = array(); };
       $pesoTotal = 0;
       foreach( $arrayCarrinho as $key=>$item ){
            $postID = intval($item['idPost']);
            $pesoTotal += get_weight_product($postID);
       };
       return $pesoTotal;
 };
 
 
 function  get_Login_form($print=true){
     
      $idPagina = get_idPaginaLogin();
      
  
      
      if( is_user_logged_in() && is_page($idPagina)  ) { 
          	$idPaginaPerfil = get_idPaginaPerfil();
           echo "<script> window.location = '".get_permalink($idPaginaPerfil)."' </script>  ";
           //wp_redirect(verifyURL(get_permalink($idPaginaPerfil));  
      }; 
     
 
       $loginPrint = "";
 
       include('layout/loginRegistro.php');

       if($print ==true){
           echo   $loginPrint;
       }else{
           return   $loginPrint;
       };
       
       
     
 }
 
 
 function  get_edit_form_perfil($print=true){
     
     
     $idLogin = get_idPaginaLogin();
     $pageLogin = get_permalink($idLogin);

     
        if( is_user_logged_in() ) { }else{ 
             echo "<script> window.location = '".verifyURL($pageLogin)."' </script>  ";
             //wp_redirect(verifyURL($pageLogin).'');  
        }; 
       
         $perfilPrint = "";
         
         include('layout/meus-dados.php'); 

       
          if($print ==true){
              echo $perfilPrint;
          }else{
              return $perfilPrint;
          };
     
     
     
 }

 
 function get_current_name_user(){
     
     
     

     global $current_user;
      get_currentuserinfo();
      $idUser = $current_user->ID;
      $userLogin = $current_user->user_login;
      $userEmail = $current_user->user_email;

 
           $nome = "$current_user->user_firstname $current_user->user_lastname";
              if($current_user->display_name !=""){
               $nome =    $current_user->display_name;
              };


        return $nome;
     
 }
 
 
 
 function get_current_id_user(){
     
     
     

     global $current_user;
      get_currentuserinfo();
      $idUser = $current_user->ID;
 

        return  $idUser;
     
 }
 
 
 
 
 
 
 //----------------------------checkout------------------------------------------------
 
 function verificaFrete($cep,$pesoTotal){
     //get $cidade  &&  $estado
     $frete = 0;
     
     include('frete/custom_buscaEndereco.php');
     //GET VALOR FRETE 
     include('frete/custom_freteCorreios2011.php');
     
     return $frete;
 };
 
 
 function custom_get_sum($preco,$frete,$desconto=0.00){
     
                   $precoSoma = $preco;
                   if(strlen($precoSoma)>7){
                   $precoSoma= str_replace('.','',$precoSoma );
                   }
                   $precoSoma = str_replace(',','.',$precoSoma);
                   $precoSoma = floatval($precoSoma);
                    
                   $precoFrete = str_replace('.','',$frete);
                   $precoFrete = str_replace(',','.',$frete);
                   $precoFrete = floatval($precoFrete);
                   
                   $desconto = str_replace('.','', $desconto);
                   $desconto = str_replace(',','.', $desconto);
                   $desconto= floatval( $desconto);
                      
                  
                   $precoF = $precoSoma + $frete - $desconto;
                   return $precoF;
 }


function custom_get_total_price_session_order(){
    
    $arrayCarrinho ='';   

 	    $blogid = intval(get_current_blog_id());  
      	 if($blogid>1){
      	       $arrayCarrinho = $_SESSION['carrinho'.$blogid];
      	 }else{
      	       $arrayCarrinho =  $_SESSION['carrinho'];  
         };
 
  	
     
      if($arrayCarrinho==""){ $arrayCarrinho = array(); };
      
        $subtotal = 0;
        
        foreach( $arrayCarrinho as $key=>$item ){
            
             $postID = intval($item['idPost']);
             
              $variacao = $item['variacaoProduto'];
                 if($variacao==""){
                     $variacao="-";
                 }
         
                $preco =  custom_get_price( $postID );
                $specialPrice =  custom_get_specialprice( $postID );
                $pesoTotal += get_weight_product($postID );
                
                if($specialPrice >0){
                $preco =  $specialPrice;   
                }
                
                $precoSoma = $preco;
                         if(strlen($precoSoma)>=6){
                          $precoSoma= str_replace('.','',$precoSoma );
                           }
                           $precoSoma = str_replace(',','.',$precoSoma);   
                           
                           
                                  $precoAdd = get_price_product_variation($postID,$variacao);

                                  //$precoAdddArray = explode('(R$',$precoAdd);
                                  $precoAdddArray = explode('(',$precoAdd);
                                  $sinal = $precoAdddArray[0];
                                  $precoAddF= str_replace(')','',$precoAdddArray[1]);
                           
                                  if(strlen($precoAddF)>=6){
                                      
                                       $precoAddFSoma =  str_replace('.','',$precoAddF);
                                       $precoAddFSoma =  str_replace(',','.',$precoAddFSoma );
                                      
                                      
                                  }else{
                                  $precoAddFSoma =  str_replace(',','.',$precoAddF);
                                  };  
                   
                                   
                  if($sinal=="-"){
                  $precoSoma = $precoSoma -  $precoAddFSoma;  
                  }elseif($sinal=="+"){
                  $precoSoma = $precoSoma +  $precoAddFSoma;    
                  };   
       
                $qtd = intval($item['qtdProduto']);
                
                
                $precoLinha =    getPriceFormat($qtd*$precoSoma) ;
                
                $subtotal += $qtd*$precoSoma;
            
           
        };
        
        return getPriceFormat($subtotal);
    
};




//GERAR PEDIDO ----------------------------------------------------------------------------------
 function gerarpedido($idUsuario,$valor,$frete,$tipoPagamento,$statusPagamento,$comentarioAdmin){
    
 
        global $wpdb;
        $tabela = $wpdb->prefix."";
        $tabela .=  "wpstore_orders";
                  
        $num = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM  `$tabela` WHERE `id_usuario`='$idUsuario' " ,1,'') );
        
        $Randow = rand(1, 999);
 
    
        $idPedido = $idUsuario.'.'.$Randow.'.'.gmdate('Y').'.'.gmdate('m').'.'.gmdate('d');
    
 
        $id = intval( $wpdb->get_var( $wpdb->prepare( "SELECT `id` FROM `$tabela` WHERE `id_pedido`='$idPedido' ",1,'' ) ) );


        $obs = ""; 
    
           if( intval($valor)<0){
              $positivoTotal = str_replace('-','',$valor);
                $obs = "<br/><span style='font-size:0.6em;color:red'>Seu cupom é maior que o total de suas compras . Em breve você receberá um  novo cupom no valor de $positivoTotal. </span><br/><br/>";
             $comentarioAdmin .= $obs;
              $valor= "0.00";
           };



      if($id ==0){
          
   
       $sql = "INSERT INTO `$tabela` (`id` ,`id_pedido` ,`id_usuario` ,`valor_total` ,`frete` ,`tipo_pagto` ,`status_pagto` ,`comentario_admin`)
              VALUES ( NULL , '$idPedido', '$idUsuario', '$valor', '$frete', '$tipoPagamento', '$statusPagamento', '$comentarioAdmin');
       ";
    
       $resultQuery = $wpdb->query($sql);
       $lastid  = $wpdb->get_var( $wpdb->prepare( "SELECT `id_pedido` FROM `$tabela` ORDER BY `id` DESC LIMIT 0 , 1",1,'' ) );
 
       if($lastid ==$idPedido){
       return $idPedido;   
       }else{
       return "ERROR1001 $lastid ||| $idPedido ";
       }
     
     
       };
    
    
  };
  //FINAL GERAR PEDIDO ----------------------------------------------------------------------------------


        function gravarEnderecoPedido($pedidoID,$idUser,$cep,$estado,$cidade,$bairro,$endereco,$numero,$complemento){
            
            
            global $wpdb;
            $tabela = $wpdb->prefix."";
            $tabela .=  "wpstore_orders_address";


              $sql = "INSERT INTO `$tabela` (`id` ,`id_pedido` ,`id_usuario` ,`cep` ,`estado`,`cidade` ,`bairro` ,`endereco` ,`numero`,`complemento`)
                      VALUES ( NULL , '$pedidoID','$idUser','$cep','$estado','$cidade','$bairro','$endereco','$numero','$complemento');
               ";

               $resultQuery = $wpdb->query($sql);
            
        };
         
         
         
         
        function   gravarProdutosPedido($pedidoID,$idUser){
            
             global $wpdb;
             
             $tabela = $wpdb->prefix."";
             
             $tabela .=  "wpstore_orders_products";
              
             $arrayCarrinho ='';   

          	    $blogid = intval(get_current_blog_id());  
               	 if($blogid>1){
               	       $arrayCarrinho = $_SESSION['carrinho'.$blogid];
               	 }else{
               	       $arrayCarrinho =  $_SESSION['carrinho'];  
                  };
       
         	

                 if($arrayCarrinho==""){ $arrayCarrinho = array(); };

                   $subtotal = 0;

                       foreach( $arrayCarrinho as $key=>$item ){
                           
                              $postID = intval($item['idPost']);

                              if($postID>0){

                                  $variacao = $item['variacaoProduto'];
                                  if($variacao==""){
                                      $variacao="-";
                                  }

                           
                              $preco =  custom_get_price( $postID );
                              $specialPrice =  custom_get_specialprice( $postID );
                             
                              if($specialPrice >0){
                              $preco =  $specialPrice;   
                              }
                              
                              $qtd = intval($item['qtdProduto']);
                              
                              $precoAdd = get_price_product_variation($postID,$variacao);

                               //$precoAdddArray = explode('(R$',$precoAdd);
                               $precoAdddArray = explode('(',$precoAdd);
                               $sinal = $precoAdddArray[0];
                               $precoAddF= str_replace(')','',$precoAdddArray[1]);
                               $precoAddFSoma =  str_replace(',','.',$precoAddF);
                           
                             $sql = "INSERT INTO `$tabela` (`id` ,`id_pedido` ,`id_usuario` ,`id_produto` ,`preco`,`variacao`,`qtdProd`,`precoAlt`,`precoAltSymb`)
                             VALUES ( NULL , '$pedidoID','$idUser','$postID','$preco','$variacao','$qtd','$precoAddFSoma','$sinal');
                              ";

                             $resultQuery = $wpdb->query($sql);
                             
                             };   
                             
                       };
           
         };
         
         
         
         
         function  get_payment_checkout($print=true){
             
                  $txtPrint = "";
            
                  include('payment/payment.php');
           
                  if($print ==true){
                      echo $txtPrint;
                  }else{
                      return $txtPrint;
                  };
                  
         };
         
 
         
         
//----------------------------checkout------------------------------------------------

//visualizar Pedidos --------------------------------


     function  custom_get_orders_user($print=true){
    
    
           $ordersPrint = "";
      
           include('layout/orders.php');
        
           if($print ==true){
               echo $ordersPrint;
           }else{
               return $ordersPrint;
           };
   
     }
     
     
     
     function  custom_get_order_user($print=true,$orderNum="", $pagto="on"){
    
    
            $orderPrint = "";
            $orderPrintB = "";
            $orderNumZ = $orderNum;
             
            include('layout/order.php'); 
            
            if($order==""){
                $orderPrint = ""; 
                $orderPrintB = ""; 
                $idPedidos = get_idPaginaPedidos(); 
                $urlPedidos = verifyURL(get_permalink($idPedidos));
                //wp_redirect($urlPedidos);   
                return "<script> window.location = '$urlPedidos' </script>";
            }

            if($pagto =="on" ){
              return  $orderPrint; 
            }else{
         
              return $orderPrintB;  
            };
    
     
     }
     
     


function custom_get_total_products_in_order($idPedido){
    
    global $wpdb;
    
    $tabela = $wpdb->prefix."";
    
    $tabela .=  "wpstore_orders_products";
 
    $sql = "SELECT count(*) FROM `$tabela` WHERE `id_pedido` = '$idPedido' ";
    
    $prodCount = $wpdb->get_var( $wpdb->prepare(  $sql ,1,'' ) );
 
    return  $prodCount ;

};
 
 
 
 
 function gravarSolicitacaoContato($nomeAviso,$emailAviso,$postIDP,$variacaoCorP,$variacaoTamanhoP){
     
     
            $postIDP = intval($postIDP);
            
            global $wpdb;
            $tabela = $wpdb->prefix."";
            $tabela .=  "wpstore_contacts"; 
            
            
            $sql = "SELECT count(*) FROM `$tabela` WHERE `emailAviso` = '$emailAviso' AND `postIDP` = '$postIDP' AND `variacaoCorP` = '$variacaoCorP' AND `variacaoTamanhoP` = '$variacaoTamanhoP'  ";

           $prodCount = $wpdb->get_var( $wpdb->prepare(  $sql  ,1,'') );
               
           if  (intval($prodCount)<=0){  
 
           $sql = "INSERT INTO `$tabela` 
                   (`id` ,`nomeAviso` ,`emailAviso` ,`postIDP` ,`variacaoCorP`,`variacaoTamanhoP`)
                   VALUES 
                   ( NULL ,'$nomeAviso','$emailAviso','$postIDP','$variacaoCorP','$variacaoTamanhoP');
            ";

            $resultQuery = $wpdb->query($sql);
            
            echo " Adicionado com Sucesso . Enviaremos um email assim que este produto estiver disponível.";
        }else{
             echo "Solicitação já enviada.Obrigado!";
        }
     
     
 };
 
 
 function criarNovoDesconto($numeroCupom,$tipoDesconto,$valorDesconto,$limite){
     
     $ERRO = "";
     if($numeroCupom=="" || $valorDesconto==""){
         $ERRO = "Preencha Corretamente os dados";
         return $ERRO;
     }else{
         
          global $wpdb;
             $tabela = $wpdb->prefix."";
             $tabela .=  "wpstore_descontos"; 
         
         
         
        $sql = "SELECT *FROM `$tabela`  WHERE `numeroCupom`='$numeroCupom' ORDER BY `ID` DESC LIMIT 0,1";

         $fivesdrafts = $wpdb->get_results($sql);
         
         if(count($fivesdrafts) <=0){
                
                
         $sql = "INSERT INTO `$tabela` 
                    (`id` ,`numeroCupom` ,`tipoDesconto` ,`valorDesconto` ,`limite`)
                    VALUES 
                    ( NULL ,'$numeroCupom','$tipoDesconto','$valorDesconto','$limite');
             ";
             
                   $resultQuery = $wpdb->query($sql);
             
              $MSG = "CUPOM INSERIDO COM SUCESSO";
      
          }else{
               $MSG = "CUPOM JÁ EXISTE"; 
          };
          
         return $MSG ;
          
         
     }
     
     
 };
 
 
 
 
 
 function consultaDesconto($oid ){
       global $wpdb;
       $tabela = $wpdb->prefix."";
       $tabela .=  "wpstore_descontos";
 
       $andQuery="";

       $sql = "SELECT *FROM `$tabela`  WHERE `numeroCupom`='$oid' ORDER BY `ID` DESC LIMIT 0,1";
    
       $fivesdrafts = $wpdb->get_results($sql);
    
       $orderCount = 0;

       return $fivesdrafts;
 };
 
 function get_session_cupom(){
     
         $infoCupom =  explode('***',$_SESSION['cupomDesconto']);
         
         $numeroCupom = $infoCupom[0];
         $tipoDesconto = $infoCupom[1];
         $valorDesconto = $infoCupom[2];
         
         $info = "$numeroCupom***$tipoDesconto***$valorDesconto";
         
         $_SESSION['cupomDesconto'] = $info;
         
         return  $infoCupom ;
 }
 
 
 
 function getCupomInfos($info){
      
       $infoCupom =  explode('***',$info);
       
       $numeroCupom = $infoCupom[0];
       $tipoDesconto = $infoCupom[1];
       $valorDesconto = $infoCupom[2];
       
       return $infoCupom;
};    
 
 
   function addUseCupom($info){
        
         $infoCupom =  explode('***',$info);
  
         $numeroCupom = $infoCupom[0];
         $tipoDesconto = $infoCupom[1];
         $valorDesconto = $infoCupom[2];
         
         global $wpdb;
         $tabela = $wpdb->prefix."";
         $tabela .=  "wpstore_descontos";
         
         $sql = "SELECT  `qtdUsado` FROM `$tabela`  WHERE `numeroCupom`='$numeroCupom' ORDER BY `id` DESC LIMIT 0,1";
         $qtdUsado= intval($wpdb->get_var( $wpdb->prepare( $sql,1,'')));
           
            if($qtdUsado<1){
                 $qtdUsado = 1;
              }else{
                 $qtdUsado += 1;
              };
 
            
            $total = getCupomDisponivel($numeroCupom) - 1;
            
            if($total>=0){
             $sql = "UPDATE `$tabela` SET `qtdUsado` = '$qtdUsado' WHERE `numeroCupom`='$numeroCupom';";
             $resultQuery = $wpdb->query($sql);
            };
            
   
    };
    
    function getCupomDisponivel($numeroCupom){
        
         global $wpdb;
         $tabela = $wpdb->prefix."";
         $tabela .=  "wpstore_descontos";
         
         $sql = "SELECT  `qtdUsado` FROM `$tabela`  WHERE `numeroCupom`='$numeroCupom' ORDER BY `id` DESC LIMIT 0,1";
         $qtdUsado= intval($wpdb->get_var( $wpdb->prepare( $sql,1,'')));

         $sql = "SELECT  `limite` FROM `$tabela`  WHERE `numeroCupom`='$numeroCupom' ORDER BY `id` DESC LIMIT 0,1";
         $qtdLimite= intval($wpdb->get_var( $wpdb->prepare( $sql,1,'')));
      
         
         $total = $qtdLimite - $qtdUsado;
         
         return  $total;
            
            
    };
    
    
    
    
    
    
    function get_subtotal(){
        
        
        $arrayCarrinho ='';   
 
    	    $blogid = intval(get_current_blog_id());  
         	 if($blogid>1){
         	       $arrayCarrinho = $_SESSION['carrinho'.$blogid];
         	 }else{
         	       $arrayCarrinho =  $_SESSION['carrinho'];  
            };
            

        if($arrayCarrinho==""){ $arrayCarrinho = array(); };

         $subtotal = 0;
 
         foreach($arrayCarrinho as $key=>$item){ 

               $postID = intval($item['idPost']);

               if($postID>0){

                   $variacao = $item['variacaoProduto'];
                   if($variacao==""){
                       $variacao="-";
                   }


                  $preco =  custom_get_price( $postID );
                  $specialPrice =  custom_get_specialprice( $postID );
                  $pesoTotal += get_weight_product($postID );

                  if($specialPrice >0){
                  $preco =  $specialPrice;   
                  }

                  $precoSoma = $preco;
                           if(strlen($precoSoma)>6){
                            $precoSoma= str_replace('.','',$precoSoma );
                             }
                             $precoSoma = str_replace(',','.',$precoSoma);   


                                    $precoAdd = get_price_product_variation($postID,$variacao);

                                    //$precoAdddArray = explode('(R$',$precoAdd);
                                    $precoAdddArray = explode('(',$precoAdd);
                                    $sinal = $precoAdddArray[0];
                                    $precoAddF= str_replace(')','',$precoAdddArray[1]);
                                    $precoAddFSoma =  str_replace(',','.',$precoAddF);


                    if($sinal=="-"){
                    $precoSoma = $precoSoma -  $precoAddFSoma;  
                    }elseif($sinal=="+"){
                    $precoSoma = $precoSoma +  $precoAddFSoma;    
                    };   

                  $qtd = intval($item['qtdProduto']);

                  $subtotal += $qtd*$precoSoma;


              };  


        };
        
        
        return $subtotal;
        
    };
    
    
    function get_current_symbol(){
        
        $moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
        if($moedaCorrente==""){
          $moedaCorrente = "R$" ; 
        }
        
        return     $moedaCorrente;
       /* */
    };
    
    
    
    function verifyURL($url){
        
        $ativarssl  =  get_option('ativarsslWPSHOP'); 
        
        if($ativarssl=="sim"){ 
            $url = str_replace('http://','https://',$url);
        };
        
        return $url; 
        
    };
    
    
    function get_parcelaMinima(){
        
        $parcelaMinima=  floatval(str_replace(',','.',get_option('parcelaMinima'))); 
        if($parcelaMinima==""){
           $parcelaMinima = 10.00; 
        }
            $parcelaMinima = number_format( $parcelaMinima,2 ,  ',', '.');
        return $parcelaMinima;
    }
    
    function get_totalParcela(){
        
        $totalParcela=  intval( get_option('totalParcela') ); 
        if($totalParcela==""){
          $totalParcela =  2; 
        };
         return $totalParcela; 
    };
    
    
  
    function add_variation_stock($idPost ,$tipoVariacao,$variacaoProduto ,$qtdProduto,$precoAlternativo,$imgAlternativa ,$precoOperacao){
        
      
           $nomeItem = $variacaoProduto;
 
           global $current_user;

           get_currentuserinfo(); 


          $msgError = "";
          $idUser = $current_user->ID;
          $update = false;
          
          $msg = "";
 
          $user_email =  $current_user->user_email ;
          
          if(intval($current_user->ID)<=0){
               $msgError =  "Permissão Administrativa negada";
          }
          


            if ( current_user_can('edit_post', $idPost) ) {
      
            }else{
     
              $msgError =  "Permissão Administrativa temporariamente indisponível";
     
            }
            
            
            
         
            if(trim( $nomeItem ) == "" && $msgError==""  ){
               $msgError =  "NONAME";
            };

         
         
         
          if($msgError=="" ){

                     global $wpdb; 
                     
                     $tabela = $wpdb->prefix."";
                     $tabela .=  "wpstore_stock";
                      
                     
                     $sql = "SELECT id
                     FROM `$tabela`
                     WHERE `idPost` = '$idPost'
                     AND `variacaoProduto` = '$nomeItem'
                     AND `tipoVariacao` = '$tipoVariacao'
                     LIMIT 0 , 30";
                     
                     $resultQuery =  intval($wpdb->query($sql));
           
               
                     if($resultQuery==0){
                         
                     $sql = "INSERT INTO `$tabela` (
                       `id` ,
                       `idPost` ,
                       `tipoVariacao` ,
                       `variacaoProduto` ,
                       `qtdProduto` ,
                       `precoAlternativo` ,
                       `imgAlternativa` ,
                        `precoOperacao`
                        ) VALUES ( NULL , '$idPost', '$tipoVariacao', '$nomeItem', '$qtdProduto', '$precoAlternativo', '$imgAlternativa', '$precoOperacao' );";
               
                         $msg = "Adicionado com Sucesso!";
                          
                     }else{
                         
                         $sql = "UPDATE `$tabela` SET 
                         `qtdProduto` = '$qtdProduto', 
                         `precoOperacao` = '$precoOperacao',
                         `precoAlternativo` = '$precoAlternativo',
                         `imgAlternativa` = '$imgAlternativa',
                         `precoOperacao` = '$precoOperacao'  WHERE  `idPost` = '$idPost' AND  `variacaoProduto` = '$nomeItem' AND `tipoVariacao` = '$tipoVariacao' ;";
                         $msg = "Atualizado com Sucesso!";
                           
                     };
                     
                     
                     
       
                     $resultQuery = $wpdb->query($sql);
                     
                     
                       if($msg =="Adicionado com Sucesso!"){
                          $msg = $wpdb->get_col("SELECT `id` FROM `$tabela`  WHERE `idPost`='$idPost' ORDER BY `id` DESC LIMIT 0 , 1" );
                          $msg = intval($msg[0]);
                       };
                        
                        
   
                
                     
                     
         };

		
			if( $msgError =="" ) {
	 
			return $msg;
			
			}else{
			    
		    return " OPS :  $msgError ";	    
		    
			};
			
        
        
        
        
    }; //final function add variation stock
    
    
    
    
    
    
    function add_orderby_stock( $item ,  $order){

        
             global $wpdb; 

             $tabela = $wpdb->prefix."";
             $tabela .=  "wpstore_stock";

             $order = intval($order); 
             $item = intval($item); 

             //echo "$order-$item<br/>";

             $sql = "UPDATE `$tabela` SET  `showOrder`='$order'  WHERE `id` ='$item'; ";

             $resultQuery =  $wpdb->query("$sql");
         
           //return  $resultQuery;

      }

    
    
      
    
    //GERT STASTUS PEDIDO ---------------------------
    
    
    function getStatusPedido($idPedido){
        global $wpdb;
        $tabela = $wpdb->prefix."";
        $tabela .=  "wpstore_orders";
        $query = "SELECT `status_pagto`  FROM `$tabela` WHERE   `id_pedido` = '$idPedido' ";
        $status= $wpdb->get_var($query);
        return  $status ;
    };
    
    //GET STASTUS PEDIDO -----------------------
    
    
    //FUNCAO ALTERA STATUS PEDIDO --------------------------------------------------------

    function alteraPedidoStatus($orderComplete,$status="",$comentario,$comentario2='',$comentario3=''){

                global $wpdb;
               $tabela = $wpdb->prefix."";
               $tabela .=  "wpstore_orders";
              //INICIO Insere  no total de Inscrições da Etapa     

              $data = gmdate('d').'/'.gmdate('m').'/'.gmdate('Y');
              
                   if($status==""){
                   $status =  $_POST['statusID']; 
                   };
                   
                   $tabela = $wpdb->prefix."";
                   $tabela .=  "wpstore_orders";
                   
                          $resultQuery = $wpdb->query("UPDATE `$tabela` SET `status_pagto` = '$status' WHERE `id_pedido` = '$orderComplete' ");

                          $tabela = $wpdb->prefix."";
                          $tabela .=  "wpstore_orders_comments";

                          $sql="INSERT INTO `$tabela` (`id` ,`id_pedido` , `comentario_cliente` ,`comentario_admin` ,`comentario_pagt` ,`status_pagto`,`data`
                          )VALUES (
                          NULL , '$orderComplete', '$comentario','$comentario2', '$comentario3','$status', '$data'
                          );";


                          if($orderComplete !=""){
                          $resultQuery = $wpdb->query("$sql");
                           enviaEmailStatus($orderComplete);
                          };


             //FINAL insere  no total de Inscrições da Etapa

    };

    //FINAL FUNCAO ALTERA STATUS PEDIDO ---------------------------------------------------



    
    function enviaEmailStatus($orderComplete){
        
        
        // ENVIO DE EMAIL ----------------------------------------------------------
           $arrInfoOrder = explode('.',$orderComplete);
           $idUser = $arrInfoOrder[0];
           
           $user_info = get_userdata($idUser);
    
           $user_email =  $user_info->user_email;
           
           $nome = "$user_info->user_lastname $user_info->user_firstname ($user_info->user_login)";

    	   $header = "<div style='width:100%;padding:5px;background:#15829D;margin-bottom:20px'><a href='".get_bloginfo('url')."'><img src='".$plugin_directory."images/topo-email.png' /></a></div>";

           $footer = "<div style='width:100%;padding:5px;background:#0A2A35;margin-top:20px'><a href='".get_bloginfo('url')."'><img src='".$plugin_directory."images/footer-email.png'/></a></div>";



           $idLogin = get_idPaginaLogin();
           $pageLogin = get_permalink($idLogin);


           $mensagemEmail = "
              <h1>Olá $nome,  </h1> 
              <p>Seu produto  teve o Status atualizado em nosso sistema. <br/> <strong> ".get_bloginfo('name')." </strong> ! Obrigado por comprar conosco.</p>
              <p>Para acessar sua conta  siga <a href='".$pageLogin."' >".$pageLogin."</a> . </p>   ";



             $mensagemEmailOrder = custom_get_order_user(false,$orderComplete,'off');

             $mensagemEmail .=  $mensagemEmailOrder ; 

              $mensagemEmail2 = "
                    <h1>Olá Administrador ,  </h1> 
                    <p>Modificação em STATUS DE PEDIDO . <strong>".get_bloginfo('name')."</strong>.</p>
                     <p>usuario : $user_email <br/>  Nome : $nome <br/>  </p>
                    <p>Para administrar faça o login em  <a href='".$pageLogin."' >".$pageLogin."</a> . </p> 
                    ";

             $mensagemEmail2 .=  $mensagemEmailOrder ;       

            $assuntoEmail = "Atualização PEDIDO : ".get_bloginfo('name')."";
            $assuntoEmail2 = "Atualização PEDIDO  :  ".get_bloginfo('name')."";
 
            include('email.php');
            

    // FINAL ENVIO DE EMAIL ----------------------------------------------------------
    
    };
    
         
    
    
    
          function custom_get_logo(){
		          $logoSiteWPSHOP = get_option('logoSiteWPSHOP');     
		          if($logoSiteWPSHOP==""){
		          }
		          return $logoSiteWPSHOP;
		     }
		     
		     
    
    
    
    //FIND IDPAGE  MEUS DADOS ------------------------------
    function get_idPaginaPerfil(){
    $idPagina   =  intval(trim(get_option('idPaginaPerfilWPSHOP')));
    
    if( $idPagina<= 0){
    global $wpdb;
    $shortcode = '[get_edit_form_perfil]';
    $query = "SELECT `ID`  FROM `$wpdb->posts` WHERE `post_content` LIKE '$shortcode' AND `post_type` = 'page' LIMIT 0,1";
    $idPagina = $wpdb->get_var($query);
    
    };
    return intval($idPagina);
    };
    //END FIND IDPAGE  MEUS DADOS ------------------------------
    
    
    //FIND IDPAGE  CHECKOUT ------------------------------
    function get_idPaginaCheckout(){
    $idPagina   =  intval(trim(get_option('idPaginaCheckoutWPSHOP')));
    
    if(  $idPagina<= 0 ){
    global $wpdb;
    $shortcode = '[custom_get_checkout]';
    $query = "SELECT `ID`  FROM `$wpdb->posts` WHERE `post_content` LIKE '$shortcode' AND `post_type` = 'page' LIMIT 0,1";
     $idPagina   = $wpdb->get_var($query);
    
    };
    return intval($idPagina);
    };
    //END FIND IDPAGE CHECKOUT------------------------------
    
     
    //FIND IDPAGE  LOGIN------------------------------
    function get_idPaginaLogin(){
    $idPagina   =  intval(trim(get_option('idPaginaLoginWPSHOP')));
    
    if(  $idPagina <= 0 ){
    global $wpdb;
    $shortcode = '[get_Login_form]';
    $query = "SELECT `ID`  FROM `$wpdb->posts` WHERE `post_content` LIKE '$shortcode' AND `post_type` = 'page' LIMIT 0,1";
    $idPagina   = intval($wpdb->get_var($query));
    
    };
    return $idPagina;
    };
    //END FIND IDPAGE LOGIN------------------------------
  
  
  
  
    //FIND IDPAGE CARRINHO------------------------------
    function get_idPaginaCarrinho(){
    $idPagina   =  intval(trim(get_option('idPaginaCarrinhoWPSHOP')));
    
    if(  $idPagina <= 0){
    global $wpdb;
    $shortcode = '[get_cart_Table]';
    $query = "SELECT `ID`  FROM `$wpdb->posts` WHERE `post_content` LIKE '$shortcode' AND `post_type` = 'page' LIMIT 0,1";
    $idPagina   = $wpdb->get_var($query);
    
    };
    return intval($idPagina);
    };
    //END FIND IDPAGE CARRINHO-----------------------------
    
    
    
    //FIND IDPAGE pagamento------------------------------
    function get_idPaginaPagamento(){
    $idPagina   =  intval(trim(get_option('idPaginaPagtoWPSHOP')));
    
    if(  $idPagina <= 0 ){
    global $wpdb;
    $shortcode = '[get_payment_checkout]';
    $query = "SELECT `ID`  FROM `$wpdb->posts` WHERE `post_content` LIKE '$shortcode' AND `post_type` = 'page' LIMIT 0,1";
     $idPagina   = $wpdb->get_var($query);
    
    };
    return intval($idPagina);
    };
    //END FIND IDPAGE pagamento-----------------------------
  
   
   
    //FIND IDPAGE pedido------------------------------
    function get_idPaginaPedido(){
        
    $idPagina   =  intval(trim(get_option('idPaginaPedidoWPSHOP')));
    
    if(  $idPagina <= 0 ){
    global $wpdb;
    $shortcode = '[custom_get_order_user]';
    $query = "SELECT `ID`  FROM `$wpdb->posts` WHERE `post_content` LIKE '$shortcode' AND `post_type` = 'page' LIMIT 0,1";
    $idPagina   = $wpdb->get_var($query);  
    echo "ID-$idPagina-DI";
    };
    return intval($idPagina);    
    
    };
    //END FIND IDPAGE pedido-----------------------------
    
   
   
    //FIND IDPAGE pedidos------------------------------
      function get_idPaginaPedidos(){
      $idPagina   =  intval(trim(get_option('idPaginaPedidosWPSHOP')));

      if(  $idPagina <= 0 ){
      global $wpdb;
      $shortcode = '[custom_get_orders_user]';
      $query = "SELECT `ID`  FROM `$wpdb->posts` WHERE `post_content` LIKE '$shortcode' AND `post_type` = 'page' LIMIT 0,1";
       $idPagina   = $wpdb->get_var($query);

      };
      return intval($idPagina);
      };
      //END FIND IDPAGE pedidos-----------------------------
   
   


    //FIND IDPAGE pedidos------------------------------
      function get_idPaginaTermos(){
      $idPagina   =  intval(trim(get_option('idPaginaTermosWPSHOP')));

      if(  $idPagina <= 0 ){
      global $wpdb;
      $shortcode = '[custom_get_termos]';
      $query = "SELECT `ID`  FROM `$wpdb->posts` WHERE `post_content` LIKE '$shortcode' AND `post_type` = 'page' LIMIT 0,1";
       $idPagina   = $wpdb->get_var($query);

      };
      return intval($idPagina);
      };
      //END FIND IDPAGE pedidos-----------------------------     
      
      
      
            function get_txtComprarBtProduto(){
                     $txtComprarBtProduto= get_option('txtComprarBtProdutoWPSHOP');   
                    if( $txtComprarBtProduto==""){
                       $txtComprarBtProduto= "Comprar"; 
                    }
                    return $txtComprarBtProduto;
             };
             
             
             
     
 
?>