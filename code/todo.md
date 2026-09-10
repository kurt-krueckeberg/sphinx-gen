# TODO

The code now works except for confirmations. This is because the
confirmation don't have any images and thus no MyST markdown "figure"
block; however, the code uses the sole markdown template that contains


```{figure} images/%ifile%
:class: image-override
```

and when %file% has no value to replace it, an excpet is thrown.

Perhaps I should special-case the Confirmations? Idea:

1. replace current figure directive above with %image-%block%, the use this
   code:

````code
public function __invoke(...)
{
  if (isset($record['ifile'])) {

     $record['image-block' = <<<EOS
```{figure} images/{$record['file']}
:class: image-override
```

  else {
     $record['image-block'] = "";    
  }  

}


````
2. In `MarkdownCreator::__invoke()` if 
