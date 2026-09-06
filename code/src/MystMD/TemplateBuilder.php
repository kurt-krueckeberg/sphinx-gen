<?php
declare (strict_types=1);
namespace myst_gen;

// TODO: Make this a function or functor
class TemplateBuilder {

   public function __construct(array $parish_settings, string $citation_str)
   {
      $citation_str = str_replace(array("@path", "@parish-name"),
	      array($parish_settings['volumes']['path'],
                    $parish_settings['parish-name']),
	      $citation_str); 


      
   }	   
}
