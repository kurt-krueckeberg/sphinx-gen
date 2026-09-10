<?php
declare(strict_types=1);

use MystMD\{KirchenBuecherResults, Config, CeremonySection, MarkdownCreator, FileLogger};       

require __DIR__ . '/vendor/autoload.php';

$config = Config::getConfig()->settings;

$kbr = new KirchenbuecherResults($config['results_file']);

$citation_string = str_replace(array("{path}", "{parish-name}"),
	array($kbr['parish']['volumes']['path'],
              $kbr['parish']['parish-name']),
	file_get_contents($config['citation_template']));

function make_array(CeremonySection $ceremony_section, KirchenbuecherResults $kbr) : array
{
    $result = array();

    $section_settings = array_slice($ceremony_section->section, 0, 3);
    
    $volumes = $kbr['parish']['volumes'];
    
    $result[] = $volumes[$section_settings['volume']]['name'];
    
    $result[] = $volumes[$section_settings['volume']]['total_images'];

    return $result;
}
        
$markdown_string = file_get_contents($config['markdown_template']);

$logger = new FileLogger("./logs");

foreach ($kbr as $ceremony => $ceremony_section) {

     $citation_string = str_replace(array('%volume_name%', '%total_images%'),
                    make_array($ceremony_section, $kbr),
                    $citation_string);

     $markdown_template = $markdown_string . $citation_string; 
          
     $markdown_writer = new MarkdownCreator($markdown_template, $kbr, $ceremony, $ceremony_section);
     
     foreach ($ceremony_section as $record) {
         
          $markdown = $markdown_template;
          
	  $filename = $markdown_writer($record);

	  $logger->log($filename);

	  echo $filename . " created.\n";
     }
}    
