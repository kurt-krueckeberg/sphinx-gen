<?php
declare(strict_types=1);
namespace MystMD;

class config_ {
    
    public readonly string $citaion_string;
    
    public readonly string $md_string;
    
    public function __construct(string $folder)
    {
        $this->citation_string = file_get_contents($folder . "/citation.md");
        
        $this->md_string = file_get_contents($folder . "/template.md");
    }
}

class Config {
    
  private static config_ $c;  
  private static bool $initialized = false;

   static private function get_config(string $folder) : config_
   {
      if (self::$initialized === false) {
       
          self::$c = new config_($folder);
     
          self::$initialized = true;
      }
    
      return self::$c;
   }

  public function __construct(string $folder)
  {
     self::get_config($folder);	  
  }

  public function get_citation_string() : string
  {
      return self::get_config()->citation_string;	  
  }

  public function get_markdown_string() : string
  {
      return self::get_config()->md_string;	  
  }

}
