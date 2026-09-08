<?php
declare (strict_types=1);
namespace MystMD;

class MarkdownCreator {

   private \SpilFileObject $file;	
   private string $md_template;
   
   private string $prefix;
   private string $symbol;
   private string $folder;
   
   private function create_filename(string $prefix, string $symbol, string $year) : string
   {
       $filestem = $prefix . '-' . $symbol . '-' . $year;
    
       for($i = 0; 1; ++$i) {
    
           $filename =  $filestem . chr(ord('a') + $i)  . ".md";
    
           if (file_exists($this->folder . "/" . $filename)) {
               
    	           continue;
           }
    
           return $filename;
        }	       
   }

   private function subst_variables(string $template, array $key_value_pairs)
   {
       return preg_replace_callback(
           '/%(\w+)%/',
           function ($matches) use ($key_value_pairs, $template) {
               
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
       $year = substr(strrchr($record['edate'], ' '), 1);
       
       $this->filename = $this->create_filename($this->prefix, $this->symbol, $year);
       
       try {
           $record['year'] = $year;
           
           $record['event'] = TODO Need the vent--Marriage, Baptism. Confirmation, Burial/Death.
           
           $record['file-name'] = substr($this->filename, 0, strpos($this->filename, "."));
           
           $markdown = $this->subst_variables($this->md_template, $record);
           
       } catch (\InvalidArgumentException $e) {
           
           echo $e->getMessage();
           throw $e;
       }
       
       $file = new \SplFileObject($this->filename, "w");

       $file->fwrite($markdown);               
   }

   public function __construct(string $markdown_template, string $prefix, string $symbol, string $folder)           
   {
      $this->md_template = $markdown_template;
      
      $this->prefix = $prefix;
      
      $this->symbol = $symbol;
      
      $this->folder = $folder;
   }
}
