<?php 

	

 	$image_url = "";  $widtImg="";

 
    if ( has_post_thumbnail($postID)) { 

    	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ) , 'full' );
 	    $image_url =  $image_url[0]; 
 	
 	 }else{ 

 	    $image_url = get_post_meta( $postID, 'linkImagem', true );
 
    };
    
    
    if($image_url ==""){
 	 $image_url = get_post_meta( $postID, 'productimage', true );
 	};
 	
 	
 	if($image_url ==""){
 	 $image_url = get_bloginfo('template_url').'/images/semFoto.png';
 	};
 	
 	
 
  
 if( $principal == true && $carregamentoPesado=="resolver"){
    
      //  if( $principal == true){
         
           
 	if($image_url !=""){
 	    
 	    $image_url = str_replace(' ','%20',$image_url);
 	    
 	    list($widthO, $heightO, $type, $attr) = getimagesize($image_url);
       $class = "";
        
        
        $start = microtime(true);

        $url = $image_url;

        // $raw = ranger($url);
         //$im = imagecreatefromstring($raw);

        // $widthO = imagesx($im);
        // $heightO = imagesy($im);

        $stop = round(microtime(true) - $start, 5);

        //echo $widthO." x ".$heightO." ({$stop}s)";
 
   
        if( intval($width) > intval($widthO) && intval($widthO)>0){
          
         $width = $widthO;
         $widtImg = $width ;
         $height = $heightO;
         if(intval($height)>160){
            // $height = 160;
         }
         $class = "notScale";
            if(!is_single()){
              $crop =1;
            };
         };
      
    };
    
  
  
   }; // end PRINCIPAL
    
    
    
    


    
    
    
 
     ?>
     
     <?php
       $the_permalink =  trim(get_post_meta($postID,'link',true));
       if($the_permalink==""  || $the_permalink=="#" ){
       $the_permalink = get_permalink($postID);
       };  
       
        $the_permalink = verifyURL($the_permalink);
     ?>
 
  	
  	 
     <?php 
     
     $crop = 1;
        
     $image_url =   verifyURL($image_url) ;   
     
     $id = get_current_blog_id();    

     if($id>1){
            $image_url =   get_image_path($image_url);     
     };

       
  
     //echo    $image_url;  
       
     
     if($print==false){?>
         
         <?php if($produto==true  ){ ?>
 
          <?php    $imgPrint .= "<a href='".$image_url."' class='imageBig' ><img  width='$width' class='image notScale $class $class2' src='".verifyURL(get_bloginfo('template_url'))."/timthumb.php?src=".$image_url."&h=$height&w=550&zc=$crop' alt='".get_the_title()."'  width='250'/></a>"; ?>
          
          <?php }else{ ?>
  	    
  	      <?php        $imgPrint .= "<a href='".$the_permalink."'><img  width='$width' class='image  $class $class2' src='".verifyURL(get_bloginfo('template_url'))."/timthumb.php?src=".$image_url."&h=$height&w=$width&zc=$crop' alt='".get_the_title()."' /></a>"; ?>

          <?php };  ?>
  	
  	
  	<?php  }else{ ?>
    
    
           <?php if($produto==true  ){        $image_url =   get_image_path($image_url);     ?>

           <a href="<?php echo  $image_url; ?>" class="imageBig" ><img  width='<?php echo $width; ?>' class="image notScale  <?php echo $class2; ?>" src="<?php echo verifyURL(get_bloginfo('template_url')); ?>/timthumb.php?src=<?php echo  $image_url; ?>&h=<?php echo $height; ?>&w=550&zc=<?php echo $crop; ?>" alt="<?php the_title(); ?>"  width='250'/></a>

           <?php }else{ ?>
               
          
          
                         <?php  if( $principal == true){ ?>
              	                      <a href="<?php echo  $the_permalink;  ?>"><img   class="image imageProduto <?php echo $class; ?> <?php echo $class2; ?>" src="<?php echo   $image_url; ?>" alt="<?php the_title(); ?>" /></a> 
              	             <?php }else{         ?>
              	                       <a href="<?php echo  $the_permalink;  ?>"><img  width='<?php echo $width; ?>' class="image <?php echo $class; ?> <?php echo $class2; ?>" src="<?php bloginfo('template_url'); ?>/timthumb.php?src=<?php echo $image_url; ?>&h=<?php echo $height; ?>&w=<?php echo $width; ?>&zc=<?php echo $crop; ?>" alt="<?php the_title(); ?>" /></a>
                            <?php };  ?>
                    
           <?php };  ?>
           
    
    
	<?php };  ?>