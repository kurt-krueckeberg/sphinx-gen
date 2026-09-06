<?php
declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;
use MystMD\{KirchenBuecherResults, CeremonySection, MarkdownCreator, TemplateBuilder};       

require __DIR__ . '/vendor/autoload.php';

$folder = "/home/kurt/sphinx-gen/code";

$citation_string = file_get_contents($folder . "/citation.md");
        
$md_string = file_get_contents($folder . "/template.md");

$yaml = Yaml::parseFile($folder . "/config.yml");

$parish_settings = array_slice($yaml['parish'], 0, 3);

$citation_string = str_replace(array("@path", "@parish-name"),
	array($parish_settings['volumes']['path'],
              $parish_settings['parish-name']),
  	      $citation_string); 

$markdown_template = $md_string . $citation_string;

$kbr = new KirchenbuecherResults($yaml);

foreach ($kbr as $ceremony_section) {

     $section_settings = $ceremony_section->getSectionSettings();

     foreach ($ceremony_section as $record) {
            
          print_r($record);
                
          $current_md = str_replace($md_find_array, $record, $current_md);
                
          //$current_citation = str_replace(,, $current_citation);
                
          echo "\n================\n";
     }
}    
      
      
      
      
      
