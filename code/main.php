<?php
declare(strict_types=1);
use Symfony\Component\Yaml\Yaml;

require __DIR__ . '/vendor/autoload.php';

$data = Yaml::parseFile('config.yml');

//print_r($data);

print_r($data['parish']);

echo "\n==================================\n";

print_r($data['baptisms']);
