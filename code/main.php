<?php
declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

require __DIR__ . '/vendor/autoload.php';

$yaml = Yaml::parseFile('config.yml');

$parish_settings = array_slice($yaml['parish'], 0, 3);

$citation = file_get_contents("citation.md");

$current_citation = str_replace(array("@path", "@parish-name"),
	array($parish_settings['volumes']['path'],
              $parish_settings['parish-name']),
	$citation); 

$sections = array("marriages", "burials", "confirmations", "baptisms");

foreach ($sections as $section_key) {

    $parish_volumes = $yaml['parish']['volumes'];
        
    $section = $yaml['parish'][$section_key];
     
    foreach ($section['records'] as $record) {
      
          print_r($record);
          
          echo "\n================\n";
    }    
}





