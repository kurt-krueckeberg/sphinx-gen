<?php
declare(strict_types=1);
namespace MystMD;

class CeremonySection implements \IteratorAggregate { 

	public readonly array $section;

	/* 
	 * returns each successive record in the 'records:' list.
	 */ 
	private function generator() 
	{
   	  foreach ($section['records'] as $record) {

              yield $record;
	  }
	} 

	public function getIterator() : \Traversable 
	{
	   return ($this->generator)();	
        }

	public function __construct(array $section)
	{
           $this->section = $section; 
	}
}

