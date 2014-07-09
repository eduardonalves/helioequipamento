<?php
/*
public $dirname = dirname(__FILE__);
$dirname = str_replace('includes','',$dirname);
$dirname.='/logs';
*/
	class Logger
	{
		private $log_file = "xml.log";
		private $fp = null;
		
		public function logOpen()
		{
			$this->fp = fopen($this->log_file, 'a');
		}
		 
		public function logWrite($strMessage, $transacao)
		{
			if(!$this->fp)
				$this->logOpen();
			
			$path = $_SERVER["REQUEST_URI"];
			$data = date("Y-m-d H:i:s:u (T)");
			
			$log = "***********************************************" . "\n";
			$log .= $data . "\n";
			$log .= "DO ARQUIVO: " . $path . "\n"; 
			$log .= "OPERAวรO: " . $transacao . "\n";
			$log .= $strMessage . "\n\n"; 

			fwrite($this->fp, $log);
		}
	}
?>