# TODO

When processing 'Confirmation' records, the `Markdown::subst_variable()` throws an `\invalidArguemntExcpetion`
because confirmation records don't have any images and don't need the required MyST figure-directive below:

```{figure} images/%ifile%
:class: image-override
```

The confirmations don't have an `ifile:` key resulting in the excpetion.

The solution is to rewrite `~/gens/code/markdown_template.md` and entirely replace
the figure directive block within it with

%image-block%

The `Markdown::adjust_recorde()` method called by `__invoke()` then will check if `$record[iifile']` is
set. If it is, it will create the figure direction using the code below;
otherwise, it will set it to an empty string:


````code
public function set_values(...)
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
