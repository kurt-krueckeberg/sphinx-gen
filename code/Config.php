<?php

class Config {

  private static string $md_template;

  public function __contruct()
  {
     self::$md_template = \file_get_contents("template.md");
  }

  public function get_tempate() : string
  {
	return self::$md_template;  
  }
}
