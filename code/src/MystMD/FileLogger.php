<?php
declare(strict_types=1);
namespace MystMD;

class FileLogger {
    
    private SplFileObject $log_file;
    
    public function log(string $filename)
    {
       $this->logger->fwrite("$filename created.\n");
    }
    
    public function __construct(string $log_folder)
    {
      $this->log_filename = $log_folder . "/" . date('m-d-Y') . ".log";
  
      $this->logger = new \SplFileObject($this->log_filename, "w");    
    }
}
