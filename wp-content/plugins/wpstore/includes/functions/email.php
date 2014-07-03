<?php  


$nome = $nome;

$mail_destino = $user_email;  

if($mail_destino ==""){
    global $current_user;
    get_currentuserinfo();
    $mail_destino =  $current_user->user_email;
}
 
  
 $emailAdmin =  get_option('smtpUserWPSHOP');   
 
$emailWpAdmin = $emailAdmin;
if($emailAdmin==""){   
    $emailAdmin =  get_option('emailAdminWPSHOP');
    $emailWpAdmin = $emailAdmin;
     
}elseif($emailAdmin==""){
$emailAdmin =  get_bloginfo('admin_email');
$emailWpAdmin = $emailAdmin;
};

$smtpPort = get_option('smtpPortWPSHOP');
$smtpSecure= get_option('smtpSecureWPSHOP');
$smtpHost= get_option('smtpHostWPSHOP');
$smtpUser= get_option('smtpUserWPSHOP');
$smtpPass= get_option('smtpPassWPSHOP');
$smtpFrom= get_option('smtpUserWPSHOP');    
 



$urlWpAdmin = get_bloginfo('siteurl');

 
$assunto= "$assuntoEmail";
$assunto2= "$assuntoEmail2";
 
  $plugin_directory = str_replace('ajax/','',plugin_dir_url( __FILE__ ));
 
  $msg = "
    <html>
    <head>
    <meta http-equiv='Content-Type' content='text/html;'>
	<style type='text/css'>
	body {color: Black;font-size:12px;font-family:'Verdana';font-color:Blue}
	h2 { color:red; }
	.teste { color:red; }
	.creditos {font-size:12px }
	a{color: Blue;}
	a hover {color: Blue;}
	img { border:none; }
	.clear{clear:both}
	</style>
	 </head>
    <body>
	<table width='600' border='0' align='center' bgcolor='#fff' style='color:#222;' >
    <tr><td><span class='style1'><a title='topo-newsletter' href='".get_bloginfo('url')."'>
   <img class='aligncenter size-full wp-image-3486' title='".get_bloginfo('blogname')."' style='border:0px' src='".$plugin_directory."images/topo-email.png' alt='' width='600' /></a>";
 
  $msg2 = $msg;
  
  $msg .= "$mensagemEmail";
  $msg2 .= "$mensagemEmail2";
  
  $footerb = "<a title='footer-newsletter' href='".get_bloginfo('url')."'>
 	<img  style='border:0px' class='aligncenter size-full wp-image-3486' title='".get_bloginfo('url')."' src='".$plugin_directory."images/footer-email.png' alt='' width='600' />
 	</a>
 	<p>Caso você não tenha solicitado este email, favor desconsiderar esta mensagem.</p>
 	<p>Esta é uma mensagem automática. Por favor não responda.<br/> Para suporte acesse ".get_bloginfo('url')."</p>
 	</div>
 	</table>
 	</body>
 	</html>";
 	
  $msg .= $footerb;
  $msg2 .= $footerb;
 
  $mailFrom = "$emailAdmin";
  $mailTo = "$mail_destino";
  $mailSubject = "$assunto";
  $mailSubject2 = "$assunto2";
  
  $mailHeader  = "From: ".get_bloginfo('name')." <$mailFrom>\r\n";
  $mailHeader .= "Reply-To: ".get_bloginfo('name')." <$mailFrom>\r\n";
  $mailHeader .= "Return-Path: ".get_bloginfo('name')." <$mailFrom>\r\n";
  $mailHeader .= "X-Mailer: PHP".phpversion()."\r\n";    
  $mailHeader .= "X-Sender-IP: {$_SERVER['REMOTE_ADDR']}\r\n";
  $mailHeader .= "Content-Type: text/html; charset=iso-8859-1\r\n";
  $mailHeader .= "MIME-Version: 1.0\r\n"; 
  $mailHeader .= "X-Priority: 1\r\n";
  //$mailHeader .= "Bcc: $emailWpAdmin\r\n";
  
  $mailBody ="$msg";
  
  $mailBody2  ="$msg2"; 
  
  $mailSignature = "<br/>--<br/>$urlWpAdmin ";
  
  $mailBody .= $mailSignature;
  
  $mailBody2 .= $mailSignature;
 
  $mailParams = "-f$mailFrom";
 
 

// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
require_once("PHPMailer/class.phpmailer.php");
//require_once("class.phpmailer.php");
 

 
      //instancia a classe
      $mail = new PHPMailer();
 
     
      $smtpDebug = get_option('smtpDebugWPSHOP'); 
      if($smtpDebug =="Y"){
      $mail->SMTPDebug  = 1;    
      }else{
       $mail->SMTPDebug  = 0;    
      }
   
      
      
     $smtpAtivo = get_option('smtpAtivoWPSHOP'); 
     
     if($smtpAtivo=="Y"){
     //defini que será enviado via SMTP
     $mail->IsSMTP();
     //define que será autenticado
     $mail->SMTPAuth = true;  
     };
     
  
     
     //altera a porta de envio
     $mail->Port = $smtpPort; //465 OR 25 OR 587
     //secure
     $mail->SMTPSecure = "$smtpSecure"; //Segurança   tls or SSL
     //define o endereço SMTP
     $mail->Host = "$smtpHost"; //localhost
     //Define o nome do usuário
     $mail->Username = "$smtpUser";
     
     //define a senha o usuário     
     
     $mail->Password = "$smtpPass";   
     
     //Informa o email e nome de quem está enviado     
          
   
      $mail->SetFrom(  "$smtpFrom" , "".get_bloginfo('name')  );
     //Informa o email e nome de quem irá receber o email
     
     $mail->AddAddress( $mailTo, utf8_decode($nome) );
 
     //REPLY TO
   //  $mail->AddReplyTo( $mail_destino, utf8_decode($nome) );
     
     //titulo da mensagem que será enviada
     $mail->Subject = utf8_decode($mailSubject);
     //a mensagem que está sendo enviada
     $mail->MsgHTML(utf8_decode($mailBody));
     //testa se foi enviada ou não  
     
       $emailInc = '';
       
     if($mail->Send()){
                  $emailInc = 'Send';   
        //echo intval($user->ID);
        // echo 10;
     
        //titulo da mensagem que será enviada
          $mail->Subject = utf8_decode($mailSubject2);
          //a mensagem que está sendo enviada
           $mail->MsgHTML(utf8_decode($mailBody2));
           $mail->ClearAllRecipients( );
           
             if( $emailWpAdmin !=""  && $mailSubject2 !=""  ){
                $mail->AddAddress( $emailWpAdmin  , utf8_decode("".get_bloginfo('name')."") );
               };
             if($emailSiteAdmin !=""){
               $mail->AddAddress( $emailSiteAdmin , utf8_decode("".get_bloginfo('name')."") );
             };
        
          if($emailSiteAdmin !="" || $emailWpAdmin !=""  && $mailSubject2 !=""  ){
          $mail->Send();
          };
          
     }else{
         echo 'Erro ao enviar o email '.$mail->ErrorInfo;
        // echo $error;
     };


  
?>