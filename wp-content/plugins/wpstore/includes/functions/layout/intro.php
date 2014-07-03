<?php 


$item = "ítens";
   if($qtdStock==1){
      $item = "ítem"; 
   };
   

              $nome = get_current_name_user();
     
   ?>
     <?php $tipoSkinShop = get_option('tipoSkinShop'); ?>
     
     <?php  if($tipoSkinShop!='DARK'){  ?>
      <div class="bemVindo">
      <?php  }else{ ?>
       <div class="bemVindo2">    
      <?php  }; ?>
      
      
      <?php 	
      
      $idPaginaPerfil = get_idPaginaPerfil(); 
      $pagePerfil = get_permalink($idPaginaPerfil);
      
      $idPaginaCheckout = get_idPaginaCheckout(); 
      $pageCheckout= get_permalink($idPaginaCheckout);
      
      $idPaginaPedidos = get_idPaginaPedidos(); 
        $pagePedidos = get_permalink($idPaginaPedidos);
        
       $idPaginaCarrinho = get_idPaginaCarrinho(); 
       $pageCarrinho = get_permalink($idPaginaCarrinho);
                $idLogin = get_idPaginaLogin();
                  $pageLogin = get_permalink($idLogin);
                  
                  ?>

      <?php if( is_user_logged_in() ){ ?>
      <p class="bem">Bem vindo, <?php echo  $nome; ?>.    
       ( 
      <a href="<?php echo get_permalink($idPaginaPerfil);  ?>">Meus Dados</a>
      | <a href="<?php echo  wp_logout_url(get_bloginfo('url')); ?>">Sair</a> ) </p>
      <?php }else{ ?>
       <p class="bem"><a href="<?php echo  $pageLogin; ?>">FAÇA LOGIN</a> </p>
      <?php  };  ?>
	
	  <div class="carrinho">
		<p><a href="<?php echo $pageCarrinho ; ?>">Meu Carrinho</a></p>
		<span><a href="<?php echo $pageCarrinho ; ?>" class="qtdItemsCart"><?php echo $qtdStock; ?> <?php echo $item; ?></a></span>
	  </div>    
	
	  <ul class="links">
		<li><a href="<?php echo  $pageCheckout; ?>">Finalizar Compra</a></li>
		<li><a href="<?php echo  $pagePedidos; ?>">Meus Pedidos</a></li>
		<li><a href="<?php echo $pagePerfil; ?>">Meus dados</a></li>
	   </ul>
    
       <div class="clear"></div>
    
       </div><!-- .bemVindo -->
