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

	public function __construct(array $keyValues) 
	{
	   $this->parts = $this->tokenize($self::$md_tempalte);
	}

	public function __invoke(string $filename, array $yamlRecords) 
	{
           $this->key_values = $this->xyz($yamlRecords);

           $this->write($filename);  	   
	}
}	
