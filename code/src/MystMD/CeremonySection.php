<?php
declare(strict_types=1);
namespace MystMD;

class CeremonySection implements \IteratorAggregate { 

	private array $section;

 	// returns successive records in the 'records:' list.
	private function generator() 
	{
   	  foreach ($section['records'] as $record) {

              yield $record;
	  }
        } 		

	public function getSectionSettings() : array
	{
           return array_slice($this->section, 0, 3);
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

