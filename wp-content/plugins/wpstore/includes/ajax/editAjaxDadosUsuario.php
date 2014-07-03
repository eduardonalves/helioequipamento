<?php

              require("../../../../../wp-load.php");
 
              	$nomeUsuario = $_REQUEST['nomeUsuario'];
              	$nascimentoUsuario = $_REQUEST['nascimentoUsuario'];
              	$sexoUsuario = $_REQUEST['sexoUsuario'];
              	$enderecoUsuario = $_REQUEST['enderecoUsuario'];
              	$enderecoUsuarioNumero = $_REQUEST['enderecoUsuarioNumero'];
              	$complementoUsuario = $_REQUEST['complementoUsuario'];
              	$bairroUsuario = $_REQUEST['bairroUsuario'];
              	$cidadeUsuario = $_REQUEST['cidadeUsuario'];
              	$estadoUsuario = $_REQUEST['estadoUsuario'];
              	$cepUsuario = $_REQUEST['cepUsuario'];
              	
              	$enderecoUsuario2 = $_REQUEST['enderecoUsuario2'];
              	$enderecoUsuarioNumero2 = $_REQUEST['enderecoUsuarioNumero2'];
              	$complementoUsuario2 = $_REQUEST['complementoUsuario2'];
              	$bairroUsuario2 = $_REQUEST['bairroUsuario2'];
              	$cidadeUsuario2 = $_REQUEST['cidadeUsuario2'];
              	$estadoUsuario2 = $_REQUEST['estadoUsuario2'];
              	$cepUsuario2 = $_REQUEST['cepUsuario2'];
              	
              	$userCpf = $_REQUEST['userCpf'];   
      
              	$dddUsuario = $_REQUEST['dddUsuario'];
              	$telefoneUsuario = $_REQUEST['telefoneUsuario'];

                	$dddUsuarioCel = $_REQUEST['dddUsuarioCel'];
                  	$telefoneUsuarioCel = $_REQUEST['telefoneUsuarioCel'];
                  	

                  $msgError ='';

                   global $current_user;

                   $user_email =  $current_user->user_email ;

                   if(intval($current_user->ID)<=0){
                         $msgError =  "Permissão Administrativa negada";
                         echo $msgError;
                   }else{   
                       
                       
                        
                        if($userCpf !="" && $userCpf!="undefined"){
                             update_user_meta($current_user->ID,'userCpf', $userCpf);
                             update_user_meta($current_user->ID,'userCpf', $userCpf);
                          };
                          
                          
                       if($nomeUsuario !="" && $nomeUsuario !="undefined"){
                          update_user_meta($current_user->ID,'first_name', $nomeUsuario);
                          update_user_meta($current_user->ID,'display_name', $nomeUsuario);
                       };
                       if($nascimentoUsuario !="" && $nascimentoUsuario !="undefined"){
                          update_user_meta($current_user->ID,'userNascimento', $nascimentoUsuario);
                       };
                       if($sexoUsuario !="" && $sexoUsuario  !="undefined"){
                          update_user_meta($current_user->ID,'userSexo', $sexoUsuario);
                       };
                        if($enderecoUsuario !="" && $enderecoUsuario  !="undefined"){
                            update_user_meta($current_user->ID,'userEndereco', $enderecoUsuario);
                         };
                       if($enderecoUsuarioNumero !="" && $enderecoUsuarioNumero !="undefined"){
                           update_user_meta($current_user->ID,'userEnderecoNumero', $enderecoUsuarioNumero);
                        };
                        if($complementoUsuario !="" && $complementoUsuario !="undefined"){
                           update_user_meta($current_user->ID,'userComplemento', $complementoUsuario);
                        };
                        if($bairroUsuario !="" && $bairroUsuario !="undefined"){
                           update_user_meta($current_user->ID,'userBairro', $bairroUsuario);
                        };
                        if($cidadeUsuario !="" && $cidadeUsuario !="undefined"){
                           update_user_meta($current_user->ID,'userCidade', $cidadeUsuario);
                        };
                        if($estadoUsuario !="" && $estadoUsuario!="undefined"){
                           update_user_meta($current_user->ID,'userEstado', $estadoUsuario);
                        };
                         if($cepUsuario !="" && $cepUsuario !="undefined"){
                             update_user_meta($current_user->ID,'userCep', $cepUsuario);
                          };
                          
                          
                         //if($enderecoUsuario2 !="" && $enderecoUsuario2  !="undefined"){
                              update_user_meta($current_user->ID,'userEndereco2', $enderecoUsuario2);
                         //};
                        // if($enderecoUsuarioNumero2 !="" && $enderecoUsuarioNumero2 !="undefined"){
                             update_user_meta($current_user->ID,'userEnderecoNumero2', $enderecoUsuarioNumero2);
                         // };
                         // if($complementoUsuario2 !="" && $complementoUsuario2 !="undefined"){
                             update_user_meta($current_user->ID,'userComplemento2', $complementoUsuario2);
                         // };
                         // if($bairroUsuario2 !="" && $bairroUsuario2 !="undefined"){
                             update_user_meta($current_user->ID,'userBairro2', $bairroUsuario2);
                         // };
                         // if($cidadeUsuario2 !="" && $cidadeUsuario2 !="undefined"){
                             update_user_meta($current_user->ID,'userCidade2', $cidadeUsuario2);
                         // };
                         // if(trim($estadoUsuario2) !="" && $estadoUsuario2!="undefined"){
                             update_user_meta($current_user->ID,'userEstado2', $estadoUsuario2);
                         // };
                         //  if($cepUsuario2 !="" && $cepUsuario2 !="undefined"){
                               update_user_meta($current_user->ID,'userCep2', $cepUsuario2);
                         //   };
                            
                            
                            
                        if($dddUsuario !="" && $dddUsuario!="undefined"){
                             update_user_meta($current_user->ID,'userDDD', $dddUsuario);
                          };
                        if($telefoneUsuario !="" && $telefoneUsuario !="undefined"){
                           update_user_meta($current_user->ID,'userTelefone', $telefoneUsuario);
                        };
                        
                        
                        
                            if($dddUsuarioCel !="" && $dddUsuarioCel!="undefined"){
                                 update_user_meta($current_user->ID,'userDDDCel', $dddUsuarioCel);
                              };
                              
                            if($telefoneUsuarioCel !="" && $telefoneUsuarioCel !="undefined"){
                               update_user_meta($current_user->ID,'userTelefoneCel', $telefoneUsuarioCel);
                            };
                            
                            
                            
                        echo "Atualizado com sucesso!";
                   };




              	?>