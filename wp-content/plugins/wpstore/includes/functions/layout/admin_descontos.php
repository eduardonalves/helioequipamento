<?php

$moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
if($moedaCorrente==""){
  $moedaCorrente = "R$" ; 
}


if( intval($_REQUEST['idRmv'] )>0 ){
      if(is_admin()){
      global $wpdb;
      $tabela = $wpdb->prefix."";
      $tabela .=  "wpstore_orders_contacts";
      $ID = $_REQUEST['idRmv'];
      $resultQuery = $wpdb->query("DELETE FROM `$tabela` WHERE `id` = '$ID'");
  	  // wp_redirect(verifyURL(get_bloginfo('url')).'/wp-admin/admin.php?page=lista_descontos');
  	   echo "<script>window.location='".verifyURL(get_bloginfo('url'))."/wp-admin/admin.php?page=lista_descontos'</script>";
      };
  	  
};

if($_POST['submit']=="Deletar"){
  
for ($i=0; $i<=count($_POST['list']);$i++) {

      	   $ID = $_POST['list'][$i];
          
            global $wpdb;
            $tabela = $wpdb->prefix."";
            $tabela2 =  $tabela;
            $tabela3 =  $tabela;
            $tabela .=  "wpstore_descontos";
          
                   
           $resultQuery = $wpdb->query("DELETE FROM `$tabela` WHERE `id` = '$ID'");
        
         
        //FINAL insere  no total de Inscrições da Etapa  

	} 
	
//	wp_redirect(verifyURL(get_bloginfo('url')).'/wp-admin/admin.php?page=lista_descontos');
	  echo "<script>window.location='".verifyURL(get_bloginfo('url'))."/wp-admin/admin.php?page=lista_descontos'</script>";
    exit;
          
            
};   

?>

     




<div id="cabecalho">
	<ul class="abas">
		<li>
			<div class="aba gradient">
				<span>Opções de Descontos</span>
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
	
	
	

