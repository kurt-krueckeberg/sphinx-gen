<?php
declare (strict_types=1);
namespace myst_gen;

class Manager {

   private $sections = array();

   private function create_filename(string $prefix, string $event_letter, string $year) : string
   {
       $filestem = $prefix . '-' . $symbol . '-' . $year;
    
       for($i = 0; 1; ++$i) {
    
           $filename =  $filestem . (char) ('a' + $i)  . "md";
    
           if (file_exists($filename))
    	           continue;
    
           return $filestem;
        }	       
   }

   public function __construct(string $yamlfilename)
   {
      $yaml = Yaml::parseFile('config.yml');

      $parish_settings = array_slice($yaml['parish'], 0, 3);
      
      $citation_str = str_replace(array("@path", "@parish-name"),
	      array($parish_settings['volumes']['path'],
                    $parish_settings['parish-name']),
	      $citation_str); 
      
      $this->sections = array("marriages", "burials", "confirmations", "baptisms");
   }	   
}
