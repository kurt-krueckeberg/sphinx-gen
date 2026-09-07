<?php
declare (strict_types=1);
namespace MystMD;

class Config {
    
  private static Config $c;  
  private static bool $initialized = false;
  private static $folder = "/home/kurt/sphinx-gen/code"; 

  public readonly array $config;

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
     $this->config['citation_template'] = file_get_contents(self::$folder . "/" . "citation_template.txt");
        
     $this->config['markdown_template'] = file_get_contents(self::$folder . "/". "markdown_template.txt");

     $this->config['yaml_file'] = "/home/kurt/sphinx-gen/code/config.yml";
  }
}