<?php

 
if( $_POST['submit']=="Criar Cupom" ){
    
    $numeroCupom  = $_POST['idCupom'];
    $tipoDesconto = $_POST['tipoDesconto'];	
    $valorDesconto = $_POST['valor'];
    $limite	 = $_POST['limite'];
    
    echo criarNovoDesconto($numeroCupom,$tipoDesconto,$valorDesconto,$limite);
}

 

 
   
   ?>
   


   
   
   <?php

   global $wpdb;
   $tabela = $wpdb->prefix."";
   $tabela .=  "wpstore_descontos";
 
   $oid = $_POST['oid'];
 
   $andQuery="";
   
    $sql = "SELECT *FROM `$tabela` ORDER BY `ID` DESC";

 

     if($oid != ''){
   
          $sql = "SELECT *FROM `$tabela`  WHERE `numeroCupom`='$oid' ORDER BY `ID` DESC";
       }

   $fivesdrafts = $wpdb->get_results($sql);
    
    ?>


    
        
 
 
 
 
            <div class="bloco"> 

    		<h3> 1)  Criar novo Cupom </h3>

    	              <span class="seta" rel='novoCupom'></span>
    				   	 <div class="texto" id='novoCupom'>  
    				   	 
    				   	 
    		 
    		 
    		                 <form action="<?php echo verifyURL(get_option( 'siteurl' )) ."/wp-admin/admin.php?page=lista_descontos";?>"  method="post" >

                             	 <label>Digite o NUMERO DO CUPOM DE DESCONTO : </label>
                             	<input type="text"  name="idCupom"/>  Ex:A001

                             	<br/><br/>

                             	<label>Tipo do desconto : </label>
                                 <select  id="tipoDesconto" name="tipoDesconto">
                                 <option value="Percentual">Percentual sobre o total </option>
                                  <option value="Valor">Valor Fixo em <?php echo $moedaCorrente; ?></option>
                                 </select>

                                 <br/><br/>

                                 <label>Digite o percentual ou valor de desconto : </label>
                                 <input type="text"  name="valor" /> Ex:1.242,20


                                 <br/><br/>

                                 <label>Se desejar, digite o numero de vezes correspondente ao limite de uso deste cupom : </label>
                                 <input type="text"  name="limite" />Ex:1

                                 <br/><br/>


                                 <input type="submit"  name="submit" value="Criar Cupom"/>



                             	</form>
                             	
                             	



    		   </div><!-- .texto -->
    			</div><!-- .bloco -->
    			
    			
    			
    
   
   
   
   
   
   
   
                     <div class="bloco"> 

                		<h3> 2 ) Lista de Cupoms Cadastrados   </h3>

                	                 <span class="seta" rel='cadCupom'></span>
                				   	 <div class="texto" id='cadCupom'>  



                                        
                            
                                         <form action="<?php echo verifyURL(get_option( 'siteurl' )) ."/wp-admin/admin.php?page=lista_descontos";?>"  method="post" >

                                            	 <label>Digite o NUMERO DO CUPOM DE DESCONTO : </label>
                                        		<input type="text"  name="oid" value="<?php echo $oid; ?>"/> 

                                                 <input type="submit"  name="submit" value="Filtrar"/>
                                        	</form><br/>




                                        	<?php 

                                        	$tipo_pagto = "";


                                            if ($fivesdrafts) {


                                                ?>

                                        	<form action="<?php echo verifyURL(get_option( 'siteurl' )) ."/wp-admin/admin.php?page=lista_descontos";?>"  method="post" >


                                        	<label>Selecionar Todos:</label><th width="28" ><input name="check" id="check" onClick="return selectCheckBox();"  type="checkbox"></th>


                                           	<ul>


                                           	<?php

                                                $orderCount = 0;

                                               foreach ( $fivesdrafts as $fivesdraft ){


                                                   $id = $fivesdraft->id;
                                                   $numeroCupom = $fivesdraft->numeroCupom;
                                               	   $tipoDesconto = $fivesdraft->tipoDesconto;
                                               	   $valorDesconto = $fivesdraft->valorDesconto;
                                                   $limite = $fivesdraft->limite ;
                                                   $qtdUsada = $fivesdraft->qtdUsado;

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


                                               	<li style="background:<?php echo $cor; ?>;padding:10px;margin-bottom:5px;" >


                                                       	      <input type='checkbox' id='check_<?php echo $id ?>'  name='list[]' value='<?php echo $id; ?>'/>
                                                               <br/><strong>Código do Cupom:</strong> <?php echo $numeroCupom ; ?> <br/>
                                                              <strong>Tipo de Desconto :</strong><?php echo $tipoDesconto; ?><br/>
                                                              <strong>Valor de Desconto :</strong> <?php echo  $valorDesconto; ?> <?php if($tipoDesconto=="Percentual"){ echo "%"; }else{}; ?><br/>
                                                              <strong>Limite de Uso:</strong> <?php echo   $limite ; ?> 
                                                              <strong>Quantidade Usada:</strong> <?php echo   $qtdUsada ; ?> 

                                                   </li>


                                                   <?php     

                                                   $orderCount +=1;
                                                    };

                                                    ?>

                                               </ul>


                                               <p>Clique abaixo para  deletar os CUPOMS   selecionados acima:</p>

                                                 <input type="submit"  name="submit" value="Deletar" onclick="return recordAction('Delete');" /> 

                                                </form>
                                                
                                                
                                                




                		   </div><!-- .texto -->
                			</div><!-- .bloco -->
                			
                			
 
 

           		<script>  

           	 
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
    
	

		<?php
 
	   }else{
		?>      
		
		    <h2  style="background:#eee;padding:10px;cursor:pointer"  > Não há cupons cadastrados </h2>   
		    
		    
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






        </form>





         <script>

         jQuery('.seta').click(function(){
             rel = jQuery(this).attr('rel');
             jQuery('.texto').hide();
             jQuery('#'+rel).show();
         });    




         </script>
	  
