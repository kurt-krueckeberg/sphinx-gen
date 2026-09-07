<?php
declare (strict_types=1);
namespace MystMD;

class MarkdownCreator {

   private \SpilFileObject $file;	
   private string $md_template;
   
   private string $prefix;
   private string $symbol;

   private function create_filename(string $prefix, string $symbol, string $year) : string
   {
       $filestem = $prefix . '-' . $symbol . '-' . $year;
    
       for($i = 0; 1; ++$i) {
    
           $filename =  $filestem . (char) ('a' + $i)  . "md";
    
           /*
            * TODO: Must check if file exits in ~/gens/petzen!!!
            */
               
           if (file_exists($filename)) {
               
    	           continue;
           }
    
           return $filename;
        }	       
   }

   private function subst_variables(string $template, array $key_value_pairs)
   {
       return preg_replace_callback(
           '/%(\w+)%/',
           function ($matches) use ($key_value_pairs) {
               
               $key = $matches[1];
               
               if (!array_key_exists($key, $key_value_pairs)) {
                   
                   throw new \InvalidArgumentException("Unknown placeholder: {$key} in this string:\n $template\n");
               }
               return $key_value_pairs[$key];
           },
           $template
       );
   }

   public function __invoke(array $record)
   {
       $year = strrchr($record['edate'], ' ') + 1;
       
       try {
         /* BUGS
          * We have to these add key-value pairs to supply value for %file-name% and %year%:
          * 
          */
           $record['year'] = $year;
           $record['file-name'] = substr($this->filename, strpos())
           
           $markdown = $this->subst_variables($this->md_template, $record);
           
       } catch (\InvalidArgumentException $e) {
           
           echo $e->getMessage();    
       }
       
         
       $this->filename = $this->create_filename($this->prefix, $this->symbol, $year);
            
       $file = new \SplFileObject($this->filename, "w");

       $file->fwrite($markdown);               
   }

   public function __construct(string $markdown_template, string $prefix, string $symbol)           
   {
      $this->md_template = $markdown_template;
      
      $this->prefix = $prefix;
      
      $this->symbol = $symbol;

   }
}
