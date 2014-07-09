<?php
      global $current_user;
      get_currentuserinfo();
      $idUser = $current_user->ID;
      $userLogin = $current_user->user_login;
      $userEmail = $current_user->user_email;

      
      $displayNameUser="$current_user->user_firstname $current_user->user_lastname"; 
      
      $userSexo = trim(get_user_meta($idUser,'userSexo',true));if($userSexo=""){$userSexo=="";};
      $userNascimento = trim(get_user_meta($idUser,'userNascimento',true));if($userNascimento==""){$userNascimento="";};
      $userEndereco = trim(get_user_meta($idUser,'userEndereco',true));if($userEndereco==""){$userEndereco="";};
      $userEnderecoNumero = trim(get_user_meta($idUser,'userEnderecoNumero',true));if($userEnderecoNumero==""){$userEnderecoNumero="";};
      $userComplemento = trim(get_user_meta($idUser,'userComplemento',true));if($userComplemento==""){$userComplemento="";};
      $userSexo = trim(get_user_meta($idUser,'userSexo',true));if($userSexo==""){$userSexo="";};
      $userCidade = trim(get_user_meta($idUser,'userCidade',true));if($userCidade==""){$userCidade="";};
      $userBairro = trim(get_user_meta($idUser,'userBairro',true));if($userBairro==""){$userBairro="";};
      $userEstado = trim(get_user_meta($idUser,'userEstado',true));if($userEstado==""){$userEstado="";};
      $userCep = trim(get_user_meta($idUser,'userCep',true));if($userCep==""){$userCep="";};
      $userDDD = trim(get_user_meta($idUser,'userDDD',true));if($userDDD==""){$userDDD="";};
      $userTelefone = trim(get_user_meta($idUser,'userTelefone',true));if($userTelefone==""){$userTelefone="";};
      
      $userDDDCel = trim(get_user_meta($idUser,'userDDDCel',true));if($userDDDCel==""){$userDDDCel="";};
        $userTelefoneCel = trim(get_user_meta($idUser,'userTelefoneCel',true));if($userTelefoneCel==""){$userTelefoneCel="";};
      
      
      
        $userEndereco2 = trim(get_user_meta($idUser,'userEndereco2',true));if($userEndereco2==""){$userEndereco2="";};
        $userEnderecoNumero2 = trim(get_user_meta($idUser,'userEnderecoNumero2',true));if($userEnderecoNumero2==""){$userEnderecoNumero2="";};
        $userComplemento2 = trim(get_user_meta($idUser,'userComplemento2',true));if($userComplemento2==""){$userComplemento2="";};
        $userCidade2 = trim(get_user_meta($idUser,'userCidade2',true));if($userCidade2==""){$userCidade2="";};
        $userBairro2 = trim(get_user_meta($idUser,'userBairro2',true));if($userBairro2==""){$userBairro2="";};
        $userEstado2 = trim(get_user_meta($idUser,'userEstado2',true));if($userEstado2==""){$userEstado2="";};
        $userCep2 = trim(get_user_meta($idUser,'userCep2',true));if($userCep2==""){$userCep2="";};
        
         $userCpf = trim(get_user_meta($idUser,'userCpf',true)); 
        
 
            $nome = "$current_user->user_firstname $current_user->user_lastname";
            if($current_user->display_name !=""){
             $nome =    $current_user->display_name;
            };
           
   
 ?>
 
 
 
 
 
 
 <?php
 $htmlVar .="<div class='pagamento'> "; ?>
 
 
 
 
 
 <?php $htmlVar .="
 
  <div id='editDados'> 


 			<div class='fluid100'>
 				<div class='form-inline content'>
 				
 				<br/>	<br/>
 					<h2>Dados Gerais</h2>
 			  
 			  
                                         	<form id='infoPedido' class='clearfix  infoPedido' method='post' >
                                         	
                                           <span style='float:left'><labe> <label for='nomeUsuario'>Nome:</label></span>
                                            <input type='text' class='required  userData nomeC geral userData' value='$displayNameUser' id='nomeUsuario' name='nomeUsuario' />
                                             <span > <label for='emailUsuario'> Email: </label></span>
                                         	 <input type='text' class='required  email userData cepC geral' value='$userEmail'  id='emailUsuario'  name='emailUsuario'	readonly='readonly' />
                                            <span >  <label for='nascimentoUsuario'>Nascimento:</label></span>
                                         	<input type='text' class='  date userData nascC geral userData' value='$userNascimento'   id='nascimentoUsuario'  name='nascimentoUsuario' />
                                               
                                          
                                         
                                                <span >  <label for='userCpf'>CPF:</label></span>
                                             	<input type='text' class='required  number' minlength='8' value='$userCpf'   id='userCpf'  name='userCpf' />
                                         
                                         
                                         
                                            <span ><label for='dddUsuarioCel'> DDD</label> - <label for='telefoneUsuarioCel'> Celular:</label></span>
                                         	<input type='text' class='number userData dddC geral userData' value='$userDDDCel' maxlength='2'   id='dddUsuarioCel'  name='dddUsuarioCel' />
                                       
                                            <input type='text' class='number userData telC geral userData' value='$userTelefoneCel' maxlength='9'  id='telefoneUsuarioCel' name='telefoneUsuarioCel' />
                                         
                                           <span ><label for='dddUsuario'> DDD </label>-<label for='telefoneUsuario'>	Telefone:</label></span>
                                         	<input type='text' class='required  number userData dddC geral' value='$userDDD'   maxlength='2' id='dddUsuario'  name='dddUsuario'  />
                                           
                                            <input type='text' class='required  number userData telC geral' value='$userTelefone' maxlength='9'   id='telefoneUsuario' name='telefoneUsuario'/>
                                           <div class='clear'></div>
                           			       	<div style='float:left;width:40%'><br/>
                           			       	 <div class='field'><label>Sexo:";
                           			       	 
                           			       	 
                           			       	 $selectedFem = "";
                           			       	 $selectedMa = "";
                           			       	 
                           			       	 if($userSexo=='FEMININO'){
                           			       	 $selectedFem = "selected='selected'";
                       			       	     }elseif($userSexo=='MASCULINO'){
                       			       	     $selectedMa = "selected='selected'";    
                       			       	     }
                           			       	 
                           			       	  $htmlVar .="<select name='sexoUsuario' class='userData' id='sexoUsuario'>
                           			       	  <option value='MASCULINO' $selectedMa>MASCULINO</option>
                           			       	  <option value='FEMININO' $selectedFem>FEMININO</option>
                           			       	  
                           			       	  </select></label>";
                           			       	 
                           			       	 
                           			       	 $htmlVar .="</div>
                                   		   </div>
                                   		   
                                   		   
                                         	<div class='clear'></div>

                     

                                         	<div class='clear'></div>

                                         	<hr/>

 
                     
          


 				<div class='clear'></div>
 				<br/><br/>
 			
 				<div class='form-inline'> 
 				<br/>
 					<h2>Seu Endereço</h2>";
 					
 					
 					      	  $htmlVar .= "
                                    <span style='float:left'> <label for='enderecoUsuario'>Endereço:</label></span>
                                	<input type='text' class='required  geral userData endC' value='$userEndereco' id='enderecoUsuario'  name='enderecoUsuario'   />
                                	 <span style='float:left'><label for='enderecoUsuarioNumero'> Numero:</label></span>
                                	<input type='text' class='required geral userData numeroC' value='$userEnderecoNumero' id='enderecoUsuarioNumero'   name='enderecoUsuarioNumero' />
	                                <span style='float:left'> <label for='complementoUsuario'>Complemento:</label></span>
                                	<input type='text' class='userData complC' value=' $userComplemento'  id='complementoUsuario'  name='complementoUsuario' />
                                    <span style='float:left'> <label for='bairroUsuario'>Bairro:</label></span>
                                	<input type='text' class='required  userData bairroC' value='$userBairro'  id='bairroUsuario' name='bairroUsuario' />

                                	<span style='float:left'><label for='cidadeUsuario'> Cidade:</label></span>
                                	<input type='text' class='required  geral userData cidadeC' value='$userCidade'  id='cidadeUsuario'   name='cidadeUsuario' />
                                	<span style='float:left'> <label for='estadoUsuario'>Estado:</label></span>
                                	<input type='text' class='required  geral userData estadoC' value='$userEstado' id='estadoUsuario' name='estadoUsuario'/>
                                	<span style='float:left'> <label for='cepUsuario'>Cep:</label></span>
                                	<input type='text' class='required  geral userData paisC' value='$userCep' id='cepUsuario' />
                                	<div class='clear'></div>

                             


                                	<div class='clear'></div>

                                	<hr/>";
                    
                    
                    
                    
                  /*
 				  $htmlVar .= "    	<div style='float:left;width:40%'>
 					<div class='field'><label>Endereço:</label><span class='userData' id='enderecoUsuario'>$userEndereco</span></div>
 					<div class='field'><label>Número:</label><span class='userData' id='enderecoUsuarioNumero'>$userEnderecoNumero</span></div>
 					</div>
 					<div style='float:left;width:40%'>
 					<div class='field'><label>Complemento:</label><span class='userData' id='complementoUsuario'> $userComplemento</span></div>
 					<div class='field'><label>Bairro:</label><span class='userData' id='bairroUsuario'>$userBairro</span></div>
 					</div>
 					<div style='float:left;width:40%'>
 					<div class='field'><label>Cidade:</label><span class='userData' id='cidadeUsuario'>$userCidade</span></div>
 					</div>
 					<div style='float:left;width:40%'>
 					<div class='field'><label>Estado:</label><span class='userData' id='estadoUsuario'>$userEstado</span></div>
 					</div>
 					<div style='float:left;width:40%'>
 					<div class='field'><label>CEP</label><span class='userData' id='cepUsuario'>$userCep</span></div>
 			    	</div>"; */

 			  $htmlVar .= "  	</div>

 				<div class='clear' id='entregando'></div>
     			<div class='form-inline content'>
         				<br/>


             			   <h2>Endereço para Entrega</h2>
             			   
             			   
             			   		     <p class='clearfix'><input type='checkbox' id='abrirEnderecoEntrega'  /><label for='abrirEnderecoEntrega'> Selecione se desejar escolher um endereço diferente do acima .     </label></p>
                                         <br/> <br/>
                           
                           
                           ";
             			   
             			   
             			   
             			   
             			   
             			   
             			   
             			   
             			   	  $htmlVar .= "
             			   	  
             			   	      <div class='contentDadosEntrega'> 
                                   
                                                 <p><label for='copiarEndereco'>Importar dados cadastrados acima.   </label><input type='checkbox' id='copiarEndereco'  /></p>
            
                                                     
                                                     <div class='clear'></div>
 
                                                     <span style='float:left'><label for='enderecoUsuario2'> Endereço:</label></span>
                                                 	<input type='text' class='required  geral userData endC' value='$userEndereco2' id='enderecoUsuario2' name='enderecoUsuario2'   />
                                                 	 <span style='float:left'><label for='enderecoUsuarioNumero2'> Numero:</label></span>
                                                 	<input type='text' class='geral userData numeroC' value='$userEnderecoNumero2' id='enderecoUsuarioNumero2'  name='enderecoUsuarioNumero2' />
                 	                                <span style='float:left'> <label for='complementoUsuario2'>Complemento:</label></span>
                                                 	<input type='text' class='required userData complC' value='$userComplemento2' id='complementoUsuario2' name='complementoUsuario2' />
                                                 		 <span style='float:left'> <label for='bairroUsuario2'>Bairro:</label></span>
                                                 	<input type='text' class='userData bairroC' value='$userBairro2'   id='bairroUsuario2'  name='bairroUsuario2'  />

                                                 	<span style='float:left'> <label for='cidadeUsuario2'>Cidade:</label></span>
                                                 	<input type='text' class='required geral userData cidadeC' value='$userCidade2'  id='cidadeUsuario2' name='cidadeUsuario2' />
                                                 	<span style='float:left'> <label for='estadoUsuario2'>Estado:</label></span>
                                                 	<input type='text' class='required geral userData estadoC' value='$userEstado2'  id='estadoUsuario2' name='estadoUsuario2'/>
                                                 	<span style='float:left'> <label for='cepUsuario2'>Cep:</label></span>
                                                 	<input type='text' class='required geral userData paisC' value='$userCep2'  id='cepUsuario2' name='cepUsuario2' />
                                                 	<div class='clear'></div>
                              
                                   	<div class='clear'></div>

                                   	<hr/>

                                     </div>
                                        ";
                                        
                                        
                               /*         
                             $htmlVar .= "  <p id='copiarEnderecoC'><input type='checkbox' id='copiarEndereco'  /> Importar dados cadastrados acima. </p>
         					<div style='float:left;width:40%'>
         					<div class='field'><label>Endereço:</label><span class='userData' id='enderecoUsuario2'>$userEndereco2</span></div>
         					<div class='field'><label>Número:</label><span class='userData' id='enderecoUsuarioNumero2'>$userEnderecoNumero2</span></div>
         					</div>
         					<div style='float:left;width:40%'>
         					<div class='field'><label>Complemento:</label><span class='userData' id='complementoUsuario2'>$userComplemento2</span></div>
         					<div class='field'><label>Bairro:</label><span class='userData' id='bairroUsuario2'>$userBairro2</span></div>
         					</div>
         					<div style='float:left;width:40%'>
         					<div class='field'><label>Cidade:</label><span class='userData' id='cidadeUsuario2'> $userCidade2</span></div>
         					</div>
         					<div style='float:left;width:40%'>
         					<div class='field'><label>Estado:</label><span class='userData' id='estadoUsuario2'>$userEstado2</span></div>
         					</div>
         					<div style='float:left;width:40%'>
         					<div class='field'><label>CEP</label><span class='userData' id='cepUsuario2'>$userCep2</span></div>
         			    	</div> ";*/

         			$htmlVar .= " 	</div>

 						<div class='clear'></div>
         	
 			    </div>
 
         		         <input class='btSalvarDados botaoO button' type='submit' value='Salvar Dados' />
                     	
                     	
                     	</form>
                     	

 </div>


 <span class='carregando' style='display:none' > <img src='".get_bloginfo('template_url')."/images/ajax-loader.gif' /></span>

 <p class='msgP'></p>


"; ?>


<?php $htmlVar .="</div>"; //div pagamento ?>

 <?php   $perfilPrint .=  $htmlVar;  ?>
