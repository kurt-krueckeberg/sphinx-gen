<?php
declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;
use MystMD\{KirchenBuecherResults, CeremonySection, MarkdownCreator, TemplateBuilder};       

require __DIR__ . '/vendor/autoload.php';

$folder = "/home/kurt/sphinx-gen/code";

$kbr = new KirchenbuecherResults("/home/kurt/sphinx-gen/code/config.yml");

$citation = file_get_contents($folder . "/" . "citation.txt");

$citation_string = str_replace(array("{path}", "{parish-name}"),
	array($kbr['parish']['volumes']['path'],
              $kbr['parish']['parish-name']),
	$citation);
        
$markdown_template = file_get_contents($folder . "/markdown_template.txt");

$markdown_writer = new MarkdownCreator($markdown_template);

foreach ($kbr as $ceremony_section) {

     $section_settings = $ceremony_section->getSectionSettings();
     
     $volumes = $parish_settings['volumes'];
     
     $volume_name = $volumes[$section_settings['volume']]['name'];
     
     $total_images = $volumes[$section_settings['volume']]['toal_images'];
                      
     $citation = str_rpelace(array('%volume-name', '%total-images'), array($volume_name, $total_images), $citation_string);
     
     $markdown_template = $md_string . $citation_string;
      
     foreach ($ceremony_section as $record) {
         
          $markdown = $markdown_template;
          
	  $markdown_writer($record, $section_settings);
     }
}    
      
      
      
      
      
