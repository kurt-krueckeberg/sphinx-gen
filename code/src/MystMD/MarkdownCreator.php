<?php
declare (strict_types=1);
namespace MystMD;

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
       $current_md = $this->md_template;

       $current_md = $this->subst_variables($current_md, $record);

       $this->file->fwrite($current_md);               
   }

   public function __construct(string $md_template, string $prefix, string $symbol, string $year)
   {
      $this->md_template = $md_tempalte;

      $filename =   $this->create_filename($prefix, $symbol, $year);

      $this->file = new \SplFileObject($filename, "w");
   }
}
