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

	public function __construct(string $template, array $parish_info) 
	{
           $this->parish = $parish;

	   $this->parts = $this->tokenize($template);
	}

	public function __invoke(string $filename, array $yamlSection) 
	{
           $this->yamlSection = $this->???($yamlRecords);

           $this->write($filename);  	   
	}
}	
