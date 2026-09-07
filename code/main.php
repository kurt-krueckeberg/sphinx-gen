<?php
declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;
use MystMD\{KirchenBuecherResults, CeremonySection, MarkdownCreator, TemplateBuilder};       

require __DIR__ . '/vendor/autoload.php';

$folder = "/home/kurt/sphinx-gen/code";

$kbr = new KirchenbuecherResults("/home/kurt/sphinx-gen/code/config.yml");

$citation_string = str_replace(array("{path}", "{parish-name}"),
	array($kbr['parish']['volumes']['path'],
	$kbr['parish']['parish-name']),
	file_get_contents($folder . "/" . "citation.txt"));
        
$markdown_template = file_get_contents($folder . "/markdown_template.txt");

$markdown_writer = new MarkdownCreator($markdown_template);

$make_array = function (CeremonySection $ceremony_section, KirchenbuecherResults $kbr) : array
{
    $result = array();

    $section_settings = array_slice($ceremony_section->section, 0, 3);
    
    $volumes = $parish_settings['parish']['volumes'];
    
    $result[] = $volumes[$section_settings['volume']]['name'];
    
    $result[] = $volumes[$section_settings['volume']]['total_images'];

    return $result;
};

foreach ($kbr as $ceremony_section) {

     $citation_string = str_replace(array('%volume-name', '%total-images'),
	     $make_array($ceremony_section, $kbr),
	     $citation_string);
     
     $markdown_template = $md_string . $citation_string;
      
     foreach ($ceremony_section as $record) {
         
          $markdown = $markdown_template;
          
	  $markdown_writer($record, array_slice($ceremony_section->section, 0, 3));
     }
}    
      
      
      
      
      
