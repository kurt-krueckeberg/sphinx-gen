<?php
declare(strict_types=1);
namespace MystMD;

class CeremonySection implements \IteratorAggregate { 

	private array $section;

	/* 
	 * returns each successive record in the 'records:' list.
	 */ 
	private function generator() 
	{
   	  foreach ($section['records'] as $record) {

              yield $record;
	  }
	} 

        /* Return these three key-value pairs are come berofe the list of
	    record; for example, for the marraiges:
            volume: band1b
            record-symbol: M
            event: Marriage
	 */ 
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

