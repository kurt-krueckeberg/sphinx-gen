# TODO

Class `KirchenbueherResults` now has a unrelated, readonly class variable
`$citation_string` that is assinged in the ctor, but has nothing to do with
the Kirchbuecher resuearch results. which should be part 
of the inner workings of a different abstraction like `Builder`, which in turn would
be configured with `MarkdownCreator`. 

For Builder pattern in PHP, see:

- <https://softwarepatternslexicon.com/php/creational-patterns-in-php/builder-pattern/>
- <https://dev.to/zhukmax/design-patterns-in-php-8-builder-2ike>
- <https://codesignal.com/learn/courses/creational-patterns-in-php/lessons/implementing-the-builder-pattern-in-php>
