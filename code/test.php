<?php

$record = array('ifile' => "petzen-band1b-img67-weiland.png");

if (isset($record['ifile'])) {

     $record['image-block'] = <<<EOS
```{figure} images/{$record['ifile']}
:class: image-override
```
EOS;

} else {
     $record['image-block'] = "";    
}  

print_r($record);
