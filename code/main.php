<?php
declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;
use MystMD\{KirchenBuecherResults, Config, CeremonySection, MarkdownCreator, TemplateBuilder};       

require __DIR__ . '/vendor/autoload.php';

$folder = "/home/kurt/sphinx-gen/code";

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
    
    $result[] = $volumes[$section_settings['volume']]['total-images'];

    return $result;
};
        
$markdown_string = file_get_contents($config['markdown_template']);

foreach ($kbr as $ceremony_section) {

     $citation_string = str_replace(array('%volume-name%', '%total-images%'),
                    make_array($ceremony_section, $kbr),
                    $citation_string);

     $markdown_template = $markdown_string . $citation_string; 
     
     $markdown_writer = new MarkdownCreator($markdown_template, $kdr['prefix'], $ceremony_section['record-symbol'], );
     
     foreach ($ceremony_section as $record) {
         
          $markdown = $markdown_template;
          
	  $markdown_writer($record, array_slice($ceremony_section->section, 0, 3));
     }
}    
