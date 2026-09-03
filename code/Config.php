<?php
declare(strict_types=1);

class config_ {
    
    public readonly string $citaion_string;
    
    public readonly string $md_string;
    
    public function __construct()
    {
        $this->citation_string = file_get_contents("citation.md");
        
        $this->md_string = file_get_contents("template.md");
    }
}

class Config {
    
  private static config_ $c;  
  private static bool $initialized = false;

   static public function get_config() : config_
   {
      if (self::$initialized === false) {
       
          self::$c = new config_;
     
          self::$initialized = true;
      }
    
      return self::$c;
  }
}