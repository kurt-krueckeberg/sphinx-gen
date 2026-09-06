<?php
declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;
use MystMD\{KirchenBuecherResults, CeremonySection, MarkdownCreator, TemplateBuilder};       

require __DIR__ . '/vendor/autoload.php';

$folder = "/home/kurt/sphinx-gen/code";

$citation_string = file_get_contents($folder . "/citation.md");
        
$md_string = file_get_contents($folder . "/template.md");

$kbr = new KirchenbuecherResults("/home/kurt/sphinx-gen/code/config.yml");

$parish_settings = $kbr->getParishValues();

$citation_string = str_replace(array("@path", "@parish-name"),
	array($parish_settings['volumes']['path'],
              $parish_settings['parish-name']),
  	      $citation_string); 

$markdown_template = $md_string . $citation_string;

$markdown_writer = new MarkdownCreator($markdown_template);

foreach ($kbr as $ceremony_section) {

     $section_settings = $ceremony_section->getSectionSettings();

     foreach ($ceremony_section as $record) {
            
	  $markdown_writer($record, $section_settings);
     }
}    
      
      
      
      
      
