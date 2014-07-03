<?php

   require("../../../../../wp-load.php");
   $nomeAviso = $_REQUEST['nomeAvisoR'];
   $emailAviso = $_REQUEST['emailAvisoR'];
   $postIDP = $_REQUEST['postIDPR'];
   $variacaoCorP = $_REQUEST['variacaoCorPR'];
   $variacaoTamanhoP = $_REQUEST['variacaoTamanhoPR'];
   gravarSolicitacaoContato($nomeAviso,$emailAviso,$postIDP,$variacaoCorP,$variacaoTamanhoP);
               
?>