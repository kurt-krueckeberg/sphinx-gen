<?php
declare(strict_types=1);
namespace MystMD;
use Symfony\Component\Yaml\Yaml;

class KirchenBuecherResults implements \IteratorAggregate, \ArrayAccess {

	private readonly array $yaml;
	private readonly string $citation_string;

	private $section_keys = array();
        
        public function __construct(string $ymlfileName, Config $config)
	{
           $this->yaml = Yaml::parseFile($ymlfileName);

	   $this->section_keys = array_keys($this->yaml['parish']['record_sections']);

	   $this->citation_string = str_replace(array("{path}", "{parish-name}"),
	                              array($this->yaml['parish']['volumes']['path'],
                                      $this->yaml['parish']['parish-name']),
     	                              file_get_contents($config['citation_template'])); 
	}
        
        private function generator() 
	{
            foreach ($this->section_keys as $section_key) {
      
               yield $section_key => new CeremonySection($this->yaml['parish']['record_sections'][$section_key]);                 
            }
	}

        #[\Override]
	public function getIterator() : \Traversable 
	{
	   return $this->generator();	
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
