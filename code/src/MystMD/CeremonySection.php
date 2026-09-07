<?php
declare(strict_types=1);
namespace MystMD;

class CeremonySection implements \IteratorAggregate, \ArrayAccess { 

	public readonly array $section;

	/* 
	 * returns each successive record in the 'records:' list.
	 */ 
	private function generator() 
	{
   	  foreach ($this->section['records'] as $record) {

              yield $record;
	  }
	} 

	public function getIterator() : \Traversable 
	{
	   return $this->generator();	
        }

	public function __construct(array $section)
	{
           $this->section = $section; 
	}
         
	#[\Override]
	public function offsetSet($offset, $value): void
       	{
           if (is_null($offset)) {

	      $this->section[] = $value;

	   } else {

              $this->section[$offset] = $value;
           }
        }
        
        #[\Override]
	public function offsetExists($offset): bool
       	{
           return isset($this->section[$offset]);
        }

        #[\Override]
	public function offsetUnset($offset): void 
	{
          unset($this->section[$offset]);
        }
        
        #[\Override]
        public function offsetGet($offset): mixed 
	{
          return isset($this->section[$offset]) ? $this->section[$offset] : null;
        }
}

