<?php
declare (strict_types=1);
namespace MystMD;

class Config {
    
  private static Config $c;  
  private static bool $initialized = false;
  private static $folder = "/home/kurt/sphinx-gen/code"; 

  public readonly \ArrayObject $settings;

  static public function getConfig() : Config 
  {
      if (self::$initialized === false) {
       
          self::$c = new Config();
     
          self::$initialized = true;
      }
    
      return self::$c;
   }

  private function __construct()
  {
     $c['citation_template'] = self::$folder . "/" . "citation_template.txt";
        
     $c['markdown_template'] = self::$folder . "/". "markdown_template.txt";

     $c['results_file'] = self::$folder . "/" . "results.yml";
     
     $this->settings = new \ArrayObject($c);
  }
}
