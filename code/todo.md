# TODO

The code now works except for confirmations. This is because the
confirmation don't have any images and thus no MyST markdown "figure"
block; however, the code uses the sole markdown template that contains


```{figure} images/%ifile%
:class: image-override
```

and when %file% has no value to replace it, an excpet is thrown.

Perhaps I should special-case the Confirmations?
