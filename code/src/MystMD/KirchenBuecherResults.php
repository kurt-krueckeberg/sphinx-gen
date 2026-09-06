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
      
               yield new CeremonySection($this->yaml[$section_key]); 
 	    }
	}

	public function getParishValues() : array
	{
	   return array_slice($this->yaml['parish'], 0, 3);	
	}

	public function getIterator() : \Traversable 
	{
	   return ($this->generator)();	
        }

	public function __construct(string $file)
	{
           $this->yaml = Yaml::parseFile($file);
	}
}

