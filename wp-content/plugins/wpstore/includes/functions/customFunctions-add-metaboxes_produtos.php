<?php
 
 
 $moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
 if($moedaCorrente==""){
   $moedaCorrente = "R$" ; 
 }


$meta_boxes_produtos = array(
    
 "preço" => array(
 "name" => "price",
 "title" => "Preço do produto",
 "description" => "É o preço  do produto em moeda corrente ($moedaCorrente ) . Ex:49,00 . "),

 "preço Promocional" => array(
 "name" => "specialprice",  
 "title" => "Preço promocional do produto",
 "description" => "É o preço em promoção do produto em moeda corrente ($moedaCorrente ) . Ex:29,90 . "),


 
 "Estoque" => array(
  "name" => "is_check_outofstock",
  "title" => "Definir se  estoque do produto é ilimitado ",
  "description" => " Clique para definir como ilimitado. Desativa controle de estoque para o produto."),


 
 

  "Estoque total" => array(
  "name" => "initstock",
  "title" => "Quantidade de estoque Total (Total de unidades)",
  "description" => "Somente necessário para o controle de produtos que não possuem variações de cor e/ou tamanho. Neste caso, defina acima a quantidade de unidades disponível em estoque."),





 "tamanho" => array(
 "name" => "size",
 "title" => "Definir Tamanhos do produto",
 "description" => "Separe por virgulas. Ex: 36,38,40 "),



 "cor" => array(
 "name" => "color",
 "title" => "Definir cores do produto",
 "description" => "Separe por virgulas. Ex: Verde,Azul,Amarelo"),
 

 
 /*
 "estoque Tamanho" => array(
 "name" => "size_stock",
 "title" => "Variação de estoque do produto (tamanho) ",
 "description" => "Separe por virgulos. Ex: 2pp,0p,0m,2g,2gg,2exg "),
 
 
 "estoque Cor" => array(
 "name" => "color_stock",
 "title" => "Variação de estoque do produto (cor)",
 "description" => "Separe por virgulos. Ex: 2Verde,2Azul,1Amarelo,0Rosa "),
 */
 
 

 
  "Controle de Estoque  ( Tamanho X Cor )  " => array(
  "name" => "color_stock",
  "title" => "Controle do estoque  através  da quantidade  de unidades disponíveis  para  cada  combinação de cada  Tamanho e  Cor.",
  "description" => "Separe por virgulas os blocos de cada variação .  quantidade-cor-tamanho <br/> Ex: 2-Verde-36,2-Verde-38,1-Amarelo-40,0-Azul-40... "),

 
 
 "Alerta de estoque" => array(
 "name" => "minstock",
 "title" => "Receber aviso quando variação de estoque chegar ao limite mínimo",
 "description" => " Ex:  3"),
 
 

 "Mostrar Estoque" => array(
 "name" => "isshowstock",
 "title" => "Mostrar quantidade de estoque ao usuário. ",
 "description" => " Ex:  1 = não adicionar,  0 = Segue configuração geral definida. "),
 
 
 

 "Peso" => array(
 "name" => "weight",
 "title" => "peso do Produto",
 "description" => "Peso do produto em Kg. Ex : 0.1 = 100 gramas "),
 
 
 "Marca do Produto" => array(
 "name" => "marca",
 "title" => "Marca do produto ",
 "description" => "  Ex: Nokia "),
 
                     
 "SKU" => array(
 "name" => "sku",
 "title" => " Numero global de item comercial. ",
 "description" => " Nesse atributo, deve ser incluído o GTIN (Número global de item comercial) do seu produto. Esses identificadores incluem o UPC (na América do Norte), o EAN (na Europa), o JAN (no Japão) e o ISBN (para livros). É possível incluir qualquer um desses valores nesse atributo. "),
 
 
 "Código de Fabricação" => array(
 "name" => "codFab",
 "title" => "Código de Fabricação ",
 "description" => " Este código identifica o  produto  para o fabricante  .  "),
 
 
 "textoGarantia" => array(
 "name" => "textoGarantia",
  "title" => "Garantias do produto",
 "description" => "É o texto  adicional  sobre garantias e suporte p/ do  produto. "),
 
 "Código Afiliado" => array(
 "name" => "affiliate_link",
  "title" => "Link Afiliado",
 "description" => "É o código para reconhecimento de link afiliado. "),
 
 
 "banner" => array(
 "name" => "banner",
  "title" => "Link de Imagem p/ banner",
 "description" => "É a url da imagem desejada para ser destaque do banner .Ex: http://....jpg"),
 
 "linkRelacionado" => array(
 "name" => "linkRelacionado",
  "title" => "É a url do produto desejado para ser o link relacionado específico ",
 "description" => "separe o ID de cada post por virgula. .Ex: 1030,1020 "),
 
 
);



$arrayTamanhos = array();
$arrayCores = array();
$arrayCoresImg = array();

 
function save_meta_box_produtos( $post_id ) {
    
global $post, $meta_boxes_produtos, $key;

  save_stock_produto($post_id );
 
foreach( $meta_boxes_produtos as $meta_box ) {
  
  $varUp = $_POST[ $meta_box[ 'name' ] ];
  
  if($varUp != ""  ){
      
      if($meta_box[ 'name' ]=='price'){ 
          $priceCompare =   str_replace('.','', $varUp);
          $priceCompare =   str_replace(',','', $priceCompare); 
          update_post_meta( $post_id, 'priceCompare' , $priceCompare );    
      }
      
      if($meta_box[ 'name' ]=='specialprice'){ 
            $priceCompare =   str_replace('.','', $varUp);
            $priceCompare =   str_replace(',','', $priceCompare); 
            update_post_meta( $post_id, 'specialpriceCompare' , $priceCompare );    
        } 
      
      
  update_post_meta( $post_id, $meta_box[ 'name' ] , $varUp );   
  
  };  
  
}
 
if ( !wp_verify_nonce( $_POST[ $key . '_wpnonce' ], plugin_basename(__FILE__) ) )
return $post_id;
 
if ( !current_user_can( 'edit_post', $post_id ))
return $post_id;
 
};
 
