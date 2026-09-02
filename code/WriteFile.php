<?php
declare(strict_types=1);

class WriteFile {

	private $key_values = array();

	private $parts = array();
	
	private function tokenize(string $str) : array
	{
 	  $tok = strtok($str, "|");

	  while ($tok !== false) {

    	    $parts[] = $tok;
    	    $tok = strtok("|");
	  }

          return $parts;
	}

	private static $md_template = ...

	public function __construct(Config $config) 
	{
	   $this->parts = $this->tokenize($config->get_template);
	}

	public function __invoke(string $filename, array $yamlSection) 
	{
           $this->yamlSection = $this->???($yamlRecords);

           $this->write($filename);  	   
	}
}	
