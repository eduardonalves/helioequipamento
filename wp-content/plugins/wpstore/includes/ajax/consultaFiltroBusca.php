<?php 
require("../../../../../wp-load.php");

 
 $dirname = dirname(__FILE__);
 $dirname = str_replace('ajax','functions',$dirname);
 $tipoSkinShop = get_option('tipoSkinShop');
 
 $tema = trim($_POST['temaV']);
 
 $currentCat = trim($_POST['currentCatV']);
  
 $paged = intval(1);
 $cat =  intval($tema);
 $currentCat = intval($currentCat);

 
 $tamanho = trim($_POST['tamanhoV']);
 $cor = trim($_POST['corV']);
 

 
 //variacao -------------------------------------
 
 $variacao = "$tamanho-$cor";
 if($tamanho=='todos' && $cor=='todos'){
  $variacao = "";    
 }elseif($tamanho=='todos'){
 $variacao = "$cor";    
 }elseif($cor=='todos'){
  $variacao =  "$tamanho";     
 };
 
 $arrayIds = array();
 
 if($variacao !=""){
     
            global $wpdb; 
             $contagem = 0;
       
             $tabela = $wpdb->prefix."";
             $tabela .=  "wpstore_stock";

             $sql = "SELECT * FROM `$tabela` WHERE  `variacaoProduto`='$variacao' ORDER BY `variacaoProduto` ASC";

             $fivesdraftsCor = $wpdb->get_results( $sql); 

            foreach ( $fivesdraftsCor as $fivesdraftC ){
  
                $idPost = $fivesdraftC->idPost; 
        
                 $arrayIds[] = $idPost;
                 
              
     
            };
          
 };
 
 
  
  
if($tema =="todos"){

   if($currentCat>0){
        query_posts( array( 'cat' => $currentCat, 'posts_per_page' => 10, 'paged' => "$paged", 'post_type' => 'produtos' ) );  
   }else{echo"CCC";
       query_posts( "posts_per_page=10&paged=$paged&post_type=produtos");
   };
   
}else{
 
   if($currentCat>0){
    $arrayCat =  array($cat,$currentCat);
    query_posts( array( 'category__and' => $arrayCat, 'posts_per_page' => 10, 'paged' => "$paged", 'post_type' => 'produtos' ) );
   }else{
     query_posts( "posts_per_page=10&cat=$cat&paged=$paged&post_type=produtos");    
   };
   
}

?>
    
<?php $cont = 0; while ( have_posts() ) : the_post(); $cont+=1; ?>
<?php 


$ajaxFiltro = true;
 $tipoSkinShop = get_option('tipoSkinShop');
if($tipoSkinShop=="DARK"){
  include($dirname."/layout/listagem-dark.php");   
}else{
 include($dirname."/layout/listagem.php");    
}

?>
<?php endwhile; ?>