add_action( 'admin_menu', 'create_meta_box_produtos' );

add_action( 'save_post', 'save_meta_box_produtos' );

 

function  save_stock_produto($post_id ){
    
    
    foreach ($_POST as $param_name => $param_val) {
        
            
             global $wpdb; 

              $tabela = $wpdb->prefix."";
              $tabela .=  "wpstore_stock";
              
              
            //COR -------------------------------------------
            
            
            
             if(  strpos($param_name,'corImagem')  !== false    ){
                    $id = str_replace('corImagem','',$param_name);
              
                    $sql = "UPDATE `$tabela` SET  `imgAlternativa` = '$param_val' WHERE  `id` = '$id' AND `idPost` = '$post_id'   ;";
              };
            
            
            
              if(  strpos($param_name,'corSymbol')  !== false    ){
                    $id = str_replace('corSymbol','',$param_name);
              
                    $sql = "UPDATE `$tabela` SET  `precoOperacao` = '$param_val' WHERE  `id` = '$id' AND `idPost` = '$post_id'   ;";
              };
           
           
           
              if(  strpos($param_name,'corValor')    !== false      ){
                   $id = str_replace('corValor','',$param_name);
              
                   $sql = "UPDATE `$tabela` SET  `precoAlternativo` = '$param_val'   WHERE  `id` = '$id' AND `idPost` = '$post_id'   ;";
              };
              
              
              
              
              if(  strpos($param_name,'corQtd')    !== false    ){
                   $id = str_replace('corQtd','',$param_name);
                
                   $sql = "UPDATE `$tabela` SET  `qtdProduto` = '$param_val' WHERE  `id` = '$id' AND `idPost` = '$post_id'   ;";
              };
                      
             
             
              if(   strpos($param_name,'corEdit')  !== false    ){
                   $id = str_replace('corEdit','',$param_name);
  
                   $sql = "UPDATE `$tabela` SET  `imgAlternativa` = '$param_val'  WHERE  `id` = '$id' AND `idPost` = '$post_id'   ;";
               };
                       
                       
            //TAMANHO --------------------------------------------------
            
            
            
            if(  strpos($param_name,'tamanhoSymbol')  !== false   ){
               
                  $id = str_replace('tamanhoValor','',$param_name);
                  $sql = "UPDATE `$tabela` SET  `precoOperacao` = '$param_val' WHERE  `id` = '$id' AND `idPost` = '$post_id'   ;";
            };
         
         
         
            if(  strpos($param_name,'tamanhoValor')  !== false    ){
     
                 $id = str_replace('tamanhoValor','',$param_name);
                 $sql = "UPDATE `$tabela` SET  `precoAlternativo` = '$param_val'   WHERE  `id` = '$id' AND `idPost` = '$post_id'   ;";
            };
            
            
            
            
            if(  strpos($param_name,'tamanhoQtd')  !== false   ){
           
                 $id = str_replace('tamanhoQtd','',$param_name);
                 $sql = "UPDATE `$tabela` SET  `qtdProduto` = '$param_val' WHERE  `id` = '$id' AND `idPost` = '$post_id'    ;";
            };
                    
           
           
            if( strpos($param_name,'tamanhoEdit')  !== false   ){
        
                 $id = str_replace('tamanhoEdit','',$param_name);
                 $sql = "UPDATE `$tabela` SET  `imgAlternativa` = '$param_val'  WHERE  `id` = '$id' AND `idPost` = '$post_id'   ;";
             };


            //TAMANHO & COR ----------------------------------------------     
            
             

                  if( strpos($param_name,'tamanhoCorSymbol')  !== false   ){

                          $nomeItem = trim(str_replace('tamanhoCorSymbol','',$param_name));


                                          $sql = "SELECT id FROM `$tabela`  WHERE `idPost` = '$post_id' AND `variacaoProduto` = '$nomeItem' AND `tipoVariacao` = 'tamanhoCor' LIMIT 0 , 30";

                                           $resultQuery =  intval($wpdb->query($sql));

                                           if($resultQuery==0){

                                           $sql = "INSERT INTO `$tabela` ( `id` , `idPost` , `tipoVariacao` , `variacaoProduto` , `precoOperacao` ) VALUES ( NULL , '$post_id', 'tamanhoCor', '$nomeItem', '$param_val'  );";

                                           }else{

                                            $sql = "UPDATE `$tabela` SET  `precoOperacao` = '$param_val'  WHERE  `variacaoProduto` = '$nomeItem' AND `idPost` = '$post_id'  AND  `tipoVariacao` ='tamanhoCor'  ;";

                                           };


                      };
                      
                 
                 
                       if( strpos($param_name,'tamanhoCorValor')  !== false   ){

                               $nomeItem = trim(str_replace('tamanhoCorValor','',$param_name));


                                               $sql = "SELECT id FROM `$tabela`  WHERE `idPost` = '$post_id' AND `variacaoProduto` = '$nomeItem' AND `tipoVariacao` = 'tamanhoCor' LIMIT 0 , 30";

                                                $resultQuery =  intval($wpdb->query($sql));

                                                if($resultQuery==0){

                                                $sql = "INSERT INTO `$tabela` ( `id` , `idPost` , `tipoVariacao` , `variacaoProduto` , `precoAlternativo` ) VALUES ( NULL , '$post_id', 'tamanhoCor', '$nomeItem', '$param_val'  );";

                                                }else{

                                                 $sql = "UPDATE `$tabela` SET  `precoAlternativo` = '$param_val'  WHERE  `variacaoProduto` = '$nomeItem' AND `idPost` = '$post_id'  AND  `tipoVariacao` ='tamanhoCor'  ;";

                                                };


                       };
                       
                       
                       
                       
                       if( strpos($param_name,'tamanhoCorQtd')  !== false   ){

                            $nomeItem = trim(str_replace('tamanhoCorQtd','',$param_name));


                                            $sql = "SELECT id FROM `$tabela`  WHERE `idPost` = '$post_id' AND `variacaoProduto` = '$nomeItem' AND `tipoVariacao` = 'tamanhoCor' LIMIT 0 , 30";

                                             $resultQuery =  intval($wpdb->query($sql));

                                             if($resultQuery==0){

                                             $sql = "INSERT INTO `$tabela` ( `id` , `idPost` , `tipoVariacao` , `variacaoProduto` , `qtdProduto` ) VALUES ( NULL , '$post_id', 'tamanhoCor', '$nomeItem', '$param_val'  );";

                                             }else{

                                              $sql = "UPDATE `$tabela` SET  `qtdProduto` = '$param_val'  WHERE  `variacaoProduto` = '$nomeItem' AND `idPost` = '$post_id'  AND  `tipoVariacao` ='tamanhoCor'  ;";

                                             };


                        };



                           
                           
                
                      $resultQuery = $wpdb->query($sql);
        
        
        
    }; //function foreach post -------------
    
    
}; //function save stock 


