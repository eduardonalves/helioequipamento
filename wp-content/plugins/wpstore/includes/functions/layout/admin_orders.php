<?php
$moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
if($moedaCorrente==""){
  $moedaCorrente = "R$" ; 
}

 
$plugin_directory = str_replace('functions/','functions/',plugin_dir_url( __FILE__ ));


?>

<?php


if( intval($_REQUEST['idRmv'] )>0 ){
      if(is_admin()){
      global $wpdb;
      $tabela = $wpdb->prefix."";
      $tabela .=  "wpstore_orders_comments";
      $ID = $_REQUEST['idRmv'];
      $resultQuery = $wpdb->query("DELETE FROM `$tabela` WHERE `id` = '$ID'");
  	  //wp_redirect(verifyURL(get_bloginfo('url')).'/wp-admin/admin.php?page=lista_pedidos');
  	  	  echo "<script>window.location='".verifyURL(get_bloginfo('url'))."/wp-admin/admin.php?page=lista_pedidos'</script>";
      };
  	  
};

if($_POST['submit']=="Deletar"){
  
for ($i=0; $i<=count($_POST['list']);$i++) {

      	   $ID = $_POST['list'][$i];
          
            global $wpdb;
            $tabela = $wpdb->prefix."";
            $tabela2 =  $tabela;
            $tabela3 =  $tabela;
            $tabela .=  "wpstore_orders";
            $tabela2 .=  "wpstore_orders_address";
            $tabela3 .=  "wpstore_orders_products";
                   
                   
           $resultQuery = $wpdb->query("DELETE FROM `$tabela` WHERE `id_pedido` = '$ID'");
           
           $resultQuery = $wpdb->query("DELETE FROM `$tabela2` WHERE `id_pedido` = '$ID'");
           
           $resultQuery = $wpdb->query("DELETE FROM `$tabela3` WHERE `id_pedido` = '$ID'");
         
           //FINAL insere  no total de Inscrições da Etapa  

	} 
	
        //	wp_redirect(verifyURL(get_bloginfo('url')).'/wp-admin/admin.php?page=lista_pedidos');
		  echo "<script>window.location='".verifyURL(get_bloginfo('url'))."/wp-admin/admin.php?page=lista_pedidos'</script>";
    exit;
          
            
}elseif($_POST['submit']=="Gravar"){
    
    $status  = $_POST['statusID'];
    
    $comentario = $_POST['comentario'];
    
    for ($i=0; $i<=count($_POST['list']);$i++) {   
      $ID = $_POST['list'][$i];
      alteraPedidoStatus($ID,$status,$comentario);
    };
    
    // ewp_redirect(verifyURL(get_bloginfo('url')).'/wp-admin/admin.php?page=lista_pedidos');
    // echo "<script>window.location='".verifyURL(get_bloginfo('url'))."/wp-admin/admin.php?page=lista_pedidos'</script>";
    
}


 
   global $wpdb;
   $tabela = $wpdb->prefix."";
   $tabela .=  "wpstore_orders";
   
   

   $oid = $_POST['oid'];

   $oemail = $_POST['oemail'];


    $andQuery="";
   
    $sql = "SELECT *FROM `$tabela` ORDER BY `ID` DESC";

     if(trim($oemail) != ''){
         $uid = trim($oemail);
         $idUser =  email_exists($uid);
        $sql = "SELECT *FROM `$tabela`  WHERE `id_usuario`='$idUser' ORDER BY `ID` DESC";
     }

     if(trim($oid) != ''){
         $oid = trim($oid);
         $sql = "SELECT *FROM `$tabela`  WHERE `id_pedido`='$oid' ORDER BY `ID` DESC";
      }
 

   $fivesdrafts = $wpdb->get_results($sql);
    
    ?>

    

   
   
   
   
   
   
   
   
   
       <div id="cabecalho">
       	<ul class="abas">
       		<li>
       			<div class="aba gradient">
       				<span>Controle de Pedidos</span>
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
       	
       	
       	
       	
       	
       	<form action="<?php echo verifyURL(get_option( 'siteurl' ))  ."/wp-admin/admin.php?page=lista_pedidos";?>"  method="post" >

            <p>Pesquise por :</p>
     		<label>Nnumero do pedido : </label>
     		<input type="text"  name="oid" value="<?php echo $oid; ?>"/>  <br/>
     		<label>ou pelo E-mail do cliente : </label>
     		<input type="text"  name="oemail" value="<?php echo $oemail; ?>"/> 

              <input type="submit"  name="submit" value="Filtrar"/>
     	</form><br/>

   
       		
 
	
	<?php 
	
	$tipo_pagto = "";
    
    
    if ($fivesdrafts) {
        
        
        ?>
 
	<form action="<?php echo verifyURL(get_option( 'siteurl' )) ."/wp-admin/admin.php?page=lista_pedidos";?>"  method="post" >
	
	
	<label>Selecionar Todos:</label>
	
	<input name="check" id="check" onClick="return selectCheckBox();"  type="checkbox"> 

 

   	<?php

        $orderCount = 0;

       foreach ( $fivesdrafts as $fivesdraft ){
           
        
           $id = $fivesdraft->id;
           $idPedido = $fivesdraft->id_pedido;
           $idUsuario = $fivesdraft->id_usuario;
       	   $valor_total = $fivesdraft->valor_total;
       	   $frete = $fivesdraft->frete;
           $tipo_pagto = $fivesdraft->tipo_pagto;
           $status_pagto = $fivesdraft->status_pagto;
           $comentario_cliente = $fivesdraft->comentario_cliente ;
           $comentario_admin = $fivesdraft->comentario_admin;


           $dataArray = explode('.',$idPedido);

           $get_total_Products = custom_get_total_products_in_order($idPedido); 
           
           
           	    if($status_pagto=="PENDENTE"){
   				$cor = "#fffadf ";
   				}elseif($status_pagto=="VERIFICANDO"){
    			$cor = "#A2C6DE";
    			}elseif($status_pagto=="APROVADO"  || $status_pagto=="TRANSPORTADORA"  ||$status_pagto=="SEPARACAO"  || $status_pagto=="ENTREGUE" ){
   				$cor = "#b2ffc8";
   				}elseif($status_pagto=="CANCELADO"){
   				$cor = "#ff6865";
   				}else{
   				$cor = "#fffadf";
   				};
   				

        ?>
        
        
        
        
        <?php
         
             /*
             $cupom=  getCupomInfos($comentario_admin);  
             $numeroCupom = $cupom[0];
      
             $desconto = 0.00;
                $vt =$valor_total;
                $vt = str_replace('.','',$vt);
                $vt = str_replace(',','.',$vt);
                $vt = floatval($vt);


                 if($cupom[1]=="Valor"){ 
                    $msg =  $cupom[1]." $moedaCorrente".$cupom[2];
                    $desconto = floatval(str_replace(',','.',$cupom[2]));
                  }elseif($cupom[1]=="Percentual"){ 
                   $msg = $cupom[1]." " .$cupom[2]."%" ;  

                    $desconto = ( $vt*floatval(str_replace(',','.',$cupom[2])) ) / 100 ;


                 };
                 
                 
                  $precoAdddArray = explode('(R$',$frete);
                  $tipoFrete = $precoAdddArray[0];
                  $freteV= trim(str_replace(')','',$precoAdddArray[1]));
                  $freteV =  floatVal(str_replace(',','.',$freteV));
                  
             
                    
                  $vtf = $valor_total-$desconto ;

             	  
              	   $totalPagto = getPriceFormat(custom_get_sum( $vtf,$freteV));
             	  
             	  if($frete==""){$frete = "0.00"; }
             	  
             	  */
             	  
             	  
             	  
             	  
             	  
             	  
             	  
                                          $cupom=  explode('***',$comentario_admin);

                                          $numeroCupom = $cupom[0];

                                         $desconto = 0.00;
                                         $vt = $valor_total;
                                         $vt = str_replace('.','',$vt);
                                         $vt = str_replace(',','.',$vt);
                                         $vt = floatval($vt);


                                          if($cupom[1]=="Valor"){ 
                                             $msg =  $cupom[1]." $moedaCorrente".$cupom[2];
                                             $desconto = floatval(str_replace(',','.',$cupom[2]));
                                           }elseif($cupom[1]=="Percentual"){
                                            $msg = $cupom[1]." " .$cupom[2]."%" ;  

                                             $desconto = ( $vt*floatval(str_replace(',','.',$cupom[2])) ) / 100 ;


                                          };


                                           $precoAdddArray = explode('(R$',$frete);
                                  	     $tipoFrete = $precoAdddArray[0];
                                           $frete= str_replace(')','',$precoAdddArray[1]);
                                           $frete =  str_replace(',','.',$frete);

                                         	$vtf = $vt+floatVal($frete)-$desconto ;

                                      	$totalPagto = $vtf;



                           	  if($frete==""){$frete = "0.00"; }
                           	  
                           	  
                           	  
                           	  
             	
              
                     $user_info = get_userdata($idUsuario);

                     $user_email =  $user_info->user_email;

                     $nome = "$user_info->user_lastname $user_info->user_firstname ($user_email )";
             
            
             
                   
                        	  if($tipo_pagto=="Depósito"){
                        	      $imgPagto = "".$plugin_directory."images/deposito.png";
                        	  }elseif($tipo_pagto=="Retirar na Loja"){
                        	      $imgPagto = "".$plugin_directory."images/retirada.png"; 
                        	  }elseif($tipo_pagto=="Moip"){
                               $imgPagto = "".$plugin_directory."images/moip.png"; 
                           }elseif($tipo_pagto=="Pagseguro"){
                               $imgPagto = "".$plugin_directory."images/pagseguro.png"; 
                           }elseif($tipo_pagto=="Paypal"){
                               $imgPagto = "".$plugin_directory."images/paypal.png"; 
                           }elseif($tipo_pagto=="Cielo"){
                               $imgPagto = "".$plugin_directory."images/cielo.png"; 
                           }
                        	?>    
             
 
       	
       	    <div class="bloco" style="background:<?php echo $cor; ?>;padding:10px;margin-bottom:5px;"  >      

    		<h3> <input type='checkbox' id='check_<?php echo $orderCount ?>'  name='list[]' value='<?php echo $idPedido; ?>'/>  <?php echo $idPedido; ?> |  <?php echo  $nome; ?></h3>

    		<span class="seta" rel='box_<?php echo $orderCount ?>'></span>     
    		
    		
    		<div class="texto" id='box_<?php echo $orderCount ?>'>
    		
    	    
       	
      
       	
               <div>
               	      
                       <br/><strong>ID do pedido:</strong> <?php echo $idPedido; ?>
                       <br/><strong>Cliente : </strong>  <?php echo  $nome; ?> 
                       <br/><strong>Data:</strong> <?php echo $dataArray[4]; ?>/<?php echo $dataArray[3]; ?>/<?php echo $dataArray[2]; ?> 
                       <br/><strong>Tipo de Pagamento:</strong><img src='<?php echo $imgPagto; ?>' />  <?php echo $tipo_pagto; ?> 
                       <br/><strong>Quantidade de Produtos:</strong> <?php echo $get_total_Products; ?>
               </div>
               
               
                 <div class="clear"></div>
                 <br/><br/>     
                 
                 
                <div>
                   <br/><strong>Status:</strong><?php echo $status_pagto; ?> 
                   <br/><strong>SubTotal:</strong> <?php echo $moedaCorrente; ?><?php echo $valor_total; ?>         
                   <br/><strong>Frete:</strong>  <?php echo " ($tipoFrete) $moedaCorrente".$frete; ?> 
                   <?php //if($numeroCupom!=""){ ?>
                   <br/> <strong>Desconto:</strong> (-<?php echo $moedaCorrente; ?>  <?php echo $desconto ; ?>)
                    <?php //}; ?>
                  <br/> <strong>Total:</strong> <?php echo $moedaCorrente; ?><?php echo  $totalPagto; ?>  
                </div>  
                
              
              <div class="clear"></div> 
              
              <br/><br/>
              
                <div class='controleStatus'>
                   <a target="_BLANK" href="<?php echo get_bloginfo('url'); ?>/pedido/?order=<?php echo $idPedido; ?>">Ver Detalhes</a> -
                   <a  class="bttrocar" rel="check_<?php echo $orderCount ?>"  href="#trocarstatus">Mudar Status</a>
                </div> 
                 <div class='clear'></div>
              <br/>
              
              <br/>
                  
                   <table width="650" class="table <?php echo $idPedido; ?>">
                   
                   
                       <thead>
                              <tr>
                                  <td class="ta-left" width="20%"><strong>Data</strong></td>
                                  <td class="ta-left"><strong>Status</strong></td>
                                  <td class="ta-left"><strong>Comentário</strong></td>
                               </tr>
                       </thead>
                       
                       
                       <tbody>



                                           <tr>
                                               <td class="ta-left va-top"><?php echo $dataArray[4]; ?>/<?php echo $dataArray[3]; ?>/<?php echo $dataArray[2]; ?></td>
                                               <td class="ta-left va-top">PENDENTE</td>
                                               <td class="ta-left va-top">Aguardando confirmação de pagamento. </td>
                                           
                                           </tr>
                                           
                           
                        <?php


                               $tabela = $wpdb->prefix."";
                               $tabela .=  "wpstore_orders_comments";

                               $fivesdrafts = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM  `$tabela` WHERE `id_pedido`='$idPedido' ORDER BY `id`  ASC  ",1,'' ) );

                               // Adicionando PRODUTOS
                               $infoCielo = "";
                               $infoCieloXML = "";
                               foreach ( $fivesdrafts as $item=>$fivesdraft ){

    		                    $id= $fivesdraft->id;
    		                    $comentario_cliente = $fivesdraft->comentario_cliente;
                                $userCidade = $fivesdraft->cidade;
                                $status_pagto = $fivesdraft->status_pagto ;
                                $data = $fivesdraft->data;
                           
                                $infoCieloXML =  $fivesdraft->comentario_pagt;

                          ?>





                                  <tr>
                                       <td class="ta-left va-top"><?php echo  $data ; ?></td>
                                       <td class="ta-left va-top"><?php echo $status_pagto; ?></td>
                                       <td class="ta-left va-top"><?php echo $comentario_cliente; ?>
                                        (<a  href="<?php echo get_bloginfo('url').'/wp-admin/admin.php?page=lista_pedidos'; ?>&idRmv=<?php echo  $id; ?>">Remover</a>)
                                        </td>
                                   </tr>


                           <?php   };  ?>
                           
                           
                           
                                </tbody>
                               </table>
                    
     

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



         		</div>   <!-- .texto -->
          	</div><!-- .bloco -->
          	
         
     
     
           <?php     
           
           $orderCount +=1;
            };
            
            ?>

 
 
   <br/>
   
   <div id="trocarstatus"></div>
   
   <h3>Escolha acima os pedidos que deseja editar  </h3>

   <br/>  

	<select name="statusID">
		<option value="0">Mudar Status</option>
       <option value="PENDENTE">PENDENTE</option>
       <option value="VERIFICANDO">PAGAMENTO EM VERIFICAÇÃO</option>
       <option value="APROVADO">APROVADO</option>
       <option value="SEPARACAO">PRODUTOS EM SEPARAÇÃO</option>
       <option value="TRANSPORTADORA">ENCOMENDA ENTREGUE A TRANSPORTADORA</option>  
       <option value="ENTREGUE">ENTREGUE</option>
       <option value="CANCELADO">CANCELADO</option>     
    </select>  


    <br/>

    <p>Preencha abaixo para fazer uma anotação sobre a mundança no status do pedido. Esta mensagem será encaminhada por email ao cliente.</p>

    <textarea name="comentario" id="comentario" style="width:50%;height:150px;" ></textarea>
    <br/>
    
    

   <input type="submit"  name="submit" value="Gravar" onclick="return recordAction('Gravar');" />
   <input type="submit"  name="submit" value="Deletar" onclick="return recordAction('Delete');" /> 

          



	</div><!-- .content -->


 

	</form>

 
                    
 
 
 
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
          
          
          
          
          
                 	 jQuery('.seta').click(function(){
                 	     rel = jQuery(this).attr('rel');
                 	     jQuery('.texto').hide();
                 	     jQuery('#'+rel).show();
                 	 });   
                 	 
                 	 
                 	 
                 	 
                 	 
                 	         jQuery('.verHistorico').click(function(){
                                   rel = jQuery(this).attr('rel');
                                   jQuery('.'+rel).fadeIn();

                               });
                               
                                jQuery('.bttrocar').click(function(){
                                     rel = jQuery(this).attr('rel');
                                     jQuery('input#'+rel).attr('checked','checked');

                                 });
                      





       	</script>
       	
       	
       	
       	
       	
	
	
	

		<?php
 
	   }else{
		?>
		    <h2> Não há pedidos realizados </h2>
	  <?php }; //FINAL PAGINA-------------------------------?>
