<?php


if( intval($_REQUEST['idRmv'] )>0 ){
      if(is_admin()){
      global $wpdb;
      $tabela = $wpdb->prefix."";
      $tabela .=  "wpstore_orders_contacts";
      $ID = $_REQUEST['idRmv'];
      $resultQuery = $wpdb->query("DELETE FROM `$tabela` WHERE `id` = '$ID'");
  	  //wp_redirect(verifyURL(get_bloginfo('url')).'/wp-admin/admin.php?page=lista_contatos');
  	   echo "<script>window.location='".verifyURL(get_bloginfo('url'))."/wp-admin/admin.php?page=lista_contatos'</script>";
      };
  	  
};

if($_POST['submit']=="Deletar"){
  
for ($i=0; $i<=count($_POST['list']);$i++) {

      	   $ID = $_POST['list'][$i];
          
            global $wpdb;
            $tabela = $wpdb->prefix."";
            $tabela2 =  $tabela;
            $tabela3 =  $tabela;
            $tabela .=  "wpstore_contacts";
          
                   
           $resultQuery = $wpdb->query("DELETE FROM `$tabela` WHERE `id` = '$ID'");
        
         
        //FINAL insere  no total de Inscrições da Etapa  

	} 
	
//	wp_redirect(verifyURL(get_bloginfo('url')).'/wp-admin/admin.php?page=lista_contatos');
	  echo "<script>window.location='".verifyURL(get_bloginfo('url'))."/wp-admin/admin.php?page=lista_contatos'</script>";
    exit;
          
            
};

 
 

   global $wpdb;
   $tabela = $wpdb->prefix."";
   $tabela .=  "wpstore_contacts";
 
   $oid = $_POST['oid'];
   $oemail = $_POST['oemail'];
   
   $andQuery="";
   
    $sql = "SELECT *FROM `$tabela` ORDER BY `ID` DESC";

     if(trim($oemail) != ''){
         $uid = trim($oemail);
        $sql = "SELECT *FROM `$tabela`  WHERE `emailAviso`='$uid' ORDER BY `ID` DESC";
     }

     if(intval( $oid) != ''){
   
          $sql = "SELECT *FROM `$tabela`  WHERE `postIDP`='$oid' ORDER BY `ID` DESC";
       }

   $fivesdrafts = $wpdb->get_results($sql);
    
    ?>
         










    <div id="cabecalho">
    	<ul class="abas">
    		<li>
    			<div class="aba gradient">
    				<span>Avisar quando chegar</span>
    			</div>
    		</li>  

    		 <?php /* 
    		<li>
    			<div class="aba gradient">
    				<span>Homepage</span>
    			</div>
    		</li>
    		<li>
    			<div class="aba gradient">
    				<span>Slide Home</span>
    			</div>
    		</li>
    		<li>
    			<div class="aba gradient">
    				<span>Sidebar</span>
    			</div>
    		</li>                   

    					*/ ?>      

    		<div class="clear"></div>
    	</ul>
    </div><!-- #cabecalho -->       





    <div id="containerAbas">  



    	<div class="conteudo">








    
	<form action="<?php echo verifyURL(get_option( 'siteurl' )) ."/wp-admin/admin.php?page=lista_contatos";?>"  method="post" >



    	 <label>Digite o ID do Produto: </label> 
		<input type="text"  name="oid" value="<?php echo $oid; ?>"/> 
     
         <br/>       
		 <label> ou Digite o E-mail do Usuário desejado: </label>
		<input type="text"  name="oemail" value="<?php echo $oemail; ?>"/> 
	     <br/> 
         <input type="submit"  name="submit" value="Filtrar"/>
	</form><br/>

 
 
	
	<?php 
	
	$tipo_pagto = "";
    
    
    if ($fivesdrafts) {
        
        
        ?>
 
	<form action="<?php echo verifyURL(get_option( 'siteurl' )) ."/wp-admin/admin.php?page=lista_contatos";?>"  method="post" >
	
	
	<label>Selecionar Todos:</label><th width="28" ><input name="check" id="check" onClick="return selectCheckBox();"  type="checkbox"></th>


    

   	<?php

        $orderCount = 0;

       foreach ( $fivesdrafts as $fivesdraft ){
           
    	 	 		
           $id = $fivesdraft->id;
           $nomeAviso = $fivesdraft->nomeAviso;
       	   $emailAviso = $fivesdraft->emailAviso;
       	   $postIDP = $fivesdraft->postIDP;
           $variacaoCorP  = $fivesdraft->variacaoCorP ;
           $variacaoTamanhoP = $fivesdraft->variacaoTamanhoP; 
 
           	    if($status_pagto=="PENDENTE"){
   				$cor = "#fffadf ";
   				}elseif($status_pagto=="APROVADO"  || $status_pagto=="TRANSPORTADORA"  ||$status_pagto=="SEPARACAO"  || $status_pagto=="ENTREGUE" ){
   				$cor = "#b2ffc8";
   				}elseif($status_pagto=="CANCELADO"){
   				$cor = "#b2ffc8";
   				}else{
   				$cor = "#fffadf";
   				};
   				

        ?>     
        
        
        
        
        
        
 		<div class="bloco"  style="background:<?php echo $cor; ?>;padding:10px;margin-bottom:5px;"  >
 			<h3><input type='checkbox' id='check_<?php echo $id ?>'  name='list[]' value='<?php echo $id; ?>'/>  <?php echo  $nomeAviso ; ?> <?php echo $emailAviso; ?> </h3>

 		        <span class="seta" rel='ck_<?php echo $id ?>'></span>
 				<div class="texto" id='ck_<?php echo $id ?>'>
 				
 				

   
               <div>
               	      
                      <strong>Nome do Solicitante:</strong> <?php echo  $nomeAviso ; ?> 
                      <strong>Email:</strong> <?php echo $emailAviso; ?> 
                      <strong>produto :</strong> <a href="<?php echo get_permalink($postIDP); ?>"><?php echo get_the_title($postIDP); ?></a>
                      <strong>Variação do produto:</strong> <?php echo $variacaoCorP; ?> <?php echo  $variacaoTamanhoP; ?>
               </div>
   
              
        
        
        
          			</div><!-- .texto -->
          		</div><!-- .bloco -->
     
     
           <?php     
           
           $orderCount +=1;
            };
            
            ?>

 
	      
	
	  
	  
	     <br/>



          <p>Clique abaixo para  deletar os pedidos dos Usuário  selecionados acima:</p>

         <input type="submit"  name="submit" value="Deletar" onclick="return recordAction('Delete');" /> 

      </form>
      
      
	

		<?php
 
	   }else{
		?>
		    <h2> Não há pedidos de contato realizados </h2>
	  <?php }; //FINAL PAGINA-------------------------------?>  
	  
	  
	            
	  
	      
	  
	  
	  
	  
	  





      










       </div>  


      	<?php /*
      	<div class="conteudo">
      		Conteúdo da aba 2
      	</div>


      	<div class="conteudo">
      		Conteúdo da aba 3
      	</div>    


      	<div class="conteudo">
      		Conteúdo da aba 4
      	</div>     
      	*/ ?>




      </div><!-- .content -->
      
      
      
      
      
      

      
      
      
	  
	  
	     		<script>        
	     		
	     		
	     		
	     		
	     		
	     		jQuery('.seta').click(function(){
                    rel = jQuery(this).attr('rel');
                    jQuery('.texto').hide();
                    jQuery('#'+rel).show();
                });

         	 
         		function checkAll(field){
         		for (i = 0; i < field.length; i++)
         			field[i].checked = true ;
         		}

         		function uncheckAll(field){
         		for (i = 0; i < field.length; i++)
         			field[i].checked = false ;
         		}

         		function selectCheckBox(){
         		    
         			field = document.getElementsByName('list[]');
         			
         			var i;
         			
         			ch	= document.getElementById('check');
         			
         			if(ch.checked){
         				checkAll(field);
         			}else{
         				uncheckAll(field);
         			}
         			
         		}   



         		function recordAction(tipo){ 
         		    
         			var flag   = false;
        
                  var chklength = document.getElementsByName("list[]").length;
                  
         			for(i=0;i<chklength;i++){
         			    
         			    flag = document.getElementById("check_"+i).checked;
         			    if(flag == true ){
         			   	  break;
         				};
         				
         			};
         			
         		     
         			if(flag == false){

         			if(tipo=="Delete"){
         			     alert("Por Favor, antes de prosseguir Selecione um pedido para deletar");
         				 return false; 
         			}else{
         			   	 alert("Por Favor, antes de prosseguir Selecione um pedido para editar");
         				 return false;				
         			};
         			

         			};  


                  if(tipo=="Delete"){
         			       if(!confirm('Você realmente deseja apagar este(s) pedido(s)')){
         			       return false;
         			       };
         		    }else{
         				   if(!confirm('Você realmente deseja editar este(s) pedido(s) ?')){
         				   return false;
         		           };	
         		    };
             return true;
        };

     	</script>
     	
