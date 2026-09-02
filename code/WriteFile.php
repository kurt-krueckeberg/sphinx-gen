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

	public function __construct(array $keyValues) 
	{
	   $this->parts = $this->tokenize($self::$page);
	}

	public function __invoke(string $filename, array $subKeys) 
	{
           $this->key_values = $this->xyz($subKeys);

           $this->write($filename);  	   
	}
}	