function display_meta_box_produtos() {
global $post, $meta_boxes_produtos, $key;
?>



<style>

 
	 .tbborder {border: 1px solid #C0C0C0;}
	 table {background: #EAF3FA;}
	.form-wrap label
	{
		display:inline;
		font-weight:bold;
	}
	
	
 .itemStock { background:#eee; border-bottom:1px dotted #ccc;padding:10px;margin:10px }
 
 
 ul.controleEstoque  { width:80% }
 
 ul.controleEstoque li { background:#eee;border:1px solid #ccc , float:left , padding:10px; margin-left:5px; }


</style>
	
	
 

<script type="text/javascript" src="<?php echo  plugins_url('wpstore/includes/js/datepicker.js' ,'WP STORE' ); ?>"></script>

<script type="text/javascript" src="<?php  echo  plugins_url('wpstore/includes/js/jquery.price_format.1.7.js' ,'WP STORE' );  ?>"></script> 

<link type="text/css" rel="stylesheet" href="<?php  echo  plugins_url('wpstore/includes/js/jquery-miniColors/jquery.miniColors.css' ,'WP STORE' );  ?>" />

<script type="text/javascript" src="<?php  echo  plugins_url('wpstore/includes/js/jquery-miniColors/jquery.miniColors.min.js' ,'WP STORE' );  ?>"></script>



 
<div class="form-wrap">


 
<?php

//wp_nonce_field( plugin_basename( __FILE__ ), $key . '_wpnonce', false, true );
 
 
foreach($meta_boxes_produtos as  $keyA => $meta_box) {
    
$data = get_post_meta($post->ID, $key, true);

?>
 
<div class="form-field form-required">

 
<h3 > <span><?php echo $keyA; ?></span> </h3>

      <br/>
    
<label for="<?php echo $meta_box[ 'name' ]; ?>"> <?php echo $meta_box[ 'title' ]; ?></label>

<?php if($meta_box[ 'name' ]=="color"  ){
    
      $nome = "cor";  
    
      echo "<h4 class='btShow' rel='$nome' style='background:#eee;border:1px solid #ddd;padding:5px;cursor:pointer;width:110px' >Editar Cores</h4>";
    
      echo "<div class='estoque container$nome' style='display:none'> ";
      
                  $qtd = 0;
                  
             $corAlt ="#F4F4F4"; 
                  
     ?>
     

   <br/> <br/>
   <p><strong> Adicionar <?php echo $nome; ?> :</strong></p>
   
   <p class='itemStock  <?php echo $nome; ?>' style="background:#ddd" >Nome <?php echo $nome; ?>: <input type='text' name='<?php echo $nome; ?>Nome' id="<?php echo $nome; ?>Nome"  style="width:100px" />  
    Diferença de Preço : <select name="<?php echo $nome; ?>Symbol" id="<?php echo $nome; ?>Symbol" ><option>+</option><option>-</option></select>  
      <?php echo $moedaCorrente; ?> <input type='text'  class="preco" name='<?php echo $nome; ?>Valor' value="0.00" id="<?php echo $nome; ?>Valor" style="width:60px"/>
      COR/IMAGEM: <span style="position:relative;">  <input type='text' class="cor"  name='<?php echo $nome; ?>Imagem' id="<?php echo $nome; ?>Imagem"  style="width:80px"  value="<?php echo $corAlt; ?>"/>  </span>
      QTD:<input type='text'  class="qtd" name='<?php echo $nome; ?>Qtd' value="<?php echo $qtd; ?>" id="<?php echo $nome; ?>Qtd" style="width:30px"/>
       <input type="button" id="<?php echo $nome; ?>Add" name="<?php echo $nome; ?>Add" style="width:110px" value="Adicionar <?php echo $nome; ?>"  class="addITem" rel='cor' />
   </p>
   
   <p class="msg"></p>
   <p class="carregando"></p>
   
   
 
   
   <br/>
   <p><strong> Cores Cadastradas : </strong></p>
 <br/>
   <div id="corCadastrado">
   
   
   
        <?php 

              global $wpdb; 
      

              $tabela = $wpdb->prefix."";
              $tabela .=  "wpstore_stock";

             $sql = "SELECT * FROM `$tabela` WHERE  	`idPost` = '$post->ID' AND  `tipoVariacao` = 'cor' ORDER BY `showOrder` ASC  LIMIT 0 , 100";
 
             $fivesdraftsCor = $wpdb->get_results( $sql);

             foreach ( $fivesdraftsCor as $fivesdraftC ){
                  
                 $arrayCores[] = $fivesdraftC->variacaoProduto; 
                 $arrayCoresImg[] = $fivesdraftC->imgAlternativa; 
                            
                   $preco = $fivesdraftC->precoAlternativo;

                    if(trim($preco)==""){
                        $preco = 0.00;
                    }
                    
                        $qtd = intval($fivesdraftC->qtdProduto);
                        
                        $corImagem = $fivesdraftC->imgAlternativa;
                        
                        if($corImagem==""){
                            $corImagem = "F4F4F4";
                        }
             ?>
             	
             
   
       <p     class='itemStock <?php echo $fivesdraftC->id; ?>'  rel='<?php echo $fivesdraftC->id; ?>' >Nome <?php echo $nome; ?>: <input type='text' name='<?php echo $nome; ?>Nome<?php echo $fivesdraftC->id; ?>' id="<?php echo $nome; ?>Nome<?php echo $fivesdraftC->id; ?>"  value="<?php echo $fivesdraftC->variacaoProduto; ?>" style="width:100px" />  
           Diferença de Preço : <select name="<?php echo $nome; ?>Symbol<?php echo $fivesdraftC->id; ?>" id="<?php echo $nome; ?>Symbol<?php echo $fivesdraftC->id; ?>" ><option>+</option><option <?php if($fivesdraftC->precoOperacao=="-"){ echo 'selected'; }; ?> >-</option></select>  
           <?php echo $moedaCorrente; ?> <input type='text'  class="preco" name='<?php echo $nome; ?>Valor<?php echo $fivesdraftC->id; ?>' value="<?php echo $preco; ?>" id="<?php echo $nome; ?>Valor<?php echo $fivesdraftC->id; ?>" style="width:60px"/>
           COR/IMAGEM: <span style="position:relative;">  <input type='text' class="cor"  name='<?php echo $nome; ?>Imagem<?php echo $fivesdraftC->id; ?>' id="<?php echo $nome; ?>Imagem<?php echo $fivesdraftC->id; ?>" value="<?php echo $corImagem; ?>" style="width:80px" />  </span>
          QTD:<input type='text'  class="qtd" name='<?php echo $nome; ?>Qtd<?php echo $fivesdraftC->id; ?>' value="<?php echo $qtd; ?>" id="<?php echo $nome; ?>Qtd<?php echo $fivesdraftC->id; ?>" style="width:30px"/>
           <input type="button" id="<?php echo $nome; ?>Edit" name="<?php echo $nome; ?>Edit" style="width:110px" value="Atualizar"  class="editITem"  rel='cor' rev="<?php echo $fivesdraftC->id; ?>" />
           <input type="button" id="<?php echo $nome; ?>Remove" name="<?php echo $nome; ?>Remove" style="width:110px" value="Remover"  class="removeITem"  rel='cor' rev="<?php echo $fivesdraftC->id; ?>" />
           
            <?php
             
             $qtd = custom_get_qtd_stock($post->ID,$fivesdraftC->variacaoProduto,'',true);
             
              $qtdVendida = custom_get_qtd_vendida( $post->ID , $fivesdraftC->variacaoProduto , '');
           
             $qtdProdutoF =   $qtd   - $qtdVendida;
             
             $estoqueTotal = verificarEstoqueTotal($post->ID,$fivesdraftC->variacaoProduto, '') - $qtd;
             
                         ?>
             <br/> <span >qtd Cadastrada: <?php echo  $qtd; ?>  <?php if($estoqueTotal>0){ ?>| VARIAÇÕES ESTOQUE : (<?php echo $estoqueTotal; ?> ) <?php }; ?>
            <br/> <span >qtd Cadastrada: <?php echo  $qtd; ?>
           <br/> <span >qtd Vendida : <?php echo  $qtdVendida; ?>
           <br/>  </span> <span >qtd Disponível : <?php echo $qtdProdutoF; ?> </span>

       
       </p>
       
       
       
       <?php }; ?>
   
   
   
   
            <?php 

             if(intval( $fivesdraftsCor )==0){
               echo "<p class='msg$nome'>Não foram cadastradas variações de cor para o produto</p>";  
             };

             ?>
             
             
 
   </div></div>
   
 <hr/>
   
 <?php }elseif($meta_box[ 'name' ]=="size"  ){  
 
      $nome = "tamanho";  
      
      
      echo "<h4 class='btShow' rel='$nome' style='background:#eee;border:1px solid #ddd;padding:5px;cursor:pointer;width:110px' >Editar Tamanhos</h4>";
      
        echo "<div class='estoque  container$nome' style='display:none'> ";
        ?>

      
     
      <br/> <br/>
      <p><strong> Adicionar <?php echo $nome; ?> :</strong></p>
 
       <p   class='itemStock <?php echo $nome; ?>' style="background:#ddd">Nome <?php echo $nome; ?>: <input type='text' name='<?php echo $nome; ?>Nome' id="<?php echo $nome; ?>Nome"  style="width:100px" />  
        Diferença de Preço : <select name="<?php echo $nome; ?>Symbol" id="<?php echo $nome; ?>Symbol" ><option>+</option><option>-</option></select>  
          <?php echo $moedaCorrente; ?> <input type='text'  class="preco" name='<?php echo $nome; ?>Valor' value="0.00"  id="<?php echo $nome; ?>Valor" style="width:60px"/>
          QTD:<input type='text'  class="qtd" name='<?php echo $nome; ?>Qtd' value="<?php echo $qtd; ?>" id="<?php echo $nome; ?>Qtd" style="width:30px"/>
           <input type="button" id="<?php echo $nome; ?>Add" name="<?php echo $nome; ?>Add" style="width:110px" value="Adicionar <?php echo $nome; ?>"   class="addITem" rel='tamanho'  />
       </p>
       
       <p class="msg"></p>
        <p class="carregando"></p>
 <br/>
      <p><strong> Tamanhos Cadastrados : </strong></p>
 <br/>
      <div id="tamanhoCadastrado">
      
        <?php 
        
           global $wpdb; 
             
           $tabela = $wpdb->prefix."";
           $tabela .=  "wpstore_stock";
       
           $sql = "SELECT * FROM `$tabela` WHERE  	`idPost` = '$post->ID' AND  `tipoVariacao` = 'tamanho'  ORDER BY `showOrder` ASC   LIMIT 0 , 100";

           $fivesdraftsTamanho = $wpdb->get_results( $sql);

           foreach ( $fivesdraftsTamanho as $fivesdraftT ) 
           {
               
           $arrayTamanhos[] = $fivesdraftT->variacaoProduto; 
 
           $preco = $fivesdraftT->precoAlternativo;
           $qtd = intval($fivesdraftT->qtdProduto);
 
           if(trim($preco)==''){
               $preco = 0.00;
           }
          
          ?>

          <p     class='itemStock <?php echo $fivesdraftT->id; ?>' rel='<?php echo $fivesdraftT->id; ?>' >Nome <?php echo $nome; ?>: <input type='text' name='<?php echo $nome; ?>Nome<?php echo $fivesdraftT->id; ?>' id="<?php echo $nome; ?>Nome<?php echo $fivesdraftT->id; ?>"  value="<?php echo $fivesdraftT->variacaoProduto; ?>" style="width:100px" />  
              Diferença de Preço : <select name="<?php echo $nome; ?>Symbol<?php echo $fivesdraftT->id; ?>" id="<?php echo $nome; ?>Symbol<?php echo $fivesdraftT->id; ?>" ><option>+</option><option <?php if($fivesdraftT->precoOperacao=="-"){ echo 'selected'; }; ?> >-</option></select>  
              <?php echo $moedaCorrente; ?> <input type='text'  class="preco" name='<?php echo $nome; ?>Valor<?php echo $fivesdraftT->id; ?>' value="<?php echo $preco; ?>" id="<?php echo $nome; ?>Valor<?php echo $fivesdraftT->id; ?>" style="width:60px"/>
              QTD:<input type='text'  class="qtd" name='<?php echo $nome; ?>Qtd<?php echo $fivesdraftT->id; ?>' value="<?php echo $qtd; ?>" id="<?php echo $nome; ?>Qtd<?php echo $fivesdraftT->id; ?>" style="width:30px"/>
              <input type="button" id="<?php echo $nome; ?>Edit" name="<?php echo $nome; ?>Edit" style="width:110px" value="Atualizar"  class="editITem"  rel='tamanho' rev="<?php echo $fivesdraftT->id; ?>" />
              <input type="button" id="<?php echo $nome; ?>Remove" name="<?php echo $nome; ?>Remove" style="width:110px" value="Remover"  class="removeITem"  rel='tamanho' rev="<?php echo $fivesdraftT->id; ?>" />
                     <?php
                      
                      $qtd = custom_get_qtd_stock($post->ID,'',$fivesdraftT->variacaoProduto,true);
                      
                     $qtdVendida = custom_get_qtd_vendida( $post->ID , '' , $fivesdraftT->variacaoProduto);
                    
                      $qtdProdutoF =   $qtd   - $qtdVendida;
                      
                      $estoqueTotal = verificarEstoqueTotal($post->ID ,'' , $fivesdraftT->variacaoProduto) - $qtd;
                    ?>
                    
                  
                    <br/> <span >qtd Cadastrada: <?php echo  $qtd; ?> <?php if($estoqueTotal>0){ ?>| VARIAÇÕES ESTOQUE  : (<?php echo $estoqueTotal; ?> ) <?php }; ?>
                    <br/> <span >qtd Vendida : <?php echo  $qtdVendida; ?>
                    <br/>  </span> <span >qtd Disponível : <?php echo $qtdProdutoF; ?> </span>

          </p>
      
          <?php }; ?>
          
          <?php 
          
          if(intval($fivesdraftsTamanho)==0){
            echo "<p class='msg$nome'>Não foram cadastradas variações de tamanhos para o produto</p>";  
          };
          
          ?>


      </div>
      
      </div>
      
      <hr/>

 <?php }; ?>
 
 

 
 
      
         
    	<?php $nameValue = $meta_box['name'];  ?>
    	
        
        <?php 
        
        if($meta_box[ 'name' ]=="color" || $meta_box[ 'name' ]=="size"  ){ 
            
        ?>
        

            <input type="hidden" name="<?php echo $meta_box[ 'name' ]; ?>"  id="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo get_post_meta($post->ID, $nameValue, true); ?>"  />

       
        <?php }elseif( $meta_box[ 'name' ]=="is_check_outofstock" ){ 
            
       
            
            ?>
            
            <div  style="background:#eee;padding:10px">
 
        <p  class='itemStock'  > 
        
        
        ILIMITADO : <input type="radio" class='radio' name="<?php echo $meta_box[ 'name' ]; ?>"  value="1"  <?php if( get_post_meta($post->ID, $nameValue, true)== '1' || get_post_meta($post->ID, $nameValue, true)== ''){  echo 'checked="checked"';  }; ?>  style="width:15px"/> 


            (  <?php echo $meta_box[ 'description' ]; ?> )  </p>
            
        
             <p  class='itemStock'  >    Controlar :<input type="radio" class='radio' name="<?php echo $meta_box[ 'name' ]; ?>"  value="0"  <?php if( get_post_meta($post->ID, $nameValue, true)== '0' ){  echo 'checked="checked"';  }; ?>  style="width:15px"/> 
        
      (  Manter controle de estoque para o produto. Configure as variações abaixo. )
      </p>
         
          </div>
          
          
          
        <?php }elseif( $meta_box[ 'name' ]=="color_stock" ){ ?>
            
            
          <?php
          
             $nome  = 'tamanhoCor';
             $contagemVariacao = 0;
 
             
            ?>
             
             
             <h4 class='btShow' rel='<?php echo $nome; ?>' style='background:#eee;border:1px solid #ddd;padding:5px;cursor:pointer;width:110px' >Editar Estoque</h4>
               
            <div class='estoque  container<?php echo $nome; ?>' style='display:none'>
                        
            </div>
            <hr/>
        <?php
           
        }else{ 
            
        ?>
 
            <input type="text" <?php  if(   $meta_box[ 'name' ]=="specialprice" || $meta_box[ 'name' ]=="price"  ){  echo 'class="preco"';  } ?> name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo get_post_meta($post->ID, $nameValue, true); ?>" />
 
            <p><?php echo $meta_box[ 'description' ]; ?></p>
            
            
                        <?php 
                        
                            /* if($meta_box[ 'name' ]=="initstock"  ){   ?>
                            <ul class="controleEstoque">
                            <li> Tamanhos </li>
                            <li> Cores </li>
                            <li> Controle da Quantidade de  Estoque </li>
                            <?php }; */
                        
                         ?>     
            

        <?php }; ?>
        
 
     
</div>
 
<?php } ?>





	
<script> var rootfolderpath = '<?php echo bloginfo('template_directory');?>/images/'; </script>

<script language="javascript" type="text/javascript">


         var urlBase = "<?php echo  plugins_url('wpstore/includes/ajax/' ,'WP STORE' ); ?>";
         
 
          jQuery("input.cor").miniColors({
            
    			letterCase: 'uppercase',
    			change: function(hex, rgb) {
    			    logData(hex, rgb);
    			}
    	  });
    	   
          jQuery('input.preco').priceFormat({
                         prefix: '',
                         centsSeparator: ',',
                         thousandsSeparator: '.'
          });
          
          
          
          
          
          
          
          
          
         function showCarregador(objectV){
                        if(objectV=="carregando"){
                        jQuery('.'+objectV).fadeIn();
                        }else{
                        jQuery(''+objectV).text('Enviando Requisição...');
                        jQuery(''+objectV).fadeIn();    
                        }
          };
          
          
          
          
          function hideCarregador(objectV){
                    if(objectV=="carregando"){
                    jQuery('.'+objectV).fadeOut();
                    }else{
                    jQuery(''+objectV).text('Enviando Requisição...');
                    jQuery(''+objectV).fadeOut();    
                    }
                   
             };
             
             

          function msg(data){

               jQuery('.msg').fadeIn();  
               jQuery('.msg').html(data);   

              setTimeout( function() {
            	 jQuery('.msg').fadeOut();
            	}, 1000 );

          };
          
          
          function carregaFuncoesItem(IDITEM){
              
              
              jQuery("input.cor"+IDITEM).miniColors({
          			letterCase: 'uppercase',
          			change: function(hex, rgb) {
          			    logData(hex, rgb);
          			}
          	  });
          	  

                jQuery('input.preco'+IDITEM).priceFormat({
                               prefix: '',
                               centsSeparator: ',',
                               thousandsSeparator: '.'
                });
                
                ativaBtEdit(IDITEM);
                ativaBtRemove(IDITEM);
                
                   
                              irpara = parseInt(jQuery('p.'+IDITEM).offset().top)-60 ;
                              jQuery('html, body').animate({ scrollTop: irpara }, 1000);
                
              
          };
          
          
        
          
         
          jQuery('.addITem').click(function() {
          
               var postID = "<?php echo $_GET['post']; ?>";
               
               var divName = ""+jQuery(this).attr('rel');
               
               var operacaoTipo = divName;
            
               var divElement = divName+"Cadastrado";
            
                 html = ""+jQuery('#carregando'+operacaoTipo).attr('rel');

                     if(html=='undefined'){

                         jQuery('p.'+operacaoTipo).append('<div id="carregando'+operacaoTipo+'" rel="'+operacaoTipo+'" >Carregando...</div>');

                     }

                showCarregador('#carregando'+operacaoTipo);
                       
                       
               
               var chaveItem = "";
               
                if( divName=='cor' ){
                        chaveItem = "cor";
                }else{
                        chaveItem = "tamanho";
                };
                    
                    
               
               var nomeItem = ""+jQuery('#'+chaveItem+'Nome').val();
               var symbolItem= ""+jQuery('#'+chaveItem+'Symbol').val();
               var precoItem  = ""+jQuery('#'+chaveItem+'Valor').val();
                var imagemItem = ""+jQuery('#'+chaveItem+'Imagem').val();
                
                var imagemItem = ""+jQuery('#'+chaveItem+'Imagem').val();
                if(imagemItem==""){
                    imagemItem="#F4F4F4";
                }
               var qtdProdV = ""+jQuery('#'+chaveItem+'Qtd').val();
        
               jQuery.post(urlBase+"addAjaxStockItem.php", { postIDP:postID, operacaoTipoP:operacaoTipo  ,  nomeItemP:nomeItem , symbolItemP:symbolItem , precoItemP : precoItem , imagemItemP:imagemItem ,  qtdProd:qtdProdV     },
                 function(data) { 
                   
                          var msgTxt= "";
                          
                          hideCarregador('#carregando'+operacaoTipo);
                          
                           if(data>0){ msgTxt= "Adicionado com Sucesso!"; }
                         
                           //msg(msgTxt); 
  
                           IDITEM = ""+data;
                      
                           var html = "";
                           
                           selected = "";
                           if(symbolItem=="-"){
                           selected = "selected";
                           }else{
                           selected = "";    
                           }
                           
                           
                         
                            if( divName=='cor' ){
                                 chaveItem = "cor";
                              html = "<p class='itemStock  "+IDITEM+" '>Nome Cor: <input type='text'  name='corNome"+IDITEM+"' id='corNome"+IDITEM+"'  value='"+nomeItem+"' style='width:100px' />  Diferença de Preço : <select name='corSymbol"+IDITEM+"' id='corSymbol"+IDITEM+"' ><option>+</option><option "+selected+">-</option></select>  <?php echo $moedaCorrente; ?> <input type='text'  class='preco"+IDITEM+"' name='corValor"+IDITEM+"' value='"+precoItem+"' id='corValor"+IDITEM+"' style='width:60px'/>COR/IMAGEM: <span style='position:relative;'>  <input type='text' class='cor"+IDITEM+"'  name='corImagem"+IDITEM+"' id='corImagem"+IDITEM+"'   value='"+imagemItem+"'  style='width:80px' />  </span>   QTD:<input type='text'  class='qtd' name='corQtd"+IDITEM+"' value='"+qtdProdV+"' id='corQtd"+IDITEM+"' style='width:30px'/><input type='button' id='corEdit"+IDITEM+"' name='corEdit"+IDITEM+"' style='width:110px' value='Atualizar'  class='editITem"+IDITEM+"'  rel='cor' rev='"+IDITEM+"' />   <input type='button' id='corRemove"+IDITEM+"' name='corRemove"+IDITEM+"' style='width:110px' value='Remove'  class='removeITem"+IDITEM+"'  rel='cor'  rev='"+IDITEM+"' /></p>";
                             }else{
                                 chaveItem = "tamanho";
                              html = "<p class='itemStock "+IDITEM+" ' >Nome Tamanho: <input type='text' name='tamanhoNome"+IDITEM+"'  id='tamanhoNome"+IDITEM+"' value='"+nomeItem+"'   style='width:100px' />  Diferença de Preço : <select name='tamanhoSymbol"+IDITEM+"'  id='tamanhoSymbol"+IDITEM+"' ><option>+</option><option "+selected+">-</option></select>  <?php echo $moedaCorrente; ?> <input type='text'  class='preco"+IDITEM+"'  name='tamanhoValor"+IDITEM+"'  value='"+precoItem+"'  id='tamanhoValor"+IDITEM+"' style='width:60px' />  QTD:<input type='text'  class='qtd' name='tamanhoQtd"+IDITEM+"' value='"+qtdProdV+"' id='tamanhoQtd"+IDITEM+"' style='width:30px'/><input type='button' id='tamanhoEdit"+IDITEM+"' name='tamanhoEdit"+IDITEM+"' style='width:110px' value='Atualizar'  class='editITem"+IDITEM+"'  rel='tamanho' rev='"+IDITEM+"' />   <input type='button' id='tamanhoRemove"+IDITEM+"' name='tamanhoRemove"+IDITEM+"' style='width:110px' value='Remover'  class='removeITem"+IDITEM+"'  rel='tamanho'  rev='"+IDITEM+"'  /></p>";
                             };
                             
                     
                        jQuery('p.msg'+operacaoTipo).fadeOut(); 

                         jQuery('#'+divElement).append(html);
                         
                         carregaFuncoesItem(IDITEM); 
                         
                       //  alert(operacaoTipo);
                         
                         hideCarregador('#carregando'+operacaoTipo);
                         
                         
                         jQuery('#'+chaveItem+'Nome').val('');
                         jQuery('#'+chaveItem+'Symbol').val('');
                         jQuery('#'+chaveItem+'Valor').val('');
                         jQuery('#'+chaveItem+'Imagem').val('#F4F4F4');
                         jQuery('#'+chaveItem+'Qtd').val('');
                         
                      
                         
  
                });
            
         });
      
      
 
 
 
 
 
 
 
     
     
      jQuery('.editITem').click(function() {
            
             var chaveEdit = ""+jQuery(this).attr('rev');
           
             var postID = "<?php echo $_GET['post']; ?>";
             
             var divName = ""+jQuery(this).attr('rel');
     
             var operacaoTipo = divName;
             
                    html = ""+jQuery('#carregando'+chaveEdit).attr('rel');
   
                    if(html=='undefined'){
                        
                        jQuery('p.'+chaveEdit).append('<div id="carregando'+chaveEdit+'" rel="'+chaveEdit+'" >Carregando...</div>');
                    
                    }
        
                      showCarregador('#carregando'+chaveEdit); 
 
                        var chaveItem = "";
                        
                        if( divName=='cor' ){
                            chaveItem = "cor";
                         }else{
                            chaveItem = "tamanho";
                         };
                         
                         
           
              var nomeItem = ""+jQuery('#'+chaveItem+'Nome'+chaveEdit+'').val();
              var symbolItem= ""+jQuery('#'+chaveItem+'Symbol'+chaveEdit+'').val();
              var precoItem  = ""+jQuery('#'+chaveItem+'Valor'+chaveEdit+'').val();
              var imagemItem = ""+jQuery('#'+chaveItem+'Imagem'+chaveEdit+'').val();
                if(imagemItem==""){
                      imagemItem="#F4F4F4";
                  }
              var qtdProdV = ""+jQuery('#'+chaveItem+'Qtd'+chaveEdit+'').val();
              
    
              
              if(operacaoTipo=="tamanhoCor"){
              var nomeItem = ""+jQuery('#'+operacaoTipo+'Nome'+chaveEdit+'').val();
              var qtdProdV= ""+jQuery('#'+operacaoTipo+'Qtd'+chaveEdit+'').val();
              };
              
         
           
              jQuery.post(urlBase+"addAjaxStockItem.php", { postIDP:postID, operacaoTipoP:operacaoTipo  ,  nomeItemP:nomeItem , symbolItemP:symbolItem , precoItemP : precoItem , imagemItemP:imagemItem  , qtdProd:qtdProdV     },
                function(data) { 
                    // msg(data); 
                     hideCarregador('#carregando'+chaveEdit);
               });
               
               
        
       });
       
       
    
     
     jQuery('.removeITem').click(function() {
         
          var chaveEdit = jQuery(this).attr('rev');
          
           var chaveEdit = ""+jQuery(this).attr('rev');
         
           var postID = "<?php echo $_GET['post']; ?>";
         
            jQuery.post(urlBase+"addAjaxStockItem.php", { postIDP:postID, itemID:chaveEdit , action:"remove" },
              function(data) { 
                   msg(data); 
                   jQuery('p.'+chaveEdit).fadeOut();
                   hideCarregador('carregando');
             });
     
     });
     
     
     
     
     
       function ativaBtEdit(IDITEM){
           
       
           jQuery('.editITem'+IDITEM).click(function() {

                  var chaveEdit = ""+jQuery(this).attr('rev');

                  var postID = "<?php echo $_GET['post']; ?>";

                  var divName = ""+jQuery(this).attr('rel');

                  var operacaoTipo = divName;
                   
                       html = ""+jQuery('#carregando'+chaveEdit).attr('rel');

                          if(html=='undefined'){

                              jQuery('p.'+chaveEdit).append('<div id="carregando'+chaveEdit+'" rel="'+chaveEdit+'" >Carregando...</div>');

                          }

                            showCarregador('#carregando'+chaveEdit);

                             var chaveItem = "";

                             if( divName=='cor' ){
                                 chaveItem = "cor";
                              }else{
                                 chaveItem = "tamanho";
                              };



                   var nomeItem = ""+jQuery('#'+chaveItem+'Nome'+chaveEdit+'').val();
                   var symbolItem= ""+jQuery('#'+chaveItem+'Symbol'+chaveEdit+'').val();
                   var precoItem  = ""+jQuery('#'+chaveItem+'Valor'+chaveEdit+'').val();
                   var imagemItem = ""+jQuery('#'+chaveItem+'Imagem'+chaveEdit+'').val();
                   var qtdProdV = ""+jQuery('#'+chaveItem+'Qtd'+chaveEdit+'').val();

               
                   if(operacaoTipo=="tamanhoCor"){
                   var nomeItem = ""+jQuery('#'+operacaoTipo+'Nome'+chaveEdit+'').val();
                   var qtdProdV= ""+jQuery('#'+operacaoTipo+'Qtd'+chaveEdit+'').val();
                   
                   var symbolItem= ""+jQuery('#'+operacaoTipo+'Symbol'+chaveEdit+'').val();
                   var precoItem  = ""+jQuery('#'+operacaoTipo+'Valor'+chaveEdit+'').val();
                   
                  
                   };
 

                   jQuery.post(urlBase+"addAjaxStockItem.php", { postIDP:postID, operacaoTipoP:operacaoTipo  ,  nomeItemP:nomeItem , symbolItemP:symbolItem , precoItemP : precoItem , imagemItemP:imagemItem  , qtdProd:qtdProdV     },
                     function(data) { 
                          //msg(data); 
                          hideCarregador('#carregando'+chaveEdit);
                    });



            });
            
            
           
       };
       
       
       
       
       
       function ativaBtRemove(IDITEM){
      
           jQuery('.removeITem'+IDITEM).click(function() {

                 var chaveEdit = ""+jQuery(this).attr('rev');
          
                 var postID = "<?php echo $_GET['post']; ?>";

                  jQuery.post(urlBase+"addAjaxStockItem.php", { postIDP:postID, itemID:chaveEdit , action:"remove" },
                    function(data) { 
                         msg(data); 
                         jQuery('p.'+chaveEdit).fadeOut();
                         hideCarregador('carregando');
                   });

           });
 
         };
         
         
         
          jQuery('.btShow').click(function(){
              
                nome =  jQuery(this).attr('rel');
                jQuery('.estoque').hide();
                
                
                 if(nome == 'tamanhoCor'){
                        
                              var postID = "<?php echo $_GET['post']; ?>";

                              jQuery('.container'+nome).fadeIn();
                              jQuery('.container'+nome).html('<p>Carregando Variações...</p>');
                              
                              irpara = parseInt(jQuery(this).offset().top);
                              jQuery('html, body').animate({ scrollTop: irpara }, 1000);
                              
                              jQuery.post(urlBase+"adminTamanhoCor.php", { postIDP:postID },
                                function(data) { 
                                      jQuery('.container'+nome).html(data);
                                      
                                         jQuery('input.preco').priceFormat({
                                                           prefix: '',
                                                           centsSeparator: ',',
                                                           thousandsSeparator: '.'
                                            });
                                      
                                  
                                  
                                       jQuery('p.loadItem').each(function(index) {
                                           
                                            ativaBtEdit(""+jQuery(this).attr('rel') );
                                        
                                       });
                                    
                                });
                               
                 }else{
                     
                     
                             jQuery('.container'+nome).fadeIn();
                             irpara = parseInt(jQuery(this).offset().top);
                             jQuery('html, body').animate({ scrollTop: irpara }, 1000);



                 }
                
                
           
                
          });
         
         
     
     
     
     //sortable tamanhos ---------------------------------------------------
           jQuery(function() {
               
                     jQuery( "#tamanhoCadastrado" ).sortable({
                         
                          start: function(event, ui) {
                                  var start_pos = ui.item.index()+1;
                                  ui.item.data('start_pos', start_pos);
                               },
                               
                          update: function (event, ui) {
                              
                                  var start_pos = ui.item.data('start_pos');
                                  var end_pos = ui.item.index()+1;
                                  
                                     
                                       itemV = "";
                                       orderV  = "";
                                       
                                       jQuery( "#tamanhoCadastrado p" ).each(function(index) {
                                            rel = jQuery(this).attr('rel');
                                            itemV += "***"+index;
                                            orderV += "***"+rel;
                                       });  
 
                                         url= urlBase+"addAjaxStockOrder.php";
                                         showBigLoad();

                                        jQuery.post(url, { arrItem:itemV,arrOrder:orderV} , function(data) {
                                        //alert(data);
                                         hideBigLoad();
                                        });
                                       
                            }
                      });
                      
                      
                      });
                     
                     //sortable tamanhos ---------------------------------------------------      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                           //sortable tamanhos ---------------------------------------------------
                                 jQuery(function() {

                                           jQuery( "#corCadastrado" ).sortable({

                                                start: function(event, ui) {
                                                        var start_pos = ui.item.index()+1;
                                                        ui.item.data('start_pos', start_pos);
                                                     },

                                                update: function (event, ui) {

                                                        var start_pos = ui.item.data('start_pos');
                                                        var end_pos = ui.item.index()+1;


                                                             itemV = "";
                                                             orderV  = "";

                                                             jQuery( "#corCadastrado p" ).each(function(index) {
                                                                  rel = jQuery(this).attr('rel');
                                                                  itemV += "***"+index;
                                                                  orderV += "***"+rel;
                                                             });  

                                                               url= urlBase+"addAjaxStockOrder.php";
                                                               showBigLoad();

                                                              jQuery.post(url, { arrItem:itemV,arrOrder:orderV} , function(data) {
                                                              //alert(data);
                                                               hideBigLoad();
                                                              });

                                                  }
                                            });

                                
                                            });

                                           //sortable tamanhos ---------------------------------------------------      


                      
                      
                      
                                function showBigLoad(){

                                    var txt  = "<div id='janela'><div class='popup'><div class='loading'><span>Carregando</span></div></div></div>";
                                    jQuery(txt).insertAfter('body');
                                    jQuery('#janela').fadeIn();

                                };

                                 function hideBigLoad(){

                                       jQuery('#janela').fadeOut();
                                       jQuery('#janela').remove();

                                  };
 
               
               
               
     

 
	</script>
	
	
	
	
 
 
</div>
<?php 


};   


function create_meta_box_produtos() {
    
global $key;
 
if( function_exists( 'add_meta_box' ) ) {

add_meta_box( 'new-meta-boxes', 'Opções do Produto', 'display_meta_box_produtos', 'produtos', 'normal', 'high' );
 
};

};



?>