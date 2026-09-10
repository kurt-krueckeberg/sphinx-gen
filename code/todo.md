# TODO

The code worsk, but the `~/gens/code/markdown_template.txt` has the event 
hardcoded as `baptism` regardless of the ceremony. The 'ceremony:' key's
value, which begins with an uppcase gets passed to the MarkdownCreator
ctor.

Solution:
Make the 'ceremony:' key's value all lowercase. change
`~/gens/code/markdown_template.txt` to use %even% instead of the hardcoded
'baptism'. Change it also to use in the H1 header %uevent% for
uppercase-event.

DONE!!
