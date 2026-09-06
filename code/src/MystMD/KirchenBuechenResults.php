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

	public function getIterator() : \Traversable 
	{
	   return ($this->generator)();	
        }

	public function __construct(array $yaml)
	{
           $this->yaml = $yaml);
	}
}

