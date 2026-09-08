<?php
declare (strict_types=1);
namespace MystMD;

class MarkdownCreator {

   private \SpilFileObject $file;	
   
   private string $md_template;   
   private string $prefix;
   private string $symbol;
   private string $folder;
   private string $event;
   private string $volume_name;
   
   private function create_filename(string $prefix, string $symbol, string $year) : string
   {
       $filestem = $prefix . '-' . $symbol . '-' . $year;
    
       for($i = 0; 1; ++$i) {
    
           $filename =  $this->folder . "/" . $filestem . chr(ord('a') + $i)  . ".md";
    
           if (file_exists($this->folder . "/" . $filename)) {
               
    	           continue;
           }
    
           return $filename;
        }	       
   }

   private function subst_variables(string $template, array $key_value_pairs) : string
   {
      print_r($key_value_pairs);
      
      return preg_replace_callback(
           '/%(\w+)%/',
           function ($matches) use ($key_value_pairs, $template) {
               
               $key = $matches[1];
               
               if (!array_key_exists($key, $key_value_pairs)) {
                   
                   throw new \InvalidArgumentException("Unknown placeholder: {$key} in this string:\n $template\n");
               }
               
               echo "preg_replace_callback() replaement for '$key' = ". $key_value_pairs[$key] . "\n";
               
               return $key_value_pairs[$key];
           },
           $template
       );
   }

   public function __invoke(array $record)
   {
       $year = (string) substr(strrchr($record['edate'], ' '), 1);
       
       $this->filename = $this->create_filename($this->prefix, $this->symbol, $year);
       
       try {
           $record['year'] = $year;
           
           $record['image_no'] = (string) $record['image_no'];
           
           $record['event'] = $this->event;
           
           // Since $this->filename has the fully qualified filename, we remove the pathinfo and extension.
           $fname = strrchr($this->filename, "/");  
                      
           $record['file_name'] = substr($fname, 1, strpos($fname, ".") - 1);
           
           $record['volume_name'] = $this->volume_name;
           
           echo "\$this->md_tempate is {$this->md_template}\n==============\n";
           
           $markdown = $this->subst_variables($this->md_template, $record);
           
           echo "\$markdown after subst_variables = \n$markdown\n";
           
       } catch (\InvalidArgumentException $e) {
           
           echo $e->getMessage();
           throw $e;
       }
       
       $file = new \SplFileObject($this->filename, "w");

       $file->fwrite($markdown);               
   }
   
   public function __construct(string $markdown_template, KirchenbuecherResults $kbr, string $ceremony, CeremonySection $ceremony_section)           
   {
      $this->md_template = $markdown_template;
      
      $this->prefix = $kbr['parish']['prefix'];
      
      $this->symbol = $ceremony_section['record-symbol'];
      
      $this->event = $ceremony;
      
      $this->folder = $kbr['parish']['output-folder'];
      
      $this->volume_name = $kbr['parish']['volumes'][$ceremony_section['volume']]['name'] . "\n";
   }
}
