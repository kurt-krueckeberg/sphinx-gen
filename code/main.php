<?php
declare(strict_types=1);

//require_once "Config.php";
//require_once "variables.php";

use Symfony\Component\Yaml\Yaml;
use MystMD\{Config, KirchenBuechenResults, CeremonySection, MarkdownCreator, TemplateBuilder};       

require __DIR__ . '/vendor/autoload.php';

function createMarkdownTemplate() : string
{
   $md_string = Config::get_config()->md_string;

   $citation_str = Config::get_config()->citation_string;

   $citation_str = str_replace(array("@path", "@parish-name"),
	array($parish_settings['volumes']['path'],
              $parish_settings['parish-name']),
  	      $citation_str); 
}

$yaml = Yaml::parseFile("/home/kurt/sphinx-gen/code/config.yml");

$parish_settings = array_slice($yaml['parish'], 0, 3);

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
      
      
      
      
      
