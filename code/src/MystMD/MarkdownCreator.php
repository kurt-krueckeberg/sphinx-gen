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
    
           if (file_exists($filename)) {
               
    	           continue;
           }
         
           return $filename;
        }	       
   }

   private function subst_variables(string $template, array $key_value_pairs) : string
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

   public function __invoke(array $record) : string
   {
       $year = substr(record['edate'], -4); // get last four characters: the year.
       
       $this->filename = $this->create_filename($this->prefix, $this->symbol, $year);
       
       try {
           $record['year'] = $year;
           
           $record['image_no'] = (string) $record['image_no'];
           
           $record['event'] = $this->event;
           
           // Since $this->filename has the fully qualified filename, we remove the pathinfo and extension.
           $basename = basename($this->filename);
           
           $record['file_name'] = substr($basename , 0, strpos($basename, "."));
           
           $record['volume_name'] = $this->volume_name;
           
           $record['total_images'] = $this->total_images;
           
           $markdown = $this->subst_variables($this->md_template, $record);           
           
       } catch (\InvalidArgumentException $e) {
           
           echo $e->getMessage();
           throw $e;
       }
       
       $file = new \SplFileObject($this->filename, "w");

       $file->fwrite($markdown);               

       return $this->filename;
   }
   
   public function __construct(string $markdown_template, KirchenbuecherResults $kbr, string $ceremony, CeremonySection $ceremony_section)           
   {
      $this->md_template = $markdown_template;
      
      $this->prefix = $kbr['parish']['prefix'];
      
      $this->symbol = $ceremony_section['record-symbol'];
      
      $this->event = $ceremony;
      
      $this->folder = $kbr['parish']['output-folder'];
      
      $this->volume_name = $kbr['parish']['volumes'][$ceremony_section['volume']]['name'];
      
      $this->total_images = (string) $kbr['parish']['volumes'][$ceremony_section['volume']]['total_images'];
   }
}
