<?php
      global $current_user;
      get_currentuserinfo();
      
      
      $idUser = $current_user->ID;
      $idView = 0;
      
      get_currentuserinfo(); 
      
      
      if ( current_user_can('edit_post', $post->ID) ) {

 
                   $idView = intval($_REQUEST['idUser']);
                  if($idView >0){
                     $idUser = $idView ;
                  };
     
      }
      
      
      $user_info = get_userdata($idUser);
 
      $userLogin =  $user_info->user_login;
      $userEmail =  $user_info->user_email;

      
      $displayNameUser="$user_info->user_firstname  $user_info->user_lastname"; 
      
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
       
 
            $nome = "$user_info->user_firstname  $user_info->user_lastname"; 
            if($user_info->display_name !=""){
             $nome =    $user_info->display_name;
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
                                         	
                                           <p class='clearfix'> <label for='nomeUsuario'  class='floatDados'>Nome:</label>
                                            <input type='text' class='required  userData nomeC geral userData' value='$displayNameUser' id='nomeUsuario' name='nomeUsuario' /></p>
                                             <p class='clearfix'> <label for='emailUsuario'  class='floatDados'> Email: </label>
                                         	 <input type='text' class='required  email userData cepC geral' value='$userEmail'  id='emailUsuario'  name='emailUsuario'	readonly='readonly' /></p>
                                          
                                            
                                          
                                                 <div class='clearfix'>


                                                    	<p class='dddCad'>
                                                    	<label for='dddUsuario'  class='floatDados'> DDD </label>
                                                  	<input type='text' class='required  number userData dddC geral' value='$userDDD'   maxlength='2' id='dddUsuario'  name='dddUsuario'  />
                                                  	 </p>

                                                  	<p class='telCad'>
                                                     <label for='telefoneUsuario'  class='floatDados'>	Telefone:</label>
                                                     <input type='text' class='required  number userData telC geral' value='$userTelefone' maxlength='9'   id='telefoneUsuario' name='telefoneUsuario'/>

                                                     </p>

                                                        <div class='clear'></div>

                                                     </div>
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                          
                                            <div class='clearfix'>
                                            
                                            
                                            	<p class='dddCad'>
                                            	<label for='dddUsuarioCel'  class='floatDados'> DDD</label> 
                                         	<input type='text' class='number userData dddC geral userData' value='$userDDDCel' maxlength='2'   id='dddUsuarioCel'  name='dddUsuarioCel' />
                                         	     </p>
                                         	     
                                         	     <p class='telCad'><label for='telefoneUsuarioCel'  class='floatDados'> Celular:</label>
                                                    <input type='text' class='number number userData telC geral userData' value='$userTelefoneCel' maxlength='9'  id='telefoneUsuarioCel' name='telefoneUsuarioCel' />
                                                    </p>
                                              <div class='clear'></div>   
                                             
                                             
                                             </div>
                                             
                                 
 
                                              <p class='clearfix'>  <label for='nascimentoUsuario'  class='floatDados'>Nascimento:</label>
                                              <input type='text' class='userData nascC geral userData' value='$userNascimento'   id='nascimentoUsuario'  name='nascimentoUsuario' /></p>
                                               
                                            
                                            
                                              
                                            
                                            
                                            
                                              <p class='clearfix'>  <label for='userCpf'  class='floatDados'>CPF:</label>
                                              <input type='text'    class='userData required  number' minlength='8'  value='$userCpf'   id='userCpf'  name='userCpf' /></p>
                                                            


                  
                                            
                                            
                                           
                                        
                           			       	 <p class='clearfix'><label>Sexo:</label>";
                           			       	 
                           			       	 
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
                           			       	  
                           			       	  </select>";
                           			       	 
                           			       	 
                           			       	 $htmlVar .="</p>
                                   	 

                                         	<div class='clear'></div> 
                                         	<hr/>

 
                     
           
 			
 				<div class='form-inline'> 
 				<br/>
 					<h2>Endereço</h2>";
 					
 					
 					      	  $htmlVar .= " 
 					      	  
 					      	  
 					      	  
 					      	     	<p class='clearfix'> <label for='cepUsuario' class='floatDados'>Cep:</label>
                                  	<input type='text' class='required  geral userData paisC campoCep' value='$userCep' id='cepUsuario' /> </p>
                                
                                       <div class='clear'></div>
                                         <div class='carregaCep hide'></div> 

                              
 					      	  
                                    <p class='clearfix'> <label for='enderecoUsuario' class='floatDados' >Endereço:</label>
                                	<input type='text' class='required  geral userData endC' value='$userEndereco' id='enderecoUsuario'  name='enderecoUsuario'   /></p>
                                	 <p class='clearfix'><label for='enderecoUsuarioNumero' class='floatDados'> Numero:</label>
                                	<input type='text' class='required geral userData numeroC' value='$userEnderecoNumero' id='enderecoUsuarioNumero'   name='enderecoUsuarioNumero' /></p>
	                                <p class='clearfix'> <label for='complementoUsuario' class='floatDados'>Complemento:</label>
                                	<input type='text' class='userData complC' value=' $userComplemento'  id='complementoUsuario'  name='complementoUsuario' /></p>
                                    <p class='clearfix'> <label for='bairroUsuario' class='floatDados'>Bairro:</label> 
                                	<input type='text' class='required  userData bairroC' value='$userBairro'  id='bairroUsuario' name='bairroUsuario' /></p>

                                	<p class='clearfix'><label for='cidadeUsuario' class='floatDados'> Cidade:</label>     
                                	<input type='text' class='required  geral userData cidadeC' value='$userCidade'  id='cidadeUsuario'   name='cidadeUsuario' /></p>
                                	<p class='clearfix'> <label for='estadoUsuario' class='floatDados'>Estado:</label><br/>  "; 
                                	
                                	
                              
                                	                  
                                     	        $htmlVar .= " <select    class='required geral userData estadoC'  id='estadoUsuario' name='estadoUsuario' >   ";
                                     	       
                                     	            
                                     	       $SELECTED = "";   
                                     	         $htmlVar .=   "<option value=''  $SELECTED >Selecione o estado</option>  " ;     
                                     	     
                                     	       if($userEstado=="AC"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; };
                                     	       $htmlVar .=   "<option value='AC'  $SELECTED >Acre</option>  " ; 
                                     	        if($userEstado=="AL"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                               $htmlVar .=  "<option value='AL' $SELECTED >Alagoas</option>  " ;  
                                                if($userEstado=="AP"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                $htmlVar .= "<option value='AP' $SELECTED >Amapá</option>   " ;   
                                                 if($userEstado=="AM"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                $htmlVar .=  "<option value='AM' $SELECTED >Amazonas</option>   "; 
                                                 if($userEstado=="BA"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                               $htmlVar .= "<option value='BA' $SELECTED >Bahia</option> " ;    
                                                if($userEstado=="CE"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                               $htmlVar .= "<option value='CE' $SELECTED >Ceará</option>   "; 
                                                if($userEstado=="DF"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                               $htmlVar .= "<option value='DF' $SELECTED >Distrito Federal</option>    "; 
                                                if($userEstado=="ES"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                               $htmlVar .= "<option value='ES' $SELECTED >Espírito Santo</option> ";   
                                                if($userEstado=="GO"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                               $htmlVar .= "<option value='GO' $SELECTED >Goiás</option>   ";  
                                                if($userEstado=="MA"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                $htmlVar .= "<option value='MA' $SELECTED >Maranhão</option>   " ; 
                                                 if($userEstado=="MT"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                               $htmlVar .= "<option value='MT' $SELECTED >Mato Grosso</option>   "; 
                                                if($userEstado=="MS"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                $htmlVar .=  "<option value='MS' $SELECTED >Mato Grosso do Sul</option>  " ; 
                                                 if($userEstado=="MG"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                              $htmlVar .= "<option value='MG' $SELECTED >Minas Gerais</option> " ; 
                                               if($userEstado=="PA"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                              $htmlVar .= "<option value='PA' $SELECTED >Pará</option>     " ;   
                                               if($userEstado=="PB"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                              $htmlVar .=  "<option value='PB' $SELECTED >Paraíba</option>   "; 
                                               if($userEstado=="PR"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                             $htmlVar .=  "<option value='PR' $SELECTED >Paraná</option>     " ;  
                                              if($userEstado=="PE"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                               $htmlVar .=  "<option value='PE' $SELECTED >Pernambuco</option>    " ;   
                                                if($userEstado=="PI"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                              $htmlVar .=  "<option value='PI' $SELECTED >Piauí</option>    ";  
                                              
                                                 if($userEstado=="RJ"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                   $htmlVar .=  "<option value='RJ' $SELECTED >Rio de Janeiro</option>    ";
                                              
                                              
                                               if($userEstado=="RN"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                              $htmlVar .=  "<option value='RN' $SELECTED >Rio Grande do Norte</option>   "; 
                                               if($userEstado=="RS"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                              $htmlVar .=  "<option value='RS' $SELECTED >Rio Grande do Sul</option>   ";  
                                               if($userEstado=="RO"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                              $htmlVar .= "<option value='RO' $SELECTED >Rondônia</option>   ";  
                                               if($userEstado=="RR"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                            $htmlVar .=  "<option value='RR' $SELECTED >Roraima</option>   ";    

                                            if($userEstado=="SP"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                             $htmlVar .=  "<option value='SP' $SELECTED >São Paulo</option>  " ;
                                             if($userEstado=="SC"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                             $htmlVar .=  "<option value='SC' $SELECTED >Santa Catarina</option>  " ;  
                                              if($userEstado=="SE"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                             $htmlVar .= "<option value='SE' $SELECTED >Sergipe</option>  ";      
                                              if($userEstado=="TO"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                             $htmlVar .=  "<option value='TO' $SELECTED >Tocantins</option>  "; 
                                              if($userEstado=="AC"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                        
                                                        
                                     	     $htmlVar .=  " </select>    </p>
 

                                	<div class='clear'></div>

                                	<hr/>";
                    
                    
                    
                    
                  /*
 				  $htmlVar .= "    	<div style='float:left;width:40%'>
 					<div class='field'><label>Endereço:</label><span class='userData' id='enderecoUsuario'>$userEndereco</p></div>
 					<div class='field'><label>Número:</label><span class='userData' id='enderecoUsuarioNumero'>$userEnderecoNumero</p></div>
 					</div>
 					<div style='float:left;width:40%'>
 					<div class='field'><label>Complemento:</label><span class='userData' id='complementoUsuario'> $userComplemento</p></div>
 					<div class='field'><label>Bairro:</label><span class='userData' id='bairroUsuario'>$userBairro</p></div>
 					</div>
 					<div style='float:left;width:40%'>
 					<div class='field'><label>Cidade:</label><span class='userData' id='cidadeUsuario'>$userCidade</p></div>
 					</div>
 					<div style='float:left;width:40%'>
 					<div class='field'><label>Estado:</label><span class='userData' id='estadoUsuario'>$userEstado</p></div>
 					</div>
 					<div style='float:left;width:40%'>
 					<div class='field'><label>CEP</label><span class='userData' id='cepUsuario'>$userCep</p></div>
 			    	</div>"; */




 			  $htmlVar .= "  	</div>

 				<div class='clear' id='entregando'></div>
     			<div class='form-inline content'>
         				<br/>


             			   <h2>Endereço alternativo para Entrega</h2>
             			   
             			   
             			     <p class='clearfix'><input type='checkbox' id='abrirEnderecoEntrega'  /><label for='abrirEnderecoEntrega'>Selecione se desejar escolher um endereço diferente do acima.   </label></p>
                              <br/> <br/>
             			   
             			   
             			   ";
             			   
             			   
             		      
             			   
             			   
             			   
             			   
             			   	  $htmlVar .= "    <div class='contentDadosEntrega'> 
             			   	    
                                                 <p class='clearfix'><input type='checkbox' id='copiarEndereco'  /><label for='copiarEndereco'>Importar dados cadastrados acima.   </label></p>
            
                                                     
                                                     <div class='clear'></div> 
                                                     
                                                     
                                                     
                                                   <p class='clearfix'> <label for='cepUsuario2' class='floatDados'>Cep:</label>
                                                  	<input type='text' class='required geral userData paisC campoCep2' value='$userCep2'  id='cepUsuario2' name='cepUsuario2' /> </p>
                                               
                                                  	<div class='clear'></div>
                                                         <div class='carregaCep hide'></div> 
                                                     
                                                     
                                                     
 
                                                     <p class='clearfix'><label for='enderecoUsuario2' class='floatDados'> Endereço:</label>
                                                 	<input type='text' class='required  geral userData endC' value='$userEndereco2' id='enderecoUsuario2' name='enderecoUsuario2'   /></p>
                                                 	 <p class='clearfix'><label for='enderecoUsuarioNumero2' class='floatDados'> Numero:</label>
                                                 	<input type='text' class='required geral userData numeroC' value='$userEnderecoNumero2' id='enderecoUsuarioNumero2'  name='enderecoUsuarioNumero2' /></p>
                 	                                <p class='clearfix'> <label for='complementoUsuario2' class='floatDados'>Complemento:</label>
                                                 	<input type='text' class='userData complC' value='$userComplemento2' id='complementoUsuario2' name='complementoUsuario2' /></p>
                                                 		 <p class='clearfix'> <label for='bairroUsuario2' class='floatDados'>Bairro:</label>
                                                 	<input type='text' class='userData bairroC' value='$userBairro2'   id='bairroUsuario2'  name='bairroUsuario2'  /></p>

                                                 	<p class='clearfix'> <label for='cidadeUsuario2' class='floatDados'>Cidade:</label>
                                                 	<input type='text' class='required geral userData cidadeC' value='$userCidade2'  id='cidadeUsuario2' name='cidadeUsuario2' /></p>
                                                 	<p class='clearfix'> <label for='estadoUsuario2' class='floatDados'>Estado:</label> <br/>
                                                 	
                                                 
                                                 	       <select    class='required geral userData estadoC'  id='estadoUsuario2' name='estadoUsuario2' >   ";
                                                 	       
                                                 	                 
                                                 	       $SELECTED = "";  
                                                 	        
                                                 	       $htmlVar .=   "<option value=''  $SELECTED >Selecione o estado</option>  " ;  
                                                 	       
                                                 	       if($userEstado2=="AC"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; };
                                                 	       $htmlVar .=   "<option value='AC'  $SELECTED >Acre</option>  " ; 
                                                 	        if($userEstado2=="AL"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                           $htmlVar .=  "<option value='AL' $SELECTED >Alagoas</option>  " ;  
                                                            if($userEstado2=="AP"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                            $htmlVar .= "<option value='AP' $SELECTED >Amapá</option>   " ;   
                                                             if($userEstado2=="AM"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                            $htmlVar .=  "<option value='AM' $SELECTED >Amazonas</option>   "; 
                                                             if($userEstado2=="BA"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                           $htmlVar .= "<option value='BA' $SELECTED >Bahia</option> " ;    
                                                            if($userEstado2=="CE"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                           $htmlVar .= "<option value='CE' $SELECTED >Ceará</option>   "; 
                                                            if($userEstado2=="DF"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                           $htmlVar .= "<option value='DF' $SELECTED >Distrito Federal</option>    "; 
                                                            if($userEstado2=="ES"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                           $htmlVar .= "<option value='ES' $SELECTED >Espírito Santo</option> ";   
                                                            if($userEstado2=="GO"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                           $htmlVar .= "<option value='GO' $SELECTED >Goiás</option>   ";  
                                                            if($userEstado2=="MA"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                            $htmlVar .= "<option value='MA' $SELECTED >Maranhão</option>   " ; 
                                                             if($userEstado2=="MT"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                           $htmlVar .= "<option value='MT' $SELECTED >Mato Grosso</option>   "; 
                                                            if($userEstado2=="MS"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                            $htmlVar .=  "<option value='MS' $SELECTED >Mato Grosso do Sul</option>  " ; 
                                                             if($userEstado2=="MG"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                          $htmlVar .= "<option value='MG' $SELECTED >Minas Gerais</option> " ; 
                                                           if($userEstado2=="PA"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                          $htmlVar .= "<option value='PA' $SELECTED >Pará</option>     " ;   
                                                           if($userEstado2=="PB"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                          $htmlVar .=  "<option value='PB' $SELECTED >Paraíba</option>   "; 
                                                           if($userEstado2=="PR"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                         $htmlVar .=  "<option value='PR' $SELECTED >Paraná</option>     " ;  
                                                          if($userEstado2=="PE"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                           $htmlVar .=  "<option value='PE' $SELECTED >Pernambuco</option>    " ;   
                                                            if($userEstado2=="PI"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                          $htmlVar .=  "<option value='PI' $SELECTED >Piauí</option>    ";  
                                                             
                                                                if($userEstado2=="RJ"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                                   $htmlVar .=  "<option value='RJ' $SELECTED >Rio de Janeiro</option>    ";
                                                     
                                                     
                                                           if($userEstado2=="RN"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                          $htmlVar .=  "<option value='RN' $SELECTED >Rio Grande do Norte</option>   "; 
                                                           if($userEstado2=="RS"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                          $htmlVar .=  "<option value='RS' $SELECTED >Rio Grande do Sul</option>   ";  
                                                           if($userEstado2=="RO"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                          $htmlVar .= "<option value='RO' $SELECTED >Rondônia</option>   ";  
                                                           if($userEstado2=="RR"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                        $htmlVar .=  "<option value='RR' $SELECTED >Roraima</option>   ";    
                                                       
                                                        if($userEstado2=="SP"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                         $htmlVar .=  "<option value='SP' $SELECTED >São Paulo</option>  " ;
                                                         
                                                        if($userEstado2=="SC"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                         $htmlVar .=  "<option value='SC' $SELECTED >Santa Catarina</option>  " ;  
                                                          if($userEstado2=="SE"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                         $htmlVar .= "<option value='SE' $SELECTED >Sergipe</option>  ";      
                                                          if($userEstado2=="TO"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                         $htmlVar .=  "<option value='TO' $SELECTED >Tocantins</option>  "; 
                                                          if($userEstado2=="AC"){$SELECTED = "selected='selected'"; }else{ $SELECTED= ""; }; 
                                                                    
                                                                    
                                                 	     $htmlVar .=  " </select>      </p>    
                                                 	   
                                                                       


                                   	<div class='clear'></div>

                                   	<hr/>
                                       </div>

                                        ";
                                        
                                        
                               /*         
                             $htmlVar .= "  <p id='copiarEnderecoC'><input type='checkbox' id='copiarEndereco'  /> Importar dados cadastrados acima. </p>
         					<div style='float:left;width:40%'>
         					<div class='field'><label>Endereço:</label><span class='userData' id='enderecoUsuario2'>$userEndereco2</p></div>
         					<div class='field'><label>Número:</label><span class='userData' id='enderecoUsuarioNumero2'>$userEnderecoNumero2</p></div>
         					</div>
         					<div style='float:left;width:40%'>
         					<div class='field'><label>Complemento:</label><span class='userData' id='complementoUsuario2'>$userComplemento2</p></div>
         					<div class='field'><label>Bairro:</label><span class='userData' id='bairroUsuario2'>$userBairro2</p></div>
         					</div>
         					<div style='float:left;width:40%'>
         					<div class='field'><label>Cidade:</label><span class='userData' id='cidadeUsuario2'> $userCidade2</p></div>
         					</div>
         					<div style='float:left;width:40%'>
         					<div class='field'><label>Estado:</label><span class='userData' id='estadoUsuario2'>$userEstado2</p></div>
         					</div>
         					<div style='float:left;width:40%'>
         					<div class='field'><label>CEP</label><span class='userData' id='cepUsuario2'>$userCep2</p></div>
         			    	</div> ";*/



                            		$htmlVar .= " 	</div>

                 						<div class='clear'></div>

                 			              </div>

                         		       ";



                    if(  $idView == 0){
         	 
                 	    		$htmlVar .= " 	<input class='btSalvarDados botaoO button' type='submit' value='Salvar Dados' />";
                  };
                     	
                     	
                  global $post;    	
               
                  if( intval($post->ID) != intval(get_idPaginaCheckout()) ){
                      
                      $pageCheck = get_permalink(get_idPaginaCheckout());
                      
                  $htmlVar .= "
                     	
                     	
                     <div class='clear'></div>	<br/>
                     	
                     	 <div class='buttons'> 
                     	       <div class='right btDir'><a href='".get_bloginfo('url')."' class='button'>Continuar comprando</a></div> 
                               <div class='left' ><a href='".$pageCheck."' class='button-alt btCalcularFrete'>Seguir para Pagamento</a></div>
                              
                               <div class='clear'></div>
                         </div>
                         
                         	";
                         	
                    };



                       $htmlVar .= "
                       
                       
                                                   
                                                   
                     	</form>
                     	

 </div>


 <span class='carregando' style='display:none' > <img src='".get_bloginfo('template_url')."/images/ajax-loader.gif' /></p>

 <p class='msgP'></p>


"; ?>


<?php $htmlVar .="</div>"; //div pagamento ?>

 <?php   $perfilPrint .=  $htmlVar;  ?>
