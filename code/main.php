<?php
declare(strict_types=1);

/*
function CreateCitationTemplate(array $data)
{
   $data['parish']	
}
 */

use Symfony\Component\Yaml\Yaml;

require __DIR__ . '/vendor/autoload.php';

$data = Yaml::parseFile('config.yml');

$parish_keys = array_slice($data['parish'], 0, 3);

echo "Parish top-level keys:\n";

print_r($parish_keys);

echo "\n==================================\n";

echo "Citation key:\n";

print_r($data['citation']);

// Use str_replace() to replace the citation string with the @xyz
// variables.
