 <?php
 $moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
 if($moedaCorrente==""){
   $moedaCorrente = "R$" ; 
 }
 ?>
 <?php 


                 $categoriaPrincipalName = "";	
            	    $categoriaPrincipalLink =  "";
            	    $categoriaPrincipalID =  "";		

            	         $categoriaPrincipalName2 = "";	
                    	    $categoriaPrincipalLink2 =  "";
                    	    $categoriaPrincipalID2 =  "";

                    	    $categoriaPrincipalName3= "";	
                        	    $categoriaPrincipalLink3 =  "";
                        	    $categoriaPrincipalID3 =  "";



                                if($categoriaPrincipalLink==""){
                                    $catID = get_query_var('cat');
                                    $categoriaPrincipalID =  $catID;
                                    $categoriaPrincipalName = get_cat_name( $catID);	
                                    $categoriaPrincipalLink =  get_category_link(  $catID );
                                }




        foreach((get_the_category()) as $category) { 
 
                           
                         	    if(intval($category->parent)==41){
                         	        $categoriaPrincipalID2 = $category->cat_ID;
                             	    $categoriaPrincipalName2 = $category->cat_name;	
                             	    $categoriaPrincipalLink2 =  get_category_link(  $categoriaPrincipalID2 );
                             	};


                                  if (cat_is_ancestor_of(41,  $category->cat_ID)  ){ 
                                      if($categoriaPrincipalID2 =="" ){
                                           $categoriaPrincipalID2 = $category->cat_ID;
                               	           $categoriaPrincipalName2 = $category->cat_name;	
                               	           $categoriaPrincipalLink2 =  get_category_link(  $categoriaPrincipalID2 );
                               	      }else{
                               	           $categoriaPrincipalID3 = $category->cat_ID;
                                     	   $categoriaPrincipalName3 = $category->cat_name;	
                                     	   $categoriaPrincipalLink3 =  get_category_link(  $categoriaPrincipalID2 );    
                               	      }
                                  }; 


        };        //final foreach categories
        
        
        
        if($categoriaPrincipalName !=""){ 
            $categoriaPrincipalName = $categoriaPrincipalName; 
            $categoriaPrincipalLink = $categoriaPrincipalLink;
            
        };
        
        
        if($categoriaPrincipalName2 !=""){ 
            $categoriaPrincipalName = $categoriaPrincipalName2; 
            $categoriaPrincipalLink = $categoriaPrincipalLink2;
            
        };
        
        
        if($categoriaPrincipalName3 !=""){ 
            $categoriaPrincipalName = $categoriaPrincipalName3; 
            $categoriaPrincipalLink = $categoriaPrincipalLink3;
            
        };

       
       
       ?>
         
         
         
         
<div class="produto">
 
     
   <?php
   
   //PLUGIN SHOP FUNCTION --------------------------------------
   custom_get_image($post->ID,132,139); 
   
   ?>
     
     <div class="desc">
         <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
         
         <?php
         if(get_post_type() == 'produtos'){
         ?>
         
         
           <p class="price"><?php echo $moedaCorrente; ?> <?php echo custom_get_price($post->ID); //PLUGIN SHOP FUNCTION --------------------------------------  ?></p>
            
             <?php 
                $preco = custom_get_specialprice($post->ID); //PLUGIN SHOP FUNCTION --------------------------------------
                if($preco>0){ 
                ?>
                
                  <dt>Preço com desconto</dt>
                  <dd><span class="priceDesc"><?php echo $moedaCorrente; ?>  <?php echo $preco; ?>  </span> <?php //echo $categoriaPrincipalName2; ?>  <?php //echo $categoriaPrincipalName3; ?> </dd>
               
                <?php }; ?>
         
         
          <a class="botao" href="<?php the_permalink(); ?>">Comprar</a>
          
          <?php }else{ ?>
              
              <p><?php echo  $categoriaPrincipalName; ?> </p>
              
          <a class="botao" href="<?php the_permalink(); ?>">Ver Mais</a>
              
          <?php }; ?>
         
         
 
      <div class="clear"></div>
         
         
     </div><!-- .desc -->
     
     <div class="clear"></div>
 </div><!-- .produto -->
 
 
    
         
         
 