<?php
declare(strict_types=1);
namespace MystMD;
use Symfony\Component\Yaml\Yaml;

class KirchenBuecherResults implements \IteratorAggregate, \ArrayAccess {

	private readonly array $yaml;

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
	
	public function offsetSet($offset, $value): void
       	{
           if (is_null($offset)) {

	      $this->yaml[] = $value;

	   } else {

              $this->yaml[$offset] = $value;
           }
        }

	public function offsetExists($offset): bool
       	{
           return isset($this->yaml[$offset]);
        }

	public function offsetUnset($offset): void 
	{
          unset($this->yaml[$offset]);
        }

        public function offsetGet($offset): mixed 
	{
          return isset($this->yaml[$offset]) ? $this->yaml[$offset] : null;
        }
}

