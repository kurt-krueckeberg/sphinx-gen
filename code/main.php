<?php
declare(strict_types=1);

require_once "Config.php";
require_once "variables.php";

use Symfony\Component\Yaml\Yaml;

require __DIR__ . '/vendor/autoload.php';


$md_string = Config::get_config()->md_string;

$citation_str = Config::get_config()->citation_string;

$citation_str = str_replace(array("@path", "@parish-name"),
	array($parish_settings['volumes']['path'],
              $parish_settings['parish-name']),
	$citation_str); 



$ceremony_section = 
foreach ($ceremony_section as $record) {
      
    print_r($record);
          
    $current_md = str_replace($md_find_array, $record, $current_md);
          
    //$current_citation = str_replace(,, $current_citation);
          
    echo "\n================\n";
}    





