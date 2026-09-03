<?php
declare(strict_types=1);

require_once "Config.php";

use Symfony\Component\Yaml\Yaml;

require __DIR__ . '/vendor/autoload.php';

$citation_str = (Config::get_config())->citation_string;

$md_string = Config::get_config()->md_string;

$yaml = Yaml::parseFile('config.yml');

$parish_settings = array_slice($yaml['parish'], 0, 3);

$citation_str = str_replace(array("@path", "@parish-name"),
	array($parish_settings['volumes']['path'],
              $parish_settings['parish-name']),
	$citation_str); 

$sections = array("marriages", "burials", "confirmations", "baptisms");

foreach ($sections as $section_key) {

    $parish_volumes = $yaml['parish']['volumes'];
        
    $section = $yaml['parish'][$section_key];
    
    $current_md = $md_string;
    
    $current_citation =  $citation_str;
    
    // TODO: add all the variables in template.md to this array.
    $md_find_array = array('%year', '%name', '@event', '&file-name', '%edate');
     
    foreach ($section['records'] as $record) {
      
          print_r($record);
          
          $current_md = str_replace($md_find_array, $record, $current_md);
          
          //$current_citation = str_replace(,, $current_citation);
          
          echo "\n================\n";
    }    
}





