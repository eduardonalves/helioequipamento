<?php 
require("../../../../../wp-load.php");

 
 $qtdCarrinho =  custom_get_qtd_items_Cart();
 
// echo $qtdCarrinho;
 
 $postID = intval($_POST['postID']);
 $tamanho = trim($_POST['variacaoTamanho']); 
 $cor = trim($_POST['variacaoCor']);
 $qtdProduto = intval($_POST['qtdProduto']);
 if($qtdProduto<=0){
     $qtdProduto = 1;
 }  

 $qtdStock = custom_get_qtd_stock($postID,$cor,$tamanho); 
 
 $check = intval(get_post_meta($postID,'is_check_outofstock',true));       
 
 if($check===1){
      $qtdStock = 1000000000;
 } ;
 

 $qtdVendida = custom_get_qtd_vendida( $postID , trim(str_replace(' ','',$cor)) , trim(str_replace(' ','',$tamanho)) );

$qtdStock -= $qtdVendida;

$qtdStock -= $qtdProduto;
      
 
//$qtdStock =1;   



if( $qtdStock > 0 ){
    
    $qtdCarrinho +=$qtdProduto;

    $variacaoCor = trim( str_replace(' ','',$tamanho) )."-".trim( str_replace(' ','',$cor) );
   
    if($cor==""){
      $variacaoCor = $tamanho;
    }elseif($tamanho==""){
       $variacaoCor= $cor;
    };
    
   
   $incluso = false;
   
   
   $arrayCarrinho ="";  
   
   $blogid = intval(get_current_blog_id());  
   		if($blogid>1){$arrayCarrinho = $_SESSION['carrinho'.$blogid];}else{  $arrayCarrinho = $_SESSION['carrinho'];  };
   
   

   if($arrayCarrinho==""){ $arrayCarrinho = array(); };
   
  //print_r($arrayCarrinho);
   
   $countA = 0;
   
   $qtdPrev = 0; 
   
   $qtdPrd = 0;
   $chaveItem = "";
   
   foreach($arrayCarrinho as $key=>$item){
       $countA +=  1;
       
      if( $item['prodString'] == trim($postID.$variacaoCor) ){
          $incluso = true; 
          $qtdPrev = intval($item['qtdProduto']);
          
          $qtdPrd = $qtdPrev+$qtdProduto;
          $chaveItem = $key;
    
      }; 
   }
   
   
   
    $precoAdd = get_price_product_variation($postID,$variacaoCor);
    if($precoAdd !=""){$precoAdd = "Variação de Preço:".$precoAdd."<br/>";};
    
   
    if (  $incluso ==true  ) {
                 //$_SESSION['carrinho'] = array();
              
                 $arrayCarrinho[$key]['idPost'] = $postID;
                 $arrayCarrinho[$key]['prodString'] = trim($postID.$variacaoCor);
                 $arrayCarrinho[$key]['variacaoProduto'] = $variacaoCor;
                 $arrayCarrinho[$key]['qtdProduto'] =  $qtdPrd;
                 $blogid = intval(get_current_blog_id()); 
                 if($blogid>1){     $_SESSION['carrinho'.$blogid] = $arrayCarrinho;           }else{       $_SESSION['carrinho'] = $arrayCarrinho;          }; 
                 
                 
                // echo ''.$precoAdd.'<span style="color:red">'.$qtdPrd.' - Este produto   foi adicionado recentemente a sua lista.</span><br/><br/><a href="'.get_bloginfo('url').'/checkout/" class="btGO">Seguir para Pagamento</a>  <br/><br/>  <a href="'.get_bloginfo('url').'/carrinho/" class="btGO" >Ver Carrinho</a>';
                echo verifyURL( get_permalink( get_idPaginaCheckout() ) ); 
    }else{
             $countA = $qtdCarrinho+1;
             $arrayCarrinho[$countA]['idPost'] = $postID;
             $arrayCarrinho[$countA]['prodString'] = trim($postID.$variacaoCor);
             $arrayCarrinho[$countA]['variacaoProduto'] = $variacaoCor;
             $arrayCarrinho[$countA]['qtdProduto'] =  $qtdProduto;
           
             
 
               $blogid = intval(get_current_blog_id()); 
             if($blogid>1){     $_SESSION['carrinho'.$blogid] = $arrayCarrinho;           }else{       $_SESSION['carrinho'] = $arrayCarrinho;          }; 


              //echo ''.$precoAdd.'<span style="color:green">Adicionado com sucesso!</span> <br/><br/><a href="'.get_bloginfo('url').'/checkout/" class="btGO" >Seguir para Pagamento</a> <br/><br/> <a href="'.get_bloginfo('url').'/carrinho/" class="btGO">Ver Carrinho</a>';
              echo verifyURL( get_permalink( get_idPaginaCheckout() ) );  
    };
    
    

}else{
echo '1';
};
 
?> 