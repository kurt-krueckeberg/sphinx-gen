<?php
declare(strict_types=1);
namespace MystMD;
use Symfony\Component\Yaml\Yaml;

class KirchenBuecherResults implements \IteratorAggregate {

	private array $yaml;

        private $section_keys = array('marriages', 'burials', 'confirmations', 'baptisms');
 	
	private function generator() 
	{
            foreach ($this->section_keys as $section_key) {
      
               yield $yaml[$section_key]; // <--  TODO: Return CeremonySection instead!
 	    }
	}

	public function getParishSettings() : array
	{
           return array_slice($yaml['parish'], 0, 3);
	}	

	public function getIterator() : \Traversable 
	{
	   return ($this->generator)();	
        }

	public function __construct(string $yaml_file)
	{
           $this->yaml = Yaml::parseFile($yaml_file);
	}
}

