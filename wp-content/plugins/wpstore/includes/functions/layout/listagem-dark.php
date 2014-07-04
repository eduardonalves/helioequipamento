<?php

$exibir = false;

 
if(count($arrayIds)>0   ){
      if ( in_array($post->ID, $arrayIds) ) {

           $exibir = true;

       };
}

 
  if($ajaxFiltro != true){  $exibir = true; }; 
  if($variacao ==""){ $exibir = true; };
  //  $exibir = true; 
  if($exibir == true){
     
     ?>
   
   
   
   	  <div class="produto">
			<h4><a href="<?php the_permalink(); ?>"><span><?php echo the_title(); ?></span></a></h4>

			<a href="<?php the_permalink(); ?>"> 	<?php  custom_get_image($post->ID,306,307,1); //PLUGIN SHOP FUNCTION -------------------------------------- ?></a>

             <?php 
                   $preco = custom_get_specialprice($post->ID); //PLUGIN SHOP FUNCTION --------------------------------------
                   if($preco>0){ 
                   ?>

                 <p class="price" style="text-decoration:line-through"><span><?php echo $simbolo; ?></span> <?php echo custom_get_price($post->ID); //PLUGIN SHOP FUNCTION --------------------------------------  ?></p>

                     <dt>Preço com desconto</dt>
                     <dd><span class="priceDesc"><span> <?php echo $simbolo; ?></span>  <?php echo $preco; ?>  </span> <?php //echo $categoriaPrincipalName2; ?>  <?php //echo $categoriaPrincipalName3; ?> </dd>

                   <?php }else{ ?>

                          <p class="price"><span><?php echo $simbolo; ?></span>  <?php echo custom_get_price($post->ID); //PLUGIN SHOP FUNCTION --------------------------------------  ?></p>

                        <?php }; ?>





	   </div> 
	   <?php };$exibir = false; ?>


