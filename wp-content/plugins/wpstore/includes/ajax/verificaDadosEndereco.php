<?php  

 
     require("../../../../../wp-load.php");
 
       global $current_user;
       get_currentuserinfo();
       $idUser = $current_user->ID;
       $userLogin = $current_user->user_login;
       $userEmail = $current_user->user_email;


       $displayNameUser="$current_user->user_firstname $current_user->user_lastname"; 

       $userEndereco = trim(get_user_meta($idUser,'userEndereco',true));if($userEndereco==""){$userEndereco="";};
       $userEnderecoNumero = trim(get_user_meta($idUser,'userEnderecoNumero',true));if($userEnderecoNumero==""){$userEnderecoNumero="";};
       $userComplemento = trim(get_user_meta($idUser,'userComplemento',true));if($userComplemento==""){$userComplemento="";};
       
       $userCidade = trim(get_user_meta($idUser,'userCidade',true));if($userCidade==""){$userCidade="";};
       $userBairro = trim(get_user_meta($idUser,'userBairro',true));if($userBairro==""){$userBairro="";};
       $userEstado = trim(get_user_meta($idUser,'userEstado',true));if($userEstado==""){$userEstado="";};
       $userCep = trim(get_user_meta($idUser,'userCep',true));if($userCep==""){$userCep="";};
       $userDDD = trim(get_user_meta($idUser,'userDDD',true));if($userDDD==""){$userDDD="";};
      
       $userTelefone = trim(get_user_meta($idUser,'userTelefone',true));if($userTelefone==""){$userTelefone="";};
 
         $userEndereco2 = trim(get_user_meta($idUser,'userEndereco2',true));
         $userEnderecoNumero2 = trim(get_user_meta($idUser,'userEnderecoNumero2',true));
         $userComplemento2 = trim(get_user_meta($idUser,'userComplemento2',true));
         $userCidade2 = trim(get_user_meta($idUser,'userCidade2',true));
         $userBairro2 = trim(get_user_meta($idUser,'userBairro2',true));
         $userEstado2 = trim(get_user_meta($idUser,'userEstado2',true));
         $userCep2 = trim(get_user_meta($idUser,'userCep2',true));

         $msg = "";

          if($userTelefone ==""){
             $msg  = "Telefone de contato , ";
          }
            
          if($userCep2 ==""){
             $msg  = "Cep | ";
          }
       
          if($userEndereco2  ==""){
             $msg  = "Endereço | ";
          }
         
          if($userBairro2 ==""){
             $msg  = "Bairro | ";
          }
            
         
          if($userCidade2 ==""){
             $msg  = "Cidade | ";
           }
         
          if($userEstado2 ==""){
             $msg  = "Estado";
          }
          
          if($msg !=""){
              $msg = "Preencha e salve os dados do endereço : ".$msg;
              echo $msg;
              
          }else{
            echo 1;  
          };
?>