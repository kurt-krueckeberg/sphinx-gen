<?php
declare(strict_types=1);

//require_once "Config.php";
//require_once "variables.php";

use Symfony\Component\Yaml\Yaml;
use MystMD\{Config, KirchenBuecherResults, CeremonySection, MarkdownCreator, TemplateBuilder};       

require __DIR__ . '/vendor/autoload.php';

$c = new Config("/home/kurt/sphinx-gen");

$md_string = $c->get_markdown_string();

$citation_string = $c->get_citation_string();
