# TODO

Class `KirchenbueherResults` now has a unrelated, readonly class variable
`$citation_string` that is assinged in the ctor, but which should be part
of inner workings of sa different abastraction like `Builder`, which would
be configured with `MarkdownCreator`. 
