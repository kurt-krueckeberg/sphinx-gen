<?php
declare (strict_types=1);
namespace MystMD;

class MarkdownCreator {

   private \SpilFileObject $file;	
   private string $md_template;
   
   private string $prefix;
   private string $symbol;

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

   private function subst_variables(string $template, array $key_value_pairs)
   {
       return preg_replace_callback(
           '/\{(\w+)\}/',
           function ($matches) use ($key_value_pairs) {
               $key = $matches[1];
               if (!array_key_exists($key, $key_value_pairs)) {
                   throw new InvalidArgumentException("Unknown placeholder: {$key}");
               }
               return $key_value_pairs[$key];
           },
           $template
       );
   }

   public function __invoke(array $record)
   {
       $markdown = $this->subst_variables($this->md_template, $record);
       
       $year = substr ($record['edate'], strrchr((string) $record['edate'], ' ') + 1);
       
       $filename =   $this->create_filename($this->prefix, $this->symbol, $year);

      $this->file = new \SplFileObject($filename, "w");

       $this->file->fwrite($markdown);               
   }

   public function __construct(string $md_template, string $prefix, string $symbol)           
   {
      $this->md_template = $md_tempalte;
      
      $this->prefix = $prefix;
      
      $this->symbol = $symbol;

   }
}
