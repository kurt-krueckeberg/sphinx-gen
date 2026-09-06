<?php
declare(strict_types=1);

//require_once "Config.php";
//require_once "variables.php";

use Symfony\Component\Yaml\Yaml;
use MystMD\{Config, KirchenBuechenResults, CeremonySection, MarkdownCreator, TemplateBuilder};       

require __DIR__ . '/vendor/autoload.php';

$yaml = Yaml::parseFile("/home/kurt/sphinx-gen/code/config.yml");

$parish_settings = array_slice($yaml['parish'], 0, 3);

$kbr = new KirchenbuecherResults($yaml);

