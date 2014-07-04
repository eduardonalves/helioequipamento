    <ul class="galeriaThumb" >
               
                <?php
					$args = array(
    				'post_type' => 'attachment',
    			    'numberposts' => -1,
    				'post_status' => null,
    				'orderby'         => 'menu_order',
    			    'order'           => 'ASC',
    			    'post_parent' => $post->ID);



				$attachments = get_posts($args);
				$count  = 0;
				
				$totalGaleria = 0;

					if ($attachments) {
						foreach ($attachments as $attachment) {
							//echo apply_filters('the_title', $attachment->post_title);
							   $image_id = $attachment->ID;  
							   $legenda = $attachment->post_excerpt;  
							   $image_url = wp_get_attachment_image_src($image_id,'large');  
							   $image_url = $image_url[0];
							   $totalGaleria  +=1;



					?>

       
      <li>
        <a href="<?php echo $image_url;   ?>" class='imageBig' >  
        
            <?php

                $image_url =   get_image_path($image_url);  

                ?>
                
          <img src="<?php bloginfo('template_url'); ?>/timthumb.php?src=<?php echo $image_url; ?>&w=60&h=40&zc=1" width="60" height="40" class="image<?php echo $count; ?>">
        </a>
      </li>


					<?php 
						$count +=1;

				    			}
							}


                 ?>
         </ul>
        