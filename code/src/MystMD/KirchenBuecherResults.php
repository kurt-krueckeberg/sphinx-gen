<?php
declare(strict_types=1);
namespace MystMD;
use Symfony\Component\Yaml\Yaml;

class KirchenBuecherResults implements \IteratorAggregate, \ArrayAccess {

	private readonly array $yaml;

        private $section_keys = array('marriage', 'burial', 'baptism', 'confirmation');
 	
	private function generator() 
	{
            foreach ($this->section_keys as $section_key) {
      
                yield $section_key => new CeremonySection($this->yaml['parish'][$section_key]);                 
 	    }
	}

        #[\Override]
	public function getIterator() : \Traversable 
	{
	   return $this->generator();	
        }

	public function __construct(string $file)
	{
           $this->yaml = Yaml::parseFile($file);
	}
        
	#[\Override]
	public function offsetSet($offset, $value): void
       	{
           if (is_null($offset)) {

	      $this->yaml[] = $value;

	   } else {

              $this->yaml[$offset] = $value;
           }
        }
        
        #[\Override]
	public function offsetExists($offset): bool
       	{
           return isset($this->yaml[$offset]);
        }

        #[\Override]
	public function offsetUnset($offset): void 
	{
          unset($this->yaml[$offset]);
        }
        
        #[\Override]
        public function offsetGet($offset): mixed 
	{
          return isset($this->yaml[$offset]) ? $this->yaml[$offset] : null;
        }
}
