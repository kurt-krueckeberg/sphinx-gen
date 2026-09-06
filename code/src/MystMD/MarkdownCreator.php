<?php
declare (strict_types=1);
namespace myst_gen;

class MarkdownCreator {

   private \SpilFileObject $file;	
   private string $md_template;

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

   public function __invoke(array $record)
   {
       $current_md = $this->md_template;

       $current_md = str_replace($this->find_variables, $record, $current_md);
               
       str_replace();
   }

   public function __construct(string $md_template, string $prefix, string $symbol, string $year)
   {
      $this->md_template = $md_tempalte;

      $this->find_variaables = array(TODO);

      $filename =   $this->create_filename($prefix, $symbol, $year);

      $this->file = new \SplFileObject($filename, "w");
   }
}
