<?php
declare (strict_types=1);
namespace myst_gen;

class MarkdownCreator {

   private \SpilFileObject $file;	

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

        //++ str_replace();
    }

    public function __construct(string $prefix, string $symbol, string $year)
    {
       $filename =   $this->create_filename($prefix, $symbol, $year);

       $this->file = new \SplFileObject($filename, "w");
    }
}
