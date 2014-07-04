<?php  
       //session_start();
       //require("../../../../../wp-load.php");
 
       global $current_user;
       
       get_currentuserinfo();
       
       $idUser = $current_user->ID;
       $userLogin = $current_user->user_login;
       $userEmail = $current_user->user_email;
     
       $pesoTotal = $peso;
  
       $displayNameUser = trim("$current_user->user_firstname $current_user->user_lastname"); 
       if($displayNameUser ==""){$displayNameUser=$userLogin;};
  
       

       $userEndereco = trim(get_user_meta($idUser,'userEndereco',true));if($userEndereco==""){$userEndereco="";};
       $userEnderecoNumero = trim(get_user_meta($idUser,'userEnderecoNumero',true));if($userEnderecoNumero==""){$userEnderecoNumero="";};
       $userComplemento = trim(get_user_meta($idUser,'userComplemento',true));if($userComplemento==""){$userComplemento="";};
       
       $userCidade = trim(get_user_meta($idUser,'userCidade',true));if($userCidade==""){$userCidade="";};
       $userBairro = trim(get_user_meta($idUser,'userBairro',true));if($userBairro==""){$userBairro="";};
       $userEstado = trim(get_user_meta($idUser,'userEstado',true));if($userEstado==""){$userEstado="";};
       
       $userPais = trim(get_user_meta($idUser,'userPais',true));if($userPais==""){$userPais="Brasil";};
       
       $userCep = trim(get_user_meta($idUser,'userCep',true));if($userCep==""){$userCep="";};
       $userDDD = trim(get_user_meta($idUser,'userDDD',true));if($userDDD==""){$userDDD="";};
      
       $userTelefone = trim(get_user_meta($idUser,'userTelefone',true));if($userTelefone==""){$userTelefone="";};
 
       $userEndereco2 = trim(get_user_meta($idUser,'userEndereco2',true));if($userEndereco2==""){$userEndereco2= $userEndereco ;};
       $userEnderecoNumero2 = trim(get_user_meta($idUser,'userEnderecoNumero2',true));if($userEnderecoNumero2==""){$userEnderecoNumero2= $userEnderecoNumero;};
       $userComplemento2 = trim(get_user_meta($idUser,'userComplemento2',true));if($userComplemento2==""){$userComplemento2= $userComplemento;};
       $userCidade2 = trim(get_user_meta($idUser,'userCidade2',true));if($userCidade2==""){$userCidade2= $userCidade;};
       $userBairro2 = trim(get_user_meta($idUser,'userBairro2',true));if($userBairro2==""){$userBairro2= $userBairro;};
       $userEstado2 = trim(get_user_meta($idUser,'userEstado2',true));if($userEstado2==""){$userEstado2= $userEstado;};
       $userCep2 = trim(get_user_meta($idUser,'userCep2',true));if($userCep2==""){$userCep2= $userCep;};
       
 
       $valor = custom_get_total_price_session_order(); 
       
       $comentario = "";
       
       if($_SESSION['cupomDesconto']){
               $info = $_SESSION['cupomDesconto'];
               $infoCupom =  explode('***',$_SESSION['cupomDesconto']);

               $numeroCupom = $infoCupom[0];
               $tipoDesconto = $infoCupom[1];
               $valorDesconto = $infoCupom[2];

               $info = "$numeroCupom***$tipoDesconto***$valorDesconto";
               
               
                $total = getCupomDisponivel($numeroCupom);
                
                if($total>0){
                  $comentario = $info;
                };
               
              
               addUseCupom($info);
               unset($_SESSION['cupomDesconto']);
               
       };           
       
       
 
              $obs = "";
              if( intval($valor)<0){
                 $positivoTotal = str_replace('-','',$valor);
                  $obs = "<br/><span style='font-size:0.6em;color:red'>Seu cupom é maior que o total de suas compras . Em breve você receberá um  novo cupom no valor de $positivoTotal. </span><br/><br/>";
                     $comentario .= $obs;
                 $comentario .= $obs;
                 $valor= "0.00";
              }

     
              
       if( $idUser > 0){
       $pedidoID = gerarPedido($idUser,$valor,$tipoFrete,$tipoPagto,'PENDENTE',$comentario);
       };
        
       
       
       if($pedidoID == 'ERROR1001'){
           
           $msg = 'ERROR1001: Erro ao gravar pedido';
           
       }else{
           
           gravarEnderecoPedido($pedidoID,$idUser,$userCep2,$userEstado2,$userCidade2,$userBairro2,$userEndereco2,$userEnderecoNumero2,$userComplemento2);
           
           gravarProdutosPedido($pedidoID,$idUser);
           
           $msg =   $msg."||".$pedidoID;
           
 
                   $blogid = intval(get_current_blog_id());  
               		if($blogid>1){  unset($_SESSION['carrinho'.$blogid]);   }else{   unset($_SESSION['carrinho']);  }; 
          
          
                $user_info = get_userdata($idUser);
 
                 $user_email = $user_info->user_email;
                 $nome = $user_info->user_firstname . " ". $user_info->user_lastname;
                 if(trim($nome)==""){ $nome = $user_info->user_login; };
          
	              // ENVIO DE EMAIL ----------------------------------------------------------
	               
	        
  				     $header = "<div style='width:100%;padding:5px;background:#15829D;margin-bottom:20px'><a href='".get_bloginfo('url')."'><img src='".$plugin_directory."images/topo-email.png' /></a></div>";

                     $footer = "<div style='width:100%;padding:5px;background:#0A2A35;margin-top:20px'><a href='".get_bloginfo('url')."'><img src='".$plugin_directory."images/footer-email.png'/></a></div>";


                             $idLogin = get_idPaginaLogin();
                             $pageLogin = get_permalink($idLogin);



                     $mensagemEmail = "
                        <h1>Olá $nome,  </h1> 
                        <p>Seu pedido foi registrado em nosso site. <br/> <strong> ".get_bloginfo('name')." </strong> ! Obrigado por comprar conosco.</p>
                        <p>Para acessar sua conta  siga <a href='".$pageLogin."' >".$pageLogin."</a> . </p>   ";
                        
                        
                        
                       $mensagemEmailOrder = custom_get_order_user(false,$pedidoID,'off');
                      
                       $mensagemEmail .=  $mensagemEmailOrder ; 
                        
                        $mensagemEmail2 = "
                              <h1>Olá Administrador ,  </h1> 
                               <p>Novo pedido realizado <strong>".get_bloginfo('name')."</strong>.</p>
                               <p>usuario : $user_email <br/>  Nome : $nome <br/>  </p>
                               <p>Para administrar faça o login em  <a href='".$pageLogin."' >".$pageLogin."</a> . </p> 
                              ";
                              
                       $mensagemEmail2 .=  $mensagemEmailOrder ;       
                    
                      $assuntoEmail = "NOVO PEDIDO : ".get_bloginfo('name')."";
                      $assuntoEmail2 = "NOVO PEDIDO  :  ".get_bloginfo('name')."";
                      
                      $msgF = $msg;


                      if(  $idUser > 0 && $msgF !=""){
                      //echo $idUser;
                      include( $CURRENT_SOURCE_FOLDERB.'/email.php');
                      };
                      
              // FINAL ENVIO DE EMAIL ----------------------------------------------------------
       };
 ?>