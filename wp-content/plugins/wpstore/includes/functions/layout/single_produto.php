 
		 <div class="produtoDir">
        
         
 
               <?php  custom_get_select_stock_form($post->ID); ?>
	 
                
                <div class="clear"></div>
					
             			
        
            <?php 
            
            $exibirFreteSingle = get_option('exibirFreteSingle');
            
            if($exibirFreteSingle !="não"){
            
            $tabelaVar = ""; 
            
            include('box-frete.php'); 
            
            echo  $tabelaVar ;  
            
            };
            
            
            ?>
       
			<div class="clear"></div>
				
			
        </div><!-- .produtoDir -->
		
 
		
        <div class="clear"></div>