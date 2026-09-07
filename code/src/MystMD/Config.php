<?php
declare (strict_types=1);
namespace MystMD;

class Config {
    
  private static Config $c;  
  private static bool $initialized = false;
  private static $folder = "/home/kurt/sphinx-gen/code"; 

  public readonly string $citation_template;
  public readonly string $markdown_template;

  static public function getConfig() 
  {
      if (self::$initialized === false) {
       
          self::$c = new Config();
     
          self::$initialized = true;
      }
    
      return self::$c;
   }

  private function __construct()
  {
     $this->citation_template = file_get_contents(self::$folder . "/" . "citation_template.txt");
        
     $this->markdown_template = file_get_contents(self::$folder . "/". "markdown_template.txt");
  }
}